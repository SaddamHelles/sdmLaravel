<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Site2Controller extends Controller
{
    public function index()
    {
        $fname = 'Saddam';
        $lname = 'Hilles';
        $arrayData = array('fname' => 'Saeed', 'lname' => 'Ali', 'age' => 31);

        $contentDetails = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.';
        $protfoliosData = array(
            [
                'id' => '1', 'title' => 'LOG CABIN', 'image' => 'cabin.png', 'content' => $contentDetails
            ],
            [
                'id' => '2', 'title' => 'TASTY CAKE', 'image' => 'cake.png', 'content' => $contentDetails
            ],
            [
                'id' => '3', 'title' => 'CIRCUS TENT', 'image' => 'circus.png', 'content' => $contentDetails
            ],
            [
                'id' => '4', 'title' => 'CONTROLLER', 'image' => 'game.png', 'content' => $contentDetails
            ]
        );
        // return view('site2.index')->with('fname', $fname)->with('lname', $lname);
        return view('site2.index', compact('arrayData', 'protfoliosData'));
    }
    public function portfolio()
    {

        return view('site2.portfolio');
    }
    public function about()
    {
        $desc = 'About-Page';
        return view('site2.about')->with('desc', $desc);
    }
    public function contact()
    {
        return view('site2.contact');
    }
}
