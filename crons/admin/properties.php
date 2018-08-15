<?php
require_once("phrets.php");
require_once __DIR__ . '/include/aws/aws-autoloader.php';
require (__DIR__ . '/include/predis/autoload.php');
include( __DIR__ .  "/../include/config_web.php");
include_once __DIR__ . '/../../trunk/app/protected/components/Doctrine_Inflector.php';

use Aws\S3\S3Client;
use Aws\S3\Exception\S3Exception;

error_reporting(E_ALL);
ini_set("display_errors", 1);
// sudo php properties.php -s"2015-11-19 00:00:01" -e"2015-11-19 23:59:59"  // import command that will run makePropertyInfoSlug()

$shortopts = "";
$shortopts .= "s::";
$shortopts .= "e::";
$shortopts .= "t::";   // determines type of execution - differential for previous run to now, history for run based on (s)tart and (e) dates
$shortopts .= "p::";

$longopts = array(
                "required:",
		        "optional::",
		        "option",
		        "opt"
            );

  
$s3 = S3Client::factory(array(
                'key'    => 'AKIAJXDPRHZBSOKS74AA',
                'secret' => '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',
));
$s3->registerStreamWrapper();

//date_default_timezone_set('America/Los_Angeles');
$options = getopt($shortopts, $longopts);

$startTime = time();
actlog('Start ' . date('c',$startTime ). ' t=' . (isset($options["t"]) ? $options["t"] : ''));

if ($options["t"] == "differential")
{
   DoDifferential();                            //Fetch the differet (last update - now)
} 
else if ($options["t"] == "property")
{
   DoPropertyCheck();                           //
}
else if ($options["t"] == "propertyfull")
{
    DoPropertyCheckFull();                           //
}
else if ($options["t"] == "test")
{
   DoPropertyTest($options["p"]);               //Fetch Property from database(REQUIRED: property_id)
}
else if ($options["t"] == "meta")
{
   DoPropertyMetaData();                        //Building tables
}
else
{
    DoFull();       //Fetch the different (REQUIRED: startdate-enddate)
}

$stopTime = time();
actlog('Stop ' . date('c', $startTime) . ' / '. date('c', $stopTime). ' time=' . time_elapsed($stopTime-$startTime) 
       . ' t=' . (isset($options["t"])?$options["t"]:''));

//Main
function DoFull() {

    // Check the permission of start
    $redis = new Predis\Client(array(
        'host'=>REDIS_SERVER,
        'port'=>REDIS_PORT
    ));


    if(!$redis->exists('StatusOfCheckDoFull') || $redis->exists('StatusOfCheckPropertyCheck') && $redis->get('StatusOfCheckPropertyCheck') == "Runned"){
        $value = $redis->exists('StatusOfCheckDoFull') ? $redis->get('StatusOfCheckDoFull') : $redis->get('StatusOfCheckPropertyCheck');
        actlog('DoFull: Starting is not possible. StatusOfCheckDoFull: '.$value);
        $redis->disconnect();
        return;
    } else {
        $start = $redis->get('StatusOfCheckDoFull');
        if($start == "Runned"){
            actlog(date("Y-m-d H:i:s").' --- DoFull: The process has been already started');
            return;
        }
    }

    $file=fopen(__DIR__ . "/lastupdate.txt","r");
    $date = fgets($file);
    fclose($file);

    if($redis->exists("FinishTimeOfDoFull")){
        $date_f = $redis->get('FinishTimeOfDoFull');
        var_dump('REDIS');
    } else {
        $date_f = date("Y-m-d H:i:s");
        $redis->set("FinishTimeOfDoFull",$date_f);
    }

    $redis->set('StatusOfCheckDoFull', "Runned");
    $redis->disconnect();
    if(empty($start)){
        actlog(date("Y-m-d H:i:s").' --- DoFull: no download required');
        return;
    } else if ($start == "Ready to start"){
        $start = '1';
    } else {
        $start = intval($start);
    }



    $rets_login_url = "http://rets.las.mlsmatrix.com/rets/login.ashx";
    $rets_username = "prop";
    $rets_password = "glvaridx";
    $class = "Listing";
    ini_set("memory_limit","512M");


    // connect to database
    $database_host = DATABASE_SERVER;
    $username = DATABASE_USERNAME;
    $password = DATABASE_PASSWORD;
    $database = DATABASE_NAME;
    $connection = mysqli_connect($database_host, $username,$password, $database);

    if(!$connection) {
        actlog(date("Y-m-d H:i:s").' --- DoFull: Error connect DB');
        return;
    }

    // connect to RETS

    for($retry=1;$retry<=3;$retry++) {
        $rets = new phRETS;
        if($connect = $rets->Connect($rets_login_url, $rets_username, $rets_password)) {
            echo "Connect: Retry#$retry\n";
            break;
        } else {
            echo "Unable to connect: Retry#$retry\n";
            actlog(date("Y-m-d H:i:s").' --- DoFull: '.$rets->Error());
            sleep(10);
        }
    }

    $resource = $rets->GetServerInformation(); //Load server name

    if ($connect) {
        actlog(date("Y-m-d H:i:s").' --- DoFull: started with parameters:'.$date.'-'.$date_f.', start Matrix_Unique_ID='.$start);

        $parse_date = date_parse($date);
        $parse_date_f = date_parse($date_f);
        $countProps = 0;
        $startTime = time();
        $sql = "(MatrixModifiedDT=".$parse_date['year']."-".sprintf("%02d",$parse_date['month'])."-".sprintf("%02d",$parse_date['day'])."T00:00:00-".sprintf("%02d",$parse_date_f['year'])."-".sprintf("%02d",$parse_date_f['month'])."-".sprintf("%02d",$parse_date_f['day'])."T23:59:59),(Matrix_Unique_ID=" . $start . "+)";

        GetMLSPropertiesCount($rets, $class, $sql);

        actlog(date("Y-m-d H:i:s").' --- DoFull: Total Results for ' . $date . ' class=' . $class . ' sql= ' .$sql . ' #' . $rets->TotalRecordsFound());
        
        $totalProp = $rets->TotalRecordsFound();
        $finish = $start;
        $unfoundCount = 0;
        while ($countProps < $totalProp) {

            $sql = "(MatrixModifiedDT=".$parse_date['year']."-".sprintf("%02d",$parse_date['month'])."-".sprintf("%02d",$parse_date['day'])."T00:00:00-".sprintf("%02d",$parse_date_f['year'])."-".sprintf("%02d",$parse_date_f['month'])."-".sprintf("%02d",$parse_date_f['day'])."T23:59:59),(Matrix_Unique_ID=" . $finish . "+)";
            $search = GetMLSProperties($rets, $class, $sql);

            if ($rets->NumRows() > 0) {
                while ($record=$rets->FetchRow($search)) {
                    actlog($countProps." loading");
                    GetRooms($record,$rets);        //Query to load the Rooms information
                    GetAgent($record,$rets);        //Query to load the Agent information
                    GetOffice($record,$rets);       //Query to load the Office information
                    $record['ResourceName'] = $resource['SystemID'];
                    $record = fixDataArray($record);
                    GetPhotos($rets, $record['Matrix_Unique_ID'], $connection);
                    DBSave($record, $class, $connection);
                    $finish = $record['Matrix_Unique_ID']+1;
                    unset($record);
                    unset($id);
                    unset($sql);
                    actlog(array(memory_get_usage(),memory_get_peak_usage()));
                    
                    $countProps++;
                }
            } else {
                $unfoundCount = $totalProp - $countProps;
                actlog(date("Y-m-d H:i:s").' --- DoFull: Probably several records from MLS have been deleted during the process');
                $countProps++;
            }
            $rets->FreeResult($search);
            actlog(date("Y-m-d H:i:s").' --- DoFull: Properties loaded: '.$countProps);
            actlog(date("Y-m-d H:i:s").' --- DoFull: Memory Usage: '.memory_get_usage());
            actlog(date("Y-m-d H:i:s").' --- DoFull: '.$finish.' is max Matrix_unique_ID(Last in query)');
            if($countProps == 10000){
                $redis->connect(array(
                    'host'=>REDIS_SERVER,
                    'port'=>REDIS_PORT
                ));
                $redis->set('StatusOfCheckDoFull',$finish);
                $redis->disconnect();
                actlog(date("Y-m-d H:i:s").' --- DoFull: Total loaded:'. $countProps.'. Different Matrix_Unique_ID:'.$start. ' - '.$finish);
                return;
            }
        }
        $check_file=fopen(__DIR__ . "/check_to_run_dofull.txt","a");
        ftruncate($check_file, 0);
        fclose($check_file);
        $file=fopen(__DIR__ . "/lastupdate.txt","w");
        fwrite($file, $date_f);
        fclose($file);
        $stopTime = time();
        unset($file);
        $redis->connect(array(
            'host'=>REDIS_SERVER,
            'port'=>REDIS_PORT
        ));
        $redis->del('StatusOfCheckDoFull');
        $redis->del('FinishTimeOfDoFull');
        $redis->disconnect();
        actlog(date("Y-m-d H:i:s").' --- DoFull: FINISHED!!!!:Total at '. $date . " = " . $countProps - $unfoundCount. ' time=' . time_elapsed($stopTime-$startTime) );

    }
    $rets->Disconnect();
    mysqli_close($connection);
}

function DoBigDifferential($startdate, $enddate) {
    // Configuration for connect to RETS

    $rets_login_url = "http://rets.las.mlsmatrix.com/rets/login.ashx";
    $rets_username = "prop";
    $rets_password = "glvaridx";
    $class = "Listing";
    ini_set("memory_limit","512M");


    // connect to database
    $database_host = DATABASE_SERVER;
    $username = DATABASE_USERNAME;
    $password = DATABASE_PASSWORD;
    $database = DATABASE_NAME;
    $connection = mysqli_connect($database_host, $username,$password, $database);
    if(!$connection) {
        actlog('Error connect DB');
        return;
    }

    // connect to RETS

    for($retry=1;$retry<=3;$retry++) {
        $rets = new phRETS;
        if($connect = $rets->Connect($rets_login_url, $rets_username, $rets_password)) {
            echo "Connect: Retry#$retry\n";
            break;
        } else {
            echo "Unable to connect: Retry#$retry\n";
            actlog($rets->Error());
            sleep(10);
        }
    }
    
    $resource = $rets->GetServerInformation(); //Load server name

      if ($connect) {

          $date = $startdate;
          $date_f = $enddate;
          actlog('DoBigDifferential started with parameters:'.$date.'-'.$date_f);
          
          $parse_date = date_parse($date);
          $parse_date_f = date_parse($date_f);
          $countProps = 0;
          $startTime = time();
          $sql = "(MatrixModifiedDT=".$parse_date['year']."-".sprintf("%02d",$parse_date['month'])."-".sprintf("%02d",$parse_date['day'])."T00:00:00-".sprintf("%02d",$parse_date_f['year'])."-".sprintf("%02d",$parse_date_f['month'])."-".sprintf("%02d",$parse_date_f['day'])."T23:59:59),(Matrix_Unique_ID=1+)";

          GetMLSPropertiesCount($rets, $class, $sql);

          actlog("Total Results for " . $date . " class=" . $class . " sql= " .$sql . " #" . $rets->TotalRecordsFound() . "\n");

          $start = 1;
          $totalProp = $rets->TotalRecordsFound();

          while ($countProps < $totalProp) {

              $sql = "(MatrixModifiedDT=".$parse_date['year']."-".sprintf("%02d",$parse_date['month'])."-".sprintf("%02d",$parse_date['day'])."T00:00:00-".sprintf("%02d",$parse_date_f['year'])."-".sprintf("%02d",$parse_date_f['month'])."-".sprintf("%02d",$parse_date_f['day'])."T23:59:59),(Matrix_Unique_ID=" . $start . "+)";
              $search = GetMLSProperties($rets, $class, $sql);

              if ($rets->NumRows() > 0) {
                  while ($record=$rets->FetchRow($search)) {
                      actlog($countProps." loading");
                      GetRooms($record,$rets);        //Query to load the Rooms information
                      GetAgent($record,$rets);        //Query to load the Agent information
                      GetOffice($record,$rets);       //Query to load the Office information
                      $countProps++;
                      $record['ResourceName'] = $resource['SystemID'];
                      $record = fixDataArray($record);
                      GetPhotos($rets, $record['Matrix_Unique_ID'], $connection);
                      DBSave($record, $class, $connection);

                      $start = $record['Matrix_Unique_ID'] + 1;
                      unset($record);
                      unset($id);
                      unset($sql);
                      actlog(array(memory_get_usage(),memory_get_peak_usage()));
                  }
              }
              $rets->FreeResult($search);
              actlog('Properties loaded: '.$countProps);
              actlog( 'Memory Usage: '.memory_get_usage());
              actlog($start.' is max Matrix_unique_ID(Last in query)');

          }
          $file=fopen(__DIR__ . "/lastupdate.txt","w");
          $nowdate = time();
          fwrite($file, $nowdate);
          fclose($file);
          unset($file);
          $stopTime = time();
          actlog('Total at '. $date . " = " . $countProps. ' time=' . time_elapsed($stopTime-$startTime) );
      }
    $rets->Disconnect();
    mysqli_close($connection);
}

