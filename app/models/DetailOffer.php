<?php

class DetailOffer extends \Eloquent
{
    protected $table = "detail_offer";
    protected $primaryKey = ['ID_Offer', 'ID_RoomType'];
    protected $fillable = ['ID_Offer', 'ID_RoomType', 'Promo'];


}