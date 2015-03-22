<?php

class Events extends \Eloquent {
    protected $table = "events";
    protected $primaryKey = "ID_Events";
	protected $fillable = ['Title','File','Description','Date','Time'];
}