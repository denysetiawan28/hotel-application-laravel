@extends("layout.default")
@section("title")Home - Everyday Smart Hotel @stop
@section("content")

<section id="main-slider" class="no-margin">

    <div class="carousel slide">

            <div class="carousel-inner">

            <div class="item img-responsive active" style="background-image: url({{ URL::to('/') }}/resources/images/slider/bg4.jpg)">

                <div class="carousel-caption">

                    <h3>Welcome to Everyday Smart Hotel Jakarta</h3>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>

                    

                </div>

            </div><!--/.item-->

            <div class="item img-responsive" style="background-image: url({{ URL::to('/') }}/resources/images/slider/bg3.jpg)">

                <div class="carousel-caption">

                    <h3>Headline</h3>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>

                    <p><a class="btn btn-info btn-sm">Read More</a></p>

                </div>

            </div><!--/.item-->

            <div class="item img-responsive" style="background-image: url({{ URL::to('/') }}/resources/images/slider/bg2.jpg)">

                <div class="carousel-caption">

                    <h3>Headline</h3>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>

                    <p><a class="btn btn-info btn-sm">Read More</a></p>

                </div>

            </div><!--/.item-->

            <div class="item img-responsive" style="background-image: url({{ URL::to('/') }}/resources/images/slider/bg1.jpg)">

                <div class="carousel-caption">

                    <h3>Headline</h3>

                    <p>Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua.</p>

                    <p><a class="btn btn-info btn-sm">Read More</a></p>

                </div>

            </div><!--/.item-->

        </div><!--/.carousel-inner-->

    </div><!--/.carousel-->

    <a class="prev hidden-xm" href="#main-slider" data-slide="prev">

        <i class="fa fa-chevron-left"></i>

    </a>

    <a class="next hidden-xm" href="#main-slider" data-slide="next">

        <i class="fa fa-chevron-right"></i>

    </a>

</section><!--/#main-slider-->



