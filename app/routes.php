<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

/*---------------------------------------------------*/

Route::get('/SynchAkomodasi',function(){
    //$profile = aboutus::get(['Logo','Name','Address','Telephone','Email','Latitude','Longitude','Link_Web']);
    //$respone = ['Profile' => $profile];
    //return respone::json($respone);
});

Route::get('/SynchRoomType',function(){

});

Route::get('/SynchGambarAkomodasi',function(){

});

Route::get('/SyncOffer',function(){

});

/*

    $url = "http://protodinas.asia/resources/images/events/Event19.JPG";
    $req = Request::create($url);   
    $name = $req->segments();
    $name = $name[count($name)-1];
    $f = file_get_contents($url);
    file_put_contents("temp/".$name,$f);
    dd(File::extension('temp/'.$name));
*/


/*---------------------------------------------------*/

Route::POST('/AddDestinasi',function(){
    $file = fopen("add_destinasi.txt","w+");
      fwrite($file, print_r(Input::json()->all()[0],true));
      fclose($file);

    $getDestination = json_decode(Input::json()->all()[0],true)['destinasi'];

    $ext = pathinfo($getDestination["logo"]);
    $image = "destinasi_".substr($getDestination["namadestinasi"], 0,5).".".$ext["extension"];
    //dd($image);
    //print_r($image);
    $destinationNew = [
            "Dest_Name"=>$getDestination["namadestinasi"],
            "Dest_Picture"=>$getDestination["logo"],
            "Dest_Description"=>$getDestination["description"],
            "Dest_Telp"=>$getDestination["telephone"],
            "Dest_Email"=>$getDestination["email"],
            "Latitude"=>$getDestination["latitude"],
            "Longitude"=>$getDestination["longitude"],
            "Web_Link"=>$getDestination["linkweb"],
            "Status"=>"Active"
    ];
    Destination::create($destinationNew);
        return Response::json($destinationNew);
});


Route::POST('/UpdateDestinasi',function() {

    $getDestinasi = Input::json()->all(); 
    
    $destinationUpdate = [ 
    "old"=>$getDestinasi["destinasi"]["old"], 
    "new"=>$getDestinasi["destinasi"]["new"],
    ]; 

    $urlOld = $destinationUpdate["old"]["logo"];
    $requestOld = Request::create($urlOld);
    $nameOld = $requestOld->segments();
    $nameOld = $nameOld[count($nameOld)-1];

    $filename = 'resources/images/destination/'.$nameOld;
    if(File::exists($filename)){
        File::delete($filename);
    }

    $urlNew = $destinationUpdate["new"]["logo"];
    $requestNew = Request::create($urlNew);
    $nameNew = $requestNew->segments();
    $nameNew = $nameNew[count($nameNew)-1];
    $fileNew = file_get_contents($urlNew);

    $destination = Destination::where("Dest_Name",'=',$destinationUpdate["old"]["namadestinasi"]) 
    ->where("Dest_Email",'=',$destinationUpdate["old"]["email"]); 
    $destinationNew = [ 
                "Dest_Name"=>$destinationUpdate["new"]["namadestinasi"], 
                "Dest_Picture"=>$nameNew, 
                "Dest_Description"=>$destinationUpdate["new"]["description"], 
                "Dest_Telp"=>$destinationUpdate["new"]["telephone"], 
                "Dest_Email"=>$destinationUpdate["new"]["email"], 
                "Latitude"=>$destinationUpdate["new"]["latitude"], 
                "Longitude"=>$destinationUpdate["new"]["longitude"], 
                "Web_Link"=>$destinationUpdate["new"]["linkweb"],
                "Status"=>"Active"
            ]; 
    if($destination->count() == 1) { 
        file_put_contents("resources/images/destination/".$nameNew,$fileNew);
        $destination->update($destinationNew); 
    }
    else if($destination->count() == 0) { 
        
        file_put_contents("resources/images/destination/".$nameNew,$fileNew);
        Destination::create($destinationNew);
    }
});


