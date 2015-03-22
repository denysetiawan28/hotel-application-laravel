<?php

class BooksController extends \BaseController {

    public $rules = array(
        'fname'=>'required|min:3',
        'lname'=>'required|min:3',
        'identity'=>'required',
        'email'=>'required|email',
        'phone'=>'required|numeric',
        'address'=>'required|min:10|max:300',
        'country'=>'required',
        'city'=>'required|min:3|max:50',
        'CardType'=>'required',
        'ccname'=>'required',
        'ccnum'=>'required',
        'agree' => 'required',
        'from'=>'required',
        'to'=>'required',
        'total_d' => 'numeric|min:1',
    );
    //home/books
	public function index()
	{
        $getoff_id = Offer::where('Status','=','Active')->get();


        //$rooms = Rooms::all();
        $offer = Offer::join('detail_offer','detail_offer.ID_Offer','=','offer.ID_Offer')
            ->join('roomtype_pic','roomtype_pic.ID_RoomType','=','detail_offer.ID_RoomType')
            ->join('roomtype','roomtype.ID_RoomType','=','detail_offer.ID_RoomType')
            ->where('offer.Status','=','Active')->where('roomtype_pic.Main_Pic','=','YES')
            ->get();

        $countOffer = Offer::where('Status','=','Active')->count();
        $countDetail = DetailOffer::join('offer','offer.ID_Offer','=','detail_offer.ID_Offer')
            ->where('offer.Status','=','Active')->count();
        $rooms = Rooms::join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
            ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')
            ->paginate(5,['roomtype.RoomType_Name','roomtype.Price','roomtype_pic.Picture',DB::raw("CONCAT(SUBSTRING(roomtype.Description, 1, 100), '...') as IsiRoom"),'roomtype.ID_RoomType']);
        $data['about'] = About::get()->all();
		return View::make('Books.index',compact('rooms'))
            ->with('data',$data)->with('countOffer',$countOffer)
            ->with('offer',$offer)->with('countDetail',$countDetail);
	}
    public function indexTravel() {
        $getoff_id = Offer::where('Status','=','Active')->get();

        $offer = Offer::join('detail_offer','detail_offer.ID_Offer','=','offer.ID_Offer')
            ->join('roomtype_pic','roomtype_pic.ID_RoomType','=','detail_offer.ID_RoomType')
            ->join('roomtype','roomtype.ID_RoomType','=','detail_offer.ID_RoomType')
            ->where('offer.Status','=','Active')->where('roomtype_pic.Main_Pic','=','YES')
            ->get();

        $countOffer = Offer::where('Status','=','Active')->count();
        $countDetail = DetailOffer::join('offer','offer.ID_Offer','=','detail_offer.ID_Offer')
            ->where('offer.Status','=','Active')->count();
        $rooms = Rooms::join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
            ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')
            ->paginate(5,['roomtype.RoomType_Name','roomtype.Price','roomtype_pic.Picture',DB::raw("CONCAT(SUBSTRING(roomtype.Description, 1, 100), '...') as IsiRoom"),'roomtype.ID_RoomType']);
        $data['about'] = About::get()->all();

        $travel = Travel::where('ID_Travel','=',Cache::get('travel_session'))->where('Status','=','Active')->get();
        return View::make('Books.Travel.index',compact('rooms'))->with('travel',$travel)
            ->with('data',$data)->with('countOffer',$countOffer)
            ->with('offer',$offer)->with('countDetail',$countDetail);
    }
	public function checkAvailability() 
	{
		$arrive =  Input::get('from');
		$depart = Input::get('to');

		
		$rooms = DB::select('
					SELECT * FROM roomtype a
					WHERE a.ID_RoomType NOT IN (
						SELECT e.ID_RoomType FROM detail_booking e
						INNER JOIN booking b
						ON e.ID_Booking = b.ID_Booking
						WHERE b.Arrive BETWEEN "'.$arrive.'" AND "'.$depart.'" OR
						b.Depart BETWEEN "'.$arrive.'" AND "'.$depart.'")');
		print_r($rooms);
					/*
		$rooms = DB::raw('SELECT * FROM roomtype a WHERE a.ID_RoomType NOT IN (
					SELECT e.ID_RoomType FROM booking e
					WHERE e.Arrive BETWEEN "'.$arrive.'" AND "'.$depart.'" OR
					e.Depart BETWEEN "'.$arrive.'" AND "'.$depart.'")');
					*/
		//var_dump($rooms->ID_RoomType);
	}

    //books/offer/idoffer/rooms/idroom (Detail guest @Booking Offer)
    public function BookOffer($idOff,$idRoom)
    {
        $offer = Offer::join('detail_offer','detail_offer.ID_Offer','=','offer.ID_Offer')
            ->join('roomtype_pic','roomtype_pic.ID_RoomType','=','detail_offer.ID_RoomType')
            ->join('roomtype','roomtype.ID_RoomType','=','detail_offer.ID_RoomType')
            ->where('offer.Status','=','Active')->where('roomtype_pic.Main_Pic','=','YES')
            ->where('offer.ID_Offer','=',$idOff)->where('roomtype.ID_RoomType','=',$idRoom)
            ->get();
        $rooms = Rooms::where('ID_RoomType','=',$idRoom)
            ->where('Status','=','Active')->get();
        $tax = Tax::where('Status','=','Active')->get();
        $additional = Additional::where('Status','=','Active')->get();
        $countAdd = Additional::where('Status','=','Active')->count();
        $data['about'] = About::get()->all();
        return View::make('Books.Offer.show')
            ->with('data',$data)->with('offer',$offer)->with('rooms',$rooms)->with('tax',$tax)
            ->with('additional',$additional)->with('countAdd',$countAdd);
    }
    //books/rooms/idroom (Detail guest@Booking room)
    public function BookNormal($idRoom)
    {
        $rooms = Rooms::where('ID_RoomType','=',$idRoom)
        ->where('Status','=','Active')->get();
        $tax = Tax::where('Status','=','Active')->get();
        $additional = Additional::where('Status','=','Active')->get();
        $countAdd = Additional::where('Status','=','Active')->count();
        $data['about'] = About::get()->all();
        return View::make('Books.Normal.show')
            ->with('data',$data)->with('rooms',$rooms)->with('tax',$tax)->with('additional',$additional)
            ->with('countAdd',$countAdd);
    }

    public function insertBookOffer()
    {
        
        $validator = Validator::make(Input::all(),$this->rules);

        if($validator->fails())
        {
            return Redirect::action('normalBook',[Input::get('roomID')])
                ->withErrors($validator,'guest')
                ->withInput();
        }
        else {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $temp;
            $bookCode = "";

            for ($i=1; $i <= 10 ; $i++)
            {
                if ($i%2 == 1) $temp = floor(rand(0,9));
                else $temp = $characters[rand(0, strlen($characters) - 1)];
                $bookCode = $bookCode . $temp;
            }

            $guest = new Guest;
            $booking = new Book;
            $payment = new Payment;
            $extra = new Extra;
            $detailBook = new DetailBooking;

            $countAdd = Additional::where('Status','=','Active')->count();
            $countBook = Book::orderby('ID_Booking','DESC')->first();
            $countGuest = Guest::orderby('ID_Guest','DESC')->first();
            $countExtra = Extra::orderby('ID_Extra','DESC')->first();
            $countPayment = Payment::orderby('ID_Payment','DESC')->first();


            $tampIDBook = $countBook->ID_Booking;
            $tampIDGuest = $countGuest->ID_Guest;
            $tampIDExtra = $countExtra->ID_Extra;
            $tampIDPayment = $countPayment->ID_Payment;


            $checkYearBook = substr(strval($tampIDBook),3,-5);
            $checkYearGuest = substr(strval($tampIDGuest),3,-5);
            $checkYearExtra = substr(strval($tampIDExtra),3,-5);
            $checkYearPayment = substr(strval($tampIDPayment),3,-5);


            $incrementIDBook = substr($tampIDBook, 3)+1;
            $incrementIDGuest= substr($tampIDGuest, 3)+1;
            $incrementIDExtra= substr($tampIDExtra, 3)+1;
            $incrementIDPayment= substr($tampIDPayment, 3)+1;


            $joinBook = "BOK".$incrementIDBook;
            $joinGuest = "GUE".$incrementIDGuest;
            $joinExtra = "EXT".$incrementIDExtra;
            $joinPayment = "PAY".$incrementIDPayment;


            $occupancy = Input::get('adult').' Adult | '.Input::get('child').' Child';
            $ccexpiry = Input::get('ccmonth').'/'.Input::get('ccyear');
          

            $arrive = date("Y-m-d", strtotime(Input::get('from'))); //arrive date
            $depart = date("Y-m-d", strtotime(Input::get('to'))); //depart

            if ($checkYearBook == strval(date("y"))) {
                //1. insert to book
                $booking->ID_Booking = $joinBook;
                $booking->Booking_code = $bookCode;
                $booking->Arrive = $arrive;
                $booking->Depart = $depart;
                $booking->Number_nights = Input::get('total_d');
                $booking->Occupancy = $occupancy;
                $booking->Booking_Status = "Booked";

                //2. insert to guest

                if ($checkYearGuest == strval(date("y"))) {
                    $guest->ID_Guest = $joinGuest;
                    $guest->ID_Booking = $joinBook;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');
                } else {
                    $guest->ID_Guest = "GUE" . date('y') . "00001";;
                    $guest->ID_Booking = $joinBook;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');

                }

                //3. insert to payment
                if ($checkYearPayment == strval(date("y"))) {
                    $payment->ID_Payment = $joinPayment;
                    $payment->ID_Booking = $joinBook;
                    $payment->Credit_Type = Input::get('cctype');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;
                } else {
                    $payment->ID_Payment = "PAY" . date('y') . "00001";
                    $payment->ID_Booking = $joinBook;
                    $payment->Credit_Type = Input::get('cctype');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;

                }
                //4. insert to extra
                if ($checkYearExtra == strval(date("y"))) {
                    $extra->ID_Extra = $joinExtra;
                    $extra->ID_Booking = $joinBook;
                    $extra->Arrival_Time = Input::get('darrive');
                    $extra->Flight_Detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');

                } else {
                    $extra->ID_Extra = "EXT" . date('y') . "00001";
                    $extra->ID_Booking = $joinBook;
                    $extra->Arrival_Time = Input::get('darrive');
                    $extra->Flight_Detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');
                }

                //5. insert to detail Book
                $detailBook->ID_Booking = $joinBook;
                $detailBook->ID_RoomType = Input::get('roomID');
                $detailBook->Quantity = Input::get('quantity');
                $detailBook->Price = Input::get('roomPR');

                //6. insert to detail additional


                for($i = 0; $i < $countAdd; $i++){
                    $data = array(
                        array('ID_Booking' => $joinBook, 'ID_Additional' => Input::get("id_add_$i"), 'Price' => Input::get("price_add_$i"), 'Quantity' => Input::get("add_$i"))
                    );
                    DetailAdditional::insert($data);
                }

                $booking->save();
                $guest->save();
                $payment->save();
                $extra->save();
                $detailBook->save();
                return Redirect::action('showBook',$bookCode);
            }
            else
            {
                //1. insert to book
                $booking->ID_Booking = "BOK" . date('y') . "00001";
                $booking->Booking_code = $bookCode;
                $booking->Arrive = $arrive;
                $booking->Depart = $depart;
                $booking->Number_nights = Input::get('total_d');
                $booking->Occupancy = $occupancy;
                $booking->Booking_Status = "Booked";

                //2. insert to guest

                if ($checkYearGuest == strval(date("y"))) {
                    $guest->ID_Guest = $joinGuest;
                    $guest->ID_Booking = "BOK" . date('y') . "00001";;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');
                } else {
                    $guest->ID_Guest = "GUE" . date('y') . "00001";
                    $guest->ID_Booking = "BOK" . date('y') . "00001";;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');

                }

                //3. insert to payment
                if ($checkYearPayment == strval(date("y"))) {
                    $payment->ID_Payment = $joinPayment;
                    $payment->ID_Booking = "BOK" . date('y') . "00001";;
                    $payment->Credit_Type = Input::get('cctype');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;
                } else {
                    $payment->ID_Payment = "PAY" . date('y') . "00001";
                    $payment->ID_Booking = "BOK" . date('y') . "00001";;
                    $payment->Credit_Type = Input::get('cctype');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;

                }
                //4. insert to extra
                if ($checkYearExtra == strval(date("y"))) {
                    $extra->ID_Extra = $joinExtra;
                    $extra->ID_Booking = "BOK" . date('y') . "00001";;
                    $extra->Arrival_Time = Input::get('darrive');
                    $extra->Flight_Detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');

                } else {
                    $extra->ID_Extra = "EXT" . date('y') . "00001";
                    $extra->ID_Booking = "BOK" . date('y') . "00001";;
                    $extra->Arrival_Time = Input::get('darrive');
                    $extra->Flight_Detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');
                }

                //5. insert to detail Book
                $detailBook->ID_Booking = "BOK" . date('y') . "00001";;
                $detailBook->ID_RoomType = Input::get('roomID');
                $detailBook->Quantity = Input::get('quantity');
                $detailBook->Price = Input::get('roomPR');

                //6. insert to detail additional
                for($i = 0; $i < $countAdd; $i++){
                    $data = array(
                        array('ID_Booking' => "BOK" . date('y') . "00001", 'ID_Additional' => Input::get("id_add_$i"), 'Price' => Input::get("price_add_$i"), 'Quantity' => Input::get("add_$i"))
                    );
                    DetailAdditional::insert($data);
                }

                $booking->save();
                $guest->save();
                $payment->save();
                $extra->save();
                $detailBook->save();
                //return Redirect::to('/rooms')->with('message','Success');
                return Redirect::action('showInvoice',$bookCode);
            }
        }
    }

    //save to db (Agent)
    public function agentInsertBook()
    {
        $validator = Validator::make(Input::all(),$this->rules);

        if($validator->passes())
        {
            echo "asd";
        }
        return Redirect::action('offerBook',[Input::get('offerID'),Input::get('roomID')])
            ->withErrors($validator,'guest')
            ->withInput();
        }
    //save to db (Normal Rates)
    public function insertBookNormal()
    {
        $validator = Validator::make(Input::all(),$this->rules);
        $getNum = Input::get('ccnum');
        $getType = Input::get('CardType');

        if($validator->fails())
        {
            return Redirect::action('normalBook',[Input::get('roomID')])
                ->withErrors($validator,'guest')
                ->withInput();

        }
        else if(!checkCreditCard($getNum, $getType, $errornumber, $errortext))
        {
            $errortext = "This Card Has Invalid Number";
            return Redirect::action('normalBook',[Input::get('roomID')])
                ->with('ccError',$errortext)
                ->withInput();
        }
        else {
            $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $temp;
            $bookCode = "";

            for ($i=1; $i <= 10 ; $i++)
            {
                if ($i%2 == 1) $temp = floor(rand(0,9));
                else $temp = $characters[rand(0, strlen($characters) - 1)];
                $bookCode = $bookCode . $temp;
            }

            $inputAll = Input::all();

            $guest = new Guest;
            $booking = new Book;
            $payment = new Payment;
            $extra = new Extra;
            $detailBook = new DetailBooking;
            $detailAdditional = new DetailAdditional;

            $countAdd = Additional::where('Status','=','Active')->count();
            $countBook = Book::orderby('ID_Booking','DESC')->first();
            $countGuest = Guest::orderby('ID_Guest','DESC')->first();
            $countExtra = Extra::orderby('ID_Extra','DESC')->first();
            $countPayment = Payment::orderby('ID_Payment','DESC')->first();


            $tampIDBook = $countBook->ID_Booking;
            $tampIDGuest = $countGuest->ID_Guest;
            $tampIDExtra = $countExtra->ID_Extra;
            $tampIDPayment = $countPayment->ID_Payment;


            $checkYearBook = substr(strval($tampIDBook),3,-5);
            $checkYearGuest = substr(strval($tampIDGuest),3,-5);
            $checkYearExtra = substr(strval($tampIDExtra),3,-5);
            $checkYearPayment = substr(strval($tampIDPayment),3,-5);


            $incrementIDBook = substr($tampIDBook, 3)+1;
            $incrementIDGuest= substr($tampIDGuest, 3)+1;
            $incrementIDExtra= substr($tampIDExtra, 3)+1;
            $incrementIDPayment= substr($tampIDPayment, 3)+1;


            $joinBook = "BOK".$incrementIDBook;
            $joinGuest = "GUE".$incrementIDGuest;
            $joinExtra = "EXT".$incrementIDExtra;
            $joinPayment = "PAY".$incrementIDPayment;



            $occupancy = Input::get('adult').' Adult | '.Input::get('child').' Child';
            $ccexpiry = Input::get('ccmonth').'/'.Input::get('ccyear');
          

            $arrive = date("Y-m-d", strtotime(Input::get('from'))); //arrive date
            $depart = date("Y-m-d", strtotime(Input::get('to'))); //depart

            if ($checkYearBook == strval(date("y"))) {
                //1. insert to book
                $booking->ID_Booking = $joinBook;
                $booking->Booking_code = $bookCode;
                $booking->Arrive = $arrive;
                $booking->Depart = $depart;
                $booking->Number_nights = Input::get('total_d');
                $booking->Occupancy = $occupancy;
                $booking->Booking_Status = "Booked";

                //2. insert to guest

                if ($checkYearGuest == strval(date("y"))) {
                    $guest->ID_Guest = $joinGuest;
                    $guest->ID_Booking = $joinBook;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');
                } else {
                    $guest->ID_Guest = "GUE" . date('y') . "00001";;
                    $guest->ID_Booking = $joinBook;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');

                }

                //3. insert to payment
                if ($checkYearPayment == strval(date("y"))) {
                    $payment->ID_Payment = $joinPayment;
                    $payment->ID_Booking = $joinBook;
                    $payment->Credit_Type = Input::get('CardType');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;
                } else {
                    $payment->ID_Payment = "PAY" . date('y') . "00001";
                    $payment->ID_Booking = $joinBook;
                    $payment->Credit_Type = Input::get('CardType');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;

                }
                //4. insert to extra
                if ($checkYearExtra == strval(date("y"))) {
                    $extra->ID_Extra = $joinExtra;
                    $extra->ID_Booking = $joinBook;
                    $extra->Arrival_time = Input::get('darrive');
                    $extra->Flight_detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');

                } else {
                    $extra->ID_Extra = "EXT" . date('y') . "00001";
                    $extra->ID_Booking = $joinBook;
                    $extra->Arrival_Time = Input::get('darrive');
                    $extra->Flight_Detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');
                }

                //5. insert to detail Book
                $detailBook->ID_Booking = $joinBook;
                $detailBook->ID_RoomType = Input::get('roomID');
                $detailBook->Quantity = Input::get('quantity');
                $detailBook->Price = Input::get('roomPR');

                for($i = 0; $i < $countAdd; $i++) {
                    $data = array(
                        array('ID_Booking' => $joinBook, 'ID_Additional' => Input::get("id_add_$i"), 'Price' => Input::get("price_add_$i"), 'Quantity' => Input::get("add_$i"))
                    );
                    DetailAdditional::insert($data);
                }

                $booking->save();
                $guest->save();
                $payment->save();
                $extra->save();
                $detailBook->save();
                return Redirect::action('showBook',$bookCode);
            }
            else
            {
                //1. insert to book
                $booking->ID_Booking = "BOK" . date('y') . "00001";
                $booking->Booking_code = $bookCode;
                $booking->Arrive = $arrive;
                $booking->Depart = $depart;
                $booking->Number_nights = Input::get('total_d');
                $booking->Occupancy = $occupancy;
                $booking->Booking_Status = "Booked";

                //2. insert to guest

                if ($checkYearGuest == strval(date("y"))) {
                    $guest->ID_Guest = $joinGuest;
                    $guest->ID_Booking = "BOK" . date('y') . "00001";;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');
                } else {
                    $guest->ID_Guest = "GUE" . date('y') . "00001";
                    $guest->ID_Booking = "BOK" . date('y') . "00001";;
                    $guest->First_Name = Input::get('fname');
                    $guest->Last_Name = Input::get('lname');
                    $guest->No_Identity = Input::get('identity');
                    $guest->Email = Input::get('email');
                    $guest->Telephone = Input::get('phone');
                    $guest->Address = Input::get('address');
                    $guest->Country = Input::get('country');
                    $guest->City = Input::get('city');
                    $guest->State = Input::get('city');
                    $guest->Post_code = Input::get('state');
                }

                //3. insert to payment
                if ($checkYearPayment == strval(date("y"))) {
                    $payment->ID_Payment = $joinPayment;
                    $payment->ID_Booking = "BOK" . date('y') . "00001";;
                    $payment->Credit_Type = Input::get('CardType');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;
                } else {
                    $payment->ID_Payment = "PAY" . date('y') . "00001";
                    $payment->ID_Booking = "BOK" . date('y') . "00001";;
                    $payment->Credit_Type = Input::get('CardType');
                    $payment->Credit_Holder = Input::get('ccname');
                    $payment->Credit_Number = Input::get('ccnum');
                    $payment->Credit_Expiry = $ccexpiry;

                }
                //4. insert to extra
                if ($checkYearExtra == strval(date("y"))) {
                    $extra->ID_Extra = $joinExtra;
                    $extra->ID_Booking = "BOK" . date('y') . "00001";;
                    $extra->Arrival_Time = Input::get('darrive');
                    $extra->Flight_Detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');

                } else {
                    $extra->ID_Extra = "EXT" . date('y') . "00001";
                    $extra->ID_Booking = "BOK" . date('y') . "00001";;
                    $extra->Arrival_Time = Input::get('darrive');
                    $extra->Flight_Detail = Input::get('fdetail');
                    $extra->Comment = Input::get('comment');
                }

                //5. insert to detail Book
                $detailBook->ID_Booking = "BOK" . date('y') . "00001";;
                $detailBook->ID_RoomType = Input::get('roomID');
                $detailBook->Quantity = Input::get('quantity');
                $detailBook->Price = Input::get('roomPR');

                //6. insert to detail additional
                for($i = 0; $i < $countAdd; $i++){
                    $data = array(
                        array('ID_Booking' => "BOK" . date('y') . "00001", 'ID_Additional' => Input::get("id_add_$i"), 'Price' => Input::get("price_add_$i"), 'Quantity' => Input::get("add_$i"))
                    );
                    DetailAdditional::insert($data);
                }

                $booking->save();
                $guest->save();
                $payment->save();
                $extra->save();
                $detailBook->save();
                return Redirect::action('showInvoice',$bookCode);
                //return Redirect::to('/rooms')->with('message','Success');
            }
        }

    }

    //final view of booking (normal rates)
    

    public function createViewBook()
    {

    }
    //show booking
    public function showInvoice($bookCode)
    {
        $about = About::all();

        $booking = DetailBooking::join('booking','booking.ID_Booking','=','detail_booking.ID_Booking')
        ->join('roomtype','roomtype.ID_RoomType','=','detail_booking.ID_RoomType')
        ->join('guest','guest.ID_Booking','=','detail_booking.ID_Booking')
        ->join('payment','payment.ID_Booking','=','detail_booking.ID_Booking')
        ->join('extra','extra.ID_Booking','=','detail_booking.ID_Booking')
        ->where('booking.Booking_code','=',$bookCode)->get();

        $guest = Guest::join('booking','booking.ID_Booking','=','guest.ID_Booking')
            ->where('booking.Booking_code','=',$bookCode)->get();


        $tax = Tax::where('Status','=','Active')->get();

        $detailAdd = DetailBooking::join('booking','booking.ID_Booking','=','detail_booking.ID_Booking')
        ->join('detail_additional','detail_additional.ID_Booking','=','detail_booking.ID_Booking')
        ->join('additional','additional.ID_Additional','=','detail_additional.ID_Additional')
        ->where('booking.Booking_code','=',$bookCode)->get();

        $totalRoom = 0;
        foreach($booking as $key => $value1)
        {
            $totalRoom += ($value1->Price*$value1->Quantity)*$value1->Number_nights;
        }
        //dd($totalRoom);
        $totalAdd = 0;
        foreach($detailAdd as $key => $value){
            $totalAdd += $value->Price*$value->Quantity;
        }
        //dd($totalAdd);
        $totalTax = 0;
        foreach($tax as $key => $value2) {
            $totalTax+= ($totalAdd+$totalRoom)*$value2->Tax;
        }
        //dd($totalTax);
        $grandTotal = $totalAdd+$totalRoom+$totalTax;
        //dd($grandTotal);

        return View::make('Books.View.show')
            ->with('booking',$booking)->with('about',$about)
            ->with('guest',$guest)->with('tax',$tax)
            ->with('detailAdd',$detailAdd)
            ->with('totalRoom',$totalRoom)->with('totalAdditional',$totalAdd)
            ->with('totalTax',$totalTax)->with('grandTotal',$grandTotal);
    }

    public function showBook($bookCode)
    {

    }
	/**
	 * Show the form for editing the specified resource.
	 * GET /books/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /books/{id}
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
	 * DELETE /books/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}

function checkCreditCard ($cardnumber, $cardname, &$errornumber, &$errortext) {

    // Define the cards we support. You may add additional card types.

    //  Name:      As in the selection box of the form - must be same as user's
    //  Length:    List of possible valid lengths of the card number for the card
    //  prefixes:  List of possible prefixes for the card
    //  checkdigit Boolean to say whether there is a check digit

    // Don't forget - all but the last array definition needs a comma separator!

    $cards = array (  array ('name' => 'American Express',
        'length' => '15',
        'prefixes' => '34,37',
        'checkdigit' => true
    ),
        array ('name' => 'Diners Club Carte Blanche',
            'length' => '14',
            'prefixes' => '300,301,302,303,304,305',
            'checkdigit' => true
        ),
        array ('name' => 'Diners Club',
            'length' => '14,16',
            'prefixes' => '36,38,54,55',
            'checkdigit' => true
        ),
        array ('name' => 'Discover',
            'length' => '16',
            'prefixes' => '6011,622,64,65',
            'checkdigit' => true
        ),
        array ('name' => 'Diners Club Enroute',
            'length' => '15',
            'prefixes' => '2014,2149',
            'checkdigit' => true
        ),
        array ('name' => 'JCB',
            'length' => '16',
            'prefixes' => '35',
            'checkdigit' => true
        ),
        array ('name' => 'Maestro',
            'length' => '12,13,14,15,16,18,19',
            'prefixes' => '5018,5020,5038,6304,6759,6761,6762,6763',
            'checkdigit' => true
        ),
        array ('name' => 'MasterCard',
            'length' => '16',
            'prefixes' => '51,52,53,54,55',
            'checkdigit' => true
        ),
        array ('name' => 'Solo',
            'length' => '16,18,19',
            'prefixes' => '6334,6767',
            'checkdigit' => true
        ),
        array ('name' => 'Switch',
            'length' => '16,18,19',
            'prefixes' => '4903,4905,4911,4936,564182,633110,6333,6759',
            'checkdigit' => true
        ),
        array ('name' => 'VISA',
            'length' => '16',
            'prefixes' => '4',
            'checkdigit' => true
        ),
        array ('name' => 'VISA Electron',
            'length' => '16',
            'prefixes' => '417500,4917,4913,4508,4844',
            'checkdigit' => true
        ),
        array ('name' => 'LaserCard',
            'length' => '16,17,18,19',
            'prefixes' => '6304,6706,6771,6709',
            'checkdigit' => true
        )
    );

    $ccErrorNo = 0;

    $ccErrors [0] = "Unknown card type";
    $ccErrors [1] = "No card number provided";
    $ccErrors [2] = "Credit card number has invalid format";
    $ccErrors [3] = "Credit card number is invalid";
    $ccErrors [4] = "Credit card number is wrong length";

    // Establish card type
    $cardType = -1;
    for ($i=0; $i<sizeof($cards); $i++) {

        // See if it is this card (ignoring the case of the string)
        if (strtolower($cardname) == strtolower($cards[$i]['name'])) {
            $cardType = $i;
            break;
        }
    }

    // If card type not found, report an error
    if ($cardType == -1) {
        $errornumber = 0;
        $errortext = $ccErrors [$errornumber];
        return false;
    }

    // Ensure that the user has provided a credit card number
    if (strlen($cardnumber) == 0)  {
        $errornumber = 1;
        $errortext = $ccErrors [$errornumber];
        return false;
    }

    // Remove any spaces from the credit card number
    $cardNo = str_replace (' ', '', $cardnumber);

    // Check that the number is numeric and of the right sort of length.
    if (!preg_match("/^[0-9]{13,19}$/",$cardNo))  {
        $errornumber = 2;
        $errortext = $ccErrors [$errornumber];
        return false;
    }

    // Now check the modulus 10 check digit - if required
    if ($cards[$cardType]['checkdigit']) {
        $checksum = 0;                                  // running checksum total
        $mychar = "";                                   // next char to process
        $j = 1;                                         // takes value of 1 or 2

        // Process each digit one by one starting at the right
        for ($i = strlen($cardNo) - 1; $i >= 0; $i--) {

            // Extract the next digit and multiply by 1 or 2 on alternative digits.
            $calc = $cardNo{$i} * $j;

            // If the result is in two digits add 1 to the checksum total
            if ($calc > 9) {
                $checksum = $checksum + 1;
                $calc = $calc - 10;
            }

            // Add the units element to the checksum total
            $checksum = $checksum + $calc;

            // Switch the value of j
            if ($j ==1) {$j = 2;} else {$j = 1;};
        }

        // All done - if checksum is divisible by 10, it is a valid modulus 10.
        // If not, report an error.
        if ($checksum % 10 != 0) {
            $errornumber = 3;
            $errortext = $ccErrors [$errornumber];
            return false;
        }
    }

    // The following are the card-specific checks we undertake.

    // Load an array with the valid prefixes for this card
    $prefix = explode(',',$cards[$cardType]['prefixes']);

    // Now see if any of them match what we have in the card number
    $PrefixValid = false;
    for ($i=0; $i<sizeof($prefix); $i++) {
        $exp = '/^' . $prefix[$i] . '/';
        if (preg_match($exp,$cardNo)) {
            $PrefixValid = true;
            break;
        }
    }

    // If it isn't a valid prefix there's no point at looking at the length
    if (!$PrefixValid) {
        $errornumber = 3;
        $errortext = $ccErrors [$errornumber];
        return false;
    }

    // See if the length is valid for this card
    $LengthValid = false;
    $lengths = explode(',',$cards[$cardType]['length']);
    for ($j=0; $j<sizeof($lengths); $j++) {
        if (strlen($cardNo) == $lengths[$j]) {
            $LengthValid = true;
            break;
        }
    }

    // See if all is OK by seeing if the length was valid.
    if (!$LengthValid) {
        $errornumber = 4;
        $errortext = $ccErrors [$errornumber];
        return false;
    };

    // The credit card is in the required format.
    return true;
}
