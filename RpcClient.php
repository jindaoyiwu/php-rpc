<?php
/**
 * Created by PhpStorm.
 * User: chengyuanzhao
 * Date: 2019/6/16
 * Time: 20:29
 */

class RpcClient {

    private $url_info = array();

    /**
     * RpcClient constructor.
     */
    public function __construct($url)
    {
        $this->url_info = parse_url($url);
    }


    public function __call($name, $arguments)
    {
        // TODO: Implement __call() method.
        //创建一个客户端
        $client = stream_socket_client("tcp://{$this->url_info['host']}:{$this->url_info['port']}", $errno, $errstr);
        if (!$client) {
            exit("{$errno} : {$errstr} \n");
        }
        $data = [
            'class'  => basename($this->url_info['path']),
            'method' => $name,
            'params' => $arguments
        ];
        //向服务端发送我们自定义的协议数据
        fwrite($client, json_encode($data));
        //读取服务端传来的数据
        $data = fread($client, 2048);
        //关闭客户端
        fclose($client);
        return $data;
    }
}
$cli = new RpcClient('http://127.0.0.1:8888/test');
echo $cli->tuzisir1()."\n";
echo $cli->tuzisir2(array('name' => 'tuzisir', 'age' => 23));