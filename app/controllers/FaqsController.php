<?php

class FaqsController extends \BaseController {

	public $rules = array(
			'con-fullname' => 'required|max:100',
			'con-email' => 'required|email|max:100',
			'con-message' => 'required|max:1000',
		);
	public function index()
	{
		$faqs = Faq::where('Status','=','Active')->get();

		$data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
	        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
	        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    	$data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
    	$data['about'] = About::get()->all();

		return View::make('faqs.index',compact('faqs'))
			->with('data',$data);
	}
	public function sendQuestion() 
	{
		$data = Input::all();
		$user = ['email'=>Input::get('con-email'),'name'=>Input::get('con-fullname')];
		$success = "Thank you for contacting us, your '".$data['con-subject']."' will be reply by us soon, please check your spambox as well";

		$validator = Validator::make(Input::all(), $this->rules);
		if($validator->passes()) 
		{

			
			Mail::send('emails.questions', $data , function($message) use ($user)
				{
					$message->from($user['email'],$user['name'])
							->to('everydaysmarthotel-jakarta@protohotel.asia','Hotel Everyday Smart Hotel - Jakarta')
							->subject('Question');
				});
			
			return Redirect::to('/faqs')->with('success',$success);
			
		}
		else 
		{
			return Redirect::to('/faqs')
				->withErrors($validator,'faqs')->withInput()->with('active','active');
		}

	}
}