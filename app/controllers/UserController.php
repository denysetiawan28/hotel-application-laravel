<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        /*
        $users = array();
        for($i = 1; $i<4 ;$i++){
            $user = new Stdclass;
            $user->email = "user{$i}@asd.com";
            $user->password = Hash::make("MySecretPassword{$i}");
            $users[] = $user;
        }
        */

		//$users = DB::table('users')->get();
        $users = DB::table('users')->join('posts','users.id','=','posts.user_id')->get();
        //dd(DB::getQueryLog());
        $data = array(
            'email'=>'some11@email.com',
            'password' => Hash::make('somepassword'),
        );
        //DB::table('users')->insert($data);
        DB::table('users')->where('id', 3)->update($data);
        DB::table('users')->where('id', 3)->delete();


        return View::make('user.index',compact('users'));


	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
            //$user = new Stdclass;
            //$user->email = "user@asd.com";
            //$user->password = Hash::make("MySecretPassword");
            $user = DB::table('users')->where('id',$id)->first();
        return View::make('user.show',compact('user'));
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
        $user = User::find($id);
		return View::make('user.edit', compact('user'));
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
        $validator = Validator::make(
            Input::All()
        );
        if($validator->fails()) {
            //dd('validator failed');
            return Redirect::back()->withInput()->withErrors($validator);
        }
		//dd(Input::all());
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
