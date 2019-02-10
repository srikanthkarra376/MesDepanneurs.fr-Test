
<?php include 'includes/header.php';?>
<?php
session_start();

 $zip = $_GET["zip"];
 $data = $_SESSION["data"];
 $validity ='FALSE';
 $global_arr = array();
 $zip_arr = array();

 #checking for session data, if available.

  if($data === "TRUE") {

    $global_arr=$_SESSION["global_arr_ref"];
      
         for ($x = 0; $x <count($global_arr); $x++) {
             
                 $tmp_arr = array();

                 $temp_array = $global_arr[$x];
                
                    if($zip === $temp_array[0]){
                          
                    echo  ' <div class="container pt-5 pb-5 mt-5">
                                <h4 class="text-info mb-3">Your Search Results: </h4>
                                <div class="alert alert-success col-md-10">
                                <strong> '.$temp_array[3].' ! </strong> MesDépanneurs.fr  already Providing the Services in this location...(TRUE)
                                </div>
                                <button class="btn btn-outline-secondary col-md-4" onclick="history.go(-1);">Back </button>
                            </div>';

                     $validity="TRUE";

                    }
           }
     } else {
        
        $global_arr = get_db();
   }
    
  
 #checking for entered zip code with previous session to reduce the calls to Geo API and make the application faster.
          if($validity!='TRUE') {

              if($_SESSION["zip_code"] === $zip) {
                  
                  $zip_arr=$_SESSION["zip_arr_ref"];

              } else {
                  
                $zip_arr = get_Geocode();
              }
          }
 
 
 if($validity==='TRUE') {

        $_SESSION["global_arr_ref"] = $global_arr;
        $_SESSION["zip_code"] = $zip;
        $_SESSION["zip_arr_ref"] = $zip_arr;
        $_SESSION["data"]="TRUE";

  } else {
    
   getValidity();
   
        if($validity==='TRUE'){
         
          echo '<div class="container mb-5">
                   <div class="alert alert-primary col-md-10 mt-4 mb-3">
                    <strong> '.$zip_arr[3].' ! </strong>is under 25kms.MesDépanneurs.fr  Can Provide the Services in this location...(TRUE)
                  </div>
                  <div class="pb-5">
                <button class="btn btn-outline-secondary col-md-3" onclick="history.go(-1);">Back </button>
                </div>
              </div>';
          
        } else  {
 
            $_SESSION["global_arr_ref"] = $global_arr;
            $_SESSION["zip_code"] = $zip;
            $_SESSION["zip_arr_ref"] = $zip_arr;
            $_SESSION["data"] = "TRUE";

            echo '<div class="alert alert-danger mt-4">
                     <strong>'.$zip_arr[3].'</strong> is NOT Under 25kms of any Nearest  Service Areas, So "MesDépanneurs.fr" Do not provide services...(FALSE)
                </div>
                 <div class="pb-3">
                <button class="btn btn btn-outline-secondary col-md-3 " onclick="history.go(-1);">Back </button>
                </div>';
    }
 
 }

 # function to get  the locations in the database 
 
function get_db() {
    
          global $zip;
          global $validity;

          $db_locations_arr = array();
          
          include 'includes/db.php';

            if ($conn->connect_error) {
                
                  die("Connection failed: " . $conn->connect_error);
            } 
            
            $sql = "SELECT * FROM locations";
            $result = $conn->query($sql);
            
            if ($result->num_rows > 0) {

              while($row = $result->fetch_assoc()) {
                    $zip_db = $row["zip"];
                    $name = $row["name"];
              
                if($zip == $zip_db){
                
                    $validity='TRUE';
                 }
    
                  $lat_db = $row['lat'];
                  $lng_db = $row['lng'];
                  $_localArr = array();

                  array_push ($_localArr, $row["zip"],$row['lat'],$row['lng'],$row['name'] );
                  
                  array_push($db_locations_arr,$_localArr);
              
                }
            }

         $conn->close();
    return $db_locations_arr;
 }

#

function get_Geocode(){
        global $zip;
        // url encode the address
        $zip = urlencode($zip);
        
        // google map geocode api url

       $url="https://maps.googleapis.com/maps/api/geocode/json?&components=country:FR|postal_code:{$zip}&key=AIzaSyC08q105oDXp_Xw4Wy_nk57GhVDTvefMxI";
         

        // get the json response
        $resp_json = file_get_contents($url);
        
        // decode the json
        $resp = json_decode($resp_json, true);
        
      // response status will be 'OK', if able to geocode given address 
        if($resp['status']=='OK'){
            
            $geo_arr = array();

            // get the important data
            $lati = isset($resp['results'][0]['geometry']['location']['lat']) ? $resp['results'][0]['geometry']['location']['lat'] : "";
            $longi = isset($resp['results'][0]['geometry']['location']['lng']) ? $resp['results'][0]['geometry']['location']['lng'] : "";
            $formatted_address = isset($resp['results'][0]['formatted_address']) ? $resp['results'][0]['formatted_address'] : "";
          
            
            array_push($geo_arr,$zip,$lati,$longi,$formatted_address);

          }  else {

            echo "There is a small error with the GEO API. Please try again after some time.";
            return false;
        }
        return $geo_arr;

                    
 }

#function to calcluate distance between  the two code postals 

function getDistance($lat1, $lon1, $lat2, $lon2, $unit) {

                    $theta = $lon1 - $lon2;
                    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
                    $dist = acos($dist);
                    $dist = rad2deg($dist);
                    $miles = $dist * 60 * 1.1515;
                    $unit = strtoupper($unit);

                    if ($unit == "K") {
                        return ($miles * 1.609344);
                    } else if ($unit == "N") {
                        return ($miles * 0.8684);
                    } else {
                        return $miles;
                    
                }
}

#function to check the 

function getValidity(){
                    global $zip_arr;
                    global $validity;
                    global $global_arr;
                    echo ' 
                     
                    <h4 class="text-danger text-center mb-3">Your Search Results: </h4>
                    
                    <u><a  data-toggle="collapse" href="#toggle-table"  aria-expanded="false" aria-controls="toggle-table">click here to see more information..</a></u>
                    <table class="table table-sm collapse mt-3" id="toggle-table" >
                    <tr> 
                    <th >Locations</th>
                    <th >Distance from <span class="text-danger"><br>'.$zip_arr[3].'</span></th>
                    <th >Service(True/False)</th>
                  </tr>';
                    
                   
                    for ($x = 0; $x <count($global_arr); $x++) {

                      if($validity === 'FALSE'){

                        $temp_array = array();
                        $temp_array = $global_arr[$x];
                        $lati1 = $temp_array[1];
                        $lng1 = $temp_array[2];
                        $lati2 = $zip_arr[1];
                        $lng2 =  $zip_arr[2];
                        $distance = ceil(getDistance($lati1,$lng1,$lati2,$lng2,'K'));
                        


                        if($distance<=25){
                          
                            $validity='TRUE';
                            
                            break;
    
                         } else {
      
                              $validity='FALSE';
                              echo "<tr> ";
                              echo "<td>$temp_array[0] ($temp_array[3])</td>";
                              echo "<td>$distance kms</td> ";
                              echo "<td>$validity</td> ";
                              echo "</tr> ";
                         }
                        
                  }
                
            }
            echo "</table>
           ";
        return $validity;
}

?>
<?php include 'includes/footer.php';?>	