<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Moduler;

class AdminYonetim extends Controller
{
    function __construct()
    {
        return view()->share('moduler', Moduler::whereDurum(1)->get());
    }
    public function home()
    {
        return view('admin.include.home');
    }
}
