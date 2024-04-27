<?php

namespace App\Models\Repositories;

use App\Models\Album;
use App\Models\Picture;

class DashboardRepository
{
 public function index(){
    $count_albums = Album::orderBy('id', 'DESC')->count();
    $count_picts = Picture::orderBy('id', 'DESC')->count();
    $albums = Album::orderBy('id', 'DESC')->take(5)->get();
    $picts = Picture::orderBy('id', 'DESC')->take(5)->get();
    return[
        'count_albums' => $count_albums,
        'count_picts'  => $count_picts,
        'albums'       => $albums,
        'picts'        => $picts,
    ];
 }
}