Route::POST('/DeleteDestinasi',function(){
    //$getDestinasi = Input::json()->all();
    $file = fopen("delete_dest.txt","w+");
      fwrite($file, print_r(Input::json()->all()[0],true));
      fclose($file);

    $getDestinasi = json_decode(Input::json()->all()[0],true)['destinasi'];

    $dest = [
            "Dest_Name"=>$getDestinasi["namadestinasi"],
            "Dest_Picture"=>$getDestinasi["logo"],
            "Dest_Description"=>$getDestinasi["description"],
            "Dest_Telp"=>$getDestinasi["telephone"],
            "Dest_Email"=>$getDestinasi["email"],
            "Latitude"=>$getDestinasi["latitude"],
            "Longitude"=>$getDestinasi["longitude"],
            "Web_Link"=>$getDestinasi["linkweb"]
        ];

    $destination = Destination::where("Dest_Name","=",$dest['Dest_Name'])
            //->where("Dest_Telp","=",$dest['Dest_Telp'])
            ->where("Dest_Email","=",$dest['Dest_Email']);

    
    if ($destination->count() == 1) 
    {
        //Destination::where("Event_ID",'=',$destination->get(["Event_ID"])->first()->Event_ID)->delete();
        $destination->delete();
    }

});

/*---------------------------------------------------*/

Route::POST('/AddEventPariwisata',function(){
    $file = fopen("eventpariwisata.txt","w+");
      fwrite($file, print_r(Input::json()->all()[0],true));
      fclose($file);
    /*
    $url = "http://protodinas.asia/resources/images/events/Event19.JPG";
    $req = Request::create($url);   
    $name = $req->segments();
    $name = $name[count($name)-1];
    $f = file_get_contents($url);
    file_put_contents("temp/".$name,$f);
    dd(File::extension('temp/'.$name));
    */
    $getEventPari = json_decode(Input::json()->all(),true,[0])['event'];

    $url = $getEventPari["gambarevent"];
    $request = Request::create($url);
    $name = $request->segments();
    $name = $name[count($name)-1];
    $file = file_get_contents($url);
    file_put_contents("resources/images/integration/int_dinas/".$name,$file);

    $event = [
        "Event_Title"=>$getEventPari["namaevent"],
        "Event_Description"=>$getEventPari["deskripsievent"],
        "Event_Picture"=>$name,
        "Event_Date"=>$getEventPari["tanggalevent"],
        "Event_Location"=>$getEventPari["lokasievent"]
    ];
        Dinasevents::create($event);
        return Response::json($event);
}); 

Route::POST('/UpdateEventPariwisata',function(){
    $getEventPari = Input::json()->all(); 


    $eventUpdate = [ 
    "old"=>$getEventPari["event"]["old"], 
    "new"=>$getEventPari["event"]["new"], 
    ]; 

    $eventDinas = Dinasevents::where("Event_Title",'=',$eventUpdate["old"]["namaevent"])  
        ->where("Event_Location",'=',$eventUpdate["old"]["lokasievent"]); 

    if($eventDinas->count() == 1) { 

        $urlOld = $eventUpdate["old"]["gambarevent"];
        $requestOld = Request::create($urlOld);
        $nameOld = $requestOld->segments();
        $nameOld = $nameOld[count($nameOld)-1];

        $filename = 'resources/images/integration/int_dinas/'.$nameOld;
        if(File::exists($filename)){
            File::delete($filename);
        }

        $urlNew = $eventUpdate["new"]["gambarevent"];
        $requestNew = Request::create($urlNew);
        $nameNew = $requestNew->segments();
        $nameNew = $nameNew[count($nameNew)-1];
        $fileNew = file_get_contents($urlNew);
        file_put_contents("resources/images/integration/int_dinas/".$nameNew,$fileNew);
        $newEvent = [ 
                "Event_Title"=>$eventUpdate["new"]["namaevent"], 
                "Event_Picture"=>$nameNew, 
                "Event_Description"=>$eventUpdate["new"]["deskripsievent"], 
                "Event_Date"=>$eventUpdate["new"]["tanggalevent"], 
                "Event_Location"=>$eventUpdate["new"]["lokasievent"]
            ]; 
        $eventDinas->update($newEvent); 
    }

});

