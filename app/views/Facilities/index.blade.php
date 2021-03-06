@extends('layout.default')
@section("title")Facility - Everyday Smart Hotel @stop
@section('content')

<section id="blog" class="container">
    <div class="center">
        <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i> Facilities </h2>
    </div>

    <div class="blog">
        <div class="row section-color">
            <div class="col-md-8 div-main">
            <h2 style="border-bottom: dotted">Our Facility</h2>
            <p>Our 475 rooms and suites are among the most spacious accommodations in Jakarta and look out over the leafy surrounding offering a unique view of the city skyline.</p>

            @foreach($facility as $item)
                <div class="blog-item">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                            <div class="col-md-5 col-xs-5 col-sm-5">
                            <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/hotel/facility/{{$item->Picture}}" width="100%" height="100px" alt="" /></a>
                            </div>
                            <div class="col-md-7 col-xs-7 col-sm-7">
                            <h4 style="color: #0182c4;font-weight: bold"> {{ $item->Facility_Name }}</h4>
                            <p> {{ $item->isiFac }} </p>
                            <a class="btn btn-primary readmore" href="{{URL::to('/facilities/view/'.$item->ID_Facility)}}">More Info<i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
            {{ $facility->links() }}
            </div>

            <aside class="col-md-4">
                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Hotel Facility List</h3>
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-122">
                            <ul class="no-style">
                                @foreach($faciList as $list)
                                <li> <a href="{{URL::to('/facilities/view/'.$list->ID_Facility)}}"><i class="fa fa-caret-right"></i> {{$list->Facility_Name}}</a> </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>  
                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Hotel Room</h3>
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
                    <h3 class="header-sidebar">Hotel Room Offer</h3>
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