<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IntegrationController extends Controller
{
    public function index()
    {
        // Your code for the "integrations" page goes here
        return view('integration.index');
    }
}
