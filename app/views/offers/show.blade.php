@extends("layout.default")
@section("title")Offer - Everyday Smart Hotel @stop
@section("content")

<section id="blog" class="container">
    <div class="center">
        <h2><a href="{{URL::to('/')}}">Home</a> <i class="fa fa-caret-right"></i> View Offer <i class="fa fa-caret-right"></i> {{$offer->Title}}</h2>
    </div>

    <div class="blog">
        <div class="row section-color">
             <div class="col-md-8 div-main">
                <div class="blog-item">
                    <div class="row">
                        <div class="col-xs-12 col-sm-2 text-center">
                            <div class="entry-meta">
                                <span id="publish_date">
                                    <p>Created Date</p>
                                    <p>{{$offer->From_Date}}</p>
                                </span>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-10 blog-content">
                        <h2><a href="{{ URL::to('/offer/view/'. $offer->ID_Offer) }}">{{ $offer->Title }}</a></h2>
                            <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/hotel/offer/{{ $offer->File }}" width="100%" alt="" /></a>
                            <h3>{{ $offer->Description }}</h3>
                            <h5>Offer Start Date : {{$offer->From_Date}}</h5>
                            <h5>Offer End Date : {{$offer->Until_Date}}</h5>

                            <ul class="nav nav-tabs nav-justified" id="myTab">
                                
                                <li class=""><a data-toggle="tab" href="#offer-room"><i class="fa fa-tree"></i>Offer Room</a>
                                </li>
                            
                            </ul>

                            <div class="tab-content" id="myTabContent">
                                <div id="offer-room" class="tab-pane fade active in">     
                                    @foreach($offerDetail as $item => $value)                         
                                    <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                                        <div class="col-xs-3 col-sm-4">
                                        <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/hotel/room/{{ $value->Picture }}" width="100%" height="100px" alt="" /></a>
                                        </div>
                                        <div class="col-xs-7 col-sm-5">
                                        <h4 style="color: #0182c4;font-weight: bold"> {{ $value->RoomType_Name }}</h4>
                                        <p> {{ $value->Description }} </p>
                                        <h6>Price : {{ $value->Promo }} </h6>
                                        </div>
                                        <div class="col-xs-2 col-sm-1">
                                        <a class="btn btn-primary readmore" href="{{URL::to('/book/offer/'.$value->ID_Offer.'/room/'.$value->ID_RoomType )}}">Select Room<i class="fa fa-angle-right"></i></a>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div><!--/.blog-item-->
            </div><!--/.col-md-8-->


            <aside class="col-md-4">
                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Room List</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="room" class="carousel slide">
                                <div class="carousel-inner">
                                    <div class="item active">
                                        <a href="{{URL::to('/rooms/view/'.$room['0']['ID_RoomType'])}}"><img class="thumbnail" src="{{URL::to('/')}}/resources/images/hotel/room/{{$room[0]['Picture']}}" alt="Slide1"></a>
                                    </div>
                                    @for($i = 1; $i<$countRoom;$i++)
                                    <div class="item">
                                        <a href="{{URL::to('/rooms/view/'.$room[$i]['ID_RoomType'])}}"><img class="thumbnail" src="{{URL::to('/')}}/resources/images/hotel/room/{{$room[$i]['Picture']}}" alt="Slide{{{$i}}}"></a>
                                     </div>
                                     @endfor
                                </div>
                                
                                 <!-- Indicators -->
                                 <ol class="carousel-indicators">
                                    <li data-target="#room" data-slide-to="0" class="active"></li>
                                    @for($i = 1; $i<$countRoom;$i++)
                                    <li data-target="#room" data-slide-to="{{$i}}"></li>
                                    @endfor

                                 </ol>
                            </div><!-- End Carousel Room -->
                        </div>
                    </div>
                </div><!--/.recent comments-->

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
        </div><!--/.row-->
    </div>
</section><!--/#blog-->
@stop


