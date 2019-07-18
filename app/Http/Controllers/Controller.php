<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function error($msg,$url = APP_URL_REF,$code)
    {
        $data =[
            "url"=>$url,
            "msg"=>$msg,
            "title"=>$msg,
            "link"=>$url,
            "code"=>$code,
        ];
        return view("error",["error"=>$data]);
    }
    public function success($msg,$url)
    {
        return view('success',['title'=>$msg,"msg"=>$msg,"url"=>$url]);
    }
}
