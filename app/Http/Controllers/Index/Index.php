<?php


namespace App\Http\Controllers\Index;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use app\extend\Gourd;
class Index extends Controller
{
    private function getNeedBetween($input, $start, $end) {
        $result = strstr($input,$end,true);
        $result1 = strstr($result,$start);
        $result2 = substr($result1,5);
        return $result2;
    }

    public function index()
    {
        if (session()->has("key"))
        {
            return  $this->success("您已登录,稍后将跳转到后台主页",url('admin/index'));
        }
        return view('index/login');
    }
    public function login(Request $request)
    {
        if ($request->method() != "POST")
        {
            return "error";
        }
        $key =$this->getNeedBetween($request->post("key"),'_key=','&dev');
        if (!$this->getstatus($key))
        {
            return $this->error("key错误",url('index'),'302');
        }
        $data =[
            "user"=>$request->post("user/index"),
            "password"=>md5($request->post("password") . "satan")
        ];
        $result = DB::table("admin")->where($data)->get()->values();
        $result = json_decode($result,true);
        if (!empty($result))
        {
            return $this->error("密码或账号错误",url("index"),'302');
        }
        $request->session()->push("key",$key);
        return $this->success("登录成功!稍后跳转到主页",url("admin/index"));
    }
    protected function getstatus(string $key)
    {

        $http = new Gourd($key);
        if ($http->status['msg'] == "未登录")
        {
            return false;
        }else{
            return true;
        }
    }
}