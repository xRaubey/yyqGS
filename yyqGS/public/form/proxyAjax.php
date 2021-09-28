<?php
/**
 * Created by PhpStorm.
 * User: yuqingyang
 * Date: 4/14/21
 * Time: 9:48 PM
 */

/**
 * Calling ajax using PHP.
 */

 $url = $_GET['url'];
 
 function curlPost($url,$data,$method){
	//$data = http_build_query($data,'','&');
    $ch = curl_init();   //1.初始化
    curl_setopt($ch, CURLOPT_URL, $url); //2.请求地址
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);//3.请求方式
    //4.参数如下
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);//https
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)');//模拟浏览器
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_AUTOREFERER, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER,array('Accept-Encoding: gzip, deflate'));//gzip解压内容
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip,deflate');

    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $tmpInfo = curl_exec($ch);//6.执行

    if (curl_errno($ch)) {//7.如果出错
        return curl_error($ch);
    }
    curl_close($ch);//8.关闭
    return $tmpInfo;
}

 
if($_SERVER['REQUEST_METHOD']=='GET'){
    echo file_get_contents($url);
}
elseif($_SERVER['REQUEST_METHOD']=='POST'){
    //$data = file_get_contents("php://input"); //json data
	$data = $_POST;
		$data = json_encode($data);
	$method="POST";
	$result=curlPost($url,$data,$method);
	//$file=mb_convert_encoding($file,'UTF-8','GBK');
	echo $data."+".$result;
}