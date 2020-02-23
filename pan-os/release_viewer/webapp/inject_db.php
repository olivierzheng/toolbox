<?php

$servername = "localhost";
$dbname = "app1";
# account for SELECT and INSERT
$rw_username = "";
$rw_password = "";

// Create connection
$conn = new mysqli($servername, $rw_username, $rw_password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


$sql = $panid = $pandesc = $version = $issue_id = $version_id = $version_value = $maint_value = "";

$fn = fopen("release.csv","r") or die ("file not found\n");
while(! feof($fn))  {
    $data = fgets($fn);

    if (!preg_match("/^$/",$data)) {
        
    $row_data = explode(';', $data);

    $panid = test_input($row_data[0]);
    if (!preg_match("/^PAN-\d*$/",$panid)) {
        exit( "Error in PANID - $panid");
    }

    $pandesc = test_input($row_data[1]);

    $version = test_input($row_data[2]);
    if (preg_match("/^(\d{1,}\.\d{1,})\.(\d{1,})+(-h(\d))?$/",$version,$match)) {
        $version_value = $match[1];
        $maint_value = $match[2];
        if( isset($match[4]) ){
            $maint_value = $maint_value.".".$match[4];
        } 
    }else {
        exit ("Error in version - $version");
    }
    
    $sql = "SELECT issue_id, issue_code FROM issue WHERE issue_code = '".$panid."' ;";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $issue_id = $row["issue_id"];
        }
        
        $sql = "SELECT version_id, version_name FROM version WHERE version_name = '".$version."' ;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $version_id = $row["version_id"];
            }
        } else {

            $sql = "INSERT INTO version (version_name, version_value, maint_value) VALUES ('".$version."','".$version_value."','".$maint_value."'); ";
            if ($conn->query($sql) === TRUE) {
                echo "New record $sql \n";
            } else {
                echo "Error: " . $sql . "\n" . $conn->error;
            }

        }

        $sql = "SELECT version_id, version_name FROM version WHERE version_name = '".$version."' ;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $version_id = $row["version_id"];
            }
        }

        $sql = "SELECT version_id, issue_id FROM versionmap WHERE version_id = '".$version_id."' AND issue_id = '".$issue_id."' ;";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            next();
        }else {
            $sql = "INSERT INTO versionmap (version_id, issue_id) VALUES ('".$version_id."','".$issue_id."'); ";
            if ($conn->query($sql) === TRUE) {
                echo "New record $sql \n";
            } else {
                echo "Error: " . $sql . "\n" . $conn->error;
            }
            
        }


    } else {
        $sql = "INSERT INTO issue (issue_code, issue_description) VALUES ('".$panid."','".$pandesc."');";

        if ($conn->query($sql) === TRUE) {
            echo "New record $sql \n";
        } else {
            echo "Error: " . $sql . "\n" . $conn->error;
        }
            
        }
    }
    

}

fclose($fn);

$conn->close(); 

?>