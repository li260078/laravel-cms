<?php

namespace App\Http\Controllers\Util;

use App\Exceptions\UploadException;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
   public function uoloader(Request $request){
          //dd(1);
      $file= $request->file('file');

       $this->checkSize($file);
       $this->checkType($file);
       if ($file){
           $path = $file->store('attachment','attachment');
           auth()->user()->attachment()->create([
              'name'=>$file->getClientOriginalName(),
              'path'=>url($path)
           ]);

       }
       return ['file' =>url($path), 'code' => 0];

   }
   private function checkSize($file){
       if ($file->getSize() > 2000000){
            throw new UploadException('上传图片过大');
       }
   }
    private function checkType($file){
       if (!in_array(strtolower($file->getClientOriginalExtension()),['jpg'] )){
           throw new UploadException('图片格式不容许');
       }
    }

   public function filesLists(){
        $files=auth()->user()->attachment()->paginate(1);
        $data=[];
        foreach ($files as $file){
            $data[]=[
              'url'=>$file['path'],
              'path'=>$file['path']
            ];
        }
        return [
          'data'=>$data,
          'page' =>$files->links().'' ,
          'code'=>0
        ];
   }



}
