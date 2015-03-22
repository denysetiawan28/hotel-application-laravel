<?php

class TravelPackage extends \Eloquent {
	protected $table ="int_travel_package";
    protected $primaryKey ="ID_Travel_Package";
    public $timestamps = false;
    protected $guarded = array("ID_Travel_Package");
}