function DoDifferential() 
{
    // Check the permission of start
    $redis = new Predis\Client(array(
        'host'=>REDIS_SERVER,
        'port'=>REDIS_PORT
    ));
    if($redis->exists('StatusOfCheckDoFull')){
        $value = $redis->get('StatusOfCheckDoFull');
        actlog('DoDifferential: Starting is not possible. StatusOfCheckDoFull: '.$value);
        $redis->disconnect();
        return;
    }
    if($redis->exists('StatusOfCheckPropertyCheck') && $redis->get('StatusOfCheckPropertyCheck') == "Runned"){
        $value = $redis->get('StatusOfCheckPropertyCheck');
        actlog('DoDifferential: Starting is not possible. StatusOfCheckPropertyCheck: '.$value);
        $redis->disconnect();
        return;
    }
    // Configuration for connect to RETS

    $rets_login_url = "http://rets.las.mlsmatrix.com/rets/login.ashx";
    $rets_username = "prop";
    $rets_password = "glvaridx";
    $class = "Listing";

    // Read last update

    $file=fopen(__DIR__ . "/lastupdate.txt","r");
    $date = fgets($file);
    fclose($file);

    // Get last date and current date as array

    $parse_date = date_parse($date);
    $nowdate = date("Y-m-d H:i:s");
    $now_parse_date = date_parse($nowdate);

    echo("Doing Differential " . $date . " to " . $nowdate ."\n\n");

    $sql = "(MatrixModifiedDT=".$parse_date['year']."-".sprintf("%02d",$parse_date['month'])."-".sprintf("%02d",$parse_date['day'])."T".sprintf("%02d",$parse_date['hour']).":".sprintf("%02d",$parse_date['minute']).":".sprintf("%02d",$parse_date['second'])."-".sprintf("%02d",$now_parse_date['year'])."-".sprintf("%02d",$now_parse_date['month'])."-".sprintf("%02d",$now_parse_date['day'])."T".sprintf("%02d",$now_parse_date['hour']).":".sprintf("%02d",$now_parse_date['minute']).":".sprintf("%02d",$now_parse_date['second']).")";
  
    echo "Doing " . $sql . "\n";
    
    // Connect to database

    $database_host = DATABASE_SERVER;
    $username = DATABASE_USERNAME;
    $password = DATABASE_PASSWORD;
    $database = DATABASE_NAME;
    $connection = mysqli_connect($database_host, $username,$password,$database);
    if(!$connection) {
        actlog('Error connect DB');
        return;
    }
    
  // connect to RETS

  for($retry=1;$retry<=3;$retry++) {
    $rets = new phRETS;
    if($connect = $rets->Connect($rets_login_url, $rets_username, $rets_password)) {
        echo "Connect: Retry#$retry\n";
        break;
    } else {
        echo "Unable to connect: Retry#$retry\n";
        actlog($rets->Error());
        sleep(10);
    }
  }
    $resource = $rets->GetServerInformation();

  if ($connect) {
      
      $countProps = 0;

      $search = GetMLSProperties($rets, $class, $sql);

      if($rets->TotalRecordsFound()>10000){
          actlog('Total records > 10000. Download stopped. The process will be executed DoFull');
          $redis->set('StatusOfCheckDoFull','Ready to start');
          $rets->FreeResult($search);
          mysqli_close($connection);
          $rets->Disconnect();
          unset($rets);
          unset($connection);
          unset($sql);
          unset($search);
          unset($resource);
          return;
      };

      if($rets->TotalRecordsFound()>5000){
          actlog('Total records > 5000. Download stopped. The process will be executed DoBigDifferential');
          $rets->Disconnect();
          mysqli_close($connection);
          DoBigDifferential($date,$nowdate);
          $rets->FreeResult($search);
          unset($rets);
          unset($connection);
          unset($sql);
          unset($search);
          unset($resource);
          return;
      };
        $redis->disconnect();
      if ($rets->NumRows() > 0) {
          actlog('Differential is '.$rets->TotalRecordsFound());
            while ($record=$rets->FetchRow($search)) {
                actlog($countProps." loading");
                GetRooms($record,$rets);        //Query to load the Rooms information
                GetAgent($record,$rets);        //Query to load the Agent information
                GetOffice($record,$rets);       //Query to load the Office information
                $countProps++;
                $record['ResourceName'] = $resource['SystemID'];
                $record = fixDataArray($record);
                GetPhotos($rets, $record['Matrix_Unique_ID'], $connection); //Query to load the first photo
                DBSave($record, $class, $connection);   //Save Data
                unset($record);
                unset($id);
                unset($sql);
            }
      }
      $file=fopen(__DIR__ . "/lastupdate.txt","w");
      fwrite($file, $nowdate);
      fclose($file);
      unset($file);
    actlog('Total ' . $countProps);
    $rets->Disconnect();
    mysqli_close($connection);
  } else {
      actlog("Unable to connect");
  }
}

function DoPropertyCheck() {
    // Check the permission of start
    $redis = new Predis\Client(array(
        'host'=>REDIS_SERVER,
        'port'=>REDIS_PORT
    ));
    if($redis->exists('StatusOfCheckDoFull')){
        $value = $redis->get('StatusOfCheckDoFull');
        actlog('DoPropertyCheck: Starting is not possible. StatusOfCheckDoFull: '.$value);
        return;
    }
    if($redis->exists('StatusOfCheckPropertyCheck') && $redis->get('StatusOfCheckPropertyCheck') == "Runned"){
        $value = $redis->get('StatusOfCheckPropertyCheck');
        actlog('DoPropertyCheck: Starting is not possible. StatusOfCheckPropertyCheck: '.$value);
        return;
    }
//    $redis->set('StatusOfCheckPropertyCheck','Runned');
    // Configuration for connect to RETS

    $rets_login_url = "http://rets.las.mlsmatrix.com/rets/login.ashx";
    $rets_username = "prop";
    $rets_password = "glvaridx";
    $date = date("Y-m-d H:i:s");

    actlog("Doing Property Check" . $date ."\n\n");

    // connect to database

    $database_host = DATABASE_SERVER;
    $username = DATABASE_USERNAME;
    $password = DATABASE_PASSWORD;
    $database = DATABASE_NAME;
    $connection = mysqli_connect($database_host, $username,$password,$database);
    if(!$connection) {
        actlog('Error connect DB');
        return;
    }

    // connect to RETS

    for($retry=1;$retry<=3;$retry++) {
        $rets = new phRETS;
        if($connect = $rets->Connect($rets_login_url, $rets_username, $rets_password)) {
            echo "Connect: Retry#$retry\n";
            break;
        } else {
            echo "Unable to connect: Retry#$retry\n";
            actlog($rets->Error());
            sleep(10);
        }
    }
    $resource = $rets->GetServerInformation();
    $resource = $resource['SystemID'];
    $searchCheckNum = 0;
    $expired = 0;
    if ($connect) {

        // get currentDate - 1 Day and current date as array

        $parse_date = date_parse(date("Y-m-d H:i:s",  strtotime('-1 day')));
        $now_parse_date = date_parse(date("Y-m-d H:i:s"));
        
        $sql = "(MatrixModifiedDT=".$parse_date['year']."-".sprintf("%02d",$parse_date['month'])."-".sprintf("%02d",$parse_date['day'])."T".sprintf("%02d",$parse_date['hour']).":".sprintf("%02d",$parse_date['minute']).":".sprintf("%02d",$parse_date['second'])."-".sprintf("%02d",$now_parse_date['year'])."-".sprintf("%02d",$now_parse_date['month'])."-".sprintf("%02d",$now_parse_date['day'])."T".sprintf("%02d",$now_parse_date['hour']).":".sprintf("%02d",$now_parse_date['minute']).":".sprintf("%02d",$now_parse_date['second']).")";
        actlog("Doing " . $sql . "\n");

        $rets->SearchQuery("Property", 'Listing', '('.$sql.')', array('Limit' => 5000, 'Count' => 1, 'Select' => 'Matrix_Unique_ID,PropertyType,ProviderKey'));
        $totalProp = $rets->TotalRecordsFound();
        $error_info = $rets->Error();
        if ($error_info['type'] == "rets") {
            actlog("RETS error in PropertyCheck function for searchCheckNum(code {$error_info['code']}): {$error_info['text']}\n");
        }
        
        $searchCheckNum = $rets->NumRows();
        actlog("NumRows " . $totalProp . "\n");
    }
  
    if ($connect && $searchCheckNum > 0) {
        actlog('RETS is live: start the checking');

        $checksql = "select mls_sysid as mls_sysid, mls_id as mls_id, mls_name as mls_name "
                . "from `bucontra_propertyhookup`.`property_info`"
                . "LEFT JOIN `bucontra_propertyhookup`.`property_info_additional_brokerage_details` on `property_info`.`property_id` = `property_info_additional_brokerage_details`.`property_id`"
                . "where `status`  in ('Active', 'Active-Exclusive Right','Auction','Contingent Offer', 'Exclusive Agency','Pending Offer')";
        
        $result = mysqli_query($connection, $checksql);
        $num_results = mysqli_num_rows($result);
        actlog($num_results . " to be checked\n\n");

        if ($num_results > 0) {
            while($property = mysqli_fetch_array($result)) {
                try {
//                    actlog("\nChecking property (mls_sysid)" . $property['mls_sysid'] . "\n");
                    $mls_sysid = $property['mls_sysid'];
                    $checksql = "select `property_id`, `mls_name` from `bucontra_propertyhookup`.`property_info` where `mls_sysid`='".$mls_sysid."' AND mls_name IS NULL or `mls_sysid`='".$mls_sysid."' AND `mls_name`='$resource'";
                    $inforesult = mysqli_query($connection, $checksql);
                    if(mysqli_errno($connection) != 0){
                        actlog(mysqli_errno($connection) . ": " . mysqli_error($connection). "\n");
                    }
                    $infonum_results = mysqli_num_rows($inforesult);

                    if ($infonum_results > 0) {

                        $inforow = mysqli_fetch_array($inforesult);

                        if($inforow['mls_name'] != NULL){
                            $query = "Matrix_Unique_ID=".$property['mls_sysid'];
                        } else {
                            $query = "ProviderKey=".$property['mls_sysid'];
                        }
                                $search = $rets->SearchQuery("Property", "Listing" , $query, array('Limit' => 5000, 'Count' => 1, 'Select' => 'Status,AuctionType,ListingAgreementType'));
                                $error_info = $rets->Error();
                 
                                if ($error_info['type'] == "rets") {
                                    actlog("RETS error in PropertyCheck function for getting status (code {$error_info['code']}): {$error_info['text']} \n");
                                }
                                if ($rets->NumRows() > 0) {
                                    $record=$rets->FetchRow($search);
                                    
                                    if($record['Status'] == 'Pending'){
                                        $record['Status'] = 'Pending Offer';
                                    } else if ($record['Status'] == 'Withdrawn'){
                                        $record['Status'] = 'Withdrawn Unconditional';
                                    } else if ($record['Status'] == 'Incomplete'){
                                        $record['Status'] == 'Expired';
                                    } else if(
                                        ($record['Status'] == "Active" ||
                                        $record['Status'] == "Active-Exclusive Right" ||
                                        $record['Status'] == "For Sale" ||
                                        $record['Status'] == "Active-Exclusive Agency") &&
                                        ($record['AuctionType'] == 'Absolute' ||
                                        $record['AuctionType'] == 'Reserve' ||
                                        $record['ListingAgreementType'] == "Auction")
                                    ){
                                        $record['Status'] = "Auction";
                                    }
                                    mysqli_query($connection, "UPDATE `bucontra_propertyhookup`.`property_info_additional_brokerage_details` set `status`='".$record['Status']."' where `property_id` =".$inforow['property_id']);
                                    if(mysqli_errno($connection) != 0){
                                        actlog(mysqli_errno($connection) . ": " . mysqli_error($connection). "\n");
                                    }

                                    actlog("Property " . $inforow['property_id'] . " status changed to ". $record['Status'] . "\n");

                                } else {
                                    
                                    if(isset($error_info['code']) && $error_info['code'] == 20201 ) {
                                        mysqli_query($connection, "UPDATE `bucontra_propertyhookup`.`property_info_additional_brokerage_details` set `status` = 'Expired' where `property_id` =".$inforow['property_id']);
                                        if(mysqli_errno($connection) != 0){
                                            actlog(mysqli_errno($connection) . ": " . mysqli_error($connection). "\n");
                                        }
                                        $expired++;
                                        actlog("Property " . $inforow['property_id'] . " changed from blank to expired\n");
                                    }
                                }
                        unset($record);
                        echo memory_get_usage() . "\n";
                        echo memory_get_peak_usage() . "\n\n\n";
                    }
                } catch (Exception $e) {
                    actlog('Caught exception: '.  $e->getMessage()."\n");
                }
            }
        }
    } else {
        actlog('RETS is NOT live');
    }
    actlog('Total number of properties that were turned to the Expired status: '.$expired);
    $redis->del('StatusOfCheckPropertyCheck');
    $redis->disconnect();
}

