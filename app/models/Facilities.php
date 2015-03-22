<?php

class Facilities extends \Eloquent {
    protected $table = "facility";
    protected $primaryKey = "ID_Facility";
	protected $fillable = [];

    public function getPicture()
    {
        return $this->hasMany('Facilitypics','ID_Facility','ID_Facility')->get();
    }
}