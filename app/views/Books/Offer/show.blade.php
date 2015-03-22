@extends('layout.default')
@section("title")Detail Information - Everyday Smart Hotel @stop
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
                        <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                        {{Form::open(array("url"=>URL::action("processing-offerBook"), "method"=>"post"))}}
                            <div class="col-md-12 col-xs-12 col-sm-10">
                                <h3 style="text-align: center; border-bottom: dotted;">Guest Information</h3>
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                <h6>01. Personal Data</h6>
                                {{ Form::label("fname","First Name") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                    @if($errors->guest)
                                        {{$errors->guest->first("fname",'<div class="error">*The first name field is required.</div>')}}
                                    @endif
                                {{ Form::text("fname",Input::old("fname"),array("class"=>"form-control")) }}

                                {{ Form::label("lname","Last Name") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                @if($errors->guest)
                                    {{$errors->guest->first("lname",'<div class="error">*The last name field is required.</div>')}}
                                @endif
                                {{ Form::text("lname",Input::old("lname"),array("class"=>"form-control")) }}

                                {{ Form::label("identity","Identity Number") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                @if($errors->guest)
                                    {{$errors->guest->first("identity",'<div class="error">*:message</div>')}}
                                @endif
                                {{ Form::text("identity",Input::old("identity"),array("class"=>"form-control")) }}

                                {{ Form::label("email","Email") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                @if($errors->guest)
                                    {{$errors->guest->first("email",'<div class="error">*:message</div>')}}
                                @endif
                                {{ Form::text("email",Input::old("email"),array("class"=>"form-control")) }}

                                {{ Form::label("country","Country") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                @if($errors->guest)
                                    {{$errors->guest->first("country",'<div class="error">*:message</div>')}}
                                @endif
                                <select id="country" name="country" class="form-control">

                                </select>

                                {{ Form::label("phone","Phone Number") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                @if($errors->guest)
                                    {{$errors->guest->first("phone",'<div class="error">*:message</div>')}}
                                @endif
                                {{ Form::text("phone",Input::old("phone"),array("class"=>"form-control")) }}
                                </div>
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                <h6>02. Address</h6>
                                {{ Form::label("Address","Address") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                @if($errors->guest)
                                    {{$errors->guest->first("address",'<div class="error">*:message</div>')}}
                                @endif
                                {{ Form::textarea("address",Input::old("address"),array("class"=>"form-control","resize"=>"false")) }}

                                {{ Form::label("city","City") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                @if($errors->guest)
                                    {{$errors->guest->first("city",'<div class="error">*:message</div>')}}
                                @endif
                                {{ Form::text("city",Input::old("city"),array("class"=>"form-control")) }}

                                {{ Form::label("pcode","Postal Code") }}
                                {{ Form::text("pcode",Input::old("pcode"),array("class"=>"form-control")) }}

                                {{ Form::label("state","State") }}
                                {{ Form::text("state",Input::old("state"),array("class"=>"form-control")) }}
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-10">
                                <h3 style="text-align: center; padding-top: 25px; border-bottom: dotted;">Payment and Additional Information</h3>
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                <h6>03. Payment</h6>
                                    {{ Form::label("ctype","Credit Card Type") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                    @if($errors->guest)
                                        {{$errors->guest->first("cctype",'<div class="error">*credit card type is required</div>')}}
                                    @endif
                                    {{ Form::text("cctype",null,array("class"=>"form-control")) }}

                                    {{ Form::label("cname","Card Holder") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                    @if($errors->guest)
                                        {{$errors->guest->first("ccname",'<div class="error">*credit card holder is required</div>')}}
                                    @endif
                                    {{ Form::text("ccname",null,array("class"=>"form-control")) }}

                                    {{ Form::label("cnumber","Card Number") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                    @if($errors->guest)
                                        {{$errors->guest->first("ccnum",'<div class="error">*credit card number is required</div>')}}
                                    @endif
                                    {{ Form::text("ccnum",null,array("class"=>"form-control")) }}


                                    @if($errors->guest)
                                        {{$errors->guest->first("ccexpirymonth",'<div class="error">*credit card expiry is required</div>')}}
                                    @endif
                                    {{ Form::label("cexpiry","Card Expiry") }} {{ Form::label("*"," *",array("class"=>"book-field-req")) }}
                                    {{ Form::label("ccmonth","Month : ")}} {{ Form::selectRange("ccmonth",1,10,NULL,array("class"=>"form-control")) }}

                                    {{Form::label("ccyear","Year : ")}}
                                    <select class="form-control"name="ccyear" id="ccyear">
                                    <?php $getYear = date('o'); ?>
                                    @for($i = 0; $i < 15; $i++)
                                        <option>{{$getYear++}}</option>
                                    @endfor
                                    </select>
                                </div>
                                <div class="col-md-6 col-xs-6 col-sm-6">
                                <h6>04. Additional Information</h6>
                                    {{ Form::label("d-arrive","Arrival Time") }}
                                    {{
                                        Form::macro('arrive', function()
                                        {
                                            return '<input class="form-control" name="darrive" type="time">';
                                        });
                                        echo Form::arrive();
                                    }}
                                    {{ Form::label("comment","Comment") }}
                                    {{ Form::text("comment",null,array("class"=>"form-control")) }}
                                </div>
                            </div>
                            <div class="col-md-12 col-xs-12 col-sm-10">
                                    @if($errors->guest)
                                        {{$errors->guest->first("agree",'<div class="error">*You must agree with our term and condition before booking</div>')}}
                                    @endif
                                {{Form::checkbox('agree','agree')}}You are close to finishing booking, please read our term and condition, to inform you a few information about our regulation of cancelling booking <a href="#">Term & Condition Policy</a>
                            </div>

                            @foreach($rooms as $item)
                            {{Form::hidden('roomID',$item->ID_RoomType) }}
                            @endforeach

                            <div class="col-md-12 col-xs-12 col-sm-10">
                                <p>{{Form::submit('Finish Book')}}</p>
                            </div>
                            {{Form::close()}}
                        </div>
                    </div>
                </div>
            </div>

            <aside class="col-md-4">
                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Detail Booking</h3>
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                            <ul class="no-style">
                                @foreach($rooms as $roomm => $roomPrice)
                                    <li>Room Type : <h5>{{$roomPrice->RoomType_Name}} </h5> </li>
                                    <li>Room Rates :<h5>Rp. {{$roomPrice->Price}} <h5> </li>
                                @endforeach

                                <!-- <li> Arrive Date : <input type="text" id="txt_from"/> -->
                                <!-- <li> Depart Date : <h5 id="txt_to"></h5> </li> -->
                                <!--<li> Total Room : <h5 id="txt_total_days"></h5> </li>-->
                                
                                <!--Total Price :-->
                            </ul>
                            <div class="col-sm-12" align="center">
                                <button type="button" class="btn btn primary" data-toggle="modal" data-target="#myModal">
                                Show Detail
                                </button>
                            </div>
                            
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="myModalLabel">Your Booking Detail</h4>
                                        </div>
                                        <div class="modal-body">
                                            @foreach($rooms as $roomm => $roomPrice)
                                                <h4>Room Type : </h4>{{$roomPrice->RoomType_Name}} <br/>
                                                <h4>Room Price : </h4>Rp. {{$roomPrice->Price}} <br/>
                                            @endforeach

                                            <table class="table">
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Room Prices</th>
                                                    <th>Quantity</th>
                                                    <th>Sub Total</th>
                                                </tr>
                                                <tr>
                                                    <td>Date</td>
                                                    <td>{{$roomPrice->RoomType_Name}}</td>
                                                    <td>Quantity</td>
                                                    <td>Sub Total</td>
                                                </tr>
                                                @foreach($tax as $taxx => $taxPrice)
                                                    <tr>
                                                        <td colspan="2"></td>
                                                        <td>{{$taxPrice->Tax_Name}} : </td>
                                                        <td>{{$taxPrice->Tax*$roomPrice->Price}}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>Additional Total : </td>
                                                    <td>asdasd</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="2"></td>
                                                    <td>Grand Total : </td>
                                                    <td>asdasd</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            &copy; Hotel Everyday Smart Hotel Jakarta 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            

                            </div>
                        </div>
                </div><!--/.recent comments-->

                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Your Stay</h3>
                        <div class="col-md-12 col-xs-12">
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="col-sm-6 col-xs-6"> <p>Arrive Date : </p> </div>
                                    <div class="col-sm-6 col-xs-6"> <input type='text' name="from" placeholder="Arrival" id="from" readonly="true" style="width:130px" /> </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="col-sm-6 col-xs-6"> <p>Depart Date : </p> </div>
                                    <div class="col-sm-6 col-xs-6"> <input type='text' name="to" placeholder="Departure" id="to" readonly="true" style="width:130px" /> </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="col-sm-6 col-xs-6"> <p>Total Night : </p> </div>
                                    <div class="col-sm-6 col-xs-6"> <input type='text' name="total" placeholder="Total Night" id="total_days" readonly="true" style="width:130px"/> </div>
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
                </div>
                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Extra Selection</h3>
                    <div class="col-md-12 col-xs-12">
                        <div class="row">
                       
                            @if(empty($countAdd))
                            <div class="col-sm-12">
                                <p>Currently we are deactive additional for a momment, sorry for the inconvinience.</p>
                            </div>
                            @else
                                @for($i = 0; $i < $countAdd;$i++)

                                @if($additional[$i]['Input_Type']=='Dropdown')
                                     <div class="col-sm-12">
                                        <div class="col-sm-6 col-xs-6"> <p>{{$additional[$i]['Additional_Name']}} :</p> </div>
                                        <div class="col-sm-6 col-xs-6"> {{ Form::selectRange("add".$i,'0','5',NULL,array("style"=>"width:130px")) }} </div>
                                    </div>
                                @else
                                    <div class="col-sm-12">
                                        <div class="col-sm-6 col-xs-6"> <p>{{$additional[$i]['Additional_Name']}} :</p> </div>
                                        <div class="col-sm-6 col-xs-6"> {{ Form::checkbox("add".$i,"Yes") }} {{Form::label("add".$i,"Yes")}} </div>
                                    </div>
                                @endif


                                    {{Form::hidden($i+1,$additional[$i]['Price'])}}
                                @endfor
                            @endif
                        </div>
                    </div>
                </div><!--/.recent comments-->
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