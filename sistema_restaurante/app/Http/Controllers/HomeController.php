<?php

namespace App\Http\Controllers;

use App\Models\Amenity;
use App\Models\Faq;
use App\Models\Gallery;
use App\Models\Price;
use App\Models\Schedule;
use App\Models\Setting;
use App\Models\Speaker;
use App\Models\Sponsor;
use App\Models\Venue;
USE App\Models\Iasd;
class HomeController extends Controller
{
   
    public function index()
    {



            return view('auth.login');

    }

   
}
