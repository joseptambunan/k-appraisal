<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assets;

class HomeController extends Controller
{
    public function index(){
        $data = Assets::orderBy("id","desc")->get();
        return view ("welcome",compact("data"));
    }

    public function search(Request $request){
        $assetName = $request->assetSearch;
        $owner = $request->ownerSearch;
        $data = Assets::where("owner","like", "%".$owner."%")->where("asset_name","like", "%".$assetName."%")->get();
        return view ("search",compact("data"));
    }
}
