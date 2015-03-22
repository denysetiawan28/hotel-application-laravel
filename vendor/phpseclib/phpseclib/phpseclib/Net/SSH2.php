<?php

/**
 * Pure-PHP implementation of SSHv2.
 *
 * PHP versions 4 and 5
 *
 * Here are some examples of how to use this library:
 * <code>
 * <?php
 *    include 'Net/SSH2.php';
 *
 *    $ssh = new Net_SSH2('www.domain.tld');
 *    if (!$ssh->login('username', 'password')) {
 *        exit('Login Failed');
 *    }
 *
 *    echo $ssh->exec('pwd');
 *    echo $ssh->exec('ls -la');
 * ?>
 * </code>
 *
 * <code>
 * <?php
 *    include 'Crypt/RSA.php';
 *    include 'Net/SSH2.php';
 *
 *    $key = new Crypt_RSA();
 *    //$key->setPassword('whatever');
 *    $key->loadKey(file_get_contents('privatekey'));
 *
 *    $ssh = new Net_SSH2('www.domain.tld');
 *    if (!$ssh->login('username', $key)) {
 *        exit('Login Failed');
 *    }
 *
 *    echo $ssh->read('username@username:~$');
 *    $ssh->write("ls -la\n");
 *    echo $ssh->read('username@username:~$');
 * ?>
 * </code>
 *
 * LICENSE: Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @category  Net
 * @package   Net_SSH2
 * @author    Jim Wigginton <terrafrost@php.net>
 * @copyright 2007 Jim Wigginton
 * @license   http://www.opensource.org/licenses/mit-license.html  MIT License
 * @link      http://phpseclib.sourceforge.net
 */

/**#@+
 * Execution Bitmap Masks
 *
 * @see Net_SSH2::bitmap
 * @access private
 */
define('NET_SSH2_MASK_CONSTRUCTOR',   0x00000001);
define('NET_SSH2_MASK_CONNECTED',     0x00000002);
define('NET_SSH2_MASK_LOGIN_REQ',     0x00000004);
define('NET_SSH2_MASK_LOGIN',         0x00000008);
define('NET_SSH2_MASK_SHELL',         0x00000010);
define('NET_SSH2_MASK_WINDOW_ADJUST', 0x00000020);
/**#@-*/

/**#@+
 * Channel constants
 *
 * RFC4254 refers not to client and server channels but rather to sender and recipient channels.  we don't refer
 * to them in that way because RFC4254 toggles the meaning. the client sends a SSH_MSG_CHANNEL_OPEN message with
 * a sender channel and the server sends a SSH_MSG_CHANNEL_OPEN_CONFIRMATION in response, with a sender and a
 * recepient channel.  at first glance, you might conclude that SSH_MSG_CHANNEL_OPEN_CONFIRMATION's sender channel
 * would be the same thing as SSH_MSG_CHANNEL_OPEN's sender channel, but it's not, per this snipet:
 *     The 'recipient channel' is the channel number given in the original
 *     open request, and 'sender channel' is the channel number allocated by
 *     the other side.
 *
 * @see Net_SSH2::_send_channel_packet()
 * @see Net_SSH2::_get_channel_packet()
 * @access private
 */
define('NET_SSH2_CHANNEL_EXEC',      0); // PuTTy uses 0x100
define('NET_SSH2_CHANNEL_SHELL',     1);
define('NET_SSH2_CHANNEL_SUBSYSTEM', 2);
/**#@-*/

/**#@+
 * @access public
 * @see Net_SSH2::getLog()
 */
/**
 * Returns the message numbers
 */
define('NET_SSH2_LOG_SIMPLE',  1);
/**
 * Returns the message content
 */
define('NET_SSH2_LOG_COMPLEX', 2);
/**
 * Outputs the content real-time
 */
define('NET_SSH2_LOG_REALTIME', 3);
/**
 * Dumps the content real-time to a file
 */
define('NET_SSH2_LOG_REALTIME_FILE', 4);
/**#@-*/

/**#@+
 * @access public
 * @see Net_SSH2::read()
 */
/**
 * Returns when a string matching $expect exactly is found
 */
define('NET_SSH2_READ_SIMPLE',  1);
/**
 * Returns when a string matching the regular expression $expect is found
 */
define('NET_SSH2_READ_REGEX', 2);
/**
 * Make sure that the log never gets larger than this
 */
define('NET_SSH2_LOG_MAX_SIZE', 1024 * 1024);
/**#@-*/

/**
 * Pure-PHP implementation of SSHv2.
 *
 * @package Net_SSH2
 * @author  Jim Wigginton <terrafrost@php.net>
 * @access  public
 */
class Net_SSH2
{
    /**
     * The SSH identifier
     *
     * @var String
     * @access private
     */
    var $identifier;

    /**
     * The Socket Object
     *
     * @var Object
     * @access private
     */
    var $fsock;

    /**
     * Execution Bitmap
     *
     * The bits that are set represent functions that have been called already.  This is used to determine
     * if a requisite function has been successfully executed.  If not, an error should be thrown.
     *
     * @var Integer
     * @access private
     */
    var $bitmap = 0;

    /**
     * Error information
     *
     * @see Net_SSH2::getErrors()
     * @see Net_SSH2::getLastError()
     * @var String
     * @access private
     */
    var $errors = array();

    /**
     * Server Identifier
     *
     * @see Net_SSH2::getServerIdentification()
     * @var mixed false or Array
     * @access private
     */
    var $server_identifier = false;

    /**
     * Key Exchange Algorithms
     *
     * @see Net_SSH2::getKexAlgorithims()
     * @var mixed false or Array
     * @access private
     */
    var $kex_algorithms = false;

    /**
     * Server Host Key Algorithms
     *
     * @see Net_SSH2::getServerHostKeyAlgorithms()
     * @var mixed false or Array
     * @access private
     */
    var $server_host_key_algorithms = false;

    /**
     * Encryption Algorithms: Client to Server
     *
     * @see Net_SSH2::getEncryptionAlgorithmsClient2Server()
     * @var mixed false or Array
     * @access private
     */
    var $encryption_algorithms_client_to_server = false;

    /**
     * Encryption Algorithms: Server to Client
     *
     * @see Net_SSH2::getEncryptionAlgorithmsServer2Client()
     * @var mixed false or Array
     * @access private
     */
    var $encryption_algorithms_server_to_client = false;

    /**
     * MAC Algorithms: Client to Server
     *
     * @see Net_SSH2::getMACAlgorithmsClient2Server()
     * @var mixed false or Array
     * @access private
     */
    var $mac_algorithms_client_to_server = false;

    /**
     * MAC Algorithms: Server to Client
     *
     * @see Net_SSH2::getMACAlgorithmsServer2Client()
     * @var mixed false or Array
     * @access private
     */
    var $mac_algorithms_server_to_client = false;

    /**
     * Compression Algorithms: Client to Server
     *
     * @see Net_SSH2::getCompressionAlgorithmsClient2Server()
     * @var mixed false or Array
     * @access private
     */
    var $compression_algorithms_client_to_server = false;

    /**
     * Compression Algorithms: Server to Client
     *
     * @see Net_SSH2::getCompressionAlgorithmsServer2Client()
     * @var mixed false or Array
     * @access private
     */
    var $compression_algorithms_server_to_client = false;

    /**
     * Languages: Server to Client
     *
     * @see Net_SSH2::getLanguagesServer2Client()
     * @var mixed false or Array
     * @access private
     */
    var $languages_server_to_client = false;

    /**
     * Languages: Client to Server
     *
     * @see Net_SSH2::getLanguagesClient2Server()
     * @var mixed false or Array
     * @access private
     */
    var $languages_client_to_server = false;

    /**
     * Block Size for Server to Client Encryption
     *
     * "Note that the length of the concatenation of 'packet_length',
     *  'padding_length', 'payload', and 'random padding' MUST be a multiple
     *  of the cipher block size or 8, whichever is larger.  This constraint
     *  MUST be enforced, even when using stream ciphers."
     *
     *  -- http://tools.ietf.org/html/rfc4253#section-6
     *
     * @see Net_SSH2::Net_SSH2()
     * @see Net_SSH2::_send_binary_packet()
     * @var Integer
     * @access private
     */
    var $encrypt_block_size = 8;

    /**
     * Block Size for Client to Server Encryption
     *
     * @see Net_SSH2::Net_SSH2()
     * @see Net_SSH2::_get_binary_packet()
     * @var Integer
     * @access private
     */
    var $decrypt_block_size = 8;

    /**
     * Server to Client Encryption Object
     *
     * @see Net_SSH2::_get_binary_packet()
     * @var Object
     * @access private
     */
    var $decrypt = false;

    /**
     * Client to Server Encryption Object
     *
     * @see Net_SSH2::_send_binary_packet()
     * @var Object
     * @access private
     */
    var $encrypt = false;

    /**
     * Client to Server HMAC Object
     *
     * @see Net_SSH2::_send_binary_packet()
     * @var Object
     * @access private
     */
    var $hmac_create = false;

    /**
     * Server to Client HMAC Object
     *
     * @see Net_SSH2::_get_binary_packet()
     * @var Object
     * @access private
     */
    var $hmac_check = false;

    /**
     * Size of server to client HMAC
     *
     * We need to know how big the HMAC will be for the server to client direction so that we know how many bytes to read.
     * For the client to server side, the HMAC object will make the HMAC as long as it needs to be.  All we need to do is
     * append it.
     *
     * @see Net_SSH2::_get_binary_packet()
     * @var Integer
     * @access private
     */
    var $hmac_size = false;

    /**
     * Server Public Host Key
     *
     * @see Net_SSH2::getServerPublicHostKey()
     * @var String
     * @access private
     */
    var $server_public_host_key;