Route::POST('/DeleteEventPariwisata',function(){
    $getEventPari = Input::json()->all();

    $url = $getEventPari["gambarevent"];
    $request = Request::create($url);
    $name = $request->segments();
    $name = $name[count($name)-1];

    $filename = 'resources/images/integration/int_dinas/'.$name;
    if(File::exists($filename)){
        File::delete($filename);
    }

    $event = [
            "Event_Title"=>$getEventPari["namaevent"],
            "Event_Picture"=>$name,
            "Event_Description"=>$getEventPari["deskripsievent"],
            "Event_Date"=>$getEventPari["tanggalevent"],
            "Event_Location"=>$getEventPari["lokasievent"]
        ];

    $eventDinas = Dinasevents::where("Event_Title","=",$event['Event_Title'])
        ->where("Event_Location","=",$event['Event_Location']);
            

    if ($eventDinas->count() == 1) 
    {
        //$dinasevents = $dinasevents->get()->first()->Event_ID;
        //Dinasevents::destroy($dinasevents->get(["Event_ID"])->first()->Event_ID);
        $eventDinas->delete();
        
    }
    else {
        for ($i=0; $i < $eventDinas->count(); $i++) { 
                $eventDinas->delete();
        }
    }
        //return Response::json($dinasevents->get()->toArray());
});

/*---------------------------------------------------*/

Route::POST('/AddAgent',function(){
    $file = fopen("add_agent.txt","w+");
      fwrite($file, print_r(Input::json()->all()[0],true));
      fclose($file);
    $getAgent = json_decode(Input::json()->all()[0],true)["agentravel"];

    /*

    $agent = json_decode(Input::json()->all()[0],true)["agentravel"]; */

    $url = $getAgent["picture"];
    $request = Request::create($url);
    $name = $request->segments();
    $name = $name[count($name)-1];
    $file = file_get_contents($url);
    file_put_contents("resources/images/travel/".$name,$file);

    $save = [
        "Travel_Logo"=>$name,
        "Travel_Name"=>$getAgent["nama"],
        "Travel_Address"=>$getAgent["alamat"],
        "Travel_Telp"=>$getAgent["phone"],
        "Travel_Email"=>$getAgent["email"],
        "Web_Link"=>$getAgent["linkweb"],
        "Status"=>"Active"
    ];

     //$package = TravelPackage::where("Package_Name","=",$save['Travel_Name'])
     //       ->where("Package_Price","=",$save['Travel_Email']);
    
        Travel::create($save);
        return Response::json($save);

});

Route::POST('/UpdateAgent',function(){
    $getAgent = Input::json()->all(); 

    $updateAgent = [ 
    "old"=>$getAgent["old"], 
    "new"=>$getAgent["new"], 
    ]; 

    $Agent = Travel::where("Travel_Name","=",$updateAgent["old"]["nama"]) 
    ->where("Travel_Email",'=',$updateAgent["old"]["email"])
    ->where("Status","=","Active"); 

    if($Agent->count() == 1) { 

    $urlOld = $updateAgent["old"]["picture"];
    $requestOld = Request::create($urlOld);
    $nameOld = $requestOld->segments();
    $nameOld = $nameOld[count($nameOld)-1];

    $filename = 'resources/images/travel/'.$nameOld;
    if(File::exists($filename)){
        File::delete($filename);
    }

    $urlNew = $updateAgent["new"]["picture"];
    $requestNew = Request::create($urlNew);
    $nameNew = $requestNew->segments();
    $nameNew = $nameNew[count($nameNew)-1];
    $fileNew = file_get_contents($urlNew);
    file_put_contents("resources/images/travel/".$nameNew,$fileNew);


    $newAgent = [ 
            "Travel_Logo"=>$nameNew, 
            "Travel_Name"=>$updateAgent["new"]["nama"], 
            "Travel_Address"=>$updateAgent["new"]["alamat"], 
            "Travel_Telp"=>$updateAgent["new"]["phone"],
            "Travel_Email"=>$updateAgent["new"]["email"],
            "Web_Link"=>$updateAgent["new"]["linkweb"]
        ]; 
    $Agent->update($newAgent); 
    }
});

