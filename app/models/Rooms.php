<?php

class Rooms extends Eloquent {
    public $timestamps = false;
    protected $table = "roomtype";
    protected $primaryKey = "ID_RoomType";
    protected $guarded = "ID_RoomType";
	protected $fillable = ['RoomType_Name','Description','Price','Capacity','Facility'];

    public function getPicture()
    {
        return $this->hasMany('Roompics','ID_RoomType','ID_RoomType')->get();
    }
    public function roomPics()
    {
        return $this->hasMany('Roompics','ID_roomType','ID_RoomType')->where('Main_Pic','=','YES')->get();
    }
    public static function getColumn(){
        $table = Schema::getColumnListing("roomtype");
        return $table;
    }
}