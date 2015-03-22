<?php

class RoomsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /rooms
	 *
	 * @return Response
	 */
	public function index()
	{
        $all = Rooms::all();
        $rooms = Rooms::join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
             ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')
            ->paginate(5,['roomtype.RoomType_Name','roomtype_pic.Picture',DB::raw("CONCAT(SUBSTRING(roomtype.Description, 1, 100), '...') as IsiRoom"),'roomtype.ID_RoomType']);

        $count = Rooms::where('Status','=','Active')->get()->count();
        $listRooms = Rooms::where('Status','=','Active')->get();

        $data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
        $data['about'] = About::get()->all();

		return View::make('Rooms.index',compact('rooms','roomPic','all'))
			->with('room_active','active')->with('count',$count)
			->with('listRoom',$listRooms)->with('data',$data);
	}
	public function show($id)
	{

		$rooms = Rooms::where('ID_RoomType','=',$id)->firstOrFail();
        $listRooms = Rooms::where('Status','=','Active')->get();

        $data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
	    $data['about'] = About::get()->all();
	    
        return View::make('Rooms.show', compact('rooms','listRooms'))
            ->with('room_active','active')->with('listRoom',$listRooms)
            ->with('data',$data);
	}

}