Route::POST('/DeleteAgent',function(){

    //$getAgent = Input::json()->all();
    $file = fopen("delete_agent.txt","w+");
      fwrite($file, print_r(Input::json()->all()[0],true));
      fclose($file);
    $getAgent = json_decode(Input::json()->all()[0],true)["agentravel"];
    $DeleteAgent = [
            "Travel_Name"=>$getAgent["nama"],
            "Travel_Email"=>$getAgent["email"],
            "Travel_Picture"=>$getAgent["picture"]
        ];
    //dd($DeleteAgent);
    $Agent = Travel::where("Travel_Name","=",$DeleteAgent['Travel_Name'])
            ->where("Travel_Email","=",$DeleteAgent['Travel_Email']);

    $url = $DeleteAgent["Travel_Picture"];
    $request = Request::create($url);
    $name = $request->segments();
    $name = $name[count($name)-1];

    $filename = 'resources/images/travel/'.$name;
    if(File::exists($filename)){
            File::delete($filename);
        }
    $Agent->delete();
    /*
    if ($Agent->count() == 1) 
    {
        
        
        //Destination::where("ID_Travel_Package",'=',$package->get(["ID_Travel_Package"])->first()->ID_Travel_Package;
        
    }
    else{
        for ($i=0; $i < $Agent->count(); $i++) { 
            if(File::exists($filename)){
                File::delete($filename);
            }
            $Agent->delete();
        }
    } */
});

/*---------------------------------------------------*/

Route::POST('/AddPaketWisata',function(){
    $getTravelPackage = Input::json()->all();

    $getAgent = [
        "Travel_Name"=>$getTravelPackage["nama"],
        "Travel_Email"=>$getTravelPackage["email"]
    ];

    $Agent = Travel::where("Travel_Name","=",$getAgent['Travel_Name'])
            ->where("Travel_Email","=",$getAgent['Travel_Email'])->first();

    $url = $getTravelPackage["paket"]["image"];
    $request = Request::create($url);
    $name = $request->segments();
    $name = $name[count($name)-1];
    $file = file_get_contents($url);
    file_put_contents("resources/images/integration/int_travel/".$name,$file);

    $newPackage = [
    "Package_Name"=>$getTravelPackage["paket"]["name"],
    "ID_Travel"=>$Agent->ID_Travel,
    "Package_Picture"=>$name,
    "Package_Description"=>$getTravelPackage["paket"]["details"],
    "Package_Price"=>$getTravelPackage["paket"]["price"]
    ];
    
        TravelPackage::create($newPackage);
        return Response::json($newPackage);
});

Route::POST('/UpdatePaketWisata',function(){
    $getTravelPackage = Input::json()->all(); 
    //print_r($getTravelPackage);

    $updatePackage = [ 
    "old"=>$getTravelPackage["old"], 
    "new"=>$getTravelPackage["new"] 
    ]; 

    //$travel = Travel::where("Travel_Name","=",$getTravelPackage['nama'])->first();

    $package = TravelPackage::where("Package_Name",'=',$updatePackage["old"]["name"]) 
        ->where("Package_Price",'=',$updatePackage["old"]["price"]); 


    if($package->count() == 1) { 

    $urlOld = $updatePackage["old"]["image"];
    $requestOld = Request::create($urlOld);
    $nameOld = $requestOld->segments();
    $nameOld = $nameOld[count($nameOld)-1];

    $filename = 'resources/images/integration/int_travel/'.$nameOld;
    if(File::exists($filename)){
        File::delete($filename);
    }

    $urlNew = $updatePackage["new"]["image"];
    $requestNew = Request::create($urlNew);
    $nameNew = $requestNew->segments();
    $nameNew = $nameNew[count($nameNew)-1];
    $fileNew = file_get_contents($urlNew);
    file_put_contents("resources/images/integration/int_travel/".$nameNew,$fileNew);


    $newPackage = [ 
            "Package_Name"=>$updatePackage["new"]["name"], 
            "Package_Picture"=>$nameNew, 
            "Package_Description"=>$updatePackage["new"]["details"], 
            "Package_Price"=>$updatePackage["new"]["price"]
        ]; 
    $package->update($newPackage); 
    } 
});

