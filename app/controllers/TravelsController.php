<?php

class TravelsController extends \BaseController {

	public $rules = array(
			'travelid'=>'required|exists:travel,ID_Travel'
		);
	public function index()
	{
		//
	}

	public function show($id)
	{
        $travel = Travel::where('ID_Travel','=',$id)->firstOrFail();

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
        $data['about'] = About::get()->all();

        $package = TravelPackage::where('ID_Travel','=',$id)->get();
        return View::make('travels.show', compact('travel'))
            ->with('package',$package)->with('data',$data);
	}

	public function checkLogin() 
	{
		$data['id_travel'] = Input::get('travelid');
		$validator = Validator::make(Input::all(),$this->rules);

		if ($validator->passes()) {
			Cache::put('travel_session',$data['id_travel'],1);
			return Redirect::to('/travel/book')->with('travel_id',Cache::get('travel_session'));
			
		}
		else{
			return Redirect::to('/book')->withErrors($validator,'travel')->withInput();
		}
	}
}