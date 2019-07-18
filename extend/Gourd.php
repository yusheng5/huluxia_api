<?php
namespace app\extend;
use http\Env;

class Gourd
{
    protected $data;
    protected $url_conf;
    protected $cat_id;
    public $status;

    public function __construct(string $_key = '')
    {
        $this->initData($_key);
        $this->SetUrlConfig();
    }

    public function SetUrlConfig(): void
    {
        $this->url_conf = [
            'GET' => [
                '活动' => "http://floor.huluxia.com/activity/list/ANDROID/2.1",
                "用户登录状态" => "http://floor.huluxia.com/user/status/ANDROID/2.1",
                "退出登录" => "http://floor.huluxia.com/user/exit/ANDROID/2.0",
                "板块" => "http://floor.huluxia.com/category/list/ANDROID/2.0",
                "用户信息" => "http://floor.huluxia.com/user/info/ANDROID/2.1",
                '首页游戏推荐' => 'http://tools.huluxia.com/bbs/recommend/ANDROID/3.6',
                '搜索建议' => "http://tools.huluxia.com/search/suggest/ANDROID/3.6",
                '版本更新检测' => 'http://version.huluxia.com/new/version/ANDROID/1.0',
                '用户主题背景' => 'http://floor.huluxia.com/glorify/used/new/ANDROID/2.2',
                '用户主题列表' => 'http://floor.huluxia.com/glorify/list/ANDROID/2.1',
                '帖子列表' => 'http://floor.huluxia.com/post/list/ANDROID/2.1',
                '板块列表' => 'http://floor.huluxia.com/category/forum/list/ANDROID/2.0',
                '板块查询' => 'http://floor.huluxia.com/category/forum/list/all/ANDROID/2.0',
                '空间背景' => 'http://floor.huluxia.com/space/list/ANDROID/2.1',
                '帖子详情' => 'http://floor.huluxia.com/post/detail/ANDROID/2.1',
                '搜索用户' => 'http://floor.huluxia.com/post/search/ANDROID/2.2',
                '签到' => 'http://floor.huluxia.com/user/signin/ANDROID/2.1',
                '达人堂' => 'http://floor.huluxia.com/daren/list/ANDROID/2.0',
            ],
            'POST' => [
                "邮箱登录" => "http://floor.huluxia.com/account/login/ANDRIOD/2.1",
            ]
        ];
        $data = $this->GET("http://floor.huluxia.com/category/list/ANDROID/2.0?platform=2&gkey=410000&app_version=3.5.0.92.2&versioncode=20141410&market_id=floor_360&device_code=%5Bw%5D02%3A00%3A00%3A00%3A00%3A00-%5Bi%5D863098036445021-%5Bs%5D89860118801461857337", [], false);
        $data = $data['categories'];
        $i = 1;
        unset($data[0]);
        unset($data[1]);
        foreach ($data as $datum) {
            $list[$i] = [$datum['title'] => $datum['categoryID']];
            $i++;
        }
        $this->cat_id = $list;
        unset($data);
        $data = $this->GET($this->url_conf['GET']['用户登录状态'], $this->data, false);
        $this->status = $data;
        unset($data);
    }

    public function initData(string $_key): void
    {
        $data = [
            'platform' => '2',
            'gkey' => '000000',
            'app_version' => "3.5.0.92.2",
            'versioncode' => '20141410',
            'market_id' => 'floor_360',
            'device_code' => '%5Bw%5D02%3A00%3A00%3A00%3A00%3A00-%5Bi%5D863098036445021-%5Bs%5D89860118801461857337',
            '_key' => $_key
        ];
        $this->data = $data;
    }

    public function user_info_list($user_id)
    {
        $this->data['start'] = "0";
        $this->data['count'] = "40";
        $this->data['user_id'] = $user_id;
        $data = $this->GET("http://floor.huluxia.com/post/create/list/ANDROID/2.0", $this->data, false);
        $data = $data['posts'];
        $i = 0;
        foreach ($data as $datum) {
            $datas = substr($datum['createTime'], 0, -3);
            if (date("Y-m-d", $datas) == date("Y-m-d", time())) {
                $i++;
            }
        }
        unset($this->data['start'], $this->data['count'], $this->data['user_id']);
        return $i;
    }

    public function Pubfunc()
    {
        $this->data['post_id'] = 39751440;
        $this->data['page_no'] = 1;
        $this->data['page_size'] = 999;
        $this->data['doc'] = 1;
        $data = $this->GET("http://floor.huluxia.com/post/detail/ANDROID/2.3", $this->data, false)['comments'];
        $datas = [];
        $i = 0;
        foreach ($data as $datum) {
            $data = substr($datum['createTime'], 0, -3);
            if (date("Y-m-d", $data) == date("Y-m-d", time())) {
                $datas[$i]['name'] = $datum['user']['nick'];
                $datas[$i]['jin'] = $this->user_info_list($datum['user']['userID']);
                $datas[$i]['time'] = date("Y-m-d", time());
                $datas[$i]['login'] = "已签到";
                $i++;
            }
        }
        return $datas;
    }

