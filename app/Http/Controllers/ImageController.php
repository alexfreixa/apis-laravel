<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $images = Image::latest()->get();    
        return [
            "status" => 1,
            "data" => $images,
            "origin" => $request->getSchemeAndHttpHost(),
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */
    public function show(Image $image, Request $request)
    {
        return [
            "status" => 1,
            "data" => $image,
            "origin" => $request->getSchemeAndHttpHost(),
        ];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Image  $image
     * @return \Illuminate\Http\Response
     */

        public function destroy($id)
        {
            $image = Image::find($id);
            $image->delete();

            $image_name = $image->image_name;

            $image_path = public_path('public/media/images/') . $image_name;
            if (file_exists($image_path)) {
                unlink($image_path);
            }

            return [
                "status" => 1,
                "data" => $image,
                "msg" => "Imatge eliminada correctament."
            ];

        }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image_file' => 'nullable|image|max:10000'
        ]);

        $image = new Image();

        if ($request->hasFile('image_file')) {
            $imatgeArxiu = $request->file('image_file');
            $nomArxiu = time() . '_' . $imatgeArxiu->getClientOriginalName();
            $imatgeArxiu->move(public_path('/public/media/images/'), $nomArxiu);
            $image->image_file = 'public/media/images/' . $nomArxiu;
            $image->image_name = $nomArxiu;
        }

        $image->save();

        return [
            "status" => 1,
            "data" => $image,
            "image_id" => $image->id,
            "hasFile" => $request->hasFile('image_file')
        ];
    }

}
