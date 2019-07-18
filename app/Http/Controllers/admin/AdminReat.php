<?php


namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBlogPost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use app\extend\Gourd;
class AdminReat extends Controller
{
    protected $hulu;
    public function init()
    {
        if (session()->has("key")){
        $key = session()->get('key');
        $this->hulu = new Gourd($key[0]);
        }
    }

    public function index()
    {
        $this->init();
        if (!session()->has("key"))
        {
            return $this->error("错误!未登录",url("index"),'301');
        }

        $user_info = $this->hulu->user_info();
//        dump($user_info);

        return view("admin/index",['user'=>$user_info]);
    }
    public function post_show(Request $request)
    {
        if (!session()->has("key"))
        {
            return $this->error("错误!未登录",url("index"),'301');
        }
        $this->init();
        $list = $this->hulu->PostList(100000000);
        if ($request->get("page") == null || !preg_match("/^[1-9][0-9]*$/",$request->get("page"))){
            $i = 0;
            foreach ($list['posts'] as $item) {
                if ($i >10)
                {
                    unset($list['posts'][$i]);
                }
                $i++;
            }
            return view('admin/post',['post'=>$list['posts'],'items'=>10]);
        }else{
            $is =$request->get('page'); //10
            for ($i = 0 ;$i<10;$i++)
            {
                if (isset($list['posts'][$is+$i])){
                $data[] = $list['posts'][$is+$i];
                }
            }
            return view('admin/post',['post'=>$data,'items'=>$request->get('page')+10]);
        }
    }
    public function post_new(Request $request)
    {
        if (!session()->has("key"))
        {
            return $this->error("错误!未登录",url("index"),'301');
        }
        $this->init();
        $data =$this->hulu->is_user_id($request->get("id"));
        if ($data['msg'] == "话题不存在")
        {
            return $this->error("帖子不存在",url('/index'),'302');
        }
        $urls =$this->hulu->post_rep();
        return view("admin/post_new",['data'=>$data,'urls'=>$urls,'pages'=>$request->get('id')+1,'page'=>$request->get('id')-1]);
    }
    public function post_huifu(Request $request)
    {
        if (!session()->has("key"))
        {
            return $this->error("错误!未登录",url("index"),'301');
        }
        $this->init();
        $data=$this->hulu->post_rep($request->post('comment_id'),$request->post('post_id'),$request->post('text'));
        return response()->json($data);
    }
    public function reply_ren(Request $request)
    {
        if (!session()->has("key"))
        {
            return $this->error("错误!未登录",url("index"),'301');
        }
        $this->init();
        $urls =$this->hulu->post_rep();
        if ($request->get('user')){
        $data = $this->hulu->reply_ren();
            return view('admin/reply_ren',['data'=>$data,'status'=>1,'urls'=>$urls]);
        }elseif($request->get('system')){
            $data = $this->hulu->reply_sys();
            return view('admin/reply_ren',['data'=>$data,'status'=>0,'urls'=>$urls]);
        }else{
            $data = $this->hulu->reply_ren();
            return view('admin/reply_ren',['data'=>$data,'status'=>1,'urls'=>$urls]);
        }
    }
    public function user()
    {
        $this->init();
        $res = $this->hulu->test();
        dump($res);
    }
}