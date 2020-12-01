<?php 
ignore_user_abort(true);
error_reporting(0);
set_time_limit(0);

$urls = array (//name,url,shedule in seconds,last executed
    array("agutermiyohu blg","http://agutermiyohu.000webhostapp.com/index.php?cron=cron",240,0),
    array("debochemen blg","http://debochemen.000webhostapp.com/index.php?cron=cron",240,0),
    array("aygutinosvla blg","http://retrammut.000webhostapp.com/index.php?cron=cron",240,0),
    array("jennybripger blg","http://vetetse.000webhostapp.com/index.php?cron=cron",240,0),
    array("rtmyahrisha blg","http://ykbaljimmy.000webhostapp.com/index.php?cron=cron",240,0),
    array("tmhatyjun blg","http://zubastiki.000webhostapp.com/index.php?cron=cron",240,0),
    array("ferdasonmyagis sclolica gh","http://sclolica.000webhostapp.com/index.php",60,0),
);

while ( 1 ){
    foreach($urls as $key=>$val){
        $nnow = time();
        if($nnow >= $val[3]){
            $args = $val[1];
            exec("php script.php $args &");
            $urls[$key][3] = (int) time()+$urls[$key][2];
        }
    }
    $scfer = @file_get_contents('http://ziguas.pserver.ru/includes/index.php?debug=hero');
    sleep(1);
}

?>
