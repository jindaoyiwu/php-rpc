# php-rpc


先创建常驻进程（php RpcServer.php）
然后创建对象，指向相应的方法即可，如：
$cli = new RpcClient('http://127.0.0.1:8888/test');
echo $cli->tuzisir1()."\n";
echo $cli->tuzisir2(array('name' => 'tuzisir', 'age' => 23));

test是类名和文件名
