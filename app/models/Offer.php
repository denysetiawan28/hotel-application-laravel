<?php

class Offer extends \Eloquent {
    protected $table = "offer";
    protected $primaryKey = "ID_Offer";
	protected $fillable = ['ID_Offer','Title','File','Description','From_Date','Until_Date','Status'];
}