    /**
     * Session identifer
     *
     * "The exchange hash H from the first key exchange is additionally
     *  used as the session identifier, which is a unique identifier for
     *  this connection."
     *
     *  -- http://tools.ietf.org/html/rfc4253#section-7.2
     *
     * @see Net_SSH2::_key_exchange()
     * @var String
     * @access private
     */
    var $session_id = false;

    /**
     * Exchange hash
     *
     * The current exchange hash
     *
     * @see Net_SSH2::_key_exchange()
     * @var String
     * @access private
     */
    var $exchange_hash = false;

    /**
     * Message Numbers
     *
     * @see Net_SSH2::Net_SSH2()
     * @var Array
     * @access private
     */
    var $message_numbers = array();

    /**
     * Disconnection Message 'reason codes' defined in RFC4253
     *
     * @see Net_SSH2::Net_SSH2()
     * @var Array
     * @access private
     */
    var $disconnect_reasons = array();

    /**
     * SSH_MSG_CHANNEL_OPEN_FAILURE 'reason codes', defined in RFC4254
     *
     * @see Net_SSH2::Net_SSH2()
     * @var Array
     * @access private
     */
    var $channel_open_failure_reasons = array();

    /**
     * Terminal Modes
     *
     * @link http://tools.ietf.org/html/rfc4254#section-8
     * @see Net_SSH2::Net_SSH2()
     * @var Array
     * @access private
     */
    var $terminal_modes = array();

    /**
     * SSH_MSG_CHANNEL_EXTENDED_DATA's data_type_codes
     *
     * @link http://tools.ietf.org/html/rfc4254#section-5.2
     * @see Net_SSH2::Net_SSH2()
     * @var Array
     * @access private
     */
    var $channel_extended_data_type_codes = array();

    /**
     * Send Sequence Number
     *
     * See 'Section 6.4.  Data Integrity' of rfc4253 for more info.
     *
     * @see Net_SSH2::_send_binary_packet()
     * @var Integer
     * @access private
     */
    var $send_seq_no = 0;

    /**
     * Get Sequence Number
     *
     * See 'Section 6.4.  Data Integrity' of rfc4253 for more info.
     *
     * @see Net_SSH2::_get_binary_packet()
     * @var Integer
     * @access private
     */
    var $get_seq_no = 0;

    /**
     * Server Channels
     *
     * Maps client channels to server channels
     *
     * @see Net_SSH2::_get_channel_packet()
     * @see Net_SSH2::exec()
     * @var Array
     * @access private
     */
    var $server_channels = array();

    /**
     * Channel Buffers
     *
     * If a client requests a packet from one channel but receives two packets from another those packets should
     * be placed in a buffer
     *
     * @see Net_SSH2::_get_channel_packet()
     * @see Net_SSH2::exec()
     * @var Array
     * @access private
     */
    var $channel_buffers = array();

    /**
     * Channel Status
     *
     * Contains the type of the last sent message
     *
     * @see Net_SSH2::_get_channel_packet()
     * @var Array
     * @access private
     */
    var $channel_status = array();

    /**
     * Packet Size
     *
     * Maximum packet size indexed by channel
     *
     * @see Net_SSH2::_send_channel_packet()
     * @var Array
     * @access private
     */
    var $packet_size_client_to_server = array();

    /**
     * Message Number Log
     *
     * @see Net_SSH2::getLog()
     * @var Array
     * @access private
     */
    var $message_number_log = array();

    /**
     * Message Log
     *
     * @see Net_SSH2::getLog()
     * @var Array
     * @access private
     */
    var $message_log = array();

    /**
     * The Window Size
     *
     * Bytes the other party can send before it must wait for the window to be adjusted (0x7FFFFFFF = 2GB)
     *
     * @var Integer
     * @see Net_SSH2::_send_channel_packet()
     * @see Net_SSH2::exec()
     * @access private
     */
    var $window_size = 0x7FFFFFFF;

    /**
     * Window size, server to client
     *
     * Window size indexed by channel
     *
     * @see Net_SSH2::_send_channel_packet()
     * @var Array
     * @access private
     */
    var $window_size_server_to_client = array();

    /**
     * Window size, client to server
     *
     * Window size indexed by channel
     *
     * @see Net_SSH2::_get_channel_packet()
     * @var Array
     * @access private
     */
    var $window_size_client_to_server = array();

    /**
     * Server signature
     *
     * Verified against $this->session_id
     *
     * @see Net_SSH2::getServerPublicHostKey()
     * @var String
     * @access private
     */
    var $signature = '';

    /**
     * Server signature format
     *
     * ssh-rsa or ssh-dss.
     *
     * @see Net_SSH2::getServerPublicHostKey()
     * @var String
     * @access private
     */
    var $signature_format = '';

    /**
     * Interactive Buffer
     *
     * @see Net_SSH2::read()
     * @var Array
     * @access private
     */
    var $interactiveBuffer = '';

    /**
     * Current log size
     *
     * Should never exceed NET_SSH2_LOG_MAX_SIZE
     *
     * @see Net_SSH2::_send_binary_packet()
     * @see Net_SSH2::_get_binary_packet()
     * @var Integer
     * @access private
     */
    var $log_size;

    /**
     * Timeout
     *
     * @see Net_SSH2::setTimeout()
     * @access private
     */
    var $timeout;

    /**
     * Current Timeout
     *
     * @see Net_SSH2::_get_channel_packet()
     * @access private
     */
    var $curTimeout;

    /**
     * Real-time log file pointer
     *
     * @see Net_SSH2::_append_log()
     * @var Resource
     * @access private
     */
    var $realtime_log_file;

    /**
     * Real-time log file size
     *
     * @see Net_SSH2::_append_log()
     * @var Integer
     * @access private
     */
    var $realtime_log_size;

    /**
     * Has the signature been validated?
     *
     * @see Net_SSH2::getServerPublicHostKey()
     * @var Boolean
     * @access private
     */
    var $signature_validated = false;

    /**
     * Real-time log file wrap boolean
     *
     * @see Net_SSH2::_append_log()
     * @access private
     */
    var $realtime_log_wrap;

    /**
     * Flag to suppress stderr from output
     *
     * @see Net_SSH2::enableQuietMode()
     * @access private
     */
    var $quiet_mode = false;

    /**
     * Time of first network activity
     *
     * @var Integer
     * @access private
     */
    var $last_packet;

    /**
     * Exit status returned from ssh if any
     *
     * @var Integer
     * @access private
     */
    var $exit_status;

    /**
     * Flag to request a PTY when using exec()
     *
     * @var Boolean
     * @see Net_SSH2::enablePTY()
     * @access private
     */
    var $request_pty = false;

    /**
     * Flag set while exec() is running when using enablePTY()
     *
     * @var Boolean
     * @access private
     */
    var $in_request_pty_exec = false;

    /**
     * Flag set after startSubsystem() is called
     *
     * @var Boolean
     * @access private
     */
    var $in_subsystem;

    /**
     * Contents of stdError
     *
     * @var String
     * @access private
     */
    var $stdErrorLog;

    /**
     * The Last Interactive Response
     *
     * @see Net_SSH2::_keyboard_interactive_process()
     * @var String
     * @access private
     */
    var $last_interactive_response = '';

    /**
     * Keyboard Interactive Request / Responses
     *
     * @see Net_SSH2::_keyboard_interactive_process()
     * @var Array
     * @access private
     */
    var $keyboard_requests_responses = array();

    /**
     * Banner Message
     *
     * Quoting from the RFC, "in some jurisdictions, sending a warning message before
     * authentication may be relevant for getting legal protection."
     *
     * @see Net_SSH2::_filter()
     * @see Net_SSH2::getBannerMessage()
     * @var String
     * @access private
     */
    var $banner_message = '';

    /**
     * Did read() timeout or return normally?
     *
     * @see Net_SSH2::isTimeout()
     * @var Boolean
     * @access private
     */
    var $is_timeout = false;

    /**
     * Log Boundary
     *
     * @see Net_SSH2::_format_log()
     * @var String
     * @access private
     */
    var $log_boundary = ':';

    /**
     * Log Long Width
     *
     * @see Net_SSH2::_format_log()
     * @var Integer
     * @access private
     */
    var $log_long_width = 65;

    /**
     * Log Short Width
     *
     * @see Net_SSH2::_format_log()
     * @var Integer
     * @access private
     */
    var $log_short_width = 16;

    /**
     * Hostname
     *
     * @see Net_SSH2::Net_SSH2()
     * @see Net_SSH2::_connect()
     * @var String
     * @access private
     */
    var $host;

    /**
     * Port Number
     *
     * @see Net_SSH2::Net_SSH2()
     * @see Net_SSH2::_connect()
     * @var Integer
     * @access private
     */
    var $port;

    /**
     * Timeout for initial connection
     *
     * Set by the constructor call. Calling setTimeout() is optional. If it's not called functions like
     * exec() won't timeout unless some PHP setting forces it too. The timeout specified in the constructor,
     * however, is non-optional. There will be a timeout, whether or not you set it. If you don't it'll be
     * 10 seconds. It is used by fsockopen() and the initial stream_select in that function.
     *
     * @see Net_SSH2::Net_SSH2()
     * @see Net_SSH2::_connect()
     * @var Integer
     * @access private
     */
    var $connectionTimeout;

    /**
     * Number of columns for terminal window size
     *
     * @see Net_SSH2::getWindowColumns()
     * @see Net_SSH2::setWindowColumns()
     * @see Net_SSH2::setWindowSize()
     * @var Integer
     * @access private
     */
    var $windowColumns = 80;

    /**
     * Number of columns for terminal window size
     *
     * @see Net_SSH2::getWindowRows()
     * @see Net_SSH2::setWindowRows()
     * @see Net_SSH2::setWindowSize()
     * @var Integer
     * @access private
     */
    var $windowRows = 24;

