<?php

namespace App\Http\Controllers;

use App\Models\Insurance;
use App\Models\User;
use Illuminate\Http\Request;

class RelationController extends Controller
{
    public function oneToOne()
    {
        
        // $insurance = Insurance::with('user')->get();
        $insurance = Insurance::all();
        return view('relations.one-to-one', compact('insurance'));
    }
}
