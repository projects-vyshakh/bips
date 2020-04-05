<?php

namespace App\Traits;

use App\Http\Controllers\Controller;
use App\Models\Media;
use App\Models\MediaSettings;
use App\Models\RolesScreen;
use App\Models\Screens;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Webpatser\Uuid\Uuid;


trait FileUploadTraits{
    use RolesAndPermissionScreens;
    public function addFiles($request){

        $mediaSettings  =   MediaSettings::get();

        $files      =   $_FILES['files'];
        $mediaUuid  =   Uuid::generate()->string;
        $idUser     =   Auth::user()->id;
        $userUuid   =   Auth::user()->uuid;
        $mediaType  =   "";
        $basePath   =   "";
        $idSettings =   "";

        $filename   =   $files['name'];
        $fileExt    =   pathinfo($filename, PATHINFO_EXTENSION);
        $filename   =   pathinfo($filename, PATHINFO_FILENAME);



        if(!empty($mediaSettings)){

            foreach($mediaSettings as $settings){
                $supportedExtenion  =   json_decode($settings['supported_extension']);


                if(in_array($fileExt, $supportedExtenion)){

                    $idSettings =   $settings['id'];
                    $mediaType  =   $settings['media_type'];
                    $basePath   =   $settings['base_path'];



                }

            }



        }





        if(!empty($mediaType) && !empty($basePath) && !empty($idSettings)){

            $targetDir  =   $basePath.$mediaType."/".$userUuid."/";
            $targetFile =   $targetDir . basename( $files['name']);

            $mediaExists =   Media::where('filename',$filename)->where('user_uuid',$userUuid)->where('bucket_name',$mediaType)->first();

            //dd($mediaExists['media_uuid']);
            if(!empty($mediaExists)){
                $dataArray  =   [
                    'settings_id'   =>  $idSettings,
                    'user_id'       =>  $idUser,
                    'user_uuid'     =>  $userUuid,
                    'media_name'    =>  $filename,
                    'bucket_name'   =>  $mediaType,
                    'filename'      =>  $filename,
                    'extension'     =>  $fileExt,
                    'updated_at'    =>  date('Y-m-d H:i:s'),
                ];

                if(Media::where('media_uuid',$mediaExists['media_uuid'])->update($dataArray)){
                    $response = $this->uploads($targetDir, $targetFile, $files);
                    return $response;
                }
            }
            else{
                $dataArray  =   [
                    'settings_id'   =>  $idSettings,
                    'media_uuid'    =>  $mediaUuid,
                    'user_id'       =>  $idUser,
                    'user_uuid'     =>  $userUuid,
                    'media_name'    =>  $filename,
                    'bucket_name'   =>  $mediaType,
                    'filename'      =>  $filename,
                    'extension'     =>  $fileExt,
                    'shared'        =>  "No",
                    'status'        =>  "Active",
                    'created_at'    =>  date('Y-m-d H:i:s'),
                    'updated_at'    =>  date('Y-m-d H:i:s'),
                ];
            }


            if(Media::insert($dataArray)){
                $response = $this->uploads($targetDir, $targetFile, $files);
                return $response;
            }

        }






    }

    public function uploads($targetDir, $targetFile, $files){


        if(!file_exists($targetDir)){
            mkdir($targetDir, 0777, true);
        }

        //dd($files['size']);


        // Check file size
        if ($files["size"] <= 500000) {

            if (move_uploaded_file($files["tmp_name"], $targetFile)) {
                return ['status'=>'success','message'=>'File uploaded successfully.'];
            } else {
                return ['status'=>'error','message'=>'There was an error in uploading file.'];
            }
        }
        else{

            return ['status'=>'error','message'=>'File size is larger.'];

        }
    }


}