    /**
     * Default Constructor.
     *
     * @param String $host
     * @param optional Integer $port
     * @param optional Integer $timeout
     * @see Net_SSH2::login()
     * @return Net_SSH2
     * @access public
     */
    function Net_SSH2($host, $port = 22, $timeout = 10)
    {
        // Include Math_BigInteger
        // Used to do Diffie-Hellman key exchange and DSA/RSA signature verification.
        if (!class_exists('Math_BigInteger')) {
            include_once 'Math/BigInteger.php';
        }

        if (!function_exists('crypt_random_string')) {
            include_once 'Crypt/Random.php';
        }

        if (!class_exists('Crypt_Hash')) {
            include_once 'Crypt/Hash.php';
        }

        $this->message_numbers = array(
            1 => 'NET_SSH2_MSG_DISCONNECT',
            2 => 'NET_SSH2_MSG_IGNORE',
            3 => 'NET_SSH2_MSG_UNIMPLEMENTED',
            4 => 'NET_SSH2_MSG_DEBUG',
            5 => 'NET_SSH2_MSG_SERVICE_REQUEST',
            6 => 'NET_SSH2_MSG_SERVICE_ACCEPT',
            20 => 'NET_SSH2_MSG_KEXINIT',
            21 => 'NET_SSH2_MSG_NEWKEYS',
            30 => 'NET_SSH2_MSG_KEXDH_INIT',
            31 => 'NET_SSH2_MSG_KEXDH_REPLY',
            50 => 'NET_SSH2_MSG_USERAUTH_REQUEST',
            51 => 'NET_SSH2_MSG_USERAUTH_FAILURE',
            52 => 'NET_SSH2_MSG_USERAUTH_SUCCESS',
            53 => 'NET_SSH2_MSG_USERAUTH_BANNER',

            80 => 'NET_SSH2_MSG_GLOBAL_REQUEST',
            81 => 'NET_SSH2_MSG_REQUEST_SUCCESS',
            82 => 'NET_SSH2_MSG_REQUEST_FAILURE',
            90 => 'NET_SSH2_MSG_CHANNEL_OPEN',
            91 => 'NET_SSH2_MSG_CHANNEL_OPEN_CONFIRMATION',
            92 => 'NET_SSH2_MSG_CHANNEL_OPEN_FAILURE',
            93 => 'NET_SSH2_MSG_CHANNEL_WINDOW_ADJUST',
            94 => 'NET_SSH2_MSG_CHANNEL_DATA',
            95 => 'NET_SSH2_MSG_CHANNEL_EXTENDED_DATA',
            96 => 'NET_SSH2_MSG_CHANNEL_EOF',
            97 => 'NET_SSH2_MSG_CHANNEL_CLOSE',
            98 => 'NET_SSH2_MSG_CHANNEL_REQUEST',
            99 => 'NET_SSH2_MSG_CHANNEL_SUCCESS',
            100 => 'NET_SSH2_MSG_CHANNEL_FAILURE'
        );
        $this->disconnect_reasons = array(
            1 => 'NET_SSH2_DISCONNECT_HOST_NOT_ALLOWED_TO_CONNECT',
            2 => 'NET_SSH2_DISCONNECT_PROTOCOL_ERROR',
            3 => 'NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED',
            4 => 'NET_SSH2_DISCONNECT_RESERVED',
            5 => 'NET_SSH2_DISCONNECT_MAC_ERROR',
            6 => 'NET_SSH2_DISCONNECT_COMPRESSION_ERROR',
            7 => 'NET_SSH2_DISCONNECT_SERVICE_NOT_AVAILABLE',
            8 => 'NET_SSH2_DISCONNECT_PROTOCOL_VERSION_NOT_SUPPORTED',
            9 => 'NET_SSH2_DISCONNECT_HOST_KEY_NOT_VERIFIABLE',
            10 => 'NET_SSH2_DISCONNECT_CONNECTION_LOST',
            11 => 'NET_SSH2_DISCONNECT_BY_APPLICATION',
            12 => 'NET_SSH2_DISCONNECT_TOO_MANY_CONNECTIONS',
            13 => 'NET_SSH2_DISCONNECT_AUTH_CANCELLED_BY_USER',
            14 => 'NET_SSH2_DISCONNECT_NO_MORE_AUTH_METHODS_AVAILABLE',
            15 => 'NET_SSH2_DISCONNECT_ILLEGAL_USER_NAME'
        );
        $this->channel_open_failure_reasons = array(
            1 => 'NET_SSH2_OPEN_ADMINISTRATIVELY_PROHIBITED'
        );
        $this->terminal_modes = array(
            0 => 'NET_SSH2_TTY_OP_END'
        );
        $this->channel_extended_data_type_codes = array(
            1 => 'NET_SSH2_EXTENDED_DATA_STDERR'
        );

        $this->_define_array(
            $this->message_numbers,
            $this->disconnect_reasons,
            $this->channel_open_failure_reasons,
            $this->terminal_modes,
            $this->channel_extended_data_type_codes,
            array(60 => 'NET_SSH2_MSG_USERAUTH_PASSWD_CHANGEREQ'),
            array(60 => 'NET_SSH2_MSG_USERAUTH_PK_OK'),
            array(60 => 'NET_SSH2_MSG_USERAUTH_INFO_REQUEST',
                  61 => 'NET_SSH2_MSG_USERAUTH_INFO_RESPONSE')
        );

        $this->host = $host;
        $this->port = $port;
        $this->connectionTimeout = $timeout;
    }

    /**
     * Connect to an SSHv2 server
     *
     * @return Boolean
     * @access private
     */
    function _connect()
    {
        if ($this->bitmap & NET_SSH2_MASK_CONSTRUCTOR) {
            return false;
        }

        $this->bitmap |= NET_SSH2_MASK_CONSTRUCTOR;

        $timeout = $this->connectionTimeout;
        $host = $this->host . ':' . $this->port;

        $this->last_packet = strtok(microtime(), ' ') + strtok(''); // == microtime(true) in PHP5

        $start = strtok(microtime(), ' ') + strtok(''); // http://php.net/microtime#61838
        $this->fsock = @fsockopen($this->host, $this->port, $errno, $errstr, $timeout);
        if (!$this->fsock) {
            user_error(rtrim("Cannot connect to $host. Error $errno. $errstr"));
            return false;
        }
        $elapsed = strtok(microtime(), ' ') + strtok('') - $start;

        $timeout-= $elapsed;

        if ($timeout <= 0) {
            user_error("Cannot connect to $host. Timeout error");
            return false;
        }

        $read = array($this->fsock);
        $write = $except = null;

        $sec = floor($timeout);
        $usec = 1000000 * ($timeout - $sec);

        // on windows this returns a "Warning: Invalid CRT parameters detected" error
        // the !count() is done as a workaround for <https://bugs.php.net/42682>
        if (!@stream_select($read, $write, $except, $sec, $usec) && !count($read)) {
            user_error("Cannot connect to $host. Banner timeout");
            return false;
        }

        /* According to the SSH2 specs,

          "The server MAY send other lines of data before sending the version
           string.  Each line SHOULD be terminated by a Carriage Return and Line
           Feed.  Such lines MUST NOT begin with "SSH-", and SHOULD be encoded
           in ISO-10646 UTF-8 [RFC3629] (language is not specified).  Clients
           MUST be able to process such lines." */
        $temp = '';
        $extra = '';
        while (!feof($this->fsock) && !preg_match('#^SSH-(\d\.\d+)#', $temp, $matches)) {
            if (substr($temp, -2) == "\r\n") {
                $extra.= $temp;
                $temp = '';
            }
            $temp.= fgets($this->fsock, 255);
        }

        if (feof($this->fsock)) {
            user_error('Connection closed by server');
            return false;
        }

        $this->identifier = $this->_generate_identifier();

        if (defined('NET_SSH2_LOGGING')) {
            $this->_append_log('<-', $extra . $temp);
            $this->_append_log('->', $this->identifier . "\r\n");
        }

        $this->server_identifier = trim($temp, "\r\n");
        if (strlen($extra)) {
            $this->errors[] = utf8_decode($extra);
        }

        if ($matches[1] != '1.99' && $matches[1] != '2.0') {
            user_error("Cannot connect to SSH $matches[1] servers");
            return false;
        }

        fputs($this->fsock, $this->identifier . "\r\n");

        $response = $this->_get_binary_packet();
        if ($response === false) {
            user_error('Connection closed by server');
            return false;
        }

        if (ord($response[0]) != NET_SSH2_MSG_KEXINIT) {
            user_error('Expected SSH_MSG_KEXINIT');
            return false;
        }

        if (!$this->_key_exchange($response)) {
            return false;
        }

        $this->bitmap|= NET_SSH2_MASK_CONNECTED;

        return true;
    }

    /**
     * Generates the SSH identifier
     *
     * You should overwrite this method in your own class if you want to use another identifier
     *
     * @access protected
     * @return String
     */
    function _generate_identifier()
    {
        $identifier = 'SSH-2.0-phpseclib_0.3';

        $ext = array();
        if (extension_loaded('mcrypt')) {
            $ext[] = 'mcrypt';
        }

        if (extension_loaded('gmp')) {
            $ext[] = 'gmp';
        } elseif (extension_loaded('bcmath')) {
            $ext[] = 'bcmath';
        }

        if (!empty($ext)) {
            $identifier .= ' (' . implode(', ', $ext) . ')';
        }

        return $identifier;
    }

