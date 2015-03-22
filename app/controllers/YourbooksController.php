<?php 

class YourbooksController extends \BaseController {
    
    public $rules = array(
            'con-fullname'=>'required|max:100',
            'con-email'=>'required|email|max:100',
            'con-subject'=>'required|max:50',
            'con-message'=>'required|max:1000',
        );
    
    public $rules2 = array(
            'bookcode'=>'required|exists:booking,Booking_code'
        );
    public function index()
    {
        $room = Rooms::select('roomtype.ID_RoomType','roomtype_pic.Picture')
        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(15)->get();

        $data['about'] = About::get()->all();
        $countRoom = Rooms::where('Status','=','Active')->count();

        $offer = Offer::where('Status','=','Active')->take(15)->get();
        $countOffer = Offer::where('Status','=','Active')->count();

        $about = About::all();
        return View::make('Books.View.index')
            ->with('data',$data)
            ->with('room',$room)->with('countRoom',$countRoom)
            ->with('offer',$offer)->with('countOffer',$countOffer)
            ->with('about',$about);
    }

    public function sendEmail()
    {
        $data = Input::all();
        $user = [
            'name'=> Input::Get('con-fullname'),
            'email'=>Input::Get('con-email'),
            'subject'=>Input::Get('con-subject'),
            'message'=>Input::Get('con-message')
            ];

        $success = "Thank you for contacting us, your email with subject '".$user['subject']."' will be reply by us soon. please check your spam folder as well";   
        $validator = Validator::make(Input::all(), $this->rules);

        if($validator->passes()) 
        {
            Mail::send('emails.contactus',$data, function($message) use ($user){
                    $message->from($user['email'],$user['name'])
                            ->to('everydaysmarthotel-jakarta@protohotel.asia','Hotel Everyday Smart Hotel - Jakarta')
                            ->subject($user['subject']);
                });  
            return Redirect::to('/yourbook')
                ->with('success',$success);
        }
        else {
            return Redirect::to('/yourbook')
                ->withErrors($validator,'viewBook')->withInput()->with('active','active');        
        }
    }

    public function checkBook()
    {
        $data['bookcode'] = Input::get('bookcode');
        $validator = Validator::make(Input::all(), $this->rules2);
        $customError = "The selected bookcode is have been cancel..";

        $book = Book::select('Booking_Status')
            ->where('Booking_code','=',$data['bookcode'])
            ->where('Booking_Status','=','Booked')->get();

        if ($validator->passes() && $book->first() != null) 
        {
            
            Cache::put('bookingcode',$data['bookcode'],1);
            $getValue = Cache::get('bookingcode');
            return Redirect::action('showBook',$getValue);
        }
        else
        {
            if ($validator->fails()) 
            {
                return Redirect::to('/yourbook')
                    ->withErrors($validator,'viewBook')->withInput();
            }
            else  
            {
                return Redirect::to('/yourbook')
                    ->withInput()->with('customError',$customError);
            }
        }
    }
    public function viewBook($bookcode)
    {
        if(Cache::has('bookingcode'))
        {
            echo "you have 60 minutes / 1 hour before the";
        }
        else
        {
            return Redirect::to('/');
        }
    }
}