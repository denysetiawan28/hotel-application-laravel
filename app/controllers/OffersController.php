<?php

class OffersController extends \BaseController {

	public function show($id)
	{
		$room = Rooms::select('roomtype.ID_RoomType','roomtype_pic.Picture')
        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(15)->get();
	    $countRoom = Rooms::where('Status','=','Active')->count();

		$offer = Offer::findOrFail($id);
		$offerDetail = Offer::join('detail_offer','detail_offer.ID_Offer','=','offer.ID_Offer')
            ->join('roomtype_pic','roomtype_pic.ID_RoomType','=','detail_offer.ID_RoomType')
            ->join('roomtype','roomtype.ID_RoomType','=','detail_offer.ID_RoomType')
            ->where('offer.Status','=','Active')->where('roomtype_pic.Main_Pic','=','YES')
            ->where('offer.ID_Offer','=',$id)->get();
        $offerCount = Offer::join('detail_offer','detail_offer.ID_Offer','=','offer.ID_Offer')
        ->join('roomtype_pic','roomtype_pic.ID_RoomType','=','detail_offer.ID_RoomType')
        ->join('roomtype','roomtype.ID_RoomType','=','detail_offer.ID_RoomType')
        ->where('offer.Status','=','Active')->where('roomtype_pic.Main_Pic','=','YES')
        ->where('offer.ID_Offer','=',$id)->count();

        $data['about'] = About::get()->all();

        return View::make('offers.show')
        	->with('offer',$offer)
        	->with('offerDetail',$offerDetail)
        	->with('room',$room)->with('countRoom',$countRoom)
        	->with('offerCount',$offerCount)->with('data',$data);
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /offers/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /offers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /offers/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}