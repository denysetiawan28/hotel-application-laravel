<?php

class DestinationController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /destination
	 *
	 * @return Response
	 */
	public function index()
	{
        $destination = Destination::join('destination_pic', 'destination.ID_Destination', '=', 'destination_pic.ID_Destination')
            ->where('destination_pic.Main_Pic','=','YES')->where('destination.Status','=','Active')
            ->paginate(5,['destination.Name','destination_pic.Picture',DB::raw("CONCAT(SUBSTRING(destination.Description, 1, 100), '...') as IsiDest"),'destination.ID_Destination']);
        $data['about'] = About::get()->all();
		return View::make('Destinations.index', compact('destination'))
		->with('data',$data);
	}

	public function show($id)
	{
        $destination = Destination::where('ID_Destination','=',$id)->firstOrFail();
        $listDest = Destination::where('Status','=','Active')->get();

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
        $data['about'] = About::get()->all();
        return View::make('Destinations.show', compact('destination','listDest'))
            ->with('data',$data);
	}
}