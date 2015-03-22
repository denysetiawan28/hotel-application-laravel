@extends('layout.default')
@section("title")About Us - Everyday Smart Hotel @stop
@section('content')
<section id="blog" class="container">
        <div class="center">
            <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i><a href="{{URL::to('/aboutus')}}"> About Us</a> <i class="fa fa-caret-right"></i></h2>
        </div>

        <div class="blog">
            <div class="row section-color">
                <div class="col-md-8 div-main">
                    <div class="blog-item">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                             	@foreach($about as $item => $aboutt)
                             		<h2 align="center">Welcome to {{ $aboutt->Name }}</h2>
                                    <p>{{ $aboutt->About }}</p>
                             		
                             		<img class="img-responsive img-rounded" src="{{URL::to('/')}}/resources/images/hotel/aboutus/{{ $aboutt->AboutUsPic}}"/>
                             		
                                    <h4 align="left" style="text-align: left;">Concept </h4>
                                    <p>{{ $aboutt->Concept }}</p> <br/>
                             		<h4 align="left" style="text-align: left;">Vision </h4>
                         			<p>{{ $aboutt->Vision }}</p> <br/>
                             		<h4 align="left" style="text-align: left;">Mission </h4>
                             		<p>{{ $aboutt->Mision }}</p> <br/>
                             		
                             	@endforeach

                                <ul class="nav nav-tabs nav-justified" id="myTab">
                                    <li class="{{ (Session::get('active') == null && Session::get('contactus') == null) ? 'active' : '' }}"><a data-toggle="tab" href="#hotel-location"><i class="fa fa-tree"></i> Maps</a>
                                    </li>
                                    <li class="{{ (Session::get('contactus') != null) ? 'active' : '' }}"><a data-toggle="tab" href="#hotel-contactus"><i class="fa fa-car"></i> Contact With Us</a>
                                    </li>
                                    <li class="{{ (Session::get('active') != null) ? 'active' : '' }}"><a data-toggle="tab" href="#hotel-regnewsletter"><i class="fa fa-support"></i> Register To Our Newsletter</a>
                                    </li>
                                </ul>

                                <div class="tab-content" id="myTabContent">
                                    <div id="hotel-location" class="tab-pane fade {{ (Session::get('active') == null && Session::get('contactus') == null) ? ' in active' : '' }}">
                                        <script>
                                        var hotel = new google.maps.LatLng(-6.150049, 106.818953);

                                        var point = [];
                                        var destName = [];

                                            //point.push(new google.maps.LatLng(-6.150049, 106.818953));
                                            destName.push("Everyday Smart Hotel Jakarta");


                                        var markers = [];
                                        var iterator = 0;

                                        var map;

                                        function initialize() {
                                            var mapOptions = {
                                            zoom: 14,
                                            center: hotel
                                            };
                                            map = new google.maps.Map(document.getElementById('map_canvas'), mapOptions);
                                        }

                                        function drop() {
                                          var nama = "Everyday Smart Hotel";
                                          var image = '{{ URL::to('/') }}/resources/icon/logo.png';
                                          markers.push(new google.maps.Marker({
                                            position: hotel,
                                            map: map,
                                            draggable: false,
                                            animation: google.maps.Animation.DROP,
                                            icon: image,
                                            title: nama
                                          }));

                                          for (var i = 0; i < point.length; i++) {
                                            setTimeout(function() {
                                              addMarker();
                                            }, i * 20);
                                          }
                                        }

                                        function addMarker() {
                                            markers.push(new google.maps.Marker({
                                            position: point[iterator],
                                            map: map,
                                            draggable: false,
                                            animation: google.maps.Animation.DROP,
                                            title:destName[iterator]
                                          }));
                                          iterator++;
                                        }
                                        google.maps.event.addDomListener(window, 'load', initialize);

                                    </script>
                                    <div id="map_canvas"></div>
                                    </div>
                                    <div id="hotel-contactus" class="tab-pane fade {{ (Session::get('contactus') != null) ? 'in active' : '' }}">
                                        {{Form::open(array("url"=>URL::action("processing-contact"), "method"=>"post"))}}
                                        {{Form::label('con-fullname','Name')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                        @if($errors->contactus)
                                            {{$errors->contactus->first("con-fullname",'<div class="error">*Full name field is required.</div>');}}
                                        @endif
                                        {{Form::text('con-fullname',null,array("class"=>"form-control"))}}
                                        
                                        {{Form::label('con-email','Email')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                        @if($errors->contactus)
                                            {{$errors->contactus->first("con-email",'<div class="error">*:message.</div>');}}
                                        @endif
                                        {{Form::email('con-email',null,array("class"=>"form-control"))}}
                                        
                                        {{Form::label('con-subject','Subject')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                        @if($errors->contactus)
                                            {{$errors->contactus->first("con-subject",'<div class="error">*:message.</div>');}}
                                        @endif
                                        {{Form::text('con-subject',null,array("class"=>"form-control"))}}

                                        {{Form::label('con-message','Message')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                        @if($errors->contactus)
                                            {{$errors->contactus->first("con-message",'<div class="error">*:message.</div>');}}
                                        @endif
                                        {{Form::textarea('con-message',null,array("class"=>"form-control"))}}

                                        {{Form::submit('send')}}
                                        {{Form::close()}}  
                                    </div>
                                    <div id="hotel-regnewsletter" class="tab-pane fade {{ (Session::get('active') != null) ? 'in active' : '' }}">
                                        {{Form::open(array("url"=>URL::action("processing-newsletter-signup"), "method"=>"post"))}}
                                        
                                        {{Form::label('news-firstname','First Name')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                        @if($errors->newsletter)
                                            {{$errors->newsletter->first("news-firstname",'<div class="error">*The first name field is required.</div>');}}
                                        @endif
                                        {{Form::text('news-firstname',null,array("class"=>"form-control"))}}

                                        {{Form::label('news-lastname','Last Name')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                        @if($errors->newsletter)
                                            {{$errors->newsletter->first("news-lastname",'<div class="error">*The last name field is required.</div>');}}
                                        @endif
                                        {{Form::text('news-lastname',null,array("class"=>"form-control"))}}
                                        
                                        {{Form::label('news-email','Email')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                        @if($errors->newsletter)
                                            {{$errors->newsletter->first("news-email",'<div class="error">*:message.</div>');}}
                                        @endif
                                        {{Form::email('news-email',null,array("class"=>"form-control"))}}
                                        
                                        {{Form::submit('register')}}
                                        {{Form::close()}}  
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <aside class="col-md-4">
                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Hotel Room List</h3>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div id="room" class="carousel slide">
                                    <div class="carousel-inner">           
                                        @foreach($data['room'] as $key => $value)          
                                        <div class="item {{ ($key==0) ? 'active' : '' }}"> 
                                            <a href="{{ URL::to ('/rooms/view/'.$value->ID_RoomType)}}"><img style="width:400px;height:300px;" class="thumbnail" src="{{ URL::to('/')}}/resources/images/hotel/room/{{ $value->Picture }}" alt="Slide_1"></a>
                                            <div class="caption">
                                              <h4><a href="{{ URL::to ('/rooms/view/'.$value->ID_RoomType)}}">{{ $value->RoomType_Name }}</a></h4>
                                            </div>
                                        </div>
                                        @endforeach  

                                    </div>
                                     <!-- Indicators --> 
                                    <ol class="carousel-indicators">
                                        @for($i=0; $i < count($data['room']) ; $i++)
                                        <li data-target="#room" data-slide-to="{{$i}}" class="{{ ($i==0) ? 'active' : '' }}">{{$i}}</li>
                                        @endfor
                                    </ol>                                                   
                                </div><!-- End Carousel Room -->
                            </div>
                        </div>
                    </div><!--/.recent comments-->

                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Hotel Room Offers</h3>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <div id="offer" class="carousel slide">
                                <div class="carousel-inner"> 
                                    @foreach($data['offer'] as $key => $value)          
                                    <div class="item {{ ($key==0) ? 'active' : '' }}"> 
                                        <a href="{{ URL::to ('/offer/view/'.$value->ID_Offer)}}"><img style="width:400px;height:300px;" class="thumbnail" src="{{ URL::to('/')}}/resources/images/hotel/offer/{{ $value->File }}" alt="Slide_1"></a>
                                        <div class="caption">
                                          <h4><a href="{{ URL::to ('/offer/view/'.$value->ID_Offer)}}">{{ $value->Title}}</a></h4>
                                        </div>
                                    </div>
                                    @endforeach                                                                         
                                </div>
                                 <!-- Indicators --> 
                                <ol class="carousel-indicators">
                                    @for($i=0; $i < count($data['offer']) ; $i++)
                                    <li data-target="#offer" data-slide-to="{{$i}}" class="{{ ($i==0) ? 'active' : '' }}">{{$i}}</li>
                                    @endfor
                                </ol> 
                            </div><!-- End Carousel Offer -->
                            </div>
                        </div>
                    </div><!--/.categories-->

                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Trip Advisor</h3>
                        <div class="row">
                            <div class="col-sm-12" align="center">
                                <div id="TA_selfserveprop975" class="TA_selfserveprop">
                                <ul id="mCPns5ENAa6" class="TA_links jJSpJqr3Hp">
                                <li id="QnTaRlq2B" class="wUZ2LK6hpUOA">
                                <a target="_blank" href="http://www.tripadvisor.com/"><img src="http://www.tripadvisor.com/img/cdsi/img2/branding/150_logo-11900-2.png" alt="TripAdvisor"/></a>
                                </li>
                                </ul>
                                </div>
                                <script src="http://www.jscache.com/wejs?wtype=selfserveprop&amp;uniq=975&amp;locationId=3913914&amp;lang=en_US&amp;rating=true&amp;nreviews=5&amp;writereviewlink=true&amp;popIdx=false&amp;iswide=false&amp;border=false&amp;display_version=2"></script>
                            </div>
                        </div>
                    </div><!--/.archieve-->

                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Contact & Address</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                <h5 align="center">Address</h5>
                                <p align="center">{{ $aboutt->Address }}</p>
                                <p align="center"><a href="mailto:{{ $aboutt->Email }}">{{ $aboutt->Email }}</a></p>
                                <p align="center">{{ $aboutt->Telephone }}</p>

                            </div>
                        </div>
                    </div><!--/.categories-->
	            </aside>
            </div>
        </div>
</section>
@stop

@section('showModal')
@if(Session::get('message') != null || Session::get('contactus') != null)
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="successLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div align="center" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="successLabel">Success</h4>
            </div>
            <div class="modal-body">
                @if(Session::get('message') != null)
                <p>{{ Session::get('message') }}</p> 
                @elseif(Session::get('contactus') != null)
                <p>{{ Session::get('contactus')}}</p> 
                @endif
            </div>
            <div class="modal-footer">
                &copy; Hotel Everyday Smart Hotel Jakarta 
            </div>
        </div>
    </div>
</div>
@endif
@stop


@section('scriptModal')
    @if(Session::get('message') != null || Session::get('contactus') != null)
        <script type="text/javascript"> 
        $("#success").modal("show");

        setTimeout(function(){
            $("#success").modal("hide");
        }, 10000);
        </script>
    @endif
@stop