<section class="recent-works section-color no-margin">

    <div class="container">

        <div class="row div-row">

            <div class="col-md-12 col-sm-12 col-xs-12">

                <div class="row">

                    <!--Room-->
                    <div class="col-md-4 col-sm-12 col-xs-12 home-header-padding">
                        <h2 class="header-home home-align">Hotel Rooms</h2>
                        <div id="room" class="carousel slide">
                            <div class="carousel-inner">           
                                @foreach($data['room'] as $key => $value)          
                                <div class="item {{ ($key==0) ? 'active' : '' }}"> 
                                    <a href="{{ URL::to ('/rooms/view/'.$value->ID_RoomType)}}" class="thumbnail"><img class="img-responsive" src="{{ URL::to('/')}}/resources/images/hotel/room/{{ $value->Picture }}" alt="Slide_1"></a>
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
                    <!--End Room-->

                    <!--Offer-->
                    <div class="col-md-4 col-sm-12 col-xs-12 home-header-padding">
                        <h2 class="header-home">Hotel Room Offers</h2>
                        <div id="offer" class="carousel slide">
                            <div class="carousel-inner"> 
                                @foreach($data['offer'] as $key => $value)          
                                <div class="item {{ ($key==0) ? 'active' : '' }}"> 
                                    <a href="{{ URL::to ('/offer/view/'.$value->ID_Offer)}}" class="thumbnail"><img class="img-responsive" src="{{ URL::to('/')}}/resources/images/hotel/offer/{{ $value->File }}" alt="Slide_1"></a>
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
                    <!--End Offer-->

                    <!--Book-->
                    <div class="col-md-4 col-sm-12 col-xs-12 home-header-padding">
                        <h2 class="header-home home-align">Book Room Now</h2>
                        {{ Form::open(array('url'=>URL::action("check-available"),'method'=>'post')) }}
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p>Arrive Date : </p>
                            {{ Form::text('from',null,array('class'=>'form-control','id'=>'from','readonly'=>'true')) }}
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                             <p>Depart Date : </p>
                             {{ Form::text('to',null,array('class'=>'form-control','id'=>'to','readonly'=>'true')) }}
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <p>Total Night : </p>
                            {{ Form::text('total',null,array('class'=>'form-control','id'=>'total_days','readonly'=>'true')) }}
                        </div>
                        <div class="col-md-12 col-sm-12 col-xs-12">
                            <input type="hidden" name="sent" value="1"/>
                             {{ Form::submit('Book Now!', array('class'=>'btn btn-primary')) }}
                        </div>
                        {{ Form::close() }}
                    </div> 
                    <!--End Book-->

                    <!--Our Gallery-->
                    <div class="col-lg-12 col-md-12 col-xs-12 home-header-padding">
                        <h2 class="header-home home-align">Everyday Smart Hotel Jakarta Gallery</h2>
                        <div class="carousel slide article-slide" id="gallery">
                            <div class="carousel-inner cont-slider">
                                @foreach($data['gallery'] as $key => $value)
                                <div class="item {{ ($key == 0) ? 'active' : '' }}">
                                    <img style="width:1200px;height:600px"src="{{URL::to('/')}}/resources/images/hotel/gallery/{{ $value->Gallery_Picture }}">
                                </div>
                                @endforeach
                            
                            </div>
                          
                          <!-- Indicators -->
                            <ol class="carousel-indicators visible-lg visible-md">
                                <?php $i = 0; ?>
                                @foreach($data['gallery'] as $key => $value)
                                <li class="{{ ($key == 0) ? 'active' : '' }}" data-slide-to="{{$i++}}" data-target="#gallery">
                                    <img src="{{URL::to('/')}}/resources/images/hotel/gallery/{{ $value->Gallery_Picture }}">
                                </li>
                                @endforeach
                            </ol>                 
                        </div>  
                    </div>
                    <!--End Our Gallery-->


                    <div class="col-lg-12 col-md-12 col-xs-12 home-header-padding">
                        <h2 class="header-home">Other Information</h2>
                        <!--Dinas-->
                        <div class="col-lg-4 col-md-4 home-header-padding">
                            <h2 class="header-home home-align">Jakarta Tourism Event</h2>
                            <div id="dinas" class="carousel slide">
                                <div class="carousel-inner"> 
                                    @foreach($data['dinas'] as $key => $value)          
                                    <div class="item {{ ($key == 0) ? 'active' : '' }}"> 
                                        <a href="{{ URL::to('/eventdinas/view/'.$value->Event_ID) }}" class="thumbnail"><img class="img-responsive" src="{{ URL::to('/')}}/resources/images/integration/int_dinas/{{ $value->Event_Picture }}" alt="Slide_1"></a>
                                        <div class="caption">
                                          <h4>{{ $value->Event_Title}}</h4>
                                          <p>{{ $value->IsiEvent }} <a href="{{ URL::to('/eventdinas/view/'.$value->Event_ID) }}">Read More...</a></p>
                                        </div>
                                    </div>
                                    @endforeach 
                                </div>
                                 <!-- Indicators --> 
                                <ol class="carousel-indicators">
                                    @for($i=0 ; $i < count($data['dinas']) ; $i++)
                                    <li data-target="#dinas" data-slide-to="{{$i}}" class="{{ ($i == 0) ? 'active' : '' }}">{{$i}}</li>
                                    @endfor
                                </ol> 
                            </div><!-- End Carousel Dinas -->
                        </div>
                        <!--End Dinas-->

                        <!--Travel Agent-->
                        <div class="col-lg-4 col-md-4 home-header-padding">
                            <h2 class="header-home home-align">Travel Agent</h2>
                            <div class="well">          
                                <div id="travel" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach(array_chunk($data['travel'],4) as $key => $value)
                                        <div class="item {{ ($key == 0 ) ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach($value as $val)
                                                <div class="col-md-6">
                                                    <a href="{{ URL::to('/travel/view/'. $val->ID_Travel) }}" class="thumbnail">
                                                        <img style="width:200;height:120px;" class="img-responsive" src="{{ URL::to('/')}}/resources/images/travel/{{ $val->Travel_Logo }}">
                                                    </a>
                                                    
                                                    <div>
                                                    <h4><a href="{{ URL::to('/travel/view/. $val->ID_Travel') }}">{{ $val->Travel_Name }}</a></h4>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach     
                                    </div>
                                    <a class="left carousel-control" href="#travel" data-slide="prev"><i class="fa fa-chevron-left fa-2x"></i></a>
                                    <a class="right carousel-control" href="#travel" data-slide="next"><i class="fa fa-chevron-right fa-2x"></i></a>
                                    
                                    <ol id="travel" class="carousel-indicators">
                                        @for($i=0 ; $i < count(array_chunk($data['travel'],4)) ; $i++)
                                        <li data-target="#travel" data-slide-to="{{$i}}" class="{{ ($i==0) ? 'active' : '' }}">{{$i}}</li>
                                        @endfor
                                    </ol>                
                                </div><!-- End Carousel --> 
                            </div><!-- End Well -->
                        </div>
                        <!--End Travel Agent-->

                        <!--Destination-->
                        <div class="col-lg-4 col-md-4 home-header-padding">
                            <h2 class="header-home home-align">Jakarta Tourism Destination</h2>
                            <div class="well">          
                                <div id="destination" class="carousel slide">
                                    <div class="carousel-inner">
                                        @foreach(array_chunk($data['destination'],4) as $key => $value)
                                        <div class="item {{ ($key==0) ? 'active' : '' }}">
                                            <div class="row">
                                                @foreach($value as $val)
                                                <div class="col-md-6">
                                                    <a href="{{ URL::to('/tourism/view/'.$val->ID_Destination)}}" class="thumbnail">
                                                        <img style="width:200px;height:120px;" class="img-responsive" src="{{ URL::to('/')}}/resources/images/destination/{{ $val->Dest_Picture }}">
                                                    </a>
                                                    
                                                    <div>
                                                    <h4><a href="{{ URL::to('/tourism/view/'.$val->ID_Destination)}}">{{ $val->Dest_Name }}</a></h4>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                    <a class="left carousel-control" href="#destination" data-slide="prev"><i class="fa fa-chevron-left fa-2x"></i></a>
                                    <a class="right carousel-control" href="#destination" data-slide="next"><i class="fa fa-chevron-right fa-2x"></i></a>
                                    
                                    <ol id="travel" class="carousel-indicators">
                                        @for($i=0 ; $i < count(array_chunk($data['destination'],4)) ;$i++)
                                        <li data-target="#destination" data-slide-to="{{$i}}" class="{{ ($i==0) ? 'active' : '' }}">{{$i}}</li>
                                        @endfor
                                    </ol>                
                                </div><!-- End Carousel --> 
                            </div><!-- End Well -->
                        </div>
                        <!--End Destination-->
                    </div>

                    <div class="col-lg-4 col-md-4 col-xs-4 home-header-padding">
                        <h2 class="header-home home-align">Everyday Smart Hotel Tweet</h2>
                        <a class="twitter-timeline" href="https://twitter.com/everydayhotels" data-widget-id="569596726139318272">Tweets by @everydayhotels</a>
                        <script>
                        !function(d,s,id)
                        {
                            var js,
                            fjs=d.getElementsByTagName(s)[0],
                            p=/^http:/.test(d.location)?'http':'https';
                            if(!d.getElementById(id))
                                {
                                    js=d.createElement(s);
                                    js.id=id;js.src=p+"://platform.twitter.com/widgets.js";
                                    fjs.parentNode.insertBefore(js,fjs);
                                }
                        }(document,"script","twitter-wjs");
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@stop   


