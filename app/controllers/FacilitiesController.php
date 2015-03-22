<?php

class FacilitiesController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /facilities
	 *
	 * @return Response
	 */
	public function index()
	{
		$facility = Facilities::join('facility_pic', 'facility.ID_Facility', '=', 'facility_pic.ID_Facility')
            ->where('facility_pic.Main_Pic','=','YES')->where('facility.Status','=','Active')
            ->paginate(5,['facility.Facility_Name','facility_pic.Picture',DB::raw("CONCAT(SUBSTRING(facility.Description, 1, 100), '...') as isiFac"),'facility.ID_Facility']);
        $faciList = Facilities::where('Status','=','Active')->get();

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
    	$data['about'] = About::get()->all();
        
        return View::make('Facilities.index',compact('facility'))
            ->with('faci_active','active')->with('faciList',$faciList)
            ->with('data',$data);
    }

	public function show($id)
	{
        $facility = Facilities::where('ID_Facility','=',$id)->firstOrFail();
        $faciList = Facilities::where('Status','=','Active')->get();

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
    	$data['about'] = About::get()->all();
    	
        return View::make('Facilities.show', compact('facility','listFaci'))
            ->with('faci_active','active')->with('faciList',$faciList)
            ->with('data',$data);
	}
}