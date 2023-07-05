<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $pengumumanLatest = Pengumuman::latest('idPengumuman')->first();

        return view('pages.home.index', [
            'title' => 'Home',
            'pengumuman' => Pengumuman::orderBy('idPengumuman', 'desc')->get(),
            'pengumumanLatest' => $pengumumanLatest,
        ]);
    }
}
