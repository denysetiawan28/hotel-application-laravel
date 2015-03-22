<?php

class Book extends \Eloquent {

    protected $table = "booking";
    protected $primaryKey = "ID_Booking";
    public $timestamps = false;
    protected $guarded = array('ID_Booking');

}