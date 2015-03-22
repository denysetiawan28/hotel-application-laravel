<?php

class Travel extends \Eloquent {
    protected $table = "travel";
    protected $primaryKey = "ID_Travel";
    protected $guarded = array("ID_Travel");
    public $timestamps = false;
    
}