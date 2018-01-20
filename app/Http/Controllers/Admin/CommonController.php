<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommonController extends Controller
{
    //图片上传操作
    public function upload(Request $request)
    {
		if ($request->isMethod('post')) {

			$file = $request->file('Filedata');

			// // 文件是否上传成功
			if ($file->isValid()) {
			 	$realPath = $file->getRealPath(); //临时文件的绝对路径
			 	$extension = $file->getClientOriginalExtension(); //上传文件的后缀

			 	// 上传目录。 public目录下 uploads/thumb 文件夹
    			//$dir = 'uploads/thumb/';
    			$dir = base_path().'/public/uploads/thumb/';

			 	$newName = date('YmdHis') . mt_rand(100, 999) . '.' . $extension;
			 	$path = $file->move($dir, $newName);

			 	$filePath = '/uploads/thumb/'.$newName;
			 	return $filePath;
			}
		}
    }
}
