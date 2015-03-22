<?php

class Newsletter extends \Eloquent {
	protected $table = "newsletter";
	protected $primaryKey = "ID_Newsletter";
	protected $guarded = ['ID_Newsletter'];
	public $timestamps = false;

}