function DoPropertyCheckFull() {
    // Check the permission of start
    $redis = new Predis\Client(array(
        'host'=>REDIS_SERVER,
        'port'=>REDIS_PORT
    ));
    if($redis->exists('StatusOfCheckDoFull')){
        $value = $redis->get('StatusOfCheckDoFull');
        actlog('DoPropertyCheck: Starting is not possible. StatusOfCheckDoFull: '.$value);
        return;
    }
    if($redis->get('StatusOfCheckPropertyCheck') == 'Completed'){
        $value = $redis->get('StatusOfCheckPropertyCheck');
        actlog('DoPropertyCheck: Starting is not possible. StatusOfCheckPropertyCheckFull: '.$value);
        return;
    }
    if($redis->exists('StatusOfCheckPropertyCheckInProgress')){
        $value = $redis->get('StatusOfCheckPropertyCheck');
        actlog('DoPropertyCheck: Starting is not possible. StatusOfCheckPropertyCheckFull: '.$value.' - '.$redis->get('StatusOfCheckPropertyCheckInProgress'));
        return;
    }

    // Configuration for connect to RETS
    $rets_login_url = "http://rets.las.mlsmatrix.com/rets/login.ashx";
    $rets_username = "prop";
    $rets_password = "glvaridx";
    $date = date("Y-m-d H:i:s");

    actlog("Doing Property Check" . $date ."\n\n");

    // connect to database

    $database_host = DATABASE_SERVER;
    $username = DATABASE_USERNAME;
    $password = DATABASE_PASSWORD;
    $database = DATABASE_NAME;
    $connection = mysqli_connect($database_host, $username,$password,$database);
    if(!$connection) {
        actlog('Error connect DB');
        return;
    }

    // connect to RETS

    for($retry=1;$retry<=3;$retry++) {
        $rets = new phRETS;
        if($connect = $rets->Connect($rets_login_url, $rets_username, $rets_password)) {
            echo "Connect: Retry#$retry\n";
            break;
        } else {
            echo "Unable to connect: Retry#$retry\n";
            actlog($rets->Error());
            sleep(10);
        }
    }
    $redis->set('StatusOfCheckPropertyCheck','Runned');
    $redis->set('StatusOfCheckPropertyCheckInProgress','Progress');
    $redis->expire('StatusOfCheckPropertyCheckInProgress', 10000);
    
    if($redis->exists('StatusOfCheckPropertyCheckLastParam')){
        $offset = $redis->get('StatusOfCheckPropertyCheckLastParam');
        $expired = $redis->get('TotalExpired');
    } else {
        $offset = 0;
        $expired = 0;
    }

    $resource = $rets->GetServerInformation();
    $resource = $resource['SystemID'];
    $searchCheckNum = 0;
    $expired = 0;

    if ($connect) {
            actlog('RETS is live: start the checking');
            $offset = intval($offset);
            $limit = 5000;
            $checksql = "select mls_sysid as mls_sysid, mls_id as mls_id, mls_name as mls_name "
                . "from `bucontra_propertyhookup`.`property_info`"
                . "LEFT JOIN `bucontra_propertyhookup`.`property_info_additional_brokerage_details` on `property_info`.`property_id` = `property_info_additional_brokerage_details`.`property_id`"
                . "LIMIT ". $offset .", ".$limit;

            $result = mysqli_query($connection, $checksql);
            $num_results = mysqli_num_rows($result);
            actlog($num_results . " to be checked\n\n");
            if ($num_results > 0) {
                while($property = mysqli_fetch_array($result)) {
                    $offset++;
                    try {
                    actlog("\nChecking property (mls_sysid)" . $property['mls_sysid'] . "\n");
                        $mls_sysid = $property['mls_sysid'];
                        $checksql = "select `property_id`, `mls_name` from `bucontra_propertyhookup`.`property_info` where `mls_sysid`='".$mls_sysid."' AND mls_name IS NULL or `mls_sysid`='".$mls_sysid."' AND `mls_name`='$resource'";
                        $inforesult = mysqli_query($connection, $checksql);
                        if(mysqli_errno($connection) != 0){
                            actlog(mysqli_errno($connection) . ": " . mysqli_error($connection). "\n");
                        }
                        $infonum_results = mysqli_num_rows($inforesult);

                        if ($infonum_results > 0) {

                            $inforow = mysqli_fetch_array($inforesult);

                            if($inforow['mls_name'] != NULL){
                                $query = "Matrix_Unique_ID=".$property['mls_sysid'];
                            } else {
                                $query = "ProviderKey=".$property['mls_sysid'];
                            }

                            $search = $rets->SearchQuery("Property", "Listing" , $query, array('Limit' => 5000, 'Count' => 1, 'Select' => 'Status,AuctionType,ListingAgreementType'));

                            $error_info = $rets->Error();

                            if ($error_info['type'] == "rets") {
                                actlog("RETS error in PropertyCheck function for getting status (code {$error_info['code']}): {$error_info['text']} \n");
                            }

                            if ($rets->NumRows() > 0) {
                                $record=$rets->FetchRow($search);

                                if($record['Status'] == 'Pending'){
                                    $record['Status'] = 'Pending Offer';
                                } else if ($record['Status'] == 'Withdrawn'){
                                    $record['Status'] = 'Withdrawn Unconditional';
                                } else if ($record['Status'] == 'Incomplete'){
                                    $record['Status'] == 'Expired';
                                } else if(
                                    ($record['Status'] == "Active" ||
                                        $record['Status'] == "Active-Exclusive Right" ||
                                        $record['Status'] == "For Sale" ||
                                        $record['Status'] == "Active-Exclusive Agency") &&
                                    ($record['AuctionType'] == 'Absolute' ||
                                        $record['AuctionType'] == 'Reserve' ||
                                        $record['ListingAgreementType'] == "Auction")
                                ){
                                    $record['Status'] = "Auction";
                                }
                                mysqli_query($connection, "UPDATE `bucontra_propertyhookup`.`property_info_additional_brokerage_details` set `status`='".$record['Status']."' where `property_id` =".$inforow['property_id']);
                                if(mysqli_errno($connection) != 0){
                                    actlog(mysqli_errno($connection) . ": " . mysqli_error($connection). "\n");
                                }
                                    actlog("Property " . $inforow['property_id'] . " status changed to ". $record['Status'] . "\n");

                            } else {

                                if(isset($error_info['code']) && $error_info['code'] == 20201 ) {
                                    mysqli_query($connection, "UPDATE `bucontra_propertyhookup`.`property_info_additional_brokerage_details` set `status` = 'Expired' where `property_id` =".$inforow['property_id']);
                                    if(mysqli_errno($connection) != 0){
                                        actlog(mysqli_errno($connection) . ": " . mysqli_error($connection). "\n");
                                    }
                                    $expired++;
//                                        actlog("Property " . $inforow['property_id'] . " changed from blank to expired\n");
                                }
                            }
                            $rets->FreeResult($search);
                            unset($record);
                            unset($search);
                        }
                    } catch (Exception $e) {
                        actlog('Caught exception: '.  $e->getMessage()."\n");
                    }
                }
                if($limit > $num_results){
                    $redis->del('StatusOfCheckPropertyCheckLastParam');
                    $redis->del('StatusOfCheckPropertyCheckInProgress');
                    $redis->del('TotalExpired');
                    $redis->set('StatusOfCheckPropertyCheck', 'Completed');
                    actlog('Total number of properties that were turned to the Expired status: '.$expired);
                    $redis->disconnect();
                    return;
                }
            }
        } else {
            actlog('RETS is NOT live');
        }
    $redis->set('TotalExpired',$expired);
    $redis->set('StatusOfCheckPropertyCheckLastParam',$offset);
    $redis->del('StatusOfCheckPropertyCheckInProgress');
    $redis->disconnect();
}

//Additional

function DoPropertyTest($propertyId)
{
    if(empty($propertyId)) {
        echo 'Wrong set parameter "p" - property id';
        return ;
    }
    $propertyId = intval($propertyId);

    // connect to database
    $database_host = DATABASE_SERVER;
    $username = DATABASE_USERNAME;
    $password = DATABASE_PASSWORD;
    $database = DATABASE_NAME;

    // connect to database
    $connection = mysqli_connect($database_host, $username,$password, $database);
    if(!$connection) {
        actlog('Error connect DB');
        return;
    }


    $sql = "
SELECT 
    `property_info`.`property_id`,
    `fundamentals_factor`,
    `conditional_factor`,
    `property_type`,
    `property_zipcode`,
    `compass_point`,
    `house_faces`,
    `house_views`,
    `street_name`,
    `pool`,
    `spa`,
    `stories`,
    `lot_description`,
    `building_description`,
    `carport_type`,
    `converted_garage`,
    `exterior_structure`,
    `roof`,
    `electrical_system`,
    `plumbing_system`,
    `built_desc`,
    `exterior_grounds`,
    `prop_desc`,
    `over_all_property`,
    `foreclosure`,
    `short_sale`,
    `sub_type`,
    `studio`,
    `condo_conversion`,
    `association_features_available`,
    `association_fee_1`,
    `assessment`,
    `sidlid`,
    `parking_description`,
    `fence_type`,
    `court_approval`,
    `bath_downstairs`,
    `bedroom_downstairs`,
    `great_room`,
    `bath_downstairs_description`,
    `flooring_description`,
    `furnishings_description`,
    `heating_features`,
    `possession_description`,
    `financing_considered`,
    `reporeo`,
    `litigation`
FROM
    `property_info`
LEFT JOIN `property_info_details` USING (`property_id` )
LEFT JOIN `property_info_additional_details` USING (`property_id` )
LEFT JOIN `property_info_additional_brokerage_details` USING (`property_id` )
WHERE `property_info`.`property_id` =  {$propertyId} 

";

    $result = mysqli_query($connection,$sql);

    $property = mysqli_fetch_assoc($result);

//print_r($property);

    $factors = searchFactors($connection, $property);

    echo $factors, PHP_EOL;

    mysqli_close($connection);
}

function DoPropertyMetaData() {
    $rets_login_url = "http://rets.las.mlsmatrix.com/rets/login.ashx";
    $rets_username = "prop";
    $rets_password = "glvaridx";

    // connect to RETS
    $rets = new phRETS;
    $connect = $rets->Connect($rets_login_url, $rets_username, $rets_password);

    if ($connect) {
        // gets resource information.  need this for the KeyField
        $rets_resource_info = $rets->GetMetadataInfo();

        $resource = "Property";
        $class = "Listing";

        // pull field format information for this class
        $rets_metadata = $rets->GetMetadata($resource, $class);

        $table_name = "rets_".strtolower($resource)."_".strtolower($class);
        // i.e. rets_property_res

        $sql = create_table_sql_from_metadata($table_name, $rets_metadata, $rets_resource_info[$resource]['KeyField']);

        acttxt($sql . ';');

    }
}

//Getting Additional data

