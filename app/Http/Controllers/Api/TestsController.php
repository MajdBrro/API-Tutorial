<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Traits\GeneralTrait;
use Illuminate\Http\Request;
class TestsController extends Controller
{

    public function htmll(){
        return view('welcomeeee');
    }
}
