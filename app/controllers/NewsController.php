<?php

class NewsController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /news
	 *
	 * @return Response
	 */
	public function index()
	{
		$news = News::orderby('Date','DESC')->paginate(5,['Title','File','Date',DB::raw("concat(SUBSTRING(Description,1,200),'...') as IsiNews"),'ID_News']);

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
		$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
		$data['about'] = About::get()->all();
		return View::make('News.index', compact('news'))
            ->with('news_active','active')->with('data',$data);
	}

	public function show($id)
	{
		$news = News::findOrFail($id);

        $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
		$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
		$data['about'] = About::get()->all();
        return View::make('News.show', compact('news'))
            ->with('news_active','active')->with('data',$data);
	}
}