function GetRooms(&$record, $rets){
    $id=$record['Matrix_Unique_ID'];
    $query = "Listing_MUI=".$id;
    $class = "Room";
    $resource = "PropertySubTable";
    
    $search = $rets->SearchQuery($resource, $class, $query, array('Limit' => 1000, 'Count' => 0, 'Select' => 'RoomType,RoomDescription,RoomDimensions'));
    $error_info = $rets->Error();
    if ($error_info['type'] == "rets") {
        echo "RETS error in GetRooms (code {$error_info['code']}): {$error_info['text']}";
    }

    while($rooms = $rets->FetchRow($search)){
        $key = str_replace(" ",'', $rooms['RoomType']);
        $record[$key.'Description'] = $rooms['RoomDescription'];
        $record[$key.'Dimensions'] = $rooms['RoomDimensions'];
    }
    $rets->FreeResult($search);

    $search = $rets->SearchQuery($resource, 'Unit', "Listing_MUI=1+", array('Limit' => 1000, 'Count' => 0, 'Select' => 'ROOMRent,UnitDesc'));
    $error_info = $rets->Error();
    if ($error_info['type'] == "rets") {
        echo "RETS error in GetUnit (code {$error_info['code']}): {$error_info['text']}";
    }
    $record['UnitDesc'] = '';
    $record['ROOMRent'] = '';
    while($unit = $rets->FetchRow($search)){
        $record['UnitDesc'] = $unit['UnitDesc'];
        $record['ROOMRent'] = $unit['ROOMRent'];
    }
    if(!isset($record['MasterBedRoomDescription'])){
        $record['MasterBedRoomDescription'] = '';
    }
    if(!isset($record['MasterBedRoomDimensions'])){
        $record['MasterBedRoomDimensions'] = '';
    }
    if(!isset($record['DiningRoomDescription'])){
        $record['DiningRoomDescription'] = '';
    }
    if(!isset($record['DiningRoomDimensions'])){
        $record['DiningRoomDimensions'] = '';
    }
    if(!isset($record['FamilyRoomDescription'])){
        $record['FamilyRoomDescription'] = '';
    }
    if(!isset($record['FamilyRoomDimensions'])){
        $record['FamilyRoomDimensions'] = '';
    }
    if(!isset($record['GreatRoomDescription'])){
        $record['GreatRoomDescription'] = '';
    }
    if(!isset($record['GreatRoomDimensions'])){
        $record['GreatRoomDimensions'] = '';
    }
    if(!isset($record['KitchenDescription'])){
        $record['KitchenDescription'] = '';
    }
    if(!isset($record['LivingRoomDimensions'])){
        $record['LivingRoomDimensions'] = '';
    }
    if(!isset($record['LivingRoomDescription'])){
        $record['LivingRoomDescription'] = '';
    }
    if(!isset($record['2ndBedroomDescription'])){
        $record['2ndBedroomDescription'] = '';
    }
    if(!isset($record['2ndBedroomDimensions'])){
        $record['2ndBedroomDimensions'] = '';
    }
    if(!isset($record['3rdBedroomDescription'])){
        $record['3rdBedroomDescription'] = '';
    }
    if(!isset($record['3rdBedroomDimensions'])){
        $record['3rdBedroomDimensions'] = '';
    }
    if(!isset($record['4thBedroomDescription'])){
        $record['4thBedroomDescription'] = '';
    }
    if(!isset($record['4thBedroomDimensions'])){
        $record['4thBedroomDimensions'] = '';
    }
    if(!isset($record['5thBedroomDescription'])){
        $record['5thBedroomDescription'] = '';
    }
    if(!isset($record['5thBedroomDimensions'])){
        $record['5thBedroomDimensions'] = '';
    }
    if(!isset($record['LoftDescription'])){
        $record['LoftDescription'] = '';
    }
    if(!isset($record['LoftDimensions'])){
        $record['LoftDimensions'] = '';
    }
    if(!isset($record['MasterBathDescription'])){
        $record['MasterBathDescription'] = '';
    }
    if(!isset($record['MasterBathDimensions'])){
        $record['MasterBathDimensions'] = '';
    }
    if(!isset($record['DenDescription'])){
        $record['DenDescription'] = '';
    }
    if(!isset($record['DenDimensions'])){
        $record['DenDimensions'] = '';
    }
    $rets->FreeResult($search);
    unset($id);
    unset($query);
    unset($class);
    unset($resource);
    unset($search);
    unset($error_info);
    unset($rooms);
//    return $record;
}

function GetAgent(&$record,$rets){
    $id=$record['ListAgent_MUI'];
    $query = "Matrix_Unique_ID=$id";
    $class = "Agent";
    $resource = "Agent";
    $search = $rets->SearchQuery($resource, $class, $query, array('Limit' => 1000, 'Count' => 0, 'Select' => '*'));
    $error_info = $rets->Error();
    if ($error_info['type'] == "rets") {
        echo "RETS error in GetRoom (code {$error_info['code']}): {$error_info['text']}";
    }
    while($agent = $rets->FetchRow($search)){
        $record['AgentEmail'] = $agent['Email'];
        $record['AgentFaxPhone'] = $agent['FaxPhone'];
        $record['AgentFirstName'] = $agent['FirstName'];
        $record['AgentOfficePhone'] = $agent['DirectWorkPhone'];
        $record['AdministrationInformation'] = $agent['AdministrationInformation'];
        
    }
    $rets->FreeResult($search);
    unset($id);
    unset($query);
    unset($class);
    unset($resource);
    unset($search);
    unset($error_info);
    unset($agent);
//    return $record;

}

function GetOffice(&$record,$rets){
    $id=$record['ListOffice_MUI'];
    $query = "Matrix_Unique_ID=$id";
    $class = "Office";
    $resource = "Office";
    $search = $rets->SearchQuery($resource, $class, $query, array('Limit' => 1000, 'Count' => 0, 'Select' => '*'));
    $error_info = $rets->Error();
    if ($error_info['type'] == "rets") {
        echo "RETS error in GetOffice (code {$error_info['code']}): {$error_info['text']}";
    }
    while($office = $rets->FetchRow($search)){
        $record['OfficeDesignatedBrokerName'] = $office['DesignatedBrokerName'];
        $record['OfficePhone'] = $office['Phone'];
        $record['OfficeMailAddress'] = $office['MailAddress'];
        $record['OfficeMailPostalCode'] = $office['MailPostalCode'];
        $record['OfficeMailCity'] = $office['MailCity'];
        $record['OfficeWebPageAddress'] = $office['WebPageAddress'];
    }
    $rets->FreeResult($search);
    unset($id);
    unset($query);
    unset($class);
    unset($resource);
    unset($search);
    unset($error_info);
    unset($office);
//    return $record;

}

function GetPhotos($rets, $id, $connection) {
    if (defined('TESTING') && TESTING === true) {
        // not upload photo
        echo "Not loaded photo : defined 'testing'\n";
        return ;
    }

//  $photo_url = 'http://img1.irradii.com/photo/';
  $photo_path = 's3://props3photos/photo/';

  // get and put on S3 only first photo here
  $photos = $rets->GetObject("Property", "LargePhoto", $id, 0);
//  if (!file_exists($photo_path . $id)) {
//    mkdir($photo_path . $id, 0777, true);
//  }

    $temp = "";
      foreach ($photos as $photo) {
        if ($photo['Success'] == true) {
            $listing = $photo['Content-ID'];
            if($photo['Object-ID'] == 1 || $photo['Object-ID'] == '1') {
                break; // Only first photo
            }
            $path_comb = $photo_path . $id . "/image-".$id."-{$photo['Object-ID']}.jpg";
            file_put_contents($path_comb, $photo['Data']);
        }
        else {
            actlog("WARNING!!!! Photos: {$photo['ReplyCode']} = {$photo['ReplyText']}\n");
        }
      }

      $sql = "INSERT IGNORE INTO  `bucontra_propertyhookup`.`tbl_property_info_cron_load_photo` ( `mls_sysid` ) VALUES ( {$id} )";
      mysqli_query($connection,$sql);
    if(mysqli_errno($connection) != 0){
          echo mysqli_errno($connection) . ": " . mysqli_error($connection). "\n";
    }
    unset($photos);
    unset($photo);
}

function GetMLSProperties($rets, $class, $sql){
        $search = $rets->SearchQuery("Property", $class, '(' . $sql . ')', array('Limit' => 5000, 'Count' => 1, 'Select' => '*'));
        $error_info = $rets->Error();
        if ($error_info['type'] == "rets") {
            echo "RETS error in GetMLSProperties (code {$error_info['code']}): {$error_info['text']}";
        }
        unset($error_info);
        return $search;
}

function GetMLSPropertiesCount($rets, $class, $sql) {
    $search = $rets->SearchQuery("Property", $class, '('.$sql.')', array('Limit' => 5000, 'Count' => 1, 'Select' => 'Matrix_Unique_ID'));
  return $search;
}

//Saving phase

function DBSave($record, $class, $connection) {
    $id = PropertyInfoSave($record, $connection);
    if(!empty($id)) {
        makePropertyInfoSlug($connection, $id);
    }
    unset($id);
  echo 'MLS Date uploaded '. $record['MatrixModifiedDT'], "\n";
}