    /**
     * Key Exchange
     *
     * @param String $kexinit_payload_server
     * @access private
     */
    function _key_exchange($kexinit_payload_server)
    {
        static $kex_algorithms = array(
            'diffie-hellman-group1-sha1', // REQUIRED
            'diffie-hellman-group14-sha1' // REQUIRED
        );

        static $server_host_key_algorithms = array(
            'ssh-rsa', // RECOMMENDED  sign   Raw RSA Key
            'ssh-dss'  // REQUIRED     sign   Raw DSS Key
        );

        static $encryption_algorithms = false;
        if ($encryption_algorithms === false) {
            $encryption_algorithms = array(
                // from <http://tools.ietf.org/html/rfc4345#section-4>:
                'arcfour256',
                'arcfour128',

                //'arcfour',        // OPTIONAL          the ARCFOUR stream cipher with a 128-bit key

                // CTR modes from <http://tools.ietf.org/html/rfc4344#section-4>:
                'aes128-ctr',     // RECOMMENDED       AES (Rijndael) in SDCTR mode, with 128-bit key
                'aes192-ctr',     // RECOMMENDED       AES with 192-bit key
                'aes256-ctr',     // RECOMMENDED       AES with 256-bit key

                'twofish128-ctr', // OPTIONAL          Twofish in SDCTR mode, with 128-bit key
                'twofish192-ctr', // OPTIONAL          Twofish with 192-bit key
                'twofish256-ctr', // OPTIONAL          Twofish with 256-bit key

                'aes128-cbc',     // RECOMMENDED       AES with a 128-bit key
                'aes192-cbc',     // OPTIONAL          AES with a 192-bit key
                'aes256-cbc',     // OPTIONAL          AES in CBC mode, with a 256-bit key

                'twofish128-cbc', // OPTIONAL          Twofish with a 128-bit key
                'twofish192-cbc', // OPTIONAL          Twofish with a 192-bit key
                'twofish256-cbc',
                'twofish-cbc',    // OPTIONAL          alias for "twofish256-cbc"
                                  //                   (this is being retained for historical reasons)

                'blowfish-ctr',   // OPTIONAL          Blowfish in SDCTR mode

                'blowfish-cbc',   // OPTIONAL          Blowfish in CBC mode

                '3des-ctr',       // RECOMMENDED       Three-key 3DES in SDCTR mode

                '3des-cbc',       // REQUIRED          three-key 3DES in CBC mode
                //'none'            // OPTIONAL          no encryption; NOT RECOMMENDED
            );

            if (phpseclib_resolve_include_path('Crypt/RC4.php') === false) {
                $encryption_algorithms = array_diff(
                    $encryption_algorithms,
                    array('arcfour256', 'arcfour128', 'arcfour')
                );
            }
            if (phpseclib_resolve_include_path('Crypt/Rijndael.php') === false) {
                $encryption_algorithms = array_diff(
                    $encryption_algorithms,
                    array('aes128-ctr', 'aes192-ctr', 'aes256-ctr', 'aes128-cbc', 'aes192-cbc', 'aes256-cbc')
                );
            }
            if (phpseclib_resolve_include_path('Crypt/Twofish.php') === false) {
                $encryption_algorithms = array_diff(
                    $encryption_algorithms,
                    array('twofish128-ctr', 'twofish192-ctr', 'twofish256-ctr', 'twofish128-cbc', 'twofish192-cbc', 'twofish256-cbc', 'twofish-cbc')
                );
            }
            if (phpseclib_resolve_include_path('Crypt/Blowfish.php') === false) {
                $encryption_algorithms = array_diff(
                    $encryption_algorithms,
                    array('blowfish-ctr', 'blowfish-cbc')
                );
            }
            if (phpseclib_resolve_include_path('Crypt/TripleDES.php') === false) {
                $encryption_algorithms = array_diff(
                    $encryption_algorithms,
                    array('3des-ctr', '3des-cbc')
                );
            }
            $encryption_algorithms = array_values($encryption_algorithms);
        }

        $mac_algorithms = array(
            // from <http://www.ietf.org/rfc/rfc6668.txt>:
            'hmac-sha2-256',// RECOMMENDED     HMAC-SHA256 (digest length = key length = 32)

            'hmac-sha1-96', // RECOMMENDED     first 96 bits of HMAC-SHA1 (digest length = 12, key length = 20)
            'hmac-sha1',    // REQUIRED        HMAC-SHA1 (digest length = key length = 20)
            'hmac-md5-96',  // OPTIONAL        first 96 bits of HMAC-MD5 (digest length = 12, key length = 16)
            'hmac-md5',     // OPTIONAL        HMAC-MD5 (digest length = key length = 16)
            //'none'          // OPTIONAL        no MAC; NOT RECOMMENDED
        );

        static $compression_algorithms = array(
            'none'   // REQUIRED        no compression
            //'zlib' // OPTIONAL        ZLIB (LZ77) compression
        );

        // some SSH servers have buggy implementations of some of the above algorithms
        switch ($this->server_identifier) {
            case 'SSH-2.0-SSHD':
                $mac_algorithms = array_values(array_diff(
                    $mac_algorithms,
                    array('hmac-sha1-96', 'hmac-md5-96')
                ));
        }

        static $str_kex_algorithms, $str_server_host_key_algorithms,
               $encryption_algorithms_server_to_client, $mac_algorithms_server_to_client, $compression_algorithms_server_to_client,
               $encryption_algorithms_client_to_server, $mac_algorithms_client_to_server, $compression_algorithms_client_to_server;

        if (empty($str_kex_algorithms)) {
            $str_kex_algorithms = implode(',', $kex_algorithms);
            $str_server_host_key_algorithms = implode(',', $server_host_key_algorithms);
            $encryption_algorithms_server_to_client = $encryption_algorithms_client_to_server = implode(',', $encryption_algorithms);
            $mac_algorithms_server_to_client = $mac_algorithms_client_to_server = implode(',', $mac_algorithms);
            $compression_algorithms_server_to_client = $compression_algorithms_client_to_server = implode(',', $compression_algorithms);
        }

        $client_cookie = crypt_random_string(16);

        $response = $kexinit_payload_server;
        $this->_string_shift($response, 1); // skip past the message number (it should be SSH_MSG_KEXINIT)
        $server_cookie = $this->_string_shift($response, 16);

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->kex_algorithms = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->server_host_key_algorithms = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->encryption_algorithms_client_to_server = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->encryption_algorithms_server_to_client = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->mac_algorithms_client_to_server = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->mac_algorithms_server_to_client = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->compression_algorithms_client_to_server = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->compression_algorithms_server_to_client = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->languages_client_to_server = explode(',', $this->_string_shift($response, $temp['length']));

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->languages_server_to_client = explode(',', $this->_string_shift($response, $temp['length']));

        extract(unpack('Cfirst_kex_packet_follows', $this->_string_shift($response, 1)));
        $first_kex_packet_follows = $first_kex_packet_follows != 0;

        // the sending of SSH2_MSG_KEXINIT could go in one of two places.  this is the second place.
        $kexinit_payload_client = pack('Ca*Na*Na*Na*Na*Na*Na*Na*Na*Na*Na*CN',
            NET_SSH2_MSG_KEXINIT, $client_cookie, strlen($str_kex_algorithms), $str_kex_algorithms,
            strlen($str_server_host_key_algorithms), $str_server_host_key_algorithms, strlen($encryption_algorithms_client_to_server),
            $encryption_algorithms_client_to_server, strlen($encryption_algorithms_server_to_client), $encryption_algorithms_server_to_client,
            strlen($mac_algorithms_client_to_server), $mac_algorithms_client_to_server, strlen($mac_algorithms_server_to_client),
            $mac_algorithms_server_to_client, strlen($compression_algorithms_client_to_server), $compression_algorithms_client_to_server,
            strlen($compression_algorithms_server_to_client), $compression_algorithms_server_to_client, 0, '', 0, '',
            0, 0
        );

        if (!$this->_send_binary_packet($kexinit_payload_client)) {
            return false;
        }
        // here ends the second place.

        // we need to decide upon the symmetric encryption algorithms before we do the diffie-hellman key exchange
        for ($i = 0; $i < count($encryption_algorithms) && !in_array($encryption_algorithms[$i], $this->encryption_algorithms_server_to_client); $i++);
        if ($i == count($encryption_algorithms)) {
            user_error('No compatible server to client encryption algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }

        // we don't initialize any crypto-objects, yet - we do that, later. for now, we need the lengths to make the
        // diffie-hellman key exchange as fast as possible
        $decrypt = $encryption_algorithms[$i];
        switch ($decrypt) {
            case '3des-cbc':
            case '3des-ctr':
                $decryptKeyLength = 24; // eg. 192 / 8
                break;
            case 'aes256-cbc':
            case 'aes256-ctr':
            case 'twofish-cbc':
            case 'twofish256-cbc':
            case 'twofish256-ctr':
                $decryptKeyLength = 32; // eg. 256 / 8
                break;
            case 'aes192-cbc':
            case 'aes192-ctr':
            case 'twofish192-cbc':
            case 'twofish192-ctr':
                $decryptKeyLength = 24; // eg. 192 / 8
                break;
            case 'aes128-cbc':
            case 'aes128-ctr':
            case 'twofish128-cbc':
            case 'twofish128-ctr':
            case 'blowfish-cbc':
            case 'blowfish-ctr':
                $decryptKeyLength = 16; // eg. 128 / 8
                break;
            case 'arcfour':
            case 'arcfour128':
                $decryptKeyLength = 16; // eg. 128 / 8
                break;
            case 'arcfour256':
                $decryptKeyLength = 32; // eg. 128 / 8
                break;
            case 'none';
                $decryptKeyLength = 0;
        }

        for ($i = 0; $i < count($encryption_algorithms) && !in_array($encryption_algorithms[$i], $this->encryption_algorithms_client_to_server); $i++);
        if ($i == count($encryption_algorithms)) {
            user_error('No compatible client to server encryption algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }

        $encrypt = $encryption_algorithms[$i];
        switch ($encrypt) {
            case '3des-cbc':
            case '3des-ctr':
                $encryptKeyLength = 24;
                break;
            case 'aes256-cbc':
            case 'aes256-ctr':
            case 'twofish-cbc':
            case 'twofish256-cbc':
            case 'twofish256-ctr':
                $encryptKeyLength = 32;
                break;
            case 'aes192-cbc':
            case 'aes192-ctr':
            case 'twofish192-cbc':
            case 'twofish192-ctr':
                $encryptKeyLength = 24;
                break;
            case 'aes128-cbc':
            case 'aes128-ctr':
            case 'twofish128-cbc':
            case 'twofish128-ctr':
            case 'blowfish-cbc':
            case 'blowfish-ctr':
                $encryptKeyLength = 16;
                break;
            case 'arcfour':
            case 'arcfour128':
                $encryptKeyLength = 16;
                break;
            case 'arcfour256':
                $encryptKeyLength = 32;
                break;
            case 'none';
                $encryptKeyLength = 0;
        }

        $keyLength = $decryptKeyLength > $encryptKeyLength ? $decryptKeyLength : $encryptKeyLength;

        // through diffie-hellman key exchange a symmetric key is obtained
        for ($i = 0; $i < count($kex_algorithms) && !in_array($kex_algorithms[$i], $this->kex_algorithms); $i++);
        if ($i == count($kex_algorithms)) {
            user_error('No compatible key exchange algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }

        switch ($kex_algorithms[$i]) {
            // see http://tools.ietf.org/html/rfc2409#section-6.2 and
            // http://tools.ietf.org/html/rfc2412, appendex E
            case 'diffie-hellman-group1-sha1':
                $prime = 'FFFFFFFFFFFFFFFFC90FDAA22168C234C4C6628B80DC1CD129024E088A67CC74' .
                         '020BBEA63B139B22514A08798E3404DDEF9519B3CD3A431B302B0A6DF25F1437' .
                         '4FE1356D6D51C245E485B576625E7EC6F44C42E9A637ED6B0BFF5CB6F406B7ED' .
                         'EE386BFB5A899FA5AE9F24117C4B1FE649286651ECE65381FFFFFFFFFFFFFFFF';
                break;
            // see http://tools.ietf.org/html/rfc3526#section-3
            case 'diffie-hellman-group14-sha1':
                $prime = 'FFFFFFFFFFFFFFFFC90FDAA22168C234C4C6628B80DC1CD129024E088A67CC74' .
                         '020BBEA63B139B22514A08798E3404DDEF9519B3CD3A431B302B0A6DF25F1437' .
                         '4FE1356D6D51C245E485B576625E7EC6F44C42E9A637ED6B0BFF5CB6F406B7ED' .
                         'EE386BFB5A899FA5AE9F24117C4B1FE649286651ECE45B3DC2007CB8A163BF05' .
                         '98DA48361C55D39A69163FA8FD24CF5F83655D23DCA3AD961C62F356208552BB' .
                         '9ED529077096966D670C354E4ABC9804F1746C08CA18217C32905E462E36CE3B' .
                         'E39E772C180E86039B2783A2EC07A28FB5C55DF06F4C52C9DE2BCBF695581718' .
                         '3995497CEA956AE515D2261898FA051015728E5A8AACAA68FFFFFFFFFFFFFFFF';
                break;
        }

        // For both diffie-hellman-group1-sha1 and diffie-hellman-group14-sha1
        // the generator field element is 2 (decimal) and the hash function is sha1.
        $g = new Math_BigInteger(2);
        $prime = new Math_BigInteger($prime, 16);
        $kexHash = new Crypt_Hash('sha1');
        //$q = $p->bitwise_rightShift(1);

        /* To increase the speed of the key exchange, both client and server may
           reduce the size of their private exponents.  It should be at least
           twice as long as the key material that is generated from the shared
           secret.  For more details, see the paper by van Oorschot and Wiener
           [VAN-OORSCHOT].

           -- http://tools.ietf.org/html/rfc4419#section-6.2 */
        $one = new Math_BigInteger(1);
        $keyLength = min($keyLength, $kexHash->getLength());
        $max = $one->bitwise_leftShift(16 * $keyLength); // 2 * 8 * $keyLength
        $max = $max->subtract($one);

        $x = $one->random($one, $max);
        $e = $g->modPow($x, $prime);

        $eBytes = $e->toBytes(true);
        $data = pack('CNa*', NET_SSH2_MSG_KEXDH_INIT, strlen($eBytes), $eBytes);

        if (!$this->_send_binary_packet($data)) {
            user_error('Connection closed by server');
            return false;
        }

        $response = $this->_get_binary_packet();
        if ($response === false) {
            user_error('Connection closed by server');
            return false;
        }
        extract(unpack('Ctype', $this->_string_shift($response, 1)));

        if ($type != NET_SSH2_MSG_KEXDH_REPLY) {
            user_error('Expected SSH_MSG_KEXDH_REPLY');
            return false;
        }

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->server_public_host_key = $server_public_host_key = $this->_string_shift($response, $temp['length']);

        $temp = unpack('Nlength', $this->_string_shift($server_public_host_key, 4));
        $public_key_format = $this->_string_shift($server_public_host_key, $temp['length']);

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $fBytes = $this->_string_shift($response, $temp['length']);
        $f = new Math_BigInteger($fBytes, -256);

        $temp = unpack('Nlength', $this->_string_shift($response, 4));
        $this->signature = $this->_string_shift($response, $temp['length']);

        $temp = unpack('Nlength', $this->_string_shift($this->signature, 4));
        $this->signature_format = $this->_string_shift($this->signature, $temp['length']);

        $key = $f->modPow($x, $prime);
        $keyBytes = $key->toBytes(true);

        $this->exchange_hash = pack('Na*Na*Na*Na*Na*Na*Na*Na*',
            strlen($this->identifier), $this->identifier, strlen($this->server_identifier), $this->server_identifier,
            strlen($kexinit_payload_client), $kexinit_payload_client, strlen($kexinit_payload_server),
            $kexinit_payload_server, strlen($this->server_public_host_key), $this->server_public_host_key, strlen($eBytes),
            $eBytes, strlen($fBytes), $fBytes, strlen($keyBytes), $keyBytes
        );

        $this->exchange_hash = $kexHash->hash($this->exchange_hash);

        if ($this->session_id === false) {
            $this->session_id = $this->exchange_hash;
        }

        for ($i = 0; $i < count($server_host_key_algorithms) && !in_array($server_host_key_algorithms[$i], $this->server_host_key_algorithms); $i++);
        if ($i == count($server_host_key_algorithms)) {
            user_error('No compatible server host key algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }

        if ($public_key_format != $server_host_key_algorithms[$i] || $this->signature_format != $server_host_key_algorithms[$i]) {
            user_error('Server Host Key Algorithm Mismatch');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }

        $packet = pack('C',
            NET_SSH2_MSG_NEWKEYS
        );

        if (!$this->_send_binary_packet($packet)) {
            return false;
        }

        $response = $this->_get_binary_packet();

        if ($response === false) {
            user_error('Connection closed by server');
            return false;
        }

        extract(unpack('Ctype', $this->_string_shift($response, 1)));

        if ($type != NET_SSH2_MSG_NEWKEYS) {
            user_error('Expected SSH_MSG_NEWKEYS');
            return false;
        }

        switch ($encrypt) {
            case '3des-cbc':
                if (!class_exists('Crypt_TripleDES')) {
                    include_once 'Crypt/TripleDES.php';
                }
                $this->encrypt = new Crypt_TripleDES();
                // $this->encrypt_block_size = 64 / 8 == the default
                break;
            case '3des-ctr':
                if (!class_exists('Crypt_TripleDES')) {
                    include_once 'Crypt/TripleDES.php';
                }
                $this->encrypt = new Crypt_TripleDES(CRYPT_DES_MODE_CTR);
                // $this->encrypt_block_size = 64 / 8 == the default
                break;
            case 'aes256-cbc':
            case 'aes192-cbc':
            case 'aes128-cbc':
                if (!class_exists('Crypt_Rijndael')) {
                    include_once 'Crypt/Rijndael.php';
                }
                $this->encrypt = new Crypt_Rijndael();
                $this->encrypt_block_size = 16; // eg. 128 / 8
                break;
            case 'aes256-ctr':
            case 'aes192-ctr':
            case 'aes128-ctr':
                if (!class_exists('Crypt_Rijndael')) {
                    include_once 'Crypt/Rijndael.php';
                }
                $this->encrypt = new Crypt_Rijndael(CRYPT_RIJNDAEL_MODE_CTR);
                $this->encrypt_block_size = 16; // eg. 128 / 8
                break;
            case 'blowfish-cbc':
                if (!class_exists('Crypt_Blowfish')) {
                    include_once 'Crypt/Blowfish.php';
                }
                $this->encrypt = new Crypt_Blowfish();
                $this->encrypt_block_size = 8;
                break;
            case 'blowfish-ctr':
                if (!class_exists('Crypt_Blowfish')) {
                    include_once 'Crypt/Blowfish.php';
                }
                $this->encrypt = new Crypt_Blowfish(CRYPT_BLOWFISH_MODE_CTR);
                $this->encrypt_block_size = 8;
                break;
            case 'twofish128-cbc':
            case 'twofish192-cbc':
            case 'twofish256-cbc':
            case 'twofish-cbc':
                if (!class_exists('Crypt_Twofish')) {
                    include_once 'Crypt/Twofish.php';
                }
                $this->encrypt = new Crypt_Twofish();
                $this->encrypt_block_size = 16;
                break;
            case 'twofish128-ctr':
            case 'twofish192-ctr':
            case 'twofish256-ctr':
                if (!class_exists('Crypt_Twofish')) {
                    include_once 'Crypt/Twofish.php';
                }
                $this->encrypt = new Crypt_Twofish(CRYPT_TWOFISH_MODE_CTR);
                $this->encrypt_block_size = 16;
                break;
            case 'arcfour':
            case 'arcfour128':
            case 'arcfour256':
                if (!class_exists('Crypt_RC4')) {
                    include_once 'Crypt/RC4.php';
                }
                $this->encrypt = new Crypt_RC4();
                break;
            case 'none';
                //$this->encrypt = new Crypt_Null();
        }

        switch ($decrypt) {
            case '3des-cbc':
                if (!class_exists('Crypt_TripleDES')) {
                    include_once 'Crypt/TripleDES.php';
                }
                $this->decrypt = new Crypt_TripleDES();
                break;
            case '3des-ctr':
                if (!class_exists('Crypt_TripleDES')) {
                    include_once 'Crypt/TripleDES.php';
                }
                $this->decrypt = new Crypt_TripleDES(CRYPT_DES_MODE_CTR);
                break;
            case 'aes256-cbc':
            case 'aes192-cbc':
            case 'aes128-cbc':
                if (!class_exists('Crypt_Rijndael')) {
                    include_once 'Crypt/Rijndael.php';
                }
                $this->decrypt = new Crypt_Rijndael();
                $this->decrypt_block_size = 16;
                break;
            case 'aes256-ctr':
            case 'aes192-ctr':
            case 'aes128-ctr':
                if (!class_exists('Crypt_Rijndael')) {
                    include_once 'Crypt/Rijndael.php';
                }
                $this->decrypt = new Crypt_Rijndael(CRYPT_RIJNDAEL_MODE_CTR);
                $this->decrypt_block_size = 16;
                break;
            case 'blowfish-cbc':
                if (!class_exists('Crypt_Blowfish')) {
                    include_once 'Crypt/Blowfish.php';
                }
                $this->decrypt = new Crypt_Blowfish();
                $this->decrypt_block_size = 8;
                break;
            case 'blowfish-ctr':
                if (!class_exists('Crypt_Blowfish')) {
                    include_once 'Crypt/Blowfish.php';
                }
                $this->decrypt = new Crypt_Blowfish(CRYPT_BLOWFISH_MODE_CTR);
                $this->decrypt_block_size = 8;
                break;
            case 'twofish128-cbc':
            case 'twofish192-cbc':
            case 'twofish256-cbc':
            case 'twofish-cbc':
                if (!class_exists('Crypt_Twofish')) {
                    include_once 'Crypt/Twofish.php';
                }
                $this->decrypt = new Crypt_Twofish();
                $this->decrypt_block_size = 16;
                break;
            case 'twofish128-ctr':
            case 'twofish192-ctr':
            case 'twofish256-ctr':
                if (!class_exists('Crypt_Twofish')) {
                    include_once 'Crypt/Twofish.php';
                }
                $this->decrypt = new Crypt_Twofish(CRYPT_TWOFISH_MODE_CTR);
                $this->decrypt_block_size = 16;
                break;
            case 'arcfour':
            case 'arcfour128':
            case 'arcfour256':
                if (!class_exists('Crypt_RC4')) {
                    include_once 'Crypt/RC4.php';
                }
                $this->decrypt = new Crypt_RC4();
                break;
            case 'none';
                //$this->decrypt = new Crypt_Null();
        }

        $keyBytes = pack('Na*', strlen($keyBytes), $keyBytes);

        if ($this->encrypt) {
            $this->encrypt->enableContinuousBuffer();
            $this->encrypt->disablePadding();

            $iv = $kexHash->hash($keyBytes . $this->exchange_hash . 'A' . $this->session_id);
            while ($this->encrypt_block_size > strlen($iv)) {
                $iv.= $kexHash->hash($keyBytes . $this->exchange_hash . $iv);
            }
            $this->encrypt->setIV(substr($iv, 0, $this->encrypt_block_size));

            $key = $kexHash->hash($keyBytes . $this->exchange_hash . 'C' . $this->session_id);
            while ($encryptKeyLength > strlen($key)) {
                $key.= $kexHash->hash($keyBytes . $this->exchange_hash . $key);
            }
            $this->encrypt->setKey(substr($key, 0, $encryptKeyLength));
        }

        if ($this->decrypt) {
            $this->decrypt->enableContinuousBuffer();
            $this->decrypt->disablePadding();

            $iv = $kexHash->hash($keyBytes . $this->exchange_hash . 'B' . $this->session_id);
            while ($this->decrypt_block_size > strlen($iv)) {
                $iv.= $kexHash->hash($keyBytes . $this->exchange_hash . $iv);
            }
            $this->decrypt->setIV(substr($iv, 0, $this->decrypt_block_size));

            $key = $kexHash->hash($keyBytes . $this->exchange_hash . 'D' . $this->session_id);
            while ($decryptKeyLength > strlen($key)) {
                $key.= $kexHash->hash($keyBytes . $this->exchange_hash . $key);
            }
            $this->decrypt->setKey(substr($key, 0, $decryptKeyLength));
        }

        /* The "arcfour128" algorithm is the RC4 cipher, as described in
           [SCHNEIER], using a 128-bit key.  The first 1536 bytes of keystream
           generated by the cipher MUST be discarded, and the first byte of the
           first encrypted packet MUST be encrypted using the 1537th byte of
           keystream.

           -- http://tools.ietf.org/html/rfc4345#section-4 */
        if ($encrypt == 'arcfour128' || $encrypt == 'arcfour256') {
            $this->encrypt->encrypt(str_repeat("\0", 1536));
        }
        if ($decrypt == 'arcfour128' || $decrypt == 'arcfour256') {
            $this->decrypt->decrypt(str_repeat("\0", 1536));
        }

        for ($i = 0; $i < count($mac_algorithms) && !in_array($mac_algorithms[$i], $this->mac_algorithms_client_to_server); $i++);
        if ($i == count($mac_algorithms)) {
            user_error('No compatible client to server message authentication algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }

        $createKeyLength = 0; // ie. $mac_algorithms[$i] == 'none'
        switch ($mac_algorithms[$i]) {
            case 'hmac-sha2-256':
                $this->hmac_create = new Crypt_Hash('sha256');
                $createKeyLength = 32;
                break;
            case 'hmac-sha1':
                $this->hmac_create = new Crypt_Hash('sha1');
                $createKeyLength = 20;
                break;
            case 'hmac-sha1-96':
                $this->hmac_create = new Crypt_Hash('sha1-96');
                $createKeyLength = 20;
                break;
            case 'hmac-md5':
                $this->hmac_create = new Crypt_Hash('md5');
                $createKeyLength = 16;
                break;
            case 'hmac-md5-96':
                $this->hmac_create = new Crypt_Hash('md5-96');
                $createKeyLength = 16;
        }

        for ($i = 0; $i < count($mac_algorithms) && !in_array($mac_algorithms[$i], $this->mac_algorithms_server_to_client); $i++);
        if ($i == count($mac_algorithms)) {
            user_error('No compatible server to client message authentication algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }

        $checkKeyLength = 0;
        $this->hmac_size = 0;
        switch ($mac_algorithms[$i]) {
            case 'hmac-sha2-256':
                $this->hmac_check = new Crypt_Hash('sha256');
                $checkKeyLength = 32;
                $this->hmac_size = 32;
                break;
            case 'hmac-sha1':
                $this->hmac_check = new Crypt_Hash('sha1');
                $checkKeyLength = 20;
                $this->hmac_size = 20;
                break;
            case 'hmac-sha1-96':
                $this->hmac_check = new Crypt_Hash('sha1-96');
                $checkKeyLength = 20;
                $this->hmac_size = 12;
                break;
            case 'hmac-md5':
                $this->hmac_check = new Crypt_Hash('md5');
                $checkKeyLength = 16;
                $this->hmac_size = 16;
                break;
            case 'hmac-md5-96':
                $this->hmac_check = new Crypt_Hash('md5-96');
                $checkKeyLength = 16;
                $this->hmac_size = 12;
        }

        $key = $kexHash->hash($keyBytes . $this->exchange_hash . 'E' . $this->session_id);
        while ($createKeyLength > strlen($key)) {
            $key.= $kexHash->hash($keyBytes . $this->exchange_hash . $key);
        }
        $this->hmac_create->setKey(substr($key, 0, $createKeyLength));

        $key = $kexHash->hash($keyBytes . $this->exchange_hash . 'F' . $this->session_id);
        while ($checkKeyLength > strlen($key)) {
            $key.= $kexHash->hash($keyBytes . $this->exchange_hash . $key);
        }
        $this->hmac_check->setKey(substr($key, 0, $checkKeyLength));

        for ($i = 0; $i < count($compression_algorithms) && !in_array($compression_algorithms[$i], $this->compression_algorithms_server_to_client); $i++);
        if ($i == count($compression_algorithms)) {
            user_error('No compatible server to client compression algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }
        $this->decompress = $compression_algorithms[$i] == 'zlib';

        for ($i = 0; $i < count($compression_algorithms) && !in_array($compression_algorithms[$i], $this->compression_algorithms_client_to_server); $i++);
        if ($i == count($compression_algorithms)) {
            user_error('No compatible client to server compression algorithms found');
            return $this->_disconnect(NET_SSH2_DISCONNECT_KEY_EXCHANGE_FAILED);
        }
        $this->compress = $compression_algorithms[$i] == 'zlib';

        return true;
    }

    /**
     * Login
     *
     * The $password parameter can be a plaintext password, a Crypt_RSA object or an array
     *
     * @param String $username
     * @param Mixed $password
     * @param Mixed $...
     * @return Boolean
     * @see _login
     * @access public
     */
    function login($username)
    {
        $args = func_get_args();
        return call_user_func_array(array(&$this, '_login'), $args);
    }

    /**
     * Login Helper
     *
     * @param String $username
     * @param Mixed $password
     * @param Mixed $...
     * @return Boolean
     * @see _login_helper
     * @access private
     */
    function _login($username)
    {
        if (!($this->bitmap & NET_SSH2_MASK_CONSTRUCTOR)) {
            if (!$this->_connect()) {
                return false;
            }
        }

        $args = array_slice(func_get_args(), 1);
        if (empty($args)) {
            return $this->_login_helper($username);
        }

        foreach ($args as $arg) {
            if ($this->_login_helper($username, $arg)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Login Helper
     *
     * @param String $username
     * @param optional String $password
     * @return Boolean
     * @access private
     * @internal It might be worthwhile, at some point, to protect against {@link http://tools.ietf.org/html/rfc4251#section-9.3.9 traffic analysis}
     *           by sending dummy SSH_MSG_IGNORE messages.
     */
    function _login_helper($username, $password = null)
    {
        if (!($this->bitmap & NET_SSH2_MASK_CONNECTED)) {
            return false;
        }

        if (!($this->bitmap & NET_SSH2_MASK_LOGIN_REQ)) {
            $packet = pack('CNa*',
                NET_SSH2_MSG_SERVICE_REQUEST, strlen('ssh-userauth'), 'ssh-userauth'
            );

            if (!$this->_send_binary_packet($packet)) {
                return false;
            }

            $response = $this->_get_binary_packet();
            if ($response === false) {
                user_error('Connection closed by server');
                return false;
            }

            extract(unpack('Ctype', $this->_string_shift($response, 1)));

            if ($type != NET_SSH2_MSG_SERVICE_ACCEPT) {
                user_error('Expected SSH_MSG_SERVICE_ACCEPT');
                return false;
            }
            $this->bitmap |= NET_SSH2_MASK_LOGIN_REQ;
        }

        if (strlen($this->last_interactive_response)) {
            return !is_string($password) && !is_array($password) ? false : $this->_keyboard_interactive_process($password);
        }

        // although PHP5's get_class() preserves the case, PHP4's does not
        if (is_object($password)) {
            switch (strtolower(get_class($password))) {
                case 'crypt_rsa':
                    return $this->_privatekey_login($username, $password);
                case 'system_ssh_agent':
                    return $this->_ssh_agent_login($username, $password);
            }
        }

        if (is_array($password)) {
            if ($this->_keyboard_interactive_login($username, $password)) {
                $this->bitmap |= NET_SSH2_MASK_LOGIN;
                return true;
            }
            return false;
        }

        if (!isset($password)) {
            $packet = pack('CNa*Na*Na*',
                NET_SSH2_MSG_USERAUTH_REQUEST, strlen($username), $username, strlen('ssh-connection'), 'ssh-connection',
                strlen('none'), 'none'
            );

            if (!$this->_send_binary_packet($packet)) {
                return false;
            }

            $response = $this->_get_binary_packet();
            if ($response === false) {
                user_error('Connection closed by server');
                return false;
            }

            extract(unpack('Ctype', $this->_string_shift($response, 1)));

            switch ($type) {
                case NET_SSH2_MSG_USERAUTH_SUCCESS:
                    $this->bitmap |= NET_SSH2_MASK_LOGIN;
                    return true;
                //case NET_SSH2_MSG_USERAUTH_FAILURE:
                default:
                    return false;
            }
        }

        $packet = pack('CNa*Na*Na*CNa*',
            NET_SSH2_MSG_USERAUTH_REQUEST, strlen($username), $username, strlen('ssh-connection'), 'ssh-connection',
            strlen('password'), 'password', 0, strlen($password), $password
        );

        // remove the username and password from the logged packet
        if (!defined('NET_SSH2_LOGGING')) {
            $logged = null;
        } else {
            $logged = pack('CNa*Na*Na*CNa*',
                NET_SSH2_MSG_USERAUTH_REQUEST, strlen('username'), 'username', strlen('ssh-connection'), 'ssh-connection',
                strlen('password'), 'password', 0, strlen('password'), 'password'
            );
        }

        if (!$this->_send_binary_packet($packet, $logged)) {
            return false;
        }

        $response = $this->_get_binary_packet();
        if ($response === false) {
            user_error('Connection closed by server');
            return false;
        }

        extract(unpack('Ctype', $this->_string_shift($response, 1)));

        switch ($type) {
            case NET_SSH2_MSG_USERAUTH_PASSWD_CHANGEREQ: // in theory, the password can be changed
                if (defined('NET_SSH2_LOGGING')) {
                    $this->message_number_log[count($this->message_number_log) - 1] = 'NET_SSH2_MSG_USERAUTH_PASSWD_CHANGEREQ';
                }
                extract(unpack('Nlength', $this->_string_shift($response, 4)));
                $this->errors[] = 'SSH_MSG_USERAUTH_PASSWD_CHANGEREQ: ' . utf8_decode($this->_string_shift($response, $length));
                return $this->_disconnect(NET_SSH2_DISCONNECT_AUTH_CANCELLED_BY_USER);
            case NET_SSH2_MSG_USERAUTH_FAILURE:
                // can we use keyboard-interactive authentication?  if not then either the login is bad or the server employees
                // multi-factor authentication
                extract(unpack('Nlength', $this->_string_shift($response, 4)));
                $auth_methods = explode(',', $this->_string_shift($response, $length));
                extract(unpack('Cpartial_success', $this->_string_shift($response, 1)));
                $partial_success = $partial_success != 0;

                if (!$partial_success && in_array('keyboard-interactive', $auth_methods)) {
                    if ($this->_keyboard_interactive_login($username, $password)) {
                        $this->bitmap |= NET_SSH2_MASK_LOGIN;
                        return true;
                    }
                    return false;
                }
                return false;
            case NET_SSH2_MSG_USERAUTH_SUCCESS:
                $this->bitmap |= NET_SSH2_MASK_LOGIN;
                return true;
        }

        return false;
    }

    /**
     * Login via keyboard-interactive authentication
     *
     * See {@link http://tools.ietf.org/html/rfc4256 RFC4256} for details.  This is not a full-featured keyboard-interactive authenticator.
     *
     * @param String $username
     * @param String $password
     * @return Boolean
     * @access private
     */
    function _keyboard_interactive_login($username, $password)
    {
        $packet = pack('CNa*Na*Na*Na*Na*',
            NET_SSH2_MSG_USERAUTH_REQUEST, strlen($username), $username, strlen('ssh-connection'), 'ssh-connection',
            strlen('keyboard-interactive'), 'keyboard-interactive', 0, '', 0, ''
        );

        if (!$this->_send_binary_packet($packet)) {
            return false;
        }

        return $this->_keyboard_interactive_process($password);
    }

    /**
     * Handle the keyboard-interactive requests / responses.
     *
     * @param String $responses...
     * @return Boolean
     * @access private
     */
    function _keyboard_interactive_process()
    {
        $responses = func_get_args();

        if (strlen($this->last_interactive_response)) {
            $response = $this->last_interactive_response;
        } else {
            $orig = $response = $this->_get_binary_packet();
            if ($response === false) {
                user_error('Connection closed by server');
                return false;
            }
        }

        extract(unpack('Ctype', $this->_string_shift($response, 1)));

        switch ($type) {
            case NET_SSH2_MSG_USERAUTH_INFO_REQUEST:
                extract(unpack('Nlength', $this->_string_shift($response, 4)));
                $this->_string_shift($response, $length); // name; may be empty
                extract(unpack('Nlength', $this->_string_shift($response, 4)));
                $this->_string_shift($response, $length); // instruction; may be empty
                extract(unpack('Nlength', $this->_string_shift($response, 4)));
                $this->_string_shift($response, $length); // language tag; may be empty
                extract(unpack('Nnum_prompts', $this->_string_shift($response, 4)));

                for ($i = 0; $i < count($responses); $i++) {
                    if (is_array($responses[$i])) {
                        foreach ($responses[$i] as $key => $value) {
                            $this->keyboard_requests_responses[$key] = $value;
                        }
                        unset($responses[$i]);
                    }
                }
                $responses = array_values($responses);

                if (isset($this->keyboard_requests_responses)) {
                    for ($i = 0; $i < $num_prompts; $i++) {
                        extract(unpack('Nlength', $this->_string_shift($response, 4)));
                        // prompt - ie. "Password: "; must not be empty
                        $prompt = $this->_string_shift($response, $length);
                        //$echo = $this->_string_shift($response) != chr(0);
                        foreach ($this->keyboard_requests_responses as $key => $value) {
                            if (substr($prompt, 0, strlen($key)) == $key) {
                                $responses[] = $value;
                                break;
                            }
                        }
                    }
                }

                // see http://tools.ietf.org/html/rfc4256#section-3.2
                if (strlen($this->last_interactive_response)) {
                    $this->last_interactive_response = '';
                } else if (defined('NET_SSH2_LOGGING')) {
                    $this->message_number_log[count($this->message_number_log) - 1] = str_replace(
                        'UNKNOWN',
                        'NET_SSH2_MSG_USERAUTH_INFO_REQUEST',
                        $this->message_number_log[count($this->message_number_log) - 1]
                    );
                }

                if (!count($responses) && $num_prompts) {
                    $this->last_interactive_response = $orig;
                    return false;
                }

                /*
                   After obtaining the requested information from the user, the client
                   MUST respond with an SSH_MSG_USERAUTH_INFO_RESPONSE message.
                */
                // see http://tools.ietf.org/html/rfc4256#section-3.4
                $packet = $logged = pack('CN', NET_SSH2_MSG_USERAUTH_INFO_RESPONSE, count($responses));
                for ($i = 0; $i < count($responses); $i++) {
                    $packet.= pack('Na*', strlen($responses[$i]), $responses[$i]);
                    $logged.= pack('Na*', strlen('dummy-answer'), 'dummy-answer');
                }

                if (!$this->_send_binary_packet($packet, $logged)) {
                    return false;
                }

                if (defined('NET_SSH2_LOGGING') && NET_SSH2_LOGGING == NET_SSH2_LOG_COMPLEX) {
                    $this->message_number_log[count($this->message_number_log) - 1] = str_replace(
                        'UNKNOWN',
                        'NET_SSH2_MSG_USERAUTH_INFO_RESPONSE',
                        $this->message_number_log[count($this->message_number_log) - 1]
                    );
                }

                /*
                   After receiving the response, the server MUST send either an
                   SSH_MSG_USERAUTH_SUCCESS, SSH_MSG_USERAUTH_FAILURE, or another
                   SSH_MSG_USERAUTH_INFO_REQUEST message.
                */
                // maybe phpseclib should force close the connection after x request / responses?  unless something like that is done
                // there could be an infinite loop of request / responses.
                return $this->_keyboard_interactive_process();
            case NET_SSH2_MSG_USERAUTH_SUCCESS:
                return true;
            case NET_SSH2_MSG_USERAUTH_FAILURE:
                return false;
        }

        return false;
    }

    /**
     * Login with an ssh-agent provided key
     *
     * @param String $username
     * @param System_SSH_Agent $agent
     * @return Boolean
     * @access private
     */
    function _ssh_agent_login($username, $agent)
    {
        $keys = $agent->requestIdentities();
        foreach ($keys as $key) {
            if ($this->_privatekey_login($username, $key)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Login with an RSA private key
     *
     * @param String $username
     * @param Crypt_RSA $password
     * @return Boolean
     * @access private
     * @internal It might be worthwhile, at some point, to protect against {@link http://tools.ietf.org/html/rfc4251#section-9.3.9 traffic analysis}
     *           by sending dummy SSH_MSG_IGNORE messages.
     */
    function _privatekey_login($username, $privatekey)
    {
        // see http://tools.ietf.org/html/rfc4253#page-15
        $publickey = $privatekey->getPublicKey(CRYPT_RSA_PUBLIC_FORMAT_RAW);
        if ($publickey === false) {
            return false;
        }

        $publickey = array(
            'e' => $publickey['e']->toBytes(true),
            'n' => $publickey['n']->toBytes(true)
        );
        $publickey = pack('Na*Na*Na*',
            strlen('ssh-rsa'), 'ssh-rsa', strlen($publickey['e']), $publickey['e'], strlen($publickey['n']), $publickey['n']
        );

        $part1 = pack('CNa*Na*Na*',
            NET_SSH2_MSG_USERAUTH_REQUEST, strlen($username), $username, strlen('ssh-connection'), 'ssh-connection',
            strlen('publickey'), 'publickey'
        );
        $part2 = pack('Na*Na*', strlen('ssh-rsa'), 'ssh-rsa', strlen($publickey), $publickey);

        $packet = $part1 . chr(0) . $part2;
        if (!$this->_send_binary_packet($packet)) {
            return false;
        }

        $response = $this->_get_binary_packet();
        if ($response === false) {
            user_error('Connection closed by server');
            return false;
        }

        extract(unpack('Ctype', $this->_string_shift($response, 1)));

        switch ($type) {
            case NET_SSH2_MSG_USERAUTH_FAILURE:
                extract(unpack('Nlength', $this->_string_shift($response, 4)));
                $this->errors[] = 'SSH_MSG_USERAUTH_FAILURE: ' . $this->_string_shift($response, $length);
                return false;
            case NET_SSH2_MSG_USERAUTH_PK_OK:
                // we'll just take it on faith that the public key blob and the public key algorithm name are as
                // they should be
                if (defined('NET_SSH2_LOGGING') && NET_SSH2_LOGGING == NET_SSH2_LOG_COMPLEX) {
                    $this->message_number_log[count($this->message_number_log) - 1] = str_replace(
                        'UNKNOWN',
                        'NET_SSH2_MSG_USERAUTH_PK_OK',
                        $this->message_number_log[count($this->message_number_log) - 1]
                    );
                }
        }

        $packet = $part1 . chr(1) . $part2;
        $privatekey->setSignatureMode(CRYPT_RSA_SIGNATURE_PKCS1);
        $signature = $privatekey->sign(pack('Na*a*', strlen($this->session_id), $this->session_id, $packet));
        $signature = pack('Na*Na*', strlen('ssh-rsa'), 'ssh-rsa', strlen($signature), $signature);
        $packet.= pack('Na*', strlen($signature), $signature);

        if (!$this->_send_binary_packet($packet)) {
            return false;
        }

        $response = $this->_get_binary_packet();
        if ($response === false) {
            user_error('Connection closed by server');
            return false;
        }

        extract(unpack('Ctype', $this->_string_shift($response, 1)));

        switch ($type) {
            case NET_SSH2_MSG_USERAUTH_FAILURE:
                // either the login is bad or the server employs multi-factor authentication
                return false;
            case NET_SSH2_MSG_USERAUTH_SUCCESS:
                $this->bitmap |= NET_SSH2_MASK_LOGIN;
                return true;
        }

        return false;
    }

    /**
     * Set Timeout
     *
     * $ssh->exec('ping 127.0.0.1'); on a Linux host will never return and will run indefinitely.  setTimeout() makes it so it'll timeout.
     * Setting $timeout to false or 0 will mean there is no timeout.
     *
     * @param Mixed $timeout
     * @access public
     */
    function setTimeout($timeout)
    {
        $this->timeout = $this->curTimeout = $timeout;
    }

    /**
     * Get the output from stdError
     *
     * @access public
     */
    function getStdError()
    {
        return $this->stdErrorLog;
    }

    /**
     * Execute Command
     *
     * If $callback is set to false then Net_SSH2::_get_channel_packet(NET_SSH2_CHANNEL_EXEC) will need to be called manually.
     * In all likelihood, this is not a feature you want to be taking advantage of.
     *
     * @param String $command
     * @param optional Callback $callback
     * @return String
     * @access public
     */
    function exec($command, $callback = null)
    {
        $this->curTimeout = $this->timeout;
        $this->is_timeout = false;
        $this->stdErrorLog = '';

        if (!($this->bitmap & NET_SSH2_MASK_LOGIN)) {
            return false;
        }

        // RFC4254 defines the (client) window size as "bytes the other party can send before it must wait for the window to
        // be adjusted".  0x7FFFFFFF is, at 2GB, the max size.  technically, it should probably be decremented, but,
        // honestly, if you're transfering more than 2GB, you probably shouldn't be using phpseclib, anyway.
        // see http://tools.ietf.org/html/rfc4254#section-5.2 for more info
        $this->window_size_server_to_client[NET_SSH2_CHANNEL_EXEC] = $this->window_size;
        // 0x8000 is the maximum max packet size, per http://tools.ietf.org/html/rfc4253#section-6.1, although since PuTTy
        // uses 0x4000, that's what will be used here, as well.
        $packet_size = 0x4000;

        $packet = pack('CNa*N3',
            NET_SSH2_MSG_CHANNEL_OPEN, strlen('session'), 'session', NET_SSH2_CHANNEL_EXEC, $this->window_size_server_to_client[NET_SSH2_CHANNEL_EXEC], $packet_size);

        if (!$this->_send_binary_packet($packet)) {
            return false;
        }

        $this->channel_status[NET_SSH2_CHANNEL_EXEC] = NET_SSH2_MSG_CHANNEL_OPEN;

        $response = $this->_get_channel_packet(NET_SSH2_CHANNEL_EXEC);
        if ($response === false) {
            return false;
        }

        if ($this->request_pty === true) {
            $terminal_modes = pack('C', NET_SSH2_TTY_OP_END);
            $packet = pack('CNNa*CNa*N5a*',
                NET_SSH2_MSG_CHANNEL_REQUEST, $this->server_channels[NET_SSH2_CHANNEL_EXEC], strlen('pty-req'), 'pty-req', 1, strlen('vt100'), 'vt100',
                $this->windowColumns, $this->windowRows, 0, 0, strlen($terminal_modes), $terminal_modes);

            if (!$this->_send_binary_packet($packet)) {
                return false;
            }
            $response = $this->_get_binary_packet();
            if ($response === false) {
                user_error('Connection closed by server');
                return false;
            }

            list(, $type) = unpack('C', $this->_string_shift($response, 1));

            switch ($type) {
                case NET_SSH2_MSG_CHANNEL_SUCCESS:
                    break;
                case NET_SSH2_MSG_CHANNEL_FAILURE:
                default:
                    user_error('Unable to request pseudo-terminal');
                    return $this->_disconnect(NET_SSH2_DISCONNECT_BY_APPLICATION);
            }
            $this->in_request_pty_exec = true;
        }

        // sending a pty-req SSH_MSG_CHANNEL_REQUEST message is unnecessary and, in fact, in most cases, slows things
        // down.  the one place where it might be desirable is if you're doing something like Net_SSH2::exec('ping localhost &').
        // with a pty-req SSH_MSG_CHANNEL_REQUEST, exec() will return immediately and the ping process will then
        // then immediately terminate.  without such a request exec() will loop indefinitely.  the ping process won't end but
        // neither will your script.

        // although, in theory, the size of SSH_MSG_CHANNEL_REQUEST could exceed the maximum packet size established by
        // SSH_MSG_CHANNEL_OPEN_CONFIRMATION, RFC4254#section-5.1 states that the "maximum packet size" refers to the
        // "maximum size of an individual data packet". ie. SSH_MSG_CHANNEL_DATA.  RFC4254#section-5.2 corroborates.
        $packet = pack('CNNa*CNa*',
            NET_SSH2_MSG_CHANNEL_REQUEST, $thi