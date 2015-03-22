<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="google-translate-customization" content="62096f6bdb176f65-472031cbd4d23fbd-gcecc5af6109dcfee-f"></meta>
    <title>@yield("title")</title>

	    <!-- core CSS -->

    <link href="{{ URL::to('/') }}/resources/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/resources/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/resources/css/prettyPhoto.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/resources/css/animate.min.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/resources/css/main.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/resources/css/responsive.css" rel="stylesheet">
    <link href="{{ URL::to('/') }}/resources/css/pic.css" rel="stylesheet" />
    <link href="{{ URL::to('/') }}/resources/css/jssor-slider.css" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/resources/css/jssor-content-slider.css" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/resources/css/jssor-tab-slider.css" rel="stylesheet"/>
    <link href="{{ URL::to('/') }}/resources/css/sidebar-carousel.css" rel="stylesheet"/>
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="{{ URL::to('/') }}/resources/icon/fav.png">
    <!-- date picker css-->
    <link href="{{ URL::to('/') }}/resources/css/jquery.datepick.css" rel="stylesheet" />
    <script src="https://maps.googleapis.com/maps/api/js?sensor=false"></script>

</head><!--/head-->

<body class="homepage" onLoad="drop()">
    @include('partials.menu')
    @yield("content")
    @yield("showModal")
    @include('partials.footer')

    <script src="{{ URL::to('/') }}/resources/js/jquery-1.10.2.js"></script>
    <script src="{{ URL::to('/') }}/resources/js/jquery.js"></script>
    <script src="{{ URL::to('/') }}/resources/js/bootstrap.min.js"></script>
    <script src="{{ URL::to('/') }}/resources/js/jquery.prettyPhoto.js"></script>
    <script src="{{ URL::to('/') }}/resources/js/jquery.isotope.min.js"></script>
    <script src="{{ URL::to('/') }}/resources/js/main.js"></script>
    <script src="{{ URL::to('/') }}/resources/js/wow.min.js"></script>
    <script src="{{ URL::to('/') }}/resources/js/jquery.plugin.js"></script>
	<script src="{{ URL::to('/') }}/resources/js/jquery.datepick.js"></script>
    <!--	<script src="{{ URL::to('/') }}/resources/js/date.js"></script> -->
    @yield("scriptDate")
	<script src="{{ URL::to('/') }}/resources/js/jssor.js"></script>
	<script src="{{ URL::to('/') }}/resources/js/jssor.slider.js"></script>
	<script src="{{ URL::to('/') }}/resources/js/jssor-slider.js"></script>
	<script src="{{ URL::to('/') }}/resources/js/jssor-content-slider.js"></script>
	<script src="{{ URL::to('/') }}/resources/js/jssor-tab-slider.js"></script>
	<script src="{{ URL::to('/') }}/resources/js/country.js"></script>
	@yield("scriptCalculate")

    <script type="text/javascript">
        $(document).ready(function(){
            $("#featured").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 5000, true);
        });
    </script>

    <script type="text/javascript">
        function googleTranslateElementInit() {
          new google.translate.TranslateElement({pageLanguage: 'en', layout: google.translate.TranslateElement.InlineLayout.SIMPLE, multilanguagePage: true}, 'google_translate_element');
        }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!--Start of Zopim Live Chat Script-->
		<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute('charset','utf-8');
		$.src='//v2.zopim.com/?2svsOJ6C3c9Vwdz1WQZmlZ6OYHVH8SbM';z.t=+new Date;$.
		type='text/javascript';e.parentNode.insertBefore($,e)})(document,'script');
		</script>
	<!--End of Zopim Live Chat Script-->
    <script src="//static.getclicky.com/js" type="text/javascript"></script>
    <script type="text/javascript">try{ clicky.init(100826239); }catch(e){}</script>
    <noscript><p><img alt="Clicky" width="1" height="1" src="//in.getclicky.com/100826239ns.gif" /></p></noscript>
    @yield("scriptModal")


</body>

</html>