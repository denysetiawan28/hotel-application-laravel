<?php

class EventsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /events
	 *
	 * @return Response
	 */
	public function index()
	{
		$events = Events::orderby('Date','DESC')
            ->where('Status','=','Active')
            ->paginate(5,['Title','File','Date','Time',DB::raw("CONCAT(SUBSTRING(Description,1,200),'...') as IsiEvents"), 'ID_Events']);

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
    	$data['about'] = About::get()->all();

        return View::make('Events.index',compact('events'))
            ->with('event_active','active')->with('data',$data);
	}

	public function show($id)
	{
		$events = Events::findOrFail($id);

		$data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
    	$data['about'] = About::get()->all();
    	
        return View::make('Events.show',compact('events'))
            ->with('event_active','active')->with('data',$data);
	}
}