<?php

class TestimonialsController extends \BaseController {

	public $rules = array(
		'feed-fullname'=>'required|min:3|max:50',
		'feed-email'=>'required|email|max:50',
		'feed-subject'=>'required|max:50',
		'feed-message'=>'required|max:100',
	);

	public function index()
	{
		$testimonial = Testimonial::orderby('date','DESC')->where('Status','=','Confirm')->paginate(10,['Name','Email','Subject','Message','Date'],'ID_Feedback');

		$data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();

        $data['about'] = About::get()->all();
		
		return View::make('Testimonials.index',compact('testimonial'))
			->with('data',$data);
	}


	public function createFeedback()
	{
		$validator = Validator::make(Input::all(),$this->rules);

		if($validator->passes())
        {
        	$testimonial = new Testimonial;

        	$count = Testimonial::orderby('ID_Feedback','DESC')->first();
        	$tampID = $count->ID_Feedback;
			$checkYear = substr(strval($tampID),3,-5);
			$incrementID = substr($tampID, 3)+1;
			$join = "FED".$incrementID;

			date_default_timezone_set('Asia/Jakarta');
		 	$date = date('Y-m-d h:i:s', time());

			if ($checkYear == strval(date("y"))) {
				$testimonial->ID_Feedback = $join;
				$testimonial->Name = Input::get('feed-fullname');
				$testimonial->Email = Input::get('feed-email');
				$testimonial->Subject = Input::get('feed-subject');
				$testimonial->Message = Input::get('feed-message');
				$testimonial->Date = $date;
				$testimonial->Status = "Pending";
				$testimonial->save();
				return Redirect::to('/testimonial')->with('message','Success');
			}
			else
			{
				$testimonial = new Testimonial;

				date_default_timezone_set('Asia/Jakarta');
		 		$date = date('Y-m-d h:i:s', time());

				$testimonial->ID_Feedback = "FED".date('y')."00001";
				$testimonial->Name = Input::get('feed-fullname');
				$testimonial->Email = Input::get('feed-email');
				$testimonial->Subject = Input::get('feed-subject');
				$testimonial->Message = Input::get('feed-message');
				$testimonial->Date = $date;
				$testimonial->Status = "Pending";
				$testimonial->save();
				return Redirect::to('/testimonial')->with('message','Success');
				
			}
        }
        else {
    		return Redirect::to('/testimonial')
			->withErrors($validator,'feedback')->withInput()->with('active','active');
        }
    	
	}
}