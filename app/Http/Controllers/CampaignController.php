<?php

namespace App\Http\Controllers;

use App\Campaign;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function random($count){
        
        $campaigns = Campaign::select('*')
                    ->inRandomOrder()
                    ->limit($count)
                    ->get();
        
        $data['campaigns'] = $campaigns;

        return response()->json([
            'response_code' => '00',
            'response_message' => 'data campaign berhasil ditampilkan',
            'data' => $data
        ], 200);


    }

    public function store(Request $request){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'mimes:jpg,jpeg,png'
        ]);

        $campaign = Campaign::create([
            'title' => $request->title,
            'description' => $request->description
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_extention = $image->getClientOriginalExtension();
            $image_name = $campaign->id . "." . $image_extention;
            $image_folder = '/photos/campaign/';
            $image_location = $image_folder.$image_name;

            try{
                $image->move(public_path($image_folder), $image_name);

                $campaign->update([
                    'image' => $image_location
                    ]);
                $data['campaign']= $campaign;

            }catch(\Exception $e){
                return response()->json([
                    'response_code' => '01',
                    'response_message' => 'Photo Profil Gagal Upload',
                    'data' => $data
                ], 200);
            }

            return response()->json([
                'response_code' => '00',
                'response_message' => 'Data Campaign Berhasil Ditambahkan',
                'data' => $data
            ], 200);
            

        }
    }
}

