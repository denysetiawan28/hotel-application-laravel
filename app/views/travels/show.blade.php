@extends('layout.default')
@section("title")Travel - Everyday Smart Hotel @stop
@section('content')
<section id="blog" class="container">
        <div class="center">
            <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i> Travel <i class="fa fa-caret-right"></i></h2>
        </div>

        <div class="blog">
            <div class="row section-color">
                <div class="col-md-8 div-main">
                    <div class="blog-item">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                                <div class="col-md-12 col-xs-3 col-sm-4">
                                    <h2 align="center" style="border-bottom:dotted;"> {{ $travel->Travel_Name }} </h2>
                                    <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/travel/{{ $travel->Travel_Logo }}" width="100%" alt="" /></a>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td><h4>Travel Address : </h4></td>
                                            <td><p><span class="glyphicon glyphicon-map-marker"></span> {{ $travel->Travel_Address }} </p></td>
                                        </tr>
                                        <tr>
                                            <td><h4>Travel Phone : </h4></td>
                                            <td><p><span class="glyphicon glyphicon-phone-alt"></span> {{ $travel->Travel_Telp }} </p></td>
                                        </tr>
                                        <tr>
                                            <td><h4>Travel Email : </h4></td>
                                            <td><span class="glyphicon glyphicon-envelope"></span><a href="mailto:{{$travel->Travel_Email}}"> {{ $travel->Travel_Email }} </a></td>
                                        </tr>
                                        <tr>
                                            <td><h4>Travel Web : </h4></td>
                                            <td><a class="btn btn-primary" href="http://{{$travel->Web_Link}}" target="_blank"><span class="glyphicon glyphicon-globe"></span> Go to Travel Booking Package Website</a></td>
                                        </tr>
                                    </table>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <ul class="nav nav-tabs nav-justified" id="myTab">
                                        <li class=""><a data-toggle="tab" href="#offer-room"><i class="fa fa-tree"></i>Travel Package</a></li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        <div id="offer-room" class="tab-pane fade active in">
                                            @foreach($package as $item)
                                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                                                <div class="col-xs-3 col-sm-4">
                                                <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/integration/int_travel/{{ $item->Package_Picture}}" width="100%" height="100px" alt="" /></a>
                                                </div>
                                                <div class="col-xs-7 col-sm-5">
                                                <h4 style="color: #0182c4;font-weight: bold"> {{ $item->Package_Name}}</h4>
                                                <p> {{ $item->Package_Description}} </p>
                                                <h6>Price : {{ $item->Package_Price}} </h6>
                                                </div>

                                            </div>
                                            @endforeach
                                        </div>
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
                </aside>
            </div>
        </div>
</section>
@stop