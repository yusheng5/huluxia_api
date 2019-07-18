<?php
/*
 * @abstract Requests
 * @author SaTan 2771717608@qq.com
 * @version 1.0
 */
namespace app\extend;
class Requests
{
    //SSL是否验证
    protected $SSL = false;
    //请求类型
    protected $Method = "GET";
    //是否返回http响应头
    protected $res  = false;
    //请求数据
    protected $param = [];
    //目标地址
    protected $url = "";
    //是否直接打印
    protected $echo = true;
    //请求头
    protected $headers = [];
    public function __construct()
    {
        $this->curl = curl_init();
    }

    /**
     * @param mixed $headers
     */
    public function setHeaders($headers): void
    {
        $this->headers = $headers;
    }
    /**
     * @param bool $echo
     */
    public function setEcho(bool $echo): void
    {
        $this->echo = $echo;
    }
    /**
     * @param string $url
     */
    public function setUrl(string $url): void
    {
        $this->url = $url;
    }
    /**
     * @param array $param
     */
    public function setParam(array $param): void
    {
        $this->param = $param;
    }
    /**
     * @param bool $SSL
     */
    public function setSSL(bool $SSL): void
    {
        $this->SSL = $SSL;
    }
    /**
     * @param bool $res
     */
    public function setRes(bool $res): void
    {
        $this->res = $res;
    }

    /**
     * @param string $Method
     */
    public function setMethod(string $Method): void
    {
        $this->Method = $Method;
    }
    protected function curl():void
    {
        curl_setopt($this->curl,CURLOPT_SSL_VERIFYPEER,$this->SSL);
        curl_setopt($this->curl,CURLOPT_SSL_VERIFYHOST,$this->SSL);
        curl_setopt($this->curl,CURLOPT_URL,$this->url);
        curl_setopt($this->curl,CURLOPT_RETURNTRANSFER,$this->echo);
        if ($this->Method == "GET")
        {
            $this->url = $this->url . "?" . $this->getUrlQuery($this->param);
            curl_setopt($this->curl,CURLOPT_URL,$this->url);
            curl_setopt($this->curl,CURLOPT_POST,false);
        }elseif ($this->Method == "POST")
        {
            curl_setopt($this->curl,CURLOPT_POST,true);
            curl_setopt($this->curl,CURLOPT_POSTFIELDS,$this->param);
        }
        curl_setopt($this->curl,CURLOPT_HTTPHEADER,$this->headers);
        curl_setopt($this->curl,CURLOPT_HEADER,$this->res);
        curl_setopt($this->curl,CURLINFO_HEADER_OUT,true);
//        curl_setopt($this->curl,CURLOPT_NOBODY,true);
    }
    private function getUrlQuery($array_query)
    {
        $tmp = array();
        foreach($array_query as $k=>$param)
        {
            $tmp[] = $k.'='.$param;
        }
        $params = implode('&',$tmp);
        return $params;
    }
    private function curl_Run()
    {
        $data = curl_exec($this->curl);
        if (curl_errno($this->curl))
        {
            return curl_error($this->curl);
        }
        if ($this->res)
        {
            $head = substr($data,0,strpos($data,"{"));
            $head = explode("\r\n",$head);
            $heads = [];
            foreach ($head as $item)
            {
                if (empty($item))
                {
                    unset($item);
                    break;
                }
                if (!strstr($item,":")){

                    $heads[] = $item;
                }else{
                    $heads[substr($item,0,strpos($item,":"))] = substr($item,strpos($item,":")+1);
                }
            }
            $body = "{" .substr($data,strpos($data,"{")+1);
            $data =[
                'HTTP'=>$heads,
                "BODY"=>json_decode( $body,true)
            ];
        }
        return $data;
    }
    public function Run()
    {
    $this->curl();
    return $this->curl_Run();
    }
    public function __destruct()
    {
        curl_close($this->curl);
    }
}