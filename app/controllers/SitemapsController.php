<?php

class SitemapsController extends \BaseController {


	public function index()
	{
		$data['about'] = About::get()->all();
		return View::make("sitemaps.index")->with('data',$data);
	}

}