@section("scriptDate")
<script>
    $(function() {
        $('#from').datepick({
            dateFormat: 'dd-mm-yyyy',
            minDate: 0,
            maxDate: '+1y',
            changeMonth: true,
            onSelect: customRange,
            defaultDate: '0',
            selectDefaultDate: true
        });

        $('#to').datepick({
            dateFormat: 'dd-mm-yyyy',
            minDate: 0,
            maxDate: '+1y',
            changeMonth: true,
            onSelect: customRange,
            defaultDate: '1',
            selectDefaultDate: true
        });
        $('#inline').datepick({
            monthsToShow: 2,
            showOtherMonths: true,
            firstDay: 1,
            renderer: $.datepick.weekOfYearRenderer,
            onShow: $.datepick.showStatus
        })
    });



    function customRange(dates) {
        var start = $('#from').datepick('getDate')[0];
        var end = $('#to').datepick('getDate')[0];
        var total = start && end ? (end.getTime() - start.getTime()) / 1000 / 60 / 60 / 24 : '';
        if (this.id == 'from') {
            $('#to').datepick('option', 'minDate', dates[0] || null);
            $( "#listRender" ).datepick( "option", "minDate", dates[0] || null);
        }
        else {
            $('#from').datepick('option', 'maxDate', dates[0] || null);
            $( "#listRender" ).datepick( "option", "maxDate", dates[0] || null);
        }
        $('#total_days').val(total);
    }

    function calculator() {
        var quantity = $('#quantity option:selected').html();
        $('#quantity').on('change', function () {
          alert($(quantity).val());
          alert($(quantity).text());
        });
    }
</script>

@stop