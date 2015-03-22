@extends('layout.default')

@section("title")Rooms - Everyday Smart Hotel @stop

@section('content')

<section id="blog" class="container">

        <div class="center">

            <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i> <a href="{{URL::to('/rooms')}}"> Rooms</a> <i class="fa fa-caret-right"></i></h2>

        </div>

        <div class="blog">
            <div class="row section-color">
                <div class="col-md-8 div-main">
                    <div class="blog-item">
                        <div class="row">

                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                                <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <h2 align="center"style="border-bottom: dotted;font-weight: bold"> {{ $rooms->RoomType_Name }} </h2>
                                    <div id="slider1_container" style="position: relative; top: 0px; left: 0px; width: 800px;
                                        height: 456px; background: #191919; overflow: hidden;">
                                        <!-- Loading Screen -->
                                        <div u="loading" style="position: absolute; top: 0px; left: 0px;">
                                            <div style="filter: alpha(opacity=70); opacity:0.7; position: absolute; display: block;
                                                background-color: #000000; top: 0px; left: 0px;width: 100%;height:100%;">
                                            </div>
                                            <div style="position: absolute; display: block; background: url({{ URL::to('/') }}resources/images/jssor-slider/img/loading.gif) no-repeat center center;
                                                top: 0px; left: 0px;width: 100%;height:100%;">
                                            </div>
                                        </div>
                                        <!-- Slides Container -->
                                        <div u="slides" style="cursor: move; position: absolute; left: 0px; top: 0px; width: 800px; height: 356px; overflow: hidden;">
                                        <?php  $slide = $rooms->getPicture() ?>
                                        @foreach($slide as $item)
                                            <div>
                                                <img u="image" src="{{ URL::to('/') }}/resources/images/hotel/room/{{$item->Picture}}" />
                                                <img u="thumb" src="{{ URL::to('/') }}/resources/images/hotel/room/{{$item->Picture}}" />
                                            </div>
                                        @endforeach
                                        </div>
                                        <!-- Arrow Left -->
                                        <span u="arrowleft" class="jssora05l" style="width: 40px; height: 40px; top: 158px; left: 8px;">
                                        </span>
                                        <!-- Arrow Right -->
                                        <span u="arrowright" class="jssora05r" style="width: 40px; height: 40px; top: 158px; right: 8px">
                                        </span>
                                        <!-- Arrow Navigator Skin End -->

                                        <!-- Thumbnail Navigator Skin Begin -->
                                        <div u="thumbnavigator" class="jssort01" style="position: absolute; width: 800px; height: 100px; left:0px; bottom: 0px;">
                                            <!-- Thumbnail Item Skin Begin -->
                                            <div u="slides" style="cursor: move;">
                                                <div u="prototype" class="p" style="position: absolute; width: 72px; height: 72px; top: 0; left: 0;">
                                                    <div class=w><div u="thumbnailtemplate" style=" width: 100%; height: 100%; border: none;position:absolute; top: 0; left: 0;"></div></div>
                                                    <div class=c>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Thumbnail Item Skin End -->
                                        </div>
                                        <!-- Thumbnail Navigator Skin End -->
                                        <a style="display: none" href="http://www.jssor.com">javascript</a>
                                    </div>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <h3>Room Description : <a class="pull-right btn btn-primary readmore" href="{{ URL::to('/book/normal/room/'.$rooms->ID_RoomType) }}">Book NOW!</a> </h3> 
                                    <p> {{ $rooms->Description }} </p> 
                                    <h4 style="color: #0182c4;font-weight: bold">Price Start from : {{ $rooms->Price }}</h4> 
                                    
                                    
                                    <h3>Facility</h3>
                                    <ul>
                                    <?php 
                                    $set = explode("|", $rooms->Facility);

                                    foreach ($set as $dat) {
                                        $dat = trim($dat);
                                        echo "<li>".$dat."</li>";
                                    }
                                    ?>
                                    </ul>
                                </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <aside class="col-md-4">
                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Other Room List</h3>
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <ul class="no-style" style="text-align: left">
                                    @foreach($listRoom as $list)
                                        <li> <a href="{{URL::to('/rooms/view/'.$list->ID_RoomType)}}"><i class="fa fa-caret-right"></i> {{$list->RoomType_Name}}</a> </li>
                                    @endforeach   
                                </ul>
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
                </aside>
            </div>
        </div>
</section>
@stop