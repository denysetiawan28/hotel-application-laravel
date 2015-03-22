<?php

class Roompics extends Eloquent {
    protected $table = "roomtype_pic";
    protected $primaryKey = "ID_RoomType_Pic";
	protected $fillable = ['ID_RoomType','Picture','Main_Pic'];

    public function rooms()
    {
        return $this->belongsTo('Rooms');
    }
}