@extends('layout.default')
@section("title")Site Maps- Everyday Smart Hotel @stop
@section('content')
<section id="blog" class="container">
    <div class="center">
        <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i><a href="{{URL::to('/yourbook')}}"> Site Maps</a> <i class="fa fa-caret-right"></i></h2>
    </div>

    <div class="blog">
        <div class="row section-color">
            <div class="col-md-8 div-main">
                <div class="blog-item">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                        	<h2>Everyday Smart Hotel Site Map</h2>
                    	   <div class="col-md-6">
	                    	   	<ul class="no-style">
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/')}}"><i class="fa fa-caret-right"></i> Home</a><h3>
	                    	   		</li>
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/rooms')}}"><i class="fa fa-caret-right"></i> Room</a><h3>
	                    	   		</li>
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/facilities')}}"><i class="fa fa-caret-right"></i> Facility</a><h3>
	                    	   		</li>
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/news')}}"><i class="fa fa-caret-right"></i> News</a><h3>
	                    	   		</li>
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/events')}}"><i class="fa fa-caret-right"></i> Event</a><h3>
	                    	   		</li>
	                    	   		
	                    	   	</ul>
                    	   </div>
                    	   <div class="col-md-6">
                    	   		<ul class="no-style">

                    	   			<li>
	                    	   			<h3><a href="{{ URL::to('/aboutus')}}"><i class="fa fa-caret-right"></i> About Us</a><h3>
	                    	   		</li>
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/faqs')}}"><i class="fa fa-caret-right"></i> FAQs</a><h3>
	                    	   		</li>
	                    	   		<li>
										<h3><a href="{{ URL::to('/testimonial')}}"><i class="fa fa-caret-right"></i> Testimonial</a></h3>
	                    	   		</li>
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/yourbook')}}"><i class="fa fa-caret-right"></i> View Your Booking</a><h3>
	                    	   		</li>
	                    	   		<li>
	                    	   			<h3><a href="{{ URL::to('/book')}}"><i class="fa fa-caret-right"></i> Booking</a><h3>
	                    	   		</li>
                    	   		</ul>	
                    	   </div>
                        
                        </div>
                    </div>
                </div>
            </div>
            <aside class="col-md-4">
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
        </div>
    </div>
</section>
@stop