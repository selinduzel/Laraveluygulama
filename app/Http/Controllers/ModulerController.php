<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ModulerController extends Controller
{
  public function index()
  {
    return view("admin.include.moduler");
  }
}
