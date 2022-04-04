<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ComingSoonResource;
use App\Http\Resources\MovesResource;
use App\Http\Resources\ShowResource;
use App\Http\Resources\SliderResource;
use App\Models\ComingSoon;
use App\Models\Posts;
use App\Models\Slider;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home()
    {
        $moves = Posts::where('rate','>=',7)->where('type','move')->latest()->get();
        $shows = Posts::where('rate','>=',7)->where('type','show')->latest()->get();
        $slider = Slider::latest()->get();
        $soon = ComingSoon::latest()->get();
        return response()->json(['moves'=>MovesResource::collection($moves),
            'shows'=>ShowResource::collection($shows),
            'soon'=>ComingSoonResource::collection($soon),
            'slider'=>SliderResource::collection($slider)
            , 'message' => 'success','code'=>200],200);
    }
}//end class
