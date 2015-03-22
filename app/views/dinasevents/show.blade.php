@extends("layout.default")

@section("title")News - Everyday Smart Hotel @stop

@section("content")



<section id="blog" class="container">

    <div class="center">

        <h2><a href="{{URL::to('/')}}">Home</a> <i class="fa fa-caret-right"></i> View Event Dinas</h2>

    </div>



    <div class="blog">

        <div class="row section-color">

             <div class="col-md-8 div-main">

                <div class="blog-item">

                    <div class="row">

                        <div class="col-xs-12 col-sm-12 col-md-12 blog-content">
                        <h2 style="text-align:center;border-bottom:dotted;"><a href="{{ URL::to('/eventdinas/view/'. $dinas->Event_ID) }}">{{ $dinas->Event_Title }}</a></h2>

                            <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/integration/int_dinas/{{ $dinas->Event_Picture }}" width="100%" alt="" /></a>
                            <br/>
                            <table class="table table-striped table-bordered">
                                <tr>
                                    <td colspan="2"><h3 align="center">Event Description</h3></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><p style="text-align:justify;">{{ $dinas->Event_Description }}</p></td>
                                </tr>
                                <tr>
                                    <td><p style="text-align:center;"><h4 align="center">Event Date</h4></p></td>
                                    <td><p style="text-align:center;"><h4 align="center">Event Location</h4></p></td>
                                </tr>
                                <tr>
                                    <td><p style="text-align:center;"><span class="glyphicon glyphicon-calendar"></span>{{ date("D, d-m-o",strtotime($dinas->Event_Date)) }}</p></td>
                                    <td><p style="text-align:center;"><span class="glyphicon glyphicon-map-marker"></span>{{ $dinas->Event_Location }}</p></td>
                                </tr>
                            </table>

                        </div>

                    </div>

                </div><!--/.blog-item-->

            </div><!--/.col-md-8-->





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

        </div><!--/.row-->

    </div>

</section><!--/#blog-->

@stop





