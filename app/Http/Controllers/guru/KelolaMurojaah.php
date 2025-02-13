<?php

namespace App\Http\Controllers\guru;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class KelolaMurojaah extends Controller
{
  public function index()
  {
    // Kirim data ke view
    return view('guru.kelola-murojaah');
  }
}
