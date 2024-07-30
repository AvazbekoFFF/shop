<?php

namespace App\Http\Controllers;

use App\Http\Resources\Good\GoodResource;
use App\Models\Good;
use Illuminate\Http\Request;

class GoodController extends Controller
{
    public function index(){
        $goods = Good::with(['characteristics', 'stocks'])->get();
        return GoodResource::collection($goods);
    }
}
