<?php

class NewslettersController extends \BaseController {

	public $rules = array(
		'news-firstname'=>'required|min:3|max:50',
		'news-lastname'=>'required|min:3|max:50',
		'news-email'=>'required|email|unique:newsletter,Email',
		);
	public function createNewsletter()
	{
		$validator = Validator::make(Input::all(),$this->rules);
		if($validator->passes())
        {
        	$newsletter = new Newsletter;

        	$count = Newsletter::orderby('ID_Newsletter','DESC')->first();
        	$tampID = $count->ID_Newsletter;
			$checkYear = substr(strval($tampID),3,-5);
			$incrementID = substr($tampID, 3)+1;
			$join = "NEW".$incrementID;
			$success = "Thank you for register to our newsletter, we will send you our newsletter to you, please check your folder spam as well";

			date_default_timezone_set('Asia/Jakarta');
		 	$date = date('Y-m-d h:i:s', time());

			if ($checkYear == strval(date("y"))) {
				$newsletter->ID_Newsletter = $join;
				$newsletter->First_Name = Input::get('news-firstname');
				$newsletter->Last_Name = Input::get('news-lastname');
				$newsletter->Email = Input::get('news-email');
				$newsletter->Date = $date;
				$newsletter->Status = "Pending";
				$newsletter->save();
				return Redirect::to('/aboutus')->with('message',$success);
			}
			else
			{
				$testimonial = new Testimonial;

				date_default_timezone_set('Asia/Jakarta');
		 		$date = date('Y-m-d h:i:s', time());

				$newsletter->ID_Newsletter = "NEW".date('y')."00001";
				$newsletter->First_Name = Input::get('news-firstname');
				$newsletter->Last_Name = Input::get('news-lastname');
				$newsletter->Email = Input::get('news-email');
				$newsletter->Date = $date;
				$newsletter->Status = "Pending";
				$newsletter->save();
				return Redirect::to('/aboutus')->with('message',$success);
			}
        }
        else {
	        return Redirect::to('/aboutus')
				->withErrors($validator,'newsletter')->withInput()->with('active','active');
		}	
	}

}