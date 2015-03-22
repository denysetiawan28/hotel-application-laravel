@extends('layout.default')
@section("title")View Your Booking - Everyday Smart Hotel @stop
@section('content')
<section id="blog" class="container">
        <div class="center">
            <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i><a href="{{URL::to('/yourbook')}}"> Your Book</a> <i class="fa fa-caret-right"></i></h2>
        </div>

        <div class="blog">
            <div class="row section-color">
                <div class="col-md-8 div-main">
                    <div class="blog-item">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                        	   <h2 style="border-bottom: dotted" align="center">View Booking</h2>
                            	<p>Are you want to view your book? Input your book code now</p>
                            	{{Form::open(array("url"=>URL::action("processing-view-book"), "method"=>"post"))}}
	                            <div class="col-sm-12">{{Form::label('bookcode','Booking Code')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}} </div>
                                <div class="col-sm-8">{{Form::text('bookcode',null,array("class"=>"form-control"))}}</div>
	                            <div class="col-sm-4">{{Form::submit('Submit')}}</div>
                                @if($errors->viewBook)
                                <div class="col-md-12 col-sm-12 col-xs-12">{{ $errors->viewBook->first("bookcode",'<div class="error">*:message.</div>') }}</div>
                                @endif
                                @if(Session::get('customError') != null)
                                <div class="col-md-12 col-sm-12 col-xs-12"><div class="error">*{{ Session::get('customError') }}</div></div>
                                @endif
                                {{Form::close()}}
                                </div>  
                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                            	<h2>Cancellation Policy</h2>
                                We understand that sometimes circumstances change, and you may want to cancel your booking.
                                Our accommodation cancellation policy is stated in our reservation page. Each booking should have 50% non-refundable deposit, any cancellation would be charged from your deposit received by the hotel.
                                <br/><br/>
                                If the worst happens and you do need to cancel your booking, here's what to do:
                                <br/>
                                1. Check the Cancellation Policy the accommodation has published on the website to see if they will allow you to cancel your booking. You'll also find it printed on your booking confirmation email.
                                <br/><br/>
                                2. Call our Customer Service Centre (0807.1.808080) to have the booking cancel and have your Booking Confirmation Number ready.
                                <br/><br/>
                                3. We will send you an email to confirm the cancellation.
                                <br/><br/>
                                Remember that you can call us Monday – Friday 8 AM – 7 PM, Saturday 9 AM – 5 PM for your further assistance.
                                
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-md-4">

                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Contact & Address</h3>
                        <div class="row">
                            <div class="col-sm-12">
                                @foreach($about as $item => $aboutt)
                                <h5 align="center">Address</h5>
                                <p align="center">{{ $aboutt->Address }}</p>
                                <p align="center"><a href="mailto:{{ $aboutt->Email }}">{{ $aboutt->Email }}</a></p>
                                <p align="center">{{ $aboutt->Telephone }}</p>
                                @endforeach

                            </div>
                        </div>
                    </div><!--/.categories-->

                    <div class="widget blog-item div-sidebar" align="center">
		                <h3 class="header-sidebar">Do You need our assistance?</h3>
		                <div class="row">
		                    <div class="col-sm-12">
		                        <p align="center">Contact us if you need our assistance in case to cancel your booking</p>
		                    	<button type="button" class="btn btn primary" data-toggle="modal" data-target="#askUS">
                                Contact Us
	                            </button>
	                            <div class="modal fade" id="askUS" tabindex="-1" role="dialog" aria-labelledby="askUSLabel" aria-hidden="true">
	                                <div class="modal-dialog">
	                                    <div class="modal-content">
	                                        <div class="modal-header">
	                                            <h4 class="modal-title" id="askUSLabel">Contact Us</h4>
	                                        </div>
	                                        <div class="modal-body">
	                                            {{Form::open(array("url"=>URL::action("processing-ask-question"), "method"=>"post"))}}

                                                {{Form::label('con-fullname','Name')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                @if($errors->viewBook)
                                                    {{ $errors->viewBook->first("con-fullname",'<div class="error">*The full name field is required.</div>') }}
                                                @endif
                                                {{Form::text('con-fullname',null,array("class"=>"form-control"))}}
                                                
                                                {{Form::label('con-email','Email')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                @if($errors->viewBook)
                                                    {{ $errors->viewBook->first("con-email",'<div class="error">*:message.</div>') }}
                                                @endif
                                                {{Form::email('con-email',null,array("class"=>"form-control"))}}
                                                
                                                {{Form::label('con-subject','Subject')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                @if($errors->viewBook)
                                                    {{ $errors->viewBook->first("con-subject",'<div class="error">*:message.</div>') }}
                                                @endif
                                                {{Form::text('con-subject',null,array("class"=>"form-control"))}}

                                                {{Form::label('con-message','Message')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                @if($errors->viewBook)
                                                    {{ $errors->viewBook->first("con-message",'<div class="error">*:message.</div>') }}
                                                @endif
                                                {{Form::textarea('con-message',null,array("class"=>"form-control"))}}

                                                {{Form::submit('send')}}
                                                {{Form::close()}}  
	                                        </div>
	                                        <div class="modal-footer">
	                                            &copy; Hotel Everyday Smart Hotel Jakarta 
	                                        </div>
	                                    </div>
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
@section("showModal")
@if(Session::get('success') != null)
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="successLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div align="center" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="successLabel">Success</h4>
            </div>
            <div class="modal-body">
                <p>{{ Session::get('success') }}</p> 
            </div>
            <div class="modal-footer">
                &copy; Hotel Everyday Smart Hotel Jakarta 
            </div>
        </div>
    </div>
</div>
@endif
@stop

@section("scriptModal")
    @if(Session::get('active') == 'active')
    <script type="text/javascript">
        $('#askUS').modal('show')
    </script>
    @endif

    @if(Session::get('success') != null )
    <script type="text/javascript">
        $("#success").modal('show');
        setTimeout(function(){
         $("#success").modal('hide');   
        },10000);
    </script>
    @endif
@stop