function PropertyInfoSave($record, $connection) {
    echo __FUNCTION__, "\n";
        if ($record['HeatingFuel'] != '') {
            $record['HeatingFuel'] = 'Heating: ' . $record['HeatingFuel'];  //Check heating text
        }

        if ($record['CoolingDescription'] != '') {
            $record['CoolingDescription'] = 'Cooling: ' . $record['CoolingDescription'];  //Check cooling text
        }

        $description_comb = fixDataString($record['BuiltDescription'].' '.$record['HomeownerAssociationName'].', '.$record['Type'].' '.$record['BuildingDescription'].' '.$record['PropertySubType'].' '.$record['SpaDescription'].', '.$record['ConstructionDescription'].' construction '.$record['PropertyCondition']); //Build Main Description

        $heating_features_comb = fixDataString($record['HeatingDescription'].";".$record['HeatingFuel']); //Build Heating Features

        $schools_comb = fixDataString($record['ElementarySchool35'].' Elementary; '.$record['JrHighSchool'].' Middle School; '.$record['HighSchool']);  //Schools list

        $interior_features_comb = fixDataString($record['Interior'].','.$record['BathDownstairsDescription'].', '.$record['WasherDryerLocation'].', '.$record['DiningRoomDescription'].' '.$record['DiningRoomDimensions'].', '.$record['FamilyRoomDescription'].' '.$record['FamilyRoomDimensions'].', '.$record['KitchenDescription'].', '.$record['OvenDescription'].', '.$record['LivingRoomDescription'].' '.$record['LivingRoomDimensions'].', '.$record['MasterBathDescription'].', '.$record['MasterBedRoomDescription'].', '.$record['FlooringDescription'].', '.$record['CoolingFuel'].', '.$record['FurnishingsDescription']);  //Interior Description build

        $interior_features2_comb = fixDataString($record['GreatRoomDescription'].' '.$record['GreatRoomDimensions'].', '.$record['MasterBedRoomDescription'].' '.$record['MasterBedRoomDimensions'].', '.$record['2ndBedroomDescription'].' '.$record['OvenDescription'].', '.$record['3rdBedroomDescription'].' '.$record['3rdBedroomDimensions'].', '.$record['4thBedroomDescription'].' '.$record['4thBedroomDimensions'].', '.$record['5thBedroomDescription'].' '.$record['5thBedroomDimensions'].', '.$record['LoftDescription'].' '.$record['LoftDimensions'].', '.$record['UnitDescription'].', '.$record['MiscellaneousDescription']);  //Interior Description2 build

        $exterior_features_comb = fixDataString($record['ExteriorDescription'].', '.$record['Fence'].' '.$record['FenceType'].', '.$record['LandscapeDescription'].', '.$record['EnergyDescription']);  //Exterior Description build

        $exterior_features2_comb = fixDataString($record['Zoning'].', '.$record['LandUse'].' '.$record['FenceType'].', '.$record['ExteriorDescription'].', '.$record['LandscapeDescription'].', '.$record['UtilityInformation'].', '.$record['EnergyDescription']);  //Exterior Description2 build
        if ($record['AssociationFeeYN'] == false) {
            $community_features_comb = $record['AssociationFeaturesAvailable'];  //Assoc Description build
        } else {
            $community_features_comb = '$'.$record['AssociationFee1'].' '.$record['AssociationFee1MQYN'].' '.$record['AssociationName'].' Association Fee Includes '.$record['AssociationFeeIncludes'].' '. $record['AssociationFeaturesAvailable'];  //Assoc Description build
        }
        $community_features_comb = fixDataString($community_features_comb);
        $property_features_comb = fixDataString($record['BuiltDescription'].' '.$record['Builder'] .' '.$record['Model'].' model featuring '.$record['GarageDescription'].', '.$record['UtilityInformation'].', '.$record['HeatingFuel'].', '.$record['CoolingFuel'].', '.$record['CoolingDescription'].', '.$record['Water'].' water, '.$record['EnergyDescription'].', '.$record['HouseViews'].', '.$record['FurnishingsDescription']);  //Property Features build

        $ac_system_comb = fixDataString($record['CoolingDescription'] . ' ' . $record['CoolingFuel']);  //AC

        $plumbing_system_comb = fixDataString($record['Water'] . ' water, ' . $record['Sewer'] . ' sewer; ' . $record['WaterHeaterDescription']);  //plumbing list

        $property_type_mls = $record['PropertyType'];
        if($record['Status'] == 'Pending'){
            $record['Status'] = 'Pending Offer';
        } else if ($record['Status'] == 'Withdrawn'){
            $record['Status'] = 'Withdrawn Unconditional';
        } else if ($record['Status'] == 'Incomplete'){
            $record['Status'] == 'Expired';
        } else if(
            ($record['Status'] == "Active" ||
                $record['Status'] == "Active-Exclusive Right" ||
                $record['Status'] == "For Sale" ||
                $record['Status'] == "Active-Exclusive Agency") &&
            ($record['AuctionType'] == 'Absolute' ||
                $record['AuctionType'] == 'Reserve' ||
                $record['ListingAgreementType'] == "Auction")
        ){
            $record['Status'] = "Auction";
        }

        if ($record['PropertySubType'] == 'Townhouse') {
            $record['PropertyType'] = 3;
        } else if ($record['PropertySubType'] == 'Single Family Residential') {
            $record['PropertyType'] = 1;
        } else if ($record['PropertySubType'] == 'Condominium') {
            $record['PropertyType'] = 2;
        } else if ($record['PropertyType'] == 'Builder') {
            $record['PropertyType'] = 15;
        } else if ($record['PropertyType'] == 'Vacant/Subdivided Land') {
            $record['PropertyType'] = 5;
        } else if ($record['PropertyType'] == 'Multiple Dwelling') {
            $record['PropertyType'] = 4;
        } else if ($record['PropertyType'] == 'Residential') {
            $record['PropertyType'] = 1;
        } else if ($record['PropertyType'] == 'Residential Rental') {
            $record['PropertyType'] = 9;
        } else if ($record['PropertyType'] == 'High Rise') {
            $record['PropertyType'] = 16;
        }

        if ($record['BuiltDescription'] == 'High Rise') {
            $record['PropertyType'] = 16;
        }

        if ($record['Manufactured'] == 1) {
            $record['PropertyType'] = 7;
        } else if ($record['ConvertedtoRealProperty'] == 1) {
            $record['PropertyType'] = 7;
        } else if ($record['PropertySubType'] == 'Manufactured Home') {
            $record['PropertyType'] = 7;
        } else if ($record['Ownership'] == 'Manufactured') {
            $record['PropertyType'] = 7;
        } else if (preg_match("/Manufactured/", $record['PropertyDescription'])) {
            $record['PropertyType'] = 7;
        } else if (preg_match("/Trlr Est/", $record['SubdivisionName'])) {
            $record['PropertyType'] = 7;
        } else if (preg_match("/Manufactured/", $record['BuildingDescription'])) {
            $record['PropertyType'] = 7;
        } else if (preg_match("/Modular/", $record['BuildingDescription'])) {
            $record['PropertyType'] = 7;
        } //Sets specific Property Type to Manufactured

        if (preg_match("/mobile/", $record['SubdivisionName'])) {
            $record['PropertyType'] = 6;
        } else if (preg_match("/Mobile/", $record['SubdivisionName'])) {
            $record['PropertyType'] = 6;
        } else if (preg_match("/Mobil/", $record['LandUse'])) {
            $record['PropertyType'] = 6;
        } else if (preg_match("/Trailer/", $record['LandUse'])) {
            $record['PropertyType'] = 6;
        } //Sets specific Property Type to Mobile

        if (preg_match("/Duplex/", $record['Ownership'])) {
            $record['PropertyType'] = 4;
        } else if (preg_match("/Triplex/", $record['Ownership'])) {
            $record['PropertyType'] = 4;
        } else if (preg_match("/Four-Plex/", $record['Ownership'])) {
            $record['PropertyType'] = 4;
        } //Sets specific Property Type to MultiFamily

        $first_sale_type = 2;

        if ($record['SaleType'] == 'Other') {
            $record['SaleType'] = 7;
        } else if ($record['SaleType'] == 'Traditional Sale') {
            $record['SaleType'] = 1;
        } else if ($record['SaleType'] == 'Short Sale') {
            $record['SaleType'] = 2;
        } else if ($record['ForeclosureCommencedYN'] == 1) {
            $record['SaleType'] = 3;
        } else if ($record['SaleType'] == 'Court Ordered Sale') {
            $record['SaleType'] = 4;
        } else if ($record['SaleType'] == 'Estate Sale') {
            $record['SaleType'] = 5;
        } else if ($record['SaleType'] == 'REO Sale') {
            $record['SaleType'] = 6;
        } else if ($record['RepoReoYN'] == 1) {
            $record['SaleType'] = 6;
        } else if ($record['SaleType'] == 'Corporate Relocation Sale') {
            $record['SaleType'] = 6;
        } else if($record['SaleType'] == 'For Saleby Owner '){
            $first_sale_type = 1;
            $record['SaleType'] = 1;
        } else if ($record['SaleType'] == ''){
            $first_sale_type = 2;
            $record['SaleType'] = 1;
        }//Set Specific Sale Types

        if (preg_match("/na/", $record['UnitNumber']) or
            preg_match('/N\/A/', $record['UnitNumber']) or
            preg_match("/ 0 /", $record['UnitNumber']) or
            preg_match("/non/", $record['UnitNumber']) or
            preg_match('/N\/a/', $record['UnitNumber']) or
            preg_match("/ NA /", $record['UnitNumber']) or
            preg_match('/ n\/a /', $record['UnitNumber']) or
            preg_match("/ n /", $record['UnitNumber']) or
            preg_match("/ - /", $record['UnitNumber'])
        ) {
            $record['UnitNumber'] = '';
        } //Clear Problem Address Characters

        if (preg_match("/na/", $record['BuildingNumber']) or
            preg_match('/N\/A/', $record['BuildingNumber']) or
            preg_match("/ 0 /", $record['BuildingNumber']) or
            preg_match("/non/", $record['BuildingNumber']) or
            preg_match('/N\/a/', $record['BuildingNumber']) or
            preg_match("/ NA /", $record['BuildingNumber']) or
            preg_match('/ n\/a /', $record['BuildingNumber']) or
            preg_match("/ n /", $record['BuildingNumber']) or
            preg_match("/ - /", $record['BuildingNumber'])
        ) {
            $record['BuildingNumber'] = '';
        } //Clear Problem Address Characters

        if (preg_match("/Fixer-Upper/", $record['PropertyDescription'])) {
            $record['PropertyCondition'] = 'Poor';
        } //Condition

        $address = $record['PublicAddress'];
        if ($address == '') {
            if(!empty($record['StreetNumber'])){
                $address .= ' ' .$record['StreetNumber'];
            }
            if(!empty($record['StreetName'])){
                $address .= ' ' .$record['StreetName'];
            }
            if(!empty($record['BuildingNumber'])){
                $address .= ' ' .$record['BuildingNumber'];
            }
            if(!empty($record['UnitNumber'])){
                $address .= ' ' .$record['UnitNumber'];
            }
        } //Compile Address
        $address = fixDataString($address);
        $price = $record['CurrentPrice'];
        if ($price == '') {
            $price = $record['ListPrice'];
        } //Set Price

        $daysFromListingToClose = '';
        if(!empty($record['CloseDate']) && $record['ListingContractDate']){
            $daysFromListingToClose = (strtotime($record['CloseDate'])-strtotime($record['ListingContractDate']))/86400;
        };
    
        $result_zipcode_check = getZipId($record['PostalCode'], $connection);
        $zip_id = $result_zipcode_check['zip_id'];
        $city_id = $result_zipcode_check['cityid'];
        $county_id = $result_zipcode_check['county_id'];
        $state_id = $result_zipcode_check['state_id'];
        $insertdate = date("Y-m-d H:i:s");
        $expiredate = date("Y-m-d", strtotime("+6 months", strtotime("now")));

        $record['ThreeQtrBaths'] = $record['ThreeQtrBaths'] == '' ? 0 : $record['ThreeQtrBaths'];
        $record['ForeclosureCommencedYN'] = $record['ForeclosureCommencedYN'] ? 'Yes' : 'No';
        $record['ShortSale'] = $record['ShortSale'] ? 'Yes' : 'No';
        $record['Location'] = !empty($record['Location']) ? $record['Location'] : NULL;
        $record['ElevatorFloorNum'] = !empty($record['ElevatorFloorNum']) ? $record['ElevatorFloorNum'] : NULL;
        $record['HomeProtectionPlan'] = !empty($record['HomeProtectionPlan']) ? $record['HomeProtectionPlan'] : NULL;
        $record['GreatRoomDescription'] = !empty($record['GreatRoomDescription']) ? 'Yes' : 'No';
        $record['UnitPoolIndoorYN'] = !empty($record['UnitPoolIndoorYN']) ? 'Yes' : 'No';
        $record['UnitSpaIndoor'] = !empty($record['UnitSpaIndoor']) ? 'Yes' : 'No';
        $record['ConvertedGarageYN'] = !empty($record['ConvertedGarageYN']) ? 'Yes' : 'No';
        $record['AssessmentYN'] = !empty($record['AssessmentYN']) ? 'Yes' : 'No';
        $record['SIDLIDYN'] = !empty($record['SIDLIDYN']) ? 'Yes' : 'No';
        $record['CourtApproval'] = !empty($record['CourtApproval']) ? 'Yes' : 'No';
        $record['GreatRoom'] = $record['GreatRoomDescription'] ? 1 : 0;
        $record['ForeclosureCommencedYN'] = $record['ForeclosureCommencedYN'] ? 'Yes' : 'No';
        $record['ShortSale'] = $record['ShortSale'] ? 'Yes' : 'No';
//    $photo = 'http://www.propertyhookup.com/admin/photos/' . $record['sysid'] . '/image-'.$record['sysid'].'-1.jpg';
        $firstPhoto = GetUrlPhoto($record['Matrix_Unique_ID']);
        $lot_acreage = $record['ApproxAddlLivArea'];
        if (!$lot_acreage && $record['PropertyType'] != 2) {
            $lot_sqft = $record['LotSqft'];
            $lot_acreage = $lot_sqft / 43560;
        }
//        actlog(array(
//            'property_street'=>$address,
//            'description'=>$description_comb,
//            'schools'=>$schools_comb,
//            'property_features'=>$property_features_comb,
//            'building_description'=>$record['BuildingDescription'],
//            'LotDescription'=>$record['LotDescription'],
//            'ac_system'=>$ac_system_comb,
//            'heating_features'=>$heating_features_comb,
//        ));
        $city = $record['City'] ? $record['City'] : $record['Town'];
    // insert into property_info and others
    $mid = getUserID($record['AgentEmail'], $record['AgentFirstName'], $record['AgentOfficePhone'], $connection);
    $sql = "INSERT INTO `bucontra_propertyhookup`.`property_info` SET 
              `mls_sysid` = '$record[Matrix_Unique_ID]',
              `mls_name` = '$record[ResourceName]',
              `area` = '$record[Area]',
              `bathrooms` = '$record[BathsTotal]',
              `description`= '$description_comb',
              `property_fetatures`= '$property_features_comb',
              `bedrooms` = '$record[BedsTotal]',
              `property_title` = '$record[Highlights]',
              `building_description` = '$record[BuildingDescription]',
              `building_number` = '$record[BuildingNumber]',
              `community_name` = '$record[CommunityName]',
              `converted_to_real_property` = '$record[ConvertedtoRealProperty]',
              `property_price` = '$price',
              `elevator_floor` = '$record[ElevatorFloorNum]',
              `garages` = '$record[Garage]',
              `location` = '$record[Location]',
              `manufactured` = '$record[Manufactured]',
              `lot_acreage` = '$record[NumAcres]',
              `ownership` = '$record[Ownership]',
              `property_zipcode`='$zip_id',
              `community_features` = '$community_features_comb',
              `property_type` = '$record[PropertyType]',
              `pool` = '$record[PvPool]',
              `property_uploaded_date`='$insertdate',
              `property_expire_date`='$expiredate',
              `property_updated_date` = '$record[MatrixModifiedDT]',
              `house_square_footage` = '$record[SqFtTotal]',
              `street_name` = '$record[StreetName]',
              `street_number` = '$record[StreetNumber]',
              `subdivision` = '$record[SubdivisionName]',
              `sub_type` = '$record[Type]',
              `photo1`='$firstPhoto',
              `year_biult_id` = '$record[YearBuilt]',
              `property_state_id` = '$state_id',
              `property_county_id` = '$county_id',
              `property_city_id` = '$city_id',
              `property_street` = '$address',
              `property_status` = 'Active',
              `schools`='$schools_comb',
              `property_type_mls`='$property_type_mls',
              `user_session_id` = 0,
              `mid` = '$mid',
              `public_remarks` = '$record[PublicRemarks]'
            ";

              // 'mid' = '$record[]',

//        $sql = "SHOW COLUMNS FROM brokerage_join;"; //fetch columns-name from DB Irradii
        mysqli_query($connection, $sql);
//
//        while($row = $res->fetch_row()){
//            writeToExampleProperties($row[0]);   // Dev-info log
//        }
        if(mysqli_errno($connection) != 0){
            actlog(mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n");
        }

        $id = mysqli_insert_id($connection);
//        writeToExampleProperties($id.' saved');  // Dev-info log

        $sql = "INSERT INTO `bucontra_propertyhookup`.`property_info_cron_estimated_price`
(`property_zipcode`) VALUES
('$zip_id')";

        mysqli_query($connection,$sql);
    if(mysqli_errno($connection) != 0){
       actlog(mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n");
    }
        $sql = "INSERT INTO `bucontra_propertyhookup`.`property_info_details` SET
                `property_id` = $id,
                `stories` = '$record[BuildingDescription]',
                `spa` = '$record[Spa]',
                `apt_suite` = '$record[UnitNumber]',
                `amenities_stove_id` = '$record[Range]',
                `amenities_refrigerator` = '$record[RefrigeratorYN]',
                `amenities_dishwasher` = '$record[DishwasherYN]',
                `amenities_washer_id` = '$record[Washer]',
                `amenities_fireplace_id` = '$record[Fireplaces]',
                `amenities_parking_id` = '$record[NumParking]',
                `amenities_microwave` = 0,
                `amenities_gated_community` = '$record[GatedYN]',
                `interior_features` = '$interior_features_comb',
                `exterior_features` = '$exterior_features_comb',
                `first_sale_type` = '$first_sale_type',
                `second_sale_type` = '$record[SaleType]',
                `property_repair_price` = 0,
                `reference` = 'FROM_GLVAR_FEED',
                `lot_sqft` = '$record[LotSqft]',
                `lot_depth` = '$record[LotDepth]',
                `lot_frontage` = '$record[LotFrontage]',
                `subdivision_name_xp` = '$record[SubdivisionName]',
                `city` = '$record[City]',
                `town` = '$record[Town]',
                `county` = '$record[CountyOrParish]',
                `subdivision_number` = '$record[SubdivisionNumber]',
                `subdivision_num_search` = '$record[SubdivisionNumSearch]',
                `metro_map_coor` = '$record[MetroMapCoorXP]',
                `metro_map_page` = '$record[MetroMapPageXP]',
                `metro_map_coor_xp` = '$record[MetroMapCoorXP]',
                `metro_map_page_xp` = '$record[MetroMapPageXP]',
                `add_liv_area` = '$record[ApproxAddlLivArea]',
                `total_liv_area` = '$record[ApproxTotalLivArea]',
                `mh_year_built` = '$record[MHYrBlt]',
                `beds_total_poss` = '$record[Fence]',
                `pool_indoor` = '$record[UnitPoolIndoorYN]',
                `spa_indoor` = '$record[UnitSpaIndoor]',
                `model` = '$record[Model]',
                `built_desc` = '$record[BuiltDescription]',
                `prop_desc` = '$record[PropertyDescription]',
                `parking_spaces` = '$record[NumofParkingSpacesIncluded]',
                `carport_type` = '$record[CarportDescription]',
                `converted_garage` = '$record[ConvertedGarageYN]',
                `studio` = '$record[StudioYN]',
                `condo_conversion` = '$record[CondoConversionYN]',
                `unit_desc` = '$record[UnitDesc]',
                `compass_point` = '$record[PrimaryViewDirection]',
                `house_faces` = '$record[HouseFaces]',
                `house_views` = '$record[HouseViews]',
                `jr_high_school` = '$record[JrHighSchool]',
                `high_school` = '$record[HighSchool]',
                `elementary_school` = '$record[ElementarySchoolK2]',
                `association_features_available` = '$record[AssociationFeaturesAvailable]',
                `association_fee_1` = '$record[AssociationFee1]',
                `association_fee_1_type` = '$record[AssociationFee1MQYN]',
                `association_name` = '$record[AssociationName]',
                `association_fee_includes` = '$record[AssociationFeeIncludes]',
                `assessment` = '$record[AssessmentYN]',
                `assessment_amount` = '$record[AssessmentBalance]',
                `assessment_amount_type` = '$record[AssessmentType]',
                `sidlid` = '$record[SIDLIDYN]',
                `sidlid_annual_amount` = '$record[SIDLIDAnnualAmount]',
                `sidlid_balance` = '$record[SIDLIDBalance]',
                `association_fee_2` = '$record[AssociationFee2]',
                `association_fee_2_type` = '$record[AssociationFee2MQYN]',
                `master_plan_fee_amount` = '$record[MasterPlanFeeAmount]',
                `master_plan_fee_type` = '$record[MasterPlanFeeMQYN]',
                `security` = '$record[Security]',
                `hoa_minimum_rental_cycle` = '$record[HOAMinimumRentalCycle]',
                `age_restricted_community` = '$record[AgeRestrictedCommunityYN]',
                `services_available_on_site` = '$record[ServicesAvailableOnSite]',
                `on_site_staff` = '$record[OnSiteStaff]',
                `on_site_staff_includes` = '$record[OnSiteStaffIncludes]',
                `association_phone` = '$record[AssociationPhone]',
                `restrictions` = '$record[LeaseDescription]',
                `prop_amenities_description` = '$record[PropAmenitiesDescription]',
                `maintenance` = '$record[Maintenance]',
                `management` = '$record[Management]',
                `num_terraces` = '$record[NumTerraces]',
                `terrace_total_sqft` = '$record[TerraceTotalSqft]',
                `terrace_location` = '$record[TerraceLocation]',
                `storage_unit_desc` = '$record[StorageUnitDesc]',
                `storage_units_num` = '$record[NumStorageUnits]',
                `storage_unit_dim` = '$record[StorageUnitDim]',
                `storage_secure` = '$record[StorageSecure]',
                `lot_description` = '$record[LotDescription]',
                `carport` = '$record[Carports]',
                `parking_description` = '$record[ParkingDescription]',
                `fence` = '$record[Fence]',
                `fence_type` = '$record[FenceType]',
                `energy_description` = '$record[EnergyDescription]',
                `pool_length` = '$record[PoolLength]',
                `pool_width` = '$record[PoolWidth]',
                `pool_description` = '$record[PoolDescription]',
                `spa_description` = '$record[SpaDescription]',
                `equestrian_description` = '$record[EquestrianDescription]',
                `dishwasher_description` = '$record[DishwasherDescription]',
                `disposal_included` = '$record[DisposalYN]',
                `refrigerator_description` = '$record[RefrigeratorDescription]',
                `dryer_included` = '$record[DryerIncluded]',
                `washer_dryer_location` = '$record[WasherDryerLocation]',
                `dryer_utilities` = '$record[DryerUtilities]',
                `fireplace_location` = '$record[FireplaceLocation]',
                `court_approval` = '$record[CourtApproval]'
              ";

                $bedroom_2nd_description = $record['2ndBedroomDescription'];
                $bedroom_2nd_dimensions = $record['2ndBedroomDimensions'];
                $bedroom_3rd_description = $record['3rdBedroomDescription'];
                $bedroom_3rd_dimensions = $record['3rdBedroomDimensions'];
                $bedroom_4th_description = $record['4thBedroomDescription'];
                $bedroom_4th_dimensions = $record['4thBedroomDimensions'];
                $bedroom_5th_description = $record['5thBedroomDescription'];
                $bedroom_5th_dimensions = $record['5thBedroomDimensions'];

        mysqli_query($connection,$sql);
    if(mysqli_errno($connection) != 0){
        actlog(mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n");
    }

        $sql = "INSERT INTO `bucontra_propertyhookup`.`property_info_additional_details` SET
                    `property_id` = $id,
                    `over_all_property` = '$record[PropertyCondition]',
                    `exterior_structure` = '$record[ConstructionDescription]',
                    `roof` = '$record[RoofDescription]',
                    `ac_system` = '$ac_system_comb',
                    `electrical_system` = '$record[Electricity]',
                    `interior_structure` = '$record[AccessibilityFeatures]',
                    `plumbing_system` = '$record[Water]',
                    `kitchen` = '$record[KitchenDescription]',
                    `kitchen_countertops` = '$record[KitchenCountertops]',
                    `numdenother` = '$record[NumDenOther]',
                    `numloft` = '$record[NumLoft]',
                    `bath_downstairs` = '$record[BathDownYN]',
                    `bedroom_downstairs` = '$record[BedroomDownstairsYN]',
                    `great_room` = '$record[GreatRoom]',
                    `baths_34` = '$record[ThreeQtrBaths]',
                    `full_baths` = '$record[BathsFull]',
                    `half_bath` = '$record[BathsHalf]',
                    `interior_description` = '$record[Interior]',
                    `bath_downstairs_description` = '$record[BathDownstairsDescription]',
                    `dining_room_description` = '$record[DiningRoomDescription]',
                    `dining_room_dimensions` = '$record[DiningRoomDimensions]',
                    `family_room_description` = '$record[FamilyRoomDescription]',
                    `family_room_dimensions` = '$record[FamilyRoomDimensions]',
                    `living_room_description` = '$record[LivingRoomDescription]',
                    `living_room_dimensions` = '$record[LivingRoomDimensions]',
                    `master_bath_description` = '$record[MasterBedRoomDimensions]',
                    `flooring_description` = '$record[FlooringDescription]',
                    `furnishings_description` = '$record[FurnishingsDescription]',
                    `great_room_dimensions` = '$record[GreatRoomDimensions]',
                    `master_bedroom_description` = '$record[MasterBedRoomDescription]',
                    `exterior_grounds`= '$record[LandscapeDescription]',
                    `master_bedroom_dimensions` = '$record[MasterBedRoomDimensions]',
                    `bedroom_2nd_description` = '$bedroom_2nd_description',
                    `bedroom_2nd_dimensions` = '$bedroom_2nd_dimensions',
                    `bedroom_3rd_description` = '$bedroom_3rd_description',
                    `bedroom_3rd_dimensions` = '$bedroom_3rd_dimensions',
                    `bedroom_4th_description` = '$bedroom_4th_description',
                    `bedroom_4th_dimensions` = '$bedroom_4th_dimensions',
                    `bedroom_5th_description` = '$bedroom_5th_description',
                    `bedroom_5th_dimensions` = '$bedroom_5th_dimensions',
                    `num_of_loft_areas` = '$record[NumofLoftAreas]',
                    `loft_description` = '$record[LoftDescription]',
                    `loft_dimensions` = '$record[LoftDimensions]',
                    `unit_description` = '$record[UnitDescription]',
                    `miscellaneous_description` = '$record[MiscellaneousDescription]',
                    `pets_allowed` = '$record[PetsAllowed]',
                    `pet_description` = '$record[PetDescription]',
                    `weight_limit` = '$record[WeightLimit]',
                    `number_of_pets` = '$record[NumberofPets]',
                    `denother_dimensions` = '$record[DenDimensions]'
                ";

        mysqli_query($connection, $sql);
    if(mysqli_errno($connection) != 0){
        actlog(mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n");
    }
        if (mysqli_errno($connection)) {
            echo $sql, PHP_EOL;
        }

        $sql = "INSERT INTO `bucontra_propertyhookup`.`property_info_additional_brokerage_details` SET
                    `property_id` = $id,
                    `status` = '$record[Status]',
                    `fireplace_features` = '$record[FireplaceDescription]',
                    `heating_features` = '$heating_features_comb',
                    `exterior_construction_features` = '$record[ConstructionDescription]',
                    `roofing_features` = '$record[RoofDescription]',
                    `interior_features` = '$record[Interior]',
                    `exterior_features` = '$record[ExteriorDescription]',
                    `sales_history` = '$record[SoldTerm]',
                    `tax_history` = '$record[AnnualPropertyTaxes]',
                    `foreclosure` = '$record[ForeclosureCommencedYN]',
                    `short_sale` = '$record[ShortSale]',
                    `page_link` = '$record[VirtualTourLink]',
                    `brokerage_mid` = 0,
                    `commission_variable` = NULL,
                    `commission_excluded` = NULL,
                    `mls_id` = '$record[MLSNumber]',
                    `pagent_name` = '$record[ListAgentFullName]',
                    `pagent_phone` = '$record[ListAgentDirectWorkPhone]',
                    `pagent_phone_fax` = '$record[AgentFaxPhone]',
                    `pagent_phone_mobile` = '$record[AgentOfficePhone]',
                    `pagent_website` = '$record[OfficeWebPageAddress]',
                    `list_agent_public_id` = '$record[ListAgentMLSID]',
                    `email` = '$record[AgentEmail]',
                    `buyer_broker_code` = '$record[SellingOfficeMLSID]',
                    `buyer_agent_public_id` = '$record[SellingAgentMLSID]',
                    `lo_phone` = '$record[ListOfficePhone]',
                    `list_office_code` = '$record[ListOfficeMLSID]',
                    `owner_licensee` = '$record[OwnerLicensee]',
                    `realtor` = '$record[RealtorYN]',
                    `sale_office_bonus` = '$record[SaleOfficeBonusYN]',
                    `home_protection_plan` = '$record[HomeProtectionPlan]',
                    `open_house_flag` = '$record[ActiveOpenHouseCount]',
                    `list_date` = '$record[ListingContractDate]',
                    `list_price` = '$record[ListPrice]',
                    `original_list_price` = '$record[OriginalListPrice]',
                    `pricechgdate` = '$record[PriceChgDate]',
                    `sale_price` = '$record[ClosePrice]',
                    `previous_price` = '$record[LastListPrice]',
                    `status_updates` = '$record[StatusUpdate]',
                    `t_status_date` = '$record[TStatusDate]',
                    `internet` = '$record[InternetYN]',
                    `idx` = '$record[IDXOptInYN]',
                    `images` = '$record[PhotoCount]',
                    `photo_excluded` = '$record[PhotoExcluded]',
                    `photo_instructions` = '$record[PhotoInstructions]',
                    `last_image_trans_date` = '$record[PhotoModificationTimestamp]',
                    `lpsqft_wcents` = '$record[RATIO_CurrentPrice_By_SQFT]',
                    `lpsqft` = '$record[RATIO_CurrentPrice_By_SQFT]',
                    `spsqft_wcents` = '$record[RATIO_ClosePrice_By_ListPrice]',
                    `splp` = '$record[RATIO_ClosePrice_By_ListPrice]',
                    `public_address` = '$record[PublicAddressYN]',
                    `avm` = '$record[AVMYN]',
                    `directions` = '$record[Directions]',
                    `contingency_desc` = '$record[ContingencyDesc]',
                    `temp_off_mrkt_status_desc` = '$record[TempOffMrktStatusDesc]',
                    `statuschangedate` = '$record[StatusChangeTimestamp]',
                    `entry_date` = '$record[OriginalEntryTimestamp]',
                    `dom` = '$record[DOM]',
                    `est_clolse_dt` = '$record[EstCloLsedt]',
                    `actual_close_date` = '$record[CloseDate]',
                    `package_available` = '$record[PackageAvailable]',
                    `property_insurance` = '$record[PropertyInsurance]',
                    `sold_appraisal` = '$record[SoldAppraisal_NUMBER]',
                    `sold_down_payment` = '$record[SoldDownPayment]',
                    `earnest_deposit` = '$record[EarnestDeposit]',
                    `sellers_contribution` = '$record[SellerContribution]',
                    `financing_considered` = '$record[FinancingConsidered]',
                    `amt_owner_will_carry` = '$record[AmtOwnerWillCarry]',
                    `existing_rent` = '$record[ExistingRent]',
                    `nod_date` = '$record[NODDate]',
                    `reporeo` = '$record[RepoReoYN]',
                    `auction_date` = '$record[AuctionDate]',
                    `auction_type` = '$record[AuctionType]',
                    `additional_au_sold_terms` = '$record[AdditionalAUSoldTerms]',
                    `litigation` = '$record[Litigation]',
                    `litigation_type` = '$record[LitigationType]',
                    `studio_rent` = '$record[ROOMRent]',
                    `cap_rate` = '$record[CapRate]',
                    `gross_rent_multiplier` = '$record[GrossRentMultiplier]',
                    `owner_will_carry` = '$record[OwnerWillCarry]',
                    `current_loan_assumable` = '$record[CurrentLoanAssumable]',
                    `cash_to_assume` = '$record[CashtoAssume]',
                    `cost_per_unit` = '$record[CostperUnit]',
                    `gross_operating_income` = '$record[GrossOperatingIncome]',
                    `yearly_operating_income` = '$record[YearlyOperatingIncome]',
                    `tenant_pays` = '$record[TenantPays]',
                    `other_income_description` = '$record[OtherIncomeDescription]',
                    `noi` = '$record[NOI]',
                    `yearly_operating_expense` = '$record[YearlyOperatingExpense]',
                    `yearly_other_income` = '$record[YearlyOtherIncome]',
                    `other_encumbrance_desc` = '$record[OtherEncumbranceDesc]',
                    `expense_source` = '$record[ExpenseSource]',
                    `service_contract_inc` = '$record[ServiceContractInc]',
                    `parcel_num` = '$record[ParcelNumber]',
                    `tax_district` = '$record[TaxDistrict]',
                    `assessed_imp_value` = '$record[AssessedImpValue]',
                    `assessed_land_value` = '$record[AssessedLandValue]',
                    `block_number` = '$record[BlockNumber]',
                    `lot_number` = '$record[LotNumber]',
                    `last_transaction_code` = '$record[TransactionType]',
                    `last_transaction_date` = '$record[LastChangeTimestamp]',
                    `active_dom` = '$record[DOM]',
                    `days_from_listing_to_close` = '$daysFromListingToClose',
                    `acceptance_date` = '$record[PendingDate]',
                    `possession_description` = '$record[SoldLeaseDescription]',
                    `commentary` = '$record[AdministrationInformation]',
                    `legal_location_range` = '$record[Range]',
                    `legal_lctn_range_search` = '$record[Range]',
                    `legal_location_section` = '$record[Section]',
                    `legal_lctn_section_search` = '$record[Section]',
                    `legal_location_township` = '$record[Township]',
                    `legal_lctntownship_search` = '$record[Township]'
                    ";
        mysqli_query($connection,$sql);
    if(mysqli_errno($connection) != 0){
        actlog(mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n");
    }
        if (mysqli_errno($connection)) {
            echo $sql, PHP_EOL;
        }

    $sql ="INSERT INTO `bucontra_propertyhookup`.`brokerage_join` SET
                `mid` = '$mid',
                `brokerage_name` = '$record[OfficeDesignatedBrokerName]',
                `brokerage_phone` = '$record[OfficePhone]',
                `brokerage_address` = '$record[OfficeMailAddress]',
                `brokerage_zipcode` = '$record[OfficeMailPostalCode]',
                `brokerage_logo_image_link` = '$record[OfficeMailCity]',
                `brokerage_website_address` = '$record[OfficeWebPageAddress]',
                `brokerage_phone_fax` = '$record[AgentFaxPhone]',
                `timestamp` = '$record[LastChangeTimestamp]'
                ";
    mysqli_query($connection, $sql);
    if(mysqli_errno($connection) != 0){
        actlog(mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n");
    }
        $factors = searchFactors($connection, array(
            'property_type' => $record['PropertyType'],
            'property_zipcode' => $zip_id,
            'compass_point' => $record['PrimaryViewDirection'],
            'house_faces' => $record['HouseFaces'],
            'house_views' => $record['HouseViews'],
            'street_name' => $record['StreetName'],
            'pool' => $record['PvPool'],
            'spa' => $record['Spa'],
            'stories' => $record['BuildingDescription'],
            'lot_description' => $record['LotDescription'],
            'building_description' => $record['BuildingDescription'],
            'carport_type' => $record['CarportDescription'],
            'converted_garage' => $record['ConvertedGarageYN'],
            'exterior_structure' => $record['ConstructionDescription'],
            'roof' => $record['RoofDescription'],
            'electrical_system' => $record['Electricity'],
            'plumbing_system' => $record['Water'],
            'built_desc' => $record['BuiltDescription'],
            'prop_desc' => $record['PropertyDescription'],
            'over_all_property' => $record['PropertyCondition'],
            'foreclosure' => $record['ForeclosureCommencedYN'],
            'short_sale' => $record['ShortSale'],
            'sub_type' => $record['Type'],
            'studio' => $record['StudioYN'],
            'condo_conversion' => $record['CondoConversionYN'],
            'association_features_available' => $record['AssociationFeaturesAvailable'],
            'association_fee_1' => $record['AssociationFee1'],
            'assessment' => $record['AssessmentYN'],
            'sidlid' => $record['SIDLIDYN'],
            'parking_description' => $record['ParkingDescription'],
            'fence_type' => $record['FenceType'],
            'court_approval' => $record['CourtApproval'],
            'bath_downstairs' => $record['BathDownYN'],
            'bedroom_downstairs' => $record['BedroomDownstairsYN'],
            'great_room' => $record['GreatRoom'],
            'bath_downstairs_description' => $record['BathDownstairsDescription'],
            'flooring_description' => $record['FlooringDescription'],
            'furnishings_description' => $record['FurnishingsDescription'],
            'heating_features' => $heating_features_comb,
            'possession_description' => $record['SoldLeaseDescription'],
            'financing_considered' => $record['FinancingConsidered'],
            'reporeo' => $record['RepoReoYN'],
            'litigation' => $record['Litigation'],
        ));
        if (!empty($factors)) {
//            actlog($factors);
//            echo $factors . " property_id = " . $id, PHP_EOL;

            $sql = "update `bucontra_propertyhookup`.`property_info` set mid = ". $mid . $factors . " where property_id = " . $id;

            mysqli_query($connection,$sql );
            if(mysqli_errno($connection) != 0){
                actlog(mysqli_errno($connection) . ": " . mysqli_error($connection) . "\n");
            }
        }
        unset($description_comb);
        unset($heating_features_comb);
        unset($schools_comb);
        unset($interior_features_comb);
        unset($interior_features2_comb);
        unset($exterior_features_comb);
        unset($exterior_features2_comb);
        unset($community_features_comb);
        unset($property_features_comb);
        unset($ac_system_comb);
        unset($plumbing_system_comb);
        unset($property_type_mls);
        unset($first_sale_type);
        unset($address);
        unset($price);
        unset($daysFromListingToClose);
        unset($result_zipcode_check);
        unset($zip_id);
        unset($city_id);
        unset($county_id);
        unset($state_id);
        unset($insertdate);
        unset($expiredate);
        unset($firstPhoto);
        unset($lot_acreage);
        unset($lot_sqft);
        unset($city);
        unset($mid);
        return $id;


}

//Helpers

function GetUrlPhoto($id) {
    $url = 'http://img1.irradii.com/photo/';
    $photo = $url . $id . '/image-'.$id.'-0.jpg';
    return $photo;
}

function getZipId($postal_code, $connection) {

    $select_property_zipcode_id = mysqli_query($connection,"SELECT county.state_id,city.county_id,city.cityid, zipcode.zip_id FROM zipcode INNER JOIN city ON zipcode.cityid = city.cityid INNER JOIN county ON city.county_id=county.county_id where zip_code='".$postal_code."'");

    $numrows_zipcode_check = mysqli_num_rows($select_property_zipcode_id);
    if ($numrows_zipcode_check > 0) {
        $result_zipcode_check = mysqli_fetch_array($select_property_zipcode_id);
        return $result_zipcode_check;
    } else {
        return array(
          'zip_id' => '',
          'cityid' => '0',
          'county_id' => '0',
          'state_id' => '0'
            );
    }
}

function getUserID($email, $name, $phone, $connection) {
    $mid = 0;
//    $checksql = "select mid from `bucontra_propertyhookup`.`registration_step1` where `username`= '" . $record_2385 . "'";
    $checksql = "select id from `bucontra_propertyhookup`.`tbl_users` where `username`= '" . $email . "'";

    $result = mysqli_query($connection,$checksql);
    $num_results = mysqli_num_rows($result);
    if ($num_results > 0) {
      $row = mysqli_fetch_array($result);
      $mid = $row['id'];

//      getUserIDRepair($mid, $record_2385, $name, $phone, $connection);
    } else {
        $sql = "INSERT INTO `bucontra_propertyhookup`.`tbl_users` (`username`,`password`,`superuser`,`status`) "
                . "VALUES('$email','33f5b4c440a77f3743eb7545bae37805',0,1)"; // set password: User_123
        mysqli_query($connection, $sql);
        if(mysqli_errno($connection) != 0){
            actlog(mysqli_errno($connection) . ": tbl_users" . mysqli_error($connection) . "\n");
        }
        $mid = mysqli_insert_id($connection);

        $sql = "INSERT INTO `bucontra_propertyhookup`.`tbl_users_profiles`
        (`mid`,`first_name`,`phone_office`)
        VALUES('$mid', '$name','$phone')";
        mysqli_query($connection, $sql);
        if(mysqli_errno($connection) != 0){
            actlog(mysqli_errno($connection) . ":tbl_users_profiles " . mysqli_error($connection) . "\n");
        }

        $sql = "INSERT INTO `bucontra_propertyhookup`.`tbl_AuthAssignment` (`itemname`, `userid`, `bizrule`, `data`) VALUES
        ('AGENT', '$mid', NULL, 'N;')";
        mysqli_query($connection,$sql);
        if(mysqli_errno($connection) != 0){
            actlog(mysqli_errno($connection) . ":tbl_AuthAssigment " . mysqli_error($connection) . "\n");
        }

actlog('Add new user ' . $mid);
    }
    return $mid;
}

function searchFactors($connection, $maths = array()){
    $factors =  '';

    if(empty($maths)) {
        return $factors;
    }

    $whereStr = '';
    foreach ($maths as $key => $value) {
//        if(!empty($value)) {
            $orEmpty    = " OR ($key = '') OR ( $key IS NULL ) ";
            $orEmptyNum = " OR ($key = 0 ) OR ( $key IS NULL ) ";
            switch ($key) {
                // long string
                case 'house_views':
                case 'stories':
                case 'lot_description':
                case 'building_description':
                case 'exterior_structure':
                case 'roof':
                case 'electrical_system':
                case 'plumbing_system':
                case 'exterior_grounds':
                case 'prop_desc':
                case 'association_features_available':
                case 'flooring_description':
                case 'heating_features':
                case 'financing_considered':
                    if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                    $whereStr .= "((LOWER('$value') LIKE CONCAT('%',LOWER($key),'%')) $orEmpty) ";
                    break;
                // special
                case 'property_id':
                case 'fundamentals_factor':
                case 'conditional_factor':
                case 'estimated_price':
                case 'property_price':
                    break;
                case 'property_zipcode':
                    break;
                // numeric
                case 'association_fee_1':
                case 'pool':
                    if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                    $whereStr .= "(($key = '$value') $orEmptyNum) ";
                    break;

                case 'property_type':
                    if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                    $whereStr .= "(($key = '$value') ) ";
                    break;

                default:
                    if(!empty($whereStr)) { $whereStr .= ' AND ' ; }
                    $whereStr .= "((LOWER($key) = LOWER('$value')) $orEmpty) ";
                    break;
            }
//        }
    }
    if(!empty($whereStr)) {
        foreach (array('fundamentals_factor', 'conditional_factor') as $factor) {
            $sumFactor = getSumFactors($connection, $maths, $factor, $whereStr);
            $factors .= ", $factor = '$sumFactor'";
        }
    }
    return $factors ;
}

function getSumFactors($connection, $maths, $factor, $whereStr) {
    $row = array();
    $row0 = array();
    $rowSum = array();
    $minTcount = 3;

    $sql = "SELECT factor_value , id, compass_point, house_faces, house_views, street_name, pool, spa, stories, lot_description, building_description, carport_type, converted_garage, exterior_structure, roof, electrical_system, plumbing_system, built_desc, exterior_grounds, prop_desc, over_all_property, foreclosure, short_sale, sub_type "
            . "FROM market_trend_table WHERE (factor_value IS NOT NULL AND factor_value != 0.0 ) "
            . "AND ((property_zipcode = 0 ) OR ( property_zipcode IS NULL )) "
            . "AND factor_type = '{$factor}' "
            . "AND factor_included > 0 AND t_count >= {$minTcount} "
            . "AND $whereStr ";
//actlog($sql);
    $result = mysqli_query($connection,$sql);
    if(mysqli_errno($connection)) {
        echo mysqli_errno($connection) . ": $factor - market_trend_table " . mysqli_error($connection). "\n";
        return 0;
    } else {
        $num_results = mysqli_num_rows($result);
        if ($num_results > 0) {
            $row0 = getArrayResult($result);
        }
    }

    if(!empty($maths['property_zipcode'])) {
        $sql = "SELECT factor_value , id, compass_point, house_faces, house_views, street_name, pool, spa, stories, lot_description, building_description, carport_type, converted_garage, exterior_structure, roof, electrical_system, plumbing_system, built_desc, exterior_grounds, prop_desc, over_all_property, foreclosure, short_sale, sub_type "
                . "FROM market_trend_table WHERE (factor_value IS NOT NULL AND factor_value != 0.0 ) "
                . "AND (property_zipcode = {$maths['property_zipcode']}) "
                . "AND factor_type = '{$factor}' "
                . "AND factor_included > 0 AND t_count >= {$minTcount} "
                . "AND $whereStr ";
//actlog($sql);
        $result = mysqli_query($connection, $sql);

        if(mysqli_errno($connection)) {
            echo mysqli_errno($connection) . ": $factor - market_trend_table " . mysqli_error($connection). "\n";
            return 0;
        } else {
            $num_results = mysqli_num_rows($result); 
            if ($num_results > 0) {
                $row = getArrayResult($result);
            }
        }
    }
    
    if(!empty($row) && !empty($row0)){
        foreach ($row0 as $key0 => $value0) {
            foreach ($row as $key => $value) {
                $equal = true;
                foreach ($value as $col => $valueCol) {
                    if($col == 'factor_value' || $col == 'id') continue;
                    if($value0[$col] !== $value[$col]) {
                        $equal = false;
                    }
                }
                if($equal) {
                    break;
                }
            }
            if(!$equal) {
                $rowSum[] = $row0[$key0] ;
            }
        }
        foreach ($row as $key => $value) {
            $rowSum[] = $row[$key] ;
        }
    } else {
        if(!empty($row) && empty($row0)) {
            $rowSum = $row ;
        } else {
            $rowSum = $row0 ;
        }
    }

    $sum = 0;
    foreach ($rowSum as $key0 => $value0) {
        $sum += $value0['factor_value'];
    }
    
//actlog(array(
//    'row0'=>$row0,
//    'row'=>$row,
//    'rowSum'=>$rowSum,
//    'sum'=>$sum
//));
    return $sum;
}

function time_elapsed($secs){
    $bit = array(
        'y' => $secs / 31556926 % 12,
        'w' => $secs / 604800 % 52,
        'd' => $secs / 86400 % 7,
        'h' => $secs / 3600 % 24,
        'm' => $secs / 60 % 60,
        's' => $secs % 60
        );
    $ret = array();  
    foreach($bit as $k => $v) {
        if($v > 0){
            $ret[] = $v . $k;
        }
    }
    if(empty($ret)) {
        $ret[] = '0s';
    }
    return join(' ', $ret);
}

function getArrayResult($result) {
    $res = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $res[]=$row;
    }
    return $res;
}

function create_table_sql_from_metadata($table_name, $rets_metadata, $key_field, $field_prefix = "") {

        $sql_query = "CREATE TABLE {$table_name} (\n";

        foreach ($rets_metadata as $field) {

                $field['SystemName'] = "`{$field_prefix}{$field['SystemName']}`";

                $cleaned_comment = addslashes($field['LongName']);

                $sql_make = "{$field['SystemName']} ";

                if ($field['Interpretation'] == "LookupMulti") {
                        $sql_make .= "TEXT";
                }
                elseif ($field['Interpretation'] == "Lookup") {
                        $sql_make .= "VARCHAR(50)";
                }
                elseif ($field['DataType'] == "Int" || $field['DataType'] == "Small" || $field['DataType'] == "Tiny") {
                        $sql_make .= "INT({$field['MaximumLength']})";
                }
                elseif ($field['DataType'] == "Long") {
                        $sql_make .= "BIGINT({$field['MaximumLength']})";
                }
                elseif ($field['DataType'] == "DateTime") {
                        $sql_make .= "DATETIME default '0000-00-00 00:00:00' not null";
                }
                elseif ($field['DataType'] == "Character" && $field['MaximumLength'] <= 255) {
                        $sql_make .= "VARCHAR({$field['MaximumLength']})";
                }
                elseif ($field['DataType'] == "Character" && $field['MaximumLength'] > 255) {
                        $sql_make .= "TEXT";
                }
                elseif ($field['DataType'] == "Decimal") {
                        $pre_point = ($field['MaximumLength'] - $field['Precision']);
                        $post_point = !empty($field['Precision']) ? $field['Precision'] : 0;
                        $sql_make .= "DECIMAL({$field['MaximumLength']},{$post_point})";
                }
                elseif ($field['DataType'] == "Boolean") {
                        $sql_make .= "CHAR(1)";
                }
                elseif ($field['DataType'] == "Date") {
                        $sql_make .= "DATE default '0000-00-00' not null";
                }
                elseif ($field['DataType'] == "Time") {
                        $sql_make .= "TIME default '00:00:00' not null";
                }
                else {
                        $sql_make .= "VARCHAR(255)";
                }

                $sql_make .= " COMMENT '{$cleaned_comment}'";
                $sql_make .= ",\n";

                $sql_query .= $sql_make;
        }

        $sql_query .= "PRIMARY KEY(`{$field_prefix}{$key_field}`) )";

        return $sql_query;

}

function makePropertyInfoSlug($connection, $id){

    $slug = $checkslug = Doctrine_Inflector::urlize(getFullAddress($connection, $id));
    if(mysqli_query($connection, "SELECT slug FROM tbl_property_info_slug WHERE tbl_property_info_slug.slug = '{$slug}'")) {
        $counter = 0;
        while ($crow = mysqli_num_rows(mysqli_query($connection, $sql = "SELECT slug FROM tbl_property_info_slug WHERE tbl_property_info_slug.slug = '{$checkslug}'"))) {
            $checkslug = sprintf('%s-%d', $slug, ++$counter);
            mysqli_query($connection, "UPDATE tbl_property_info_slug SET tbl_property_info_slug.slug = '{$checkslug}' WHERE tbl_property_info_slug.slug = '{$slug}'");
        }
    }

//echo 'crow=' . $crow . ' sql=' . $sql1, PHP_EOL;

    echo 'slug=' . $checkslug, PHP_EOL;
//    $sql = "INSERT IGNORE INTO  `bucontra_propertyhookup`.`tbl_property_info_slug` ( `property_id`, `slug` ) VALUES ( {$id}, '{$checkslug}' )";
    $sql = "INSERT IGNORE INTO  `bucontra_propertyhookup`.`tbl_property_info_slug` ( `property_id`, `slug` ) VALUES ( {$id}, '{$slug}' )";
    mysqli_query($connection,$sql);
    if(mysqli_errno($connection) != 0){
        echo mysqli_errno($connection) . ": " . mysqli_error($connection). "\n";
    }
    unset($slug);
    unset($crow);
    unset($sql);
    unset($checkslug);
}

function getFullAddress($connection, $id = false ) {
    if($id) {
        $sql = "SELECT t1.property_street, t3.zip_code, t4.city_name, t6.state_code  FROM `property_info` AS t1
                    LEFT JOIN ( `zipcode` AS t3, `city` AS t4, `county` AS t5, `state` AS t6 ) 
                    ON (`t3`.`zip_id` = `t1`.`property_zipcode` AND `t4`.`cityid` = `t1`.`property_city_id` 
                        AND `t5`.`county_id` = `t1`.`property_county_id` AND `t6`.`stid` = `t1`.`property_state_id` )
                    WHERE `t1`.`property_id` = '{$id}'
        ";
        $result = mysqli_query($connection,$sql);

        $num_results = mysqli_num_rows($result);
        if ($num_results > 0) {
            $property = mysqli_fetch_object($result);
        } else {
            return '';
        }
    } else {
        return '';
    }

    $address = $property->property_street;
    $address .= !empty($address)?' ':'';
    $address .= !empty($property->city_name)?$property->city_name:'';
    $address = ucwords(strtolower($address));

    $address .= !empty($address)?', ':'';
    $address .= !empty($property->state_code)?strtoupper($property->state_code):'';

    $address .= !empty($address)?' ':'';
    $address .= !empty($property->zip_code)?strtoupper($property->zip_code):'';

    return $address;
}

function fixDataArray ($record){
    $isError=true;
    $countOfCycle = 0;
    do {
        $countOfCycle++;
        var_dump('Array: '.$countOfCycle);
        foreach ($record as $k => $v) {
            $isError = false;
            $v = trim($v);
            if ($countOfCycle == 1 && strstr($v, '\'') != '') {
                $isError = true;
                $v = str_replace("'", "\\'", $v);
            }
            if (preg_match_all('/  +/', $v, $matches)) {
                $v = preg_replace('/  +/', ' ', trim($v));
                $isError = true;
            }

            if (preg_match_all('/ none| n\/a| N\/A| non| b\/a| 0+$| na/', $v, $matches)) {
                $matchesStr = '';
                foreach ($matches as $match) {
                    $matchesStr .= implode('|', $match);
                }
                $matchesStr = str_replace('/', '\/', $matchesStr);
                $v = preg_replace("/" . $matchesStr . "/", "", trim($v));
                $isError = true;
            }
            if (preg_match_all('/(, ){2,}/', $v, $matches)) {
                $v = preg_replace('/(, ){2,}/', ' ', trim($v));
                $isError = true;
            }
            $record[$k] = $v;
        }
    }while ($isError);

    return $record;
}
function fixDataString ($string){
    $isError=true;
    $countOfCycle = 0;
    do{
        $countOfCycle++;
        var_dump('String: '.$countOfCycle);
        $isError = false;
        if ($countOfCycle == 1 && strstr($string, '\'') != ''){
            $isError=true;
            $string = str_replace("'", "\\'", $string);
        }
        if(preg_match_all('/  +/',$string,$matches)){
            $string = preg_replace('/  +/', ' ', trim($string));
            $isError=true;
        }

        if(preg_match_all('/ none| n\/a| N\/A| non| b\/a| 0+$| na/',$string,$matches)){
            $matchesStr ='';
            foreach ($matches as $match){
                $matchesStr .= implode('|',$match);
            }
            $matchesStr = str_replace('/','\/',$matchesStr);
            $string = preg_replace("/".$matchesStr."/", "", trim($string));
            $isError=true;
        }
        if(preg_match_all('/(, ){2,}/',$string,$matches)) {
            $string = preg_replace('/(, ){2,}/', ' ', trim($string));
            $isError = true;
        }
    } while ($isError);
    $string = trim($string);
    return $string;
}

//Writing logs

function actlog($param) {
    $file=fopen(__DIR__ . "/../logs/properties.log","a");
    fwrite($file, print_r($param,1));
    fwrite($file, PHP_EOL);
    fclose($file);
    unset($file);
    unset($param);
}

function writeToExampleProperties($param){
    $file=fopen(__DIR__ . "/example_properties.log","a");
    fwrite($file, print_r($param,1));
    fwrite($file, PHP_EOL);
    fclose($file);
}

function acttxt($param) {
    $file=fopen(__DIR__ . "/../logs/rets_metadata.sql","a");
    fwrite($file, print_r($param,1));
    fwrite($file, PHP_EOL);
    fclose($file);
}