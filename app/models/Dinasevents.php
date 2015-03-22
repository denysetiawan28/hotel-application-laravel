<?php

class Dinasevents extends \Eloquent {
    protected $table = "int_event_dinas";
    protected $primaryKey = "Event_ID";
    protected $guarded = array('Event_ID');
    public $timestamps = false;

    public static function getColumn()
    {
        $table = Schema::getColumnListing("int_event_dinas");
        return $table;
    }
}