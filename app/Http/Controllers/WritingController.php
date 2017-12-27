<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WritingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function write()
    {
        // Begin to write
        return 'Begin to write';
    }
}
