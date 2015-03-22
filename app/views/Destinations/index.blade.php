@extends('layout.default')
@section('content')

<section id="blog" class="container">
    <div class="center">
        <h2><a href="{{URL::to('/')}}">Home </a> <i class="fa fa-caret-right"></i> Rooms <i class="fa fa-caret-right"></i></h2>
    </div>

    <div class="blog">
        <div class="row section-color">
            <div class="col-md-8 div-main">
            <h2 style="border-bottom: dotted">Close Destination</h2>
            <p>There are many close destination around us, but we summarize the destination that the best for you...</p>
                @foreach($destination as $item)
                <div class="blog-item">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-10 blog-content">
                            <div class="col-xs-3 col-sm-4">
                                <a href="#"><img class="img-responsive img-blog" src="{{ URL::to('/') }}/resources/images/hotel/tourism/{{$item->Picture}}" width="100%" height="100px" alt="" /></a>
                            </div>
                            <div class="col-xs-7 col-sm-5">
                                <h4 style="color: #0182c4;font-weight: bold"> {{ $item->Name }}</h4>
                                <p> {{ $item->IsiDest }} </p>
                            </div>
                            <div class="col-xs-2 col-sm-1">
                                <a class="btn btn-primary readmore" href="{{URL::to('/tourism/view/'.$item->ID_Destination)}}">More Info<i class="fa fa-angle-right"></i></a>
                            </div>
                        </div>
                    </div>
               </div>
               @endforeach
               {{ $destination->links() }}
            </div>

            <aside class="col-md-4">
                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Room List</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            <ul class="no-style" style="text-align: left">

                            </ul>
                        </div>
                    </div>
                </div><!--/.recent comments-->

                <div class="widget blog-item div-sidebar">
                    <h3 class="header-sidebar">Offer</h3>
                    <div class="row">
                        <div class="col-sm-12">
                            For Offer
                        </div>
                    </div>
                </div><!--/.categories-->
            </aside>
        </div>
    </div>
</section>
@stop