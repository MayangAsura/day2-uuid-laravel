<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Blog;

class BlogController extends Controller
{
    public function random($count){
        $blogs = Blog::select('*')
                ->inRandomOrder()
                ->limit($count)
                ->get();

        $data['blogs'] = $blogs;

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

        $blog = Blog::create([
            'title' => $request->title,
            'description' => $request->description,
        ]);

        if($request->hasFile('image')){
            $image = $request->file('image');
            $image_extention = $image->getClientOriginalExtension();
            $image_name = $blog->id . "." . $image_extention;
            $image_folder = '/photos/blog/';
            $image_location = $image_folder.$image_name;

            try{
                $image->move(public_path($image_folder), $image_name);

                $blog->update([
                    'image' => $image_location
                    ]);
                $data['blog']= $blog;

            }catch(\Exception $e){
                return response()->json([
                    'response_code' => '01',
                    'response_message' => 'Photo Blog Gagal Upload',
                    'data' => $data
                ], 200);
            }

            return response()->json([
                'response_code' => '00',
                'response_message' => 'Data Blog Berhasil Ditambahkan',
                'data' => $data
            ], 200);
            

        }
    }
}
