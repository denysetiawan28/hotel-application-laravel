@extends('layout.default')
@section("title")Testimonial - Everyday Smart Hotel @stop
@section('content')
<section id="blog" class="container">
    <div class="center">
        <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i><a href="{{URL::to('/testimonial')}}"> Testimonial</a> <i class="fa fa-caret-right"></i></h2>
    </div>

    <div class="blog">
        <div class="row section-color">
            <div class="col-md-8 div-main">
                <div class="blog-item">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                        	<h2 style="border-bottom: dotted">Testimonial</h2>
                            <p>Here is our list of testimonial</p>
                    		@foreach($testimonial as $item)
                     		<blockquote class="testimonial"> 
			                    <p> {{ $item->Message }} </p> 
			                </blockquote> 
			                <div class="arrow-down">
                            
			                </div> <p class="testimonial-author">{{ $item->Name }} | <span>{{ date("D, d-m-Y H:i:s",strtotime($item->Date))}}</span></p> <br>
	                            
                     		@endforeach
                     		{{ $testimonial->links() }}
                        </div>
                    </div>
                </div>
            </div>
            <aside class="col-md-4">

                <div class="widget blog-item div-sidebar" align="center">
                    <h3 class="header-sidebar">Give Us Your Impression & Comment</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <p>Do you have any impression for us? click give impression to us, so we can show your testimonial</p>
                            <button type="button" class="btn btn primary" data-toggle="modal" data-target="#feed">
                                Give Immpression
                            </button>
                            <div class="modal fade" id="feed" tabindex="-1" role="dialog" aria-labelledby="feedLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="feedLabel">Feedback</h4>
                                        </div>
                                        <div class="modal-body">
                                            
                                            {{Form::open(array("url"=>URL::action("processing-testimonial"), "method"=>"post"))}}
                                            {{Form::label('feed-fullname','Name')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                            @if($errors->feedback)
                                                {{$errors->feedback->first("feed-fullname",'<div class="error">*The full name field is required.</div>');}}
                                            @endif
                                            {{Form::text('feed-fullname',null,array("class"=>"form-control"))}}
                                            
                                            {{Form::label('feed-email','Email')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                            @if($errors->feedback)
                                                {{$errors->feedback->first("feed-email",'<div class="error">*:message.</div>');}}
                                            @endif
                                            {{Form::email('feed-email',null,array("class"=>"form-control"))}}
                                            
                                            {{Form::label('feed-subject','Subject')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                            @if($errors->feedback)
                                                {{$errors->feedback->first("feed-subject",'<div class="error">*The subject field is required.</div>');}}
                                            @endif
                                            {{Form::text('feed-subject',null,array("class"=>"form-control"))}}

                                            {{Form::label('feed-message','Message')}} {{ Form::label('mandatory','*',array("Class"=>"mandatory-field"))}}
                                            @if($errors->feedback)
                                                {{$errors->feedback->first("feed-message",'<div class="error">*The message field is required.</div>');}}
                                            @endif
                                            {{Form::textarea('feed-message',null,array("class"=>"form-control"))}}

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
@if(Session::get('message') != null)
<div class="modal fade" id="success" tabindex="-1" role="dialog" aria-labelledby="successLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div align="center" class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="successLabel">Success</h4>
            </div>
            <div class="modal-body">
                <p>You have success to give us testimonial or comment.</p> 
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
    @if(Session::get('active') != null)
        <script type="text/javascript">
            $('#feed').modal('show')
        </script>
    @endif

    @if(Session::get('message') != null)
        <script type="text/javascript">
            //$('#success').modal('show')
            $('#success').modal('show')

            setTimeout(function() {
                $('#success').modal('hide');
            }, 10000);
        </script>
    @endif
@stop