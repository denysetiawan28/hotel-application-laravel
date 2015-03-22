<?php

class News extends \Eloquent {
    protected $table_name =  "news";
    protected $primaryKey = "ID_News";

    protected $fillable = ['Title','File','Description','Date'];


    public static function getColumn()
    {
        $table_name = Schema::getColumnListing("news");
        return $table_name;
    }
}