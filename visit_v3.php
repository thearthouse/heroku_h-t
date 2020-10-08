<?php 
ignore_user_abort(true);
error_reporting(0);
set_time_limit(0);

$urls = array (//name,url,shedule in seconds,last executed
  array("test","https://cron-job.org",60,0), 
  array("test2","https://cron-job.org/?id=1",5,0),
);

function find($prefix){
    global $urls; 
    $gih = 'false';
    foreach($urls as $key=>$val){
        if($prefix >= $val[3]){
            $gih = $key;
        }
    }
    return $gih;
}
while ( 1 ){
    foreach($urls as $key=>$val){
        $nnow = time();
        if($nnow >= $val[3]){
            $args = $val[1];
            shell_exec("php script.php $args > /dev/null 2>&1 &" );
            $urls[$key][3] = (int) time()+$urls[$key][2];
        }
    }
    sleep(3);
}

?>
