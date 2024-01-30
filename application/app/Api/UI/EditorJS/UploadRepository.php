<?php

namespace App\Api\UI\EditorJS;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Intervention\Image\ImageManagerStatic as Image;

class UploadRepository
{

    function ImageVideo(){
        Image::configure(['driver' => 'imagick']);
        $request = request();
        $validator = Validator::make(
            $request->all(),
            [
                'image' => 'required|mimes:jpeg,webp,png,jpg,gif,svg,avi,mp4,mov|max:50000',
            ]
        );


        //  Log::warning("upload to server2",$_FILES);

        if ($validator->fails()) {

            return array('error' => 1, 'message' => $validator->messages()->first());
        }
        $image = $request->image;
        $mimetype = $image->getClientMimeType();
        //Log::error("mimetype upload file " . $mimetype);
        //Log:error("before upload test",["file"=>$request->file]);
        $type_file="image";
        if (Str::contains($mimetype, "video") == true) {
            $fileName = time() . \Illuminate\Support\Str::random(20) . 'video_.' . request()->image->getClientOriginalExtension();
            $type_file="video";

            $request->image->storeAs('editor', $fileName, 'public');
            $folder_type = "images";
            $web_url = URL::to("/" . $folder_type . "/editor/" . $fileName);;

            //
            return array('success' => 1, 'file' => array('url' => URL::to($web_url)));
        } else {
            $fileName = time()  . \Illuminate\Support\Str::random(20) . '.' . request()->image->getClientOriginalExtension();
            $img = Image::make($image->path());
            $width_img = $img->width();
            $height_img = $img->height();

            if ($width_img > 1300 and $width_img > $height_img) {
                $img->resize(1200, null, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                });
            } else if ($height_img > 1300 and $width_img < $height_img) {
                $img->resize(null, 1200, function ($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();

                });
            }
            $img->orientate();
            $folder_type = 'images';

            // Storage::disk('public')->put($fileName,$request->image,'public');
            //Storage::putFile('images',$request->image,'public');
            $destinationPath = public_path('/images/editor');
            $img->save(public_path('images/editor/' . $fileName));
            //  $img->move($destinationPath, $fileName);
            // $request->image->storeAs('editor',$fileName,'public');
            $web_url = "/" . $folder_type . "/editor/" . $fileName;;
            return array('success' => 1, 'file' => array('url' => URL::to($web_url)));
        }
    }

}
