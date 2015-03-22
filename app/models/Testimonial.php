<?php

class Testimonial extends \Eloquent {
	protected $table = "feedback";
	protected $primaryKey = "ID_Feedback";
	public $timestamps = false;
}