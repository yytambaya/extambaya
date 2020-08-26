<?php
class Connection{
public $error;
public static $status;

public static function getRate($url){
  $c = curl_init();
  curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($c, CURLOPT_URL, $url);
  $result = curl_exec($c);
  $info = json_decode($result, true);
  if(curl_errno($c) or isset($info['error'])){
    $error = curl_error($c)." ".$info['error'];
  }
  curl_close($c);
  if(isset($error)){
    $status = 0;
    return [0, $error];
  }else{
    $status = 1;
    return [1, $info];
  }

}

}

?>
