<?php

class Facilitypics extends \Eloquent {
    protected $table = "facility_pic";
    protected $primaryKey = "ID_Facility_Pic";
    protected $fillable = ['ID_Facility','Picture','Main_Pic'];

    public function facility()
    {
        return $this->belongsTo('Facilities');
    }
}