Route::POST('/DeletePaketWisata',function(){
    $getTravelPackage = Input::json()->all();
    $deletePackage = [
        "Package_Name"=>$getTravelPackage["paket"]["name"],
        "Package_Price"=>$getTravelPackage["paket"]["price"],
        "Package_Picture"=>$getTravelPackage["picture"]
    ];

    $package = TravelPackage::where("Package_Name","=",$deletePackage['Package_Name'])
            ->where("Package_Price","=",$deletePackage['Package_Price']);

    $name = $package->get()->first()->Package_Picture;

    $filename = 'resources/images/integration/int_travel/'.$name;

    if ($package->count() == 1) 
    {
        //Destination::where("ID_Travel_Package",'=',$package->get(["ID_Travel_Package"])->first()->ID_Travel_Package;
        if(File::exists($filename)){
            File::delete($filename);
        }   
        $package->delete();
    }
    else {
        for ($i=0; $i < $package->count(); $i++) { 
            if(File::exists($filename)){
                File::delete($filename);
            }
            $package->delete();
        }
    }
});

/*---------------------------------------------------*/


//home
Route::get('/', function(){

    $data['room'] = Rooms::select('roomtype.RoomType_Name','roomtype.ID_RoomType','roomtype_pic.Picture')
        ->join('roomtype_pic', 'roomtype.ID_RoomType', '=', 'roomtype_pic.ID_RoomType')
        ->where('roomtype_pic.Main_Pic','=','YES')->where('roomtype.Status','=','Active')->take(40)->get()->all();
    $data['offer'] = Offer::where('Status','=','Active')->take(40)->get()->all();
    $data['dinas'] = Dinasevents::select(DB::raw("Event_ID, Event_Picture, Event_Date, Event_Title, CONCAT(SUBSTRING(Event_Description,1,100),'...') as IsiEvent"))
        ->orderby('Event_Date', 'DESC')->take(40)->get()->all();
    $data['travel'] = Travel::where('Status','=','Active')->take(40)->get()->all();
    $data['destination'] = Destination::where('Status','=','Active')->take(40)->get()->all();

    $data['gallery'] = Gallery::where("Status","!=","Delete")->get()->all();
    $data['about'] = About::get()->all();
    Session::put('key','expiry',1);
    $value = Session::get('key');
    
    
    return View::make('home')
        ->with('index','active')
        ->with('data',$data);
});

Route::get('post/listing', array('uses' => 'PostController@listing', 'as' => 'get.post.listing'));
Route::get('post/{id}', array('uses' => 'PostController@single', 'as' => 'get.post.single'))->where(array('id' => '[1-9][0-9]*', 'slug' => '[a-zA-Z0-9-_]+'));
Route::post('post/{id}', array('uses' => 'PostController@update', 'as' => 'post.post.update'))->where(array('id' => '[1-9][0-9]*'));
Route::resource('user','UserController');

//resource
Route::resource('/tourism','DestinationController');
Route::resource('/book','BooksController');
Route::resource('/rooms','RoomsController');
Route::resource('/facilities','FacilitiesController');
Route::resource('/news','NewsController');
Route::resource('/events','EventsController');
Route::resource('/aboutus','AboutusController');
Route::resource('/contactus','ContactsController');
Route::resource('/testimonial','TestimonialsController');
Route::resource('/sitemap','SitemapsController');
Route::resource('/faqs','FaqsController');
Route::resource('/yourbook','YourbooksController'); //show menu your book
if(Cache::has('travel_session')) {
    Route::resource('/travel/book','BooksController@indexTravel');
}

