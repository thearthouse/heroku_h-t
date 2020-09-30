<?php 
//ignore_user_abort(true);
error_reporting(0);
set_time_limit(0);

function file_getcontent_with_proxy($urltoget) {
    $url = $urltoget;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // read more about HTTPS 
    curl_setopt($ch, CURLOPT_USERAGENT,'Mozilla/5.0 (Linux; Android 10; IN2011 Build/QKQ1.191222.002; wv) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/84.0.4147.89 Mobile Safari/537.36 GSA/11.20.15.21.arm64');
    $curl_scraped_page = curl_exec($ch);
    curl_close($ch);
    return $curl_scraped_page;
}


$urls = array (
  array("test","https://cron-job.org",0),
  array("test2","https://cron-job.org",0),
);

function find($prefix){
    global $urls; 
    $gih = 'false';
    foreach($urls as $key=>$val){
        if($prefix >= $val[2]){
            $gih = $key;
        }
    }
    return $gih;
}
while ( 1 ){
    $keyer = find(time());
    if($keyer !== 'false'){
        $res = file_getcontent_with_proxy($urls[$keyer][1]);
        $urls[$keyer][2] = time()+60;
        echo "visiting ".$urls[$keyer][1]." ".$urls[$keyer][0]." ".time()."\n";
    }
    sleep(3);
}
die();






while ( 1 ){

    sleep(3);
}


/*     foreach($urls as $key=>$val){
        $name = $val[0];
        $url = $val[1];
        $res = file_getcontent_with_proxy($url);
        echo "$name with $url succes<br>";
    }
    echo "sleeping<br>"; */

/* while ( 1 ){
    $list = file(dirname(__FILE__).'/list.txt', FILE_SKIP_EMPTY_LINES);
    foreach ($list as $url) {
        $res = file_getcontent_with_proxy(trim($url));
    }
sleep(60);
} */
?>