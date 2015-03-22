@extends('layout.default')
@section("title")FAQs - Everyday Smart Hotel @stop
@section('content')
<section id="blog" class="container">
        <div class="center">
            <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i><a href="{{URL::to('/faq')}}"> FAQs</a> <i class="fa fa-caret-right"></i></h2>
        </div>

        <div class="blog">
            <div class="row section-color">
                <div class="col-md-8 div-main">
                    <div class="blog-item">
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                            	<h2 style="border-bottom: dotted">Frequently Asked Question</h2>
                                <p>Here is our frequently of question and answer</p>
                            	
                                @foreach($faqs as $item)
                         		<div class="panel-group" id="accordion">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title">
                                                <a class="accordion-toggle" data-toggle="collapse" data-parent="accordion" href="#{{ $item->ID_FAQ }}">
                                                    <label>Q : {{ $item->Question }}</label>
                                                </a>
                                            </h4>
                                        </div>
                                        <div id="{{ $item->ID_FAQ }}" class="panel-collapse collapse">
                                            <div class="panel-body">
                                                <p>A : {{ $item->Answer }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <aside class="col-md-4">
                    <div class="widget blog-item div-sidebar">
                        <h3 class="header-sidebar">Do You Have Any Question?</h3>
                        <div class="row">
                            <div class="col-sm-12" align="center">
                                <p align="center">Are your question is answered yet? If you are not satisfied with our answer, you can ask us.</p>
                                <button type="button" class="btn btn primary" data-toggle="modal" data-target="#askUS">
                                Ask Us
                                </button>
                                <div class="modal fade" id="askUS" tabindex="-1" role="dialog" aria-labelledby="askUSLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="askUSLabel">Contact Us</h4>
                                            </div>
                                            <div class="modal-body">
                                                {{Form::open(array("url"=>URL::action("processing-question"), "method"=>"post"))}}

                                                {{Form::label('con-fullname','Name')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                @if($errors->faqs)
                                                    {{ $errors->faqs->first("con-name",'<div class="error">*The full name field is required.</div>') }}
                                                @endif
                                                {{Form::text('con-fullname',null,array("class"=>"form-control"))}}
                                                
                                                {{Form::label('con-email','Email')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                @if($errors->faqs)
                                                    {{ $errors->faqs->first("con-email",'<div class="error">*:message.</div>') }}
                                                @endif
                                                {{Form::email('con-email',null,array("class"=>"form-control"))}}
                                                
                                                {{Form::label('con-subject','Subject')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                {{Form::text('con-subject','Question',array("class"=>"form-control","readonly"=>"true"))}}

                                                {{Form::label('con-message','Message')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                                @if($errors->faqs)
                                                    {{ $errors->faqs->first("con-message",'<div class="error">*:message.</div>') }}
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