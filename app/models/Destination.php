<?php

class Destination extends \Eloquent {
    protected $table = "destination";
    protected $primaryKey = "ID_Destination";
    protected $guarded = array('ID_Destination');
    public $timestamps = false;
    public static function getColumn()
    {
        $table = Schema::getColumnListing("destination");
        return $table;
    }
}