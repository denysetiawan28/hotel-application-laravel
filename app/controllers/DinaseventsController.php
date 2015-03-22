<?php

class DinaseventsController extends \BaseController {

	
	public function show($id)
	{
        $dinas = Dinasevents::orderby('Event_Date','Desc')->where('Event_ID','=',$id)->firstOrFail();

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
        $data['about'] = About::get()->all();
        return View::make('dinasevents.show', compact('dinas'))
            ->with('data',$data);
	
	}

}