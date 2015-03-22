@extends('layout.default')
@section("title")Tourism - Everyday Smart Hotel @stop
@section('content')
<section id="blog" class="container">
        <div class="center">
            <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i> Tourism <i class="fa fa-caret-right"></i></h2>
        </div>

        <div class="blog">
            <div class="row section-color">
                <div class="col-md-8 div-main">
                    <div class="blog-item">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                                <div class="col-md-12 col-xs-3 col-sm-4">
                                    <h2 align="center" style="border-bottom:dotted;"> {{ $destination->Dest_Name }} </h2>
                                    <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/destination/{{ $destination->Dest_Picture }}" width="100%" alt="" /></a>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <table class="table table-bordered table-stripped">
                                        <tr>
                                            <td colspan="2"><h3 align="center">Description</h3></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><p style="text-align:justify;">{{ $destination->Dest_Description }}</p></td>
                                        </tr>
                                        <tr>
                                            <td><p style="text-align:left;">Destination Website</p></td>
                                            <td><p style="text-align:left;"><a class="btn btn-primary" href="http://{{$destination->Web_Link}}" target="_blank"><span class="glyphicon glyphicon-globe"></span> Visit destination website</a></p></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><h3 align="center">Maps</h3></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <script>
                                                var hotel = new google.maps.LatLng(-6.150049, 106.818953);

                                                var point = [];
                                                var destName = [];

                                                    point.push(new google.maps.LatLng({{ $destination->Latitude }}, {{ $destination->Longitude}}));
                                                    destName.push("{{ $destination->Name }}");


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
                                            </td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="col-md-4">
                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Tourism Event</h3>
                        <div class="row">
                            <div class="col-sm-12">
                               <ul class="no-style" style="text-align: left">
                                @foreach($listDest as $listItem)
                                <li><a href="{{URL::to('/tourism/view/'.$listItem->ID_Destination)}}"><i class="fa fa-caret-right"></i> {{$listItem->Dest_Name}} </a> </li>
                                @endforeach
                                </ul>
                            </div>
                        </div>
                    </div><!--/.recent comments-->

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
                </aside>
            </div>
        </div>
</section>
@stop