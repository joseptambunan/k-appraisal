<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Assets;
use Illuminate\Support\Facades\Validator;
use App\Helper\KAppraisal;

class AssetController extends Controller
{
    public function index(Request $request){
        $errorMessages = array(
            'owner.required' => 'Owner harus diisi',
            'owner.email' => 'Email harus menggunakan format email xxx@xxx.com', 
            'asset_name.required' => 'Asset Name harus diisi',
            'asset_name.max' => 'Maximum 100 Karakter',
            'value.required' => 'Value harus diisi',
            'last_check_at.required' => 'Last Check harus diisi'
        );

        $validator = Validator::make($request->all(), [
            'owner' => 'required|email',
            'asset_name' => 'required|string|max:100',
            'value' => 'required|integer',
            'last_check_at' => 'required|date_format:Y-m-d',
            'added_at' => 'date_format:Y-m-d'
        ], $errorMessages);

        if ($validator->fails()) {
            $data['status'] = false;
            $data['messages'] = $validator->errors();
            return response()->json($data, 400);
        }

        $addedAt = date("Y-m-d");
        if ( $request->added_at){
            $addedAt = $request->added_at;
        }

        $flight = Assets::updateOrCreate(
            ['id' => $request->id],
            ['owner' => $request->owner, 'asset_name' => $request->asset_name, 'value' => $request->value
            , 'days' => KAppraisal::dateDay($addedAt, $request->last_check_at), 'added_at' => $addedAt, 'last_check_at' => date("Y-m-d")]
        );

        $data['status'] = true;
        $data['messages'] = "Success save data";
        return response()->json($data, 200);
    }

    public function management(Request $request){
        $assetData = Assets::orderBy("assets.id", "desc")->paginate(10,["assets.id as id","assets.owner as owner", "assets.asset_name as asset_name"
        , "assets.value as value","assets.days as days", "assets.added_at as added_at", "assets.last_check_at as last_check_at"]);
        
        $assetData->map(function($items) {
            $items->last_check_at = date("d-M-Y", strtotime($items->last_check_at));
            $items->added_at = date("d-M-Y", strtotime($items->added_at));
        });
        return response()->json($assetData->toArray(), 200);
    }

    public function delete (Request $request){
        $deleteData = Assets::find($request->id);
        if ( $deleteData == NUll){
            $data['status'] = false;
            $data['messages'] = "Data not found";
            return response()->json($data, 400);
        }else{
            $deleteData->delete();
            $data['status'] = false;
            $data['messages'] = "Sukses Delete";
            return response()->json($data, 200);
        }
    }
}