//get
Route::get('/tourism/view/{id}','DestinationController@show');
Route::get('/offer/view/{id}','OffersController@show');
Route::get('/book/offer/{idOff}/room/{idRoom}',array('uses'=>'BooksController@BookOffer','as'=>'offerBook'));
Route::get('/book/normal/room/{idRoom}',array('uses'=>'BooksController@BookNormal', 'as'=>'normalBook'));
Route::get('/rooms/view/{id}','RoomsController@show');
Route::get('/facilities/view/{id}','FacilitiesController@show');
Route::get('/events/view/{id}','EventsController@show');
Route::get('/news/view/{id}','NewsController@show');
Route::get('/travel/view/{id}','TravelsController@show');
Route::get('/eventdinas/view/{id}','DinaseventsController@show');
Route::get('/yourinvoice/view/{bookCode}',array('uses' => 'BooksController@showInvoice','as'=>'showInvoice'));
//show booking by booking code
Route::get('/yourbook/view/{bookCode}', array('uses' => 'YourbooksController@viewBook','as'=>'showBook')); 

//post
Route::POST('check-travel',array('uses'=>'TravelsController@checkLogin','as'=>'login-travel'));
Route::POST('check-availability', array('uses'=>'BooksController@checkAvailability','as'=>'check-available'));
Route::POST('processing-normal',array('uses'=>'BooksController@insertBookNormal','as'=>'processing-normalBook'));
Route::POST('processing-offer',array('uses'=>'BooksController@insertBookOffer','as'=>'processing-offerBook'));
Route::POST('processing-create-view',array('uses'=>'BooksController@createViewBook','as'=>'processing-create-viewBook')); //processing view from /yourbook to /yourbook/view/{bookCode}
Route::POST('processing-cancel',array('uses'=>'BooksController@cancelBook','as'=>'processing-cancelBook')); //processing cancel book
//processing book view from yourbook
Route::POST('processing-create-view',array('uses'=>'YourbooksController@checkBook','as'=>'processing-view-book'));
//send question (faq) email from faq
Route::POST('processing-faq',array('uses'=>'FaqsController@sendQuestion','as'=>'processing-question'));
//send question (cancel book) email from view book
Route::POST('processiong-question', array('uses'=>'YourbooksController@sendEmail','as'=>'processing-ask-question'));
//send question email from about us
Route::POST('processing-contactus',array('uses'=>'AboutusController@sendEmail','as'=>'processing-contact'));
//create  testimonial
Route::POST('processing-feedback',array('uses'=>'TestimonialsController@createFeedback','as'=>'processing-testimonial'));
//register newslleter
Route::POST('processing-newsletter',array('uses'=>'NewslettersController@createNewsletter','as'=>'processing-newsletter-signup'));


//route to backend
Route::get('/backend', function(){
    ob_start();
    require(path('admin/build')."index.php");
    return(ob_get_clean());
});

Route::get("/backend", function(){ 
    return Redirect::to("admin/build/index.php"); 
});
//Route::get('post/listing', array('uses' => 'PostController@listing', 'as' => 'post.listing'));
//Route::get('post/single', array('uses' => 'PostController@single', 'as' => 'post.single'));


//Route::group(array('before'=>'auth'), function(){
//    Route::get('post/listing', array('uses' => 'PostController@listing', 'as' => 'get.post.listing'));
//    Route::get('post/{id}', array('uses' => 'PostController@single', 'as' => 'get.post.single'))->where(array('id' => '[1-9][0-9]*', 'slug' => '[a-zA-Z0-9-_]+'));
//    Route::post('post/{id}', array('uses' => 'PostController@update', 'as' => 'post.post.update'))->where(array('id' => '[1-9][0-9]*'));
//});
/*
Route::group(array('prefix'=>'admin'), function(){
    Route::get('post/listing', array('uses' => 'PostController@listing', 'as' => 'get.post.listing'));
    Route::get('post/{id}', array('uses' => 'PostController@single', 'as' => 'get.post.single'))->where(array('id' => '[1-9][0-9]*', 'slug' => '[a-zA-Z0-9-_]+'));
    Route::post('post/{id}', array('uses' => 'PostController@update', 'as' => 'post.post.update'))->where(array('id' => '[1-9][0-9]*'));
});
Route::get('login', function(){
    return "login page";
});
*/		