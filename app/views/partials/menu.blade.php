<header id="header">
	@foreach($data['about'] as $key => $aboutUs)
	@endforeach
      <div class="top-bar">
            <div class="container">
                <div class="row">
                    <div class="col-sm-6 col-xs-12">
                        <div id="google_translate_element"></div>
                    </div>

                    <div class="col-sm-6 col-xs-12">
                       <div class="social">
                            <ul class="social-share">
                                <li><a href="https://www.facebook.com/everydayhotels"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://twitter.com/everydayhotels"><i class="fa fa-twitter"></i></a></li>
                            </ul>
                            <div class="search">
                                <form role="form">
                                    <input type="text" class="search-form" autocomplete="off" placeholder="Search">
                                    <i class="fa fa-search"></i>
                                </form>
                           </div>
                       </div>
                    </div>
                </div>
            </div><!--/.container-->
        </div>  

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="{{ URL::to('/') }}"><img src="{{ URL::to('/') }}/resources/icon/{{ $aboutUs->Logo }}" alt="logo"></a>
                </div>

                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li class="{{$index or '' }}"><a href="{{ URL::to('/') }}">Home</a></li>
                        <li class="{{$room_active or ''}}"><a href="{{ URL::to('/rooms') }}">Hotel Room</a></li>
                        <li class="{{$faci_active or ''}}"><a href="{{ URL::to('/facilities') }}">Hotel Facilities</a></li>
                        <li class="{{$news_active or ''}}"><a href="{{ URL::to('/news') }}">Hotel News</a></li>
                        <li class="{{$event_active or ''}}"><a href="{{ URL::to('/events') }}">Hotel Events</a></li>
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">Other Hotel Location <i class="fa fa-angle-down"></i></a>
                            <ul class="dropdown-menu">
                            	<li><a href="http://everydaysmarthotels.com/malang/">Malang - Jawa Timur</a></li>
                                <li><a href="http://everydaysmarthotels.com/kuta/">Kuta - Bali</a></li>
                            </ul>
                        </li>                                        
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
    </header><!--/header-->

