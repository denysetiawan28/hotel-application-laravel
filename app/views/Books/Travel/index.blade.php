@extends('layout.default')

@section("title")Select Rates - Everyday Smart Hotel @stop

@section('content')



<section id="blog" class="container">
        <div class="center">
            <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i><a href="{{URL::to('/books')}}"> Book Room</a> <i class="fa fa-caret-right"></i></h2>
        </div>
        <div class="blog ">
            <div class="row section-color">
                <div class="col-md-8 div-main">
                    <div class="blog-item">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12 blog-content">
                            	@if(Cache::has('travel_session'))
                        			@foreach($travel as $key)
                            		<h5>Welcome, {{ $key->Travel_Name }}</h5>
                            		<p>You have session for 60 minutes to complete booking</p>
                            		@endforeach
                            	@endif
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                @if(empty($countOffer))
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#noOffer">
                                                        No Offer yet
                                                    </a>
                                                </h4>
                                            </div>

                                            <div id="noOffer" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                    <div class="blog-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12 col-sm-12 blog-content">
                                                                <div class="col-md-5 col-xs-5 col-sm-5">
                                                                <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/hotel/room/" width="100%" height="100px" alt="" /></a>
                                                                </div>
                                                                <div class="col-md-7 col-xs-7 col-sm-7">
                                                                <h4 style="color: #0182c4;font-weight: bold"> </h4>
                                                                <p> Currently there is no offer for any room, click here stay up to date with us</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    @for($i=0; $i < $countOffer ; $i++)
                                    <?php $plus = $i + 1; ?>
                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#{{$offer[$plus]['ID_Offer']}}">
                                                        Offer : {{$offer[$plus]['Title']}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="{{$offer[$plus]['ID_Offer']}}" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                {{Form::open()}}
                                                <?php $count = $countDetail/$countOffer; ?>
                                                    @for($j = 0; $j < $count; $j++)
                                                    <div class="blog-item">
                                                        <div class="row">
                                                            <div class="col-md-12 col-xs-12 col-sm-12 blog-content">
                                                                <div class="col-md-5 col-xs-5 col-sm-5">
                                                                    <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/hotel/room/{{$offer[$plus]['Picture']}}" width="100%" height="100px" alt="" /></a>
                                                                </div>

                                                                <div class="col-md-7 col-xs-7 col-sm-7">
                                                                    <h4 style="color: #0182c4;font-weight: bold"> {{ $offer[$plus]['RoomType_Name'] }}</h4>
                                                                    <p> {{ $offer[$plus]['Description'] }} </p>
                                                                    <h6>Price : {{ $offer[$plus]['Promo'] }} </h6>
                                                                    <a class="btn btn-primary readmore" href="{{URL::to('/book/offer/'.$offer[$plus]['ID_Offer'].'/room/'.$offer[$j]['ID_RoomType'])}}">Select Room<i class="fa fa-angle-right"></i></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endfor
                                                    {{Form::close()}}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endfor
                                @endif

                                    <div class="panel-group" id="accordion">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">
                                                    <a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#normal">
                                                        Normal Cost
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="normal" class="panel-collapse collapse">
                                                <div class="panel-body">
                                                {{Form::open()}}
                                                    @foreach($rooms as $item)
                                                        <div class="blog-item">
                                                            <div class="row">
                                                                <div class="col-md-12 col-xs-12 col-sm-12 blog-content">
                                                                    <div class="col-md-5 col-xs-5 col-sm-5">
                                                                        <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/hotel/room/{{$item->Picture}}" width="100%" height="100px" alt="" /></a>
                                                                    </div>

                                                                    <div class="col-md-7 col-xs-7 col-sm-7">
                                                                        <h4 style="color: #0182c4;font-weight: bold"> {{ $item->RoomType_Name }}</h4>
                                                                        <p> {{ $item->IsiRoom }} </p>
                                                                        <h6>Price : {{ $item->Price }} </h6>
                                                                        <a class="btn btn-primary readmore" href="{{URL::to('/book/normal/room/'.$item->ID_RoomType)}}">Select Room<i class="fa fa-angle-right"></i></a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                {{Form::close()}}   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <aside class="col-md-4">
                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Your Stay</h3>
                            <div class="col-md-12 col-xs-12">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="col-sm-5 col-xs-5"> <p>Arrive Date : </p> </div>
                                        <div class="col-sm-7 col-xs-7"> <input type='text' name="from" placeholder="Arrival" id="from" readonly="true"/> </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="col-sm-5 col-xs-5"> <p>Depart Date : </p> </div>
                                        <div class="col-sm-7 col-xs-7"> <input type='text' name="to" placeholder="Departure" id="to" readonly="true"/> </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="col-sm-5 col-xs-5"> <p>Total Night : </p> </div>
                                        <div class="col-sm-7 col-xs-7"> <input type='text' name="total_d" placeholder="Total Night" id="total_days" readonly="true" /> </div>
                                    </div>
                                </div>
                            </div>
                    </div><!--/.recent comments-->

                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Guest Detail</h3>
                        <div class="row">
                            <div class="col-md-12 col-sm-12 col-xs-12">
                                <div class="col-sm-12">
                                    <div class="col-sm-6 col-xs-6">
                                        <p>Adult : </p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6"> 
                                        {{ Form::selectRange("adult","1","2",NULL,array("style"=>"width:130px")) }}
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 col-xs-6">
                                       <p>Child : </p>
                                    </div>
                                    <div class="col-sm-6 col-xs-6">
                                       {{ Form::selectRange("child","0","2",NULL,array("style"=>"width:130px")) }}
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div><!--/.categories-->
                </aside>
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



