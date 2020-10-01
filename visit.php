<?php 
ignore_user_abort(true);
error_reporting(0);
set_time_limit(0);

function file_getcontent_with_proxy($urltoget) {
    $url = $urltoget;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // read more about HTTPS 
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; Android 10; IN2011 Build/QKQ1.191222.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.89 Mobile Safari/537.36 GSA/11.20.15.21.arm64');
    $curl_scraped_page = curl_exec($ch);
    $httpcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);
    file_put_contents("php://stderr", "$httpcode $url\n");
    return $curl_scraped_page;
}


$urls = array (
  array("adowsom blg","http://adowsom.000webhostapp.com"),
  array("agutermiyohu blg","http://agutermiyohu.000webhostapp.com/index.php?cron=cron"),
);
$st = count($urls);
//echo "Start ht";
while ( 1 ){
    $dt = 0;
    foreach($urls as $key=>$val){
        $name = $val[0];
        $url = $val[1];
        $res = file_getcontent_with_proxy($url);
        if($res){
        $dt += 1;
        }else{
        file_put_contents("php://stderr", "Name: $name error\n");
        }
    }
    //echo "sleeping<br>";
    file_put_contents("php://stderr", "Tot:$st - Succes:$dt\n");
    sleep(60);
}
?>