    public function SignIn()
    {
        if (empty($this->data['_key'])) {
            return "没有登录";
        }
        $result = [];
        foreach ($this->cat_id as $item) {
            foreach ($item as $value) {
                $this->data['cat_id'] = $value;
                $result[] = $this->GET($this->url_conf['GET']['签到'], $this->data, false);
            }
        }
        return $result;
    }

    public function user_info()
    {
        $this->data['user_id'] = $_SERVER['HuLuXia_user_id'];
        $url = "http://floor.huluxia.com/user/info/ANDROID/2.1";
        $result = $this->GET($url, $this->data, false);
        unset($this->data['user_id']);
        return $result;
    }
    public function test()
    {
        $this->SignIn();
        $data['_key'] = $this->data['_key'] ;
        $url = "http://floor.huluxia.com/user/info/ANDROID/2.1";
        $result = $this->GET($url,$this->data,false);
        return $result;
    }
    public function PostList($count)
    {
        $this->data['user_id'] = $_SERVER['HuLuXia_user_id'];
        $this->data['count'] = $count;
        $url = "http://floor.huluxia.com/post/create/list/ANDROID/2.0";
        $result = $this->GET($url, $this->data, false);
        unset($this->data['user_id'], $this->data['count']);
        return $result;
    }

    /*
     * 发送帖子
     * @param int $cat_id 板块id
     * @param int $tag_id 为cat_id+01,02,,,,如不存在将返回全部
     * @param string $title 帖子主题
     * @param string $detail 帖子内容
     */
    public function Posting(int $cat_id, int $tag_id, string $title, $lng = "113.8886", $lat = "35.265557", array $images, $user_ids = "", $recommendTopics = "")
    {
        $data['cat_id'] = $cat_id;
        $data['tag_id'] = $tag_id;
        $data['title'] = $title;
        $data['lng'] = $lng;
        $data['lat'] = $lat;
        $str = "";
        foreach ($images as $image) {
            $str .= $image . "%2C";
        }
        $data['images'] = $str;
        $data['user_ids'] = $user_ids;
        $data['$recommendTopics'] = $user_ids;
        $url_s = "?";
        foreach ($this->data as $datum) {
            $url_s .= $datum . "&";
        }
        $url = "http://floor.huluxia.com/post/create/ANDROID/2.0?" . $url_s;
        $result = $this->POST($url, $data);
        return $result;
    }

    public function post_rep()
    {
        $url = $this->GET("http://floor.huluxia.com/comment/create/ANDROID/2.0", $this->data, true);
        $data = ['url' => $url];
        return $data;
    }

    public function reply_ren()
    {
        $this->data['type_id'] = 2;
        $this->data['start'] = 0;
        $this->data['count'] = 20;
        $url = "http://floor.huluxia.com/message/new/list/ANDROID/2.1";
        $result = $this->GET($url,$this->data,false);
        unset($this->data['type_id'], $this->data['start'],$this->data['count']);
        return $result;
    }
    public function reply_sys()
    {
        $this->data['type_id'] = 1;
        $this->data['start'] = 0;
        $this->data['count'] = 20;
        $url = "http://floor.huluxia.com/message/new/list/ANDROID/2.1";
        $result = $this->GET($url,$this->data,false);
        unset($this->data['type_id'], $this->data['start'],$this->data['count']);
        return $result;
    }
    public function is_user_id(int $id)
    {
        $this->data['post_id'] = $id;
        $this->data['page_size'] = 9999;
        $this->data['page_no'] = 1;
        $this->data['doc'] = 1;
        $url = "http://floor.huluxia.com/post/detail/ANDROID/2.1";
        $this->data['count'] = 99999;
        $result = $this->GET($url,$this->data,false);
        unset( $this->data['count'],$this->data['post_id'], $this->data['page_size'] );
        return $result;
    }
    public function PlateList()
    {
        $data = [];
        foreach ($this->cat_id as $item => $value) {
            $data[] = $value;
        }
        return $data;
    }
    public function activity()
    {
        $url = $this->url_conf['GET']['活动'];
        $data = $this->GET($url,$this->data,false);
        return $data;
    }
    private function GET(string $url,array $data,bool $s)
    {
        $url = $url . "?" .$this->getUrlQuery($data);
        if ($s){
            return $url;
        }
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        if (curl_errno($ch)){
            return curl_strerror(curl_errno($ch));
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data,true);
    }
    private function POST(string $url,array $data)
    {
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        if (curl_errno($ch)){
            return curl_strerror(curl_errno($ch));
        }
        $data = curl_exec($ch);
        curl_close($ch);
        return json_decode($data,true);
    }
    private function getUrlQuery($array_query)
    {
        $tmp = array();
        foreach($array_query as $k=> $param)
        {
            $tmp[] = $k.'='.$param;
        }
        $params = implode('&',$tmp);
        return $params;
    }
}