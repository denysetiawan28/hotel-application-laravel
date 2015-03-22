<?php

class AboutusController extends \BaseController {

	public $rules = array(
			'con-fullname'=>'required|max:100',
			'con-email'=>'required|email|max:100',
			'con-subject'=>'required|max:50',
			'con-message'=>'required|max:1000',
		);

	public function index()
	{
		$about = About::all();

		$data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
    	$data['about'] = About::get()->all();
		
		return View::make('Aboutus.index',compact('about'))
			->with('data',$data);
	}
	public function sendEmail()
	{
		$data = Input::all();
		$user = [
			'email'=>Input::get('con-email'),
			'name'=>Input::get('con-fullname'),
			'subject'=>Input::get('con-subject')
			];

		$success = "Thank you for contacting us, your email with subject '".$user['subject']."' will be reply by us soon. please check your spam folder as well";
		$validator = Validator::make(Input::all(), $this->rules);

		if ($validator->passes()) 
		{
			Mail::send('emails.contactus',$data, function($message) use ($user)
				{
					$message->from($user['email'],$user['name'])
							->to('everydaysmarthotel-jakarta@protohotel.asia','Hotel Everyday Smart Hotel - Jakarta')
							->subject($user['subject']);
				});

			return Redirect::to('/aboutus')
				->with('contactus',$success);
		}
		else 
		{
			return Redirect::to('/aboutus')
				->withErrors($validator,'contactus')->withInput()->with('contactus','active');
		}
	}

}