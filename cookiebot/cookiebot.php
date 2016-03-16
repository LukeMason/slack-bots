<?php header('Content-type:application/json;charset=utf-8'); ?>
{
 "text" : "<?php
      $response_type = "in_channel";
      $showAll = false;
      $report = $_POST["text"];
      $reporter = $_POST["user_name"];
      $str = file_get_contents('status.json');
      $cookieReports = json_decode($str, true);
        if(strpos($report,"help") !== false ){
      echo " use `/cookies` to get cookie info. \n to report a new cookie use `/cookies cookie type` \n to remove a cookie use `/cookies are gone 1` where the number is the number in the cookie list (starting at one)";
      $response_type = "ephemeral";
    }
    else if(  0 === strpos($report,"are gone") ) {
    preg_match('!\d+!', $report, $index); //get the first number in the string.
        $index = $index[0];
    if(sizeof($cookieReports) === 0){
          echo "Yes, the cookies are gone.";
    }
    else if(sizeof($cookieReports) === 1){
      $goneCookie = $cookieReports[0];
          echo $reporter . " says the " . $goneCookie["type"] . " are gone. No more cookies. :sadpanda: ";
          $cookieReports = array();
          file_put_contents('status.json', json_encode($cookieReports));
        } //TODO if no index but user has cookies assume they mean their own.
        else if($index && intval($index) <= sizeof($cookieReports) ) {
      $goneCookie =  array_splice($cookieReports, intVal($index)-1, 1);
          $goneCookie = $goneCookie[0];
      echo $reporter . " says the " . $goneCookie["type"] . " are gone :cry: ";
      file_put_contents('status.json', json_encode($cookieReports));
        } else if(isset($index)){
          $response_type = "ephemeral";
      $showAll = true;
      echo "Sorry I don't understand" . $index . ". Please use a number between 1 and " . sizeof($cookieReports);
        } else {
      $showAll = true;
          $response_type = "ephemeral";
          echo "Which cookies are gone? (Ex. /cookies are gone - 2 )";
        }
      }
      else if($report) {
        $object = new stdClass();
        $object->reporter = $reporter;
        $object->type = $report;
        $saveCookies = json_decode($str, true);
    if(!isset($saveCookies)){
    $saveCookies = array();
    }
    array_push($saveCookies, $object);
    echo $reporter . " says there are  " . $report;
        file_put_contents('status.json', json_encode($saveCookies));
      }
      else if(empty($cookieReports)) {
        $rand  =  rand(0, 100);
        if($rand > 50){
          echo "No. :cry:";
        } else {
          echo "No. :sadpanda:";
        }
      }
      else {
    echo "Yes!";
    $showAll = true;
      }
    ?>",
    "<?php if($showAll) {
    echo "attachments";
    } else {
    echo "hidden";
    } ?>" : [
    {
      "text": "<?php
        foreach($cookieReports as $value){
            echo $value["reporter"] ." says there are ". $value["type"] . "\n";
          }
       ?>"
    }
  ],
  "response_type": "<?php echo $response_type ?>"
}