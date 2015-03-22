<?php
/**
 * Created by PhpStorm.
 * User: denyst
 * Date: 12/13/2014
 * Time: 9:24 PM
 */

class PostController extends BaseController
{
    public function listing() {
        return View::make('post.listing');
    }

    public function single($id){
        return View::make('post.single')->with('id',$id);
    }
    public function update($id){
        dd($_POST);
    }
} 