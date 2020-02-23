<?php include 'constants.php';?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<style>
table#result{
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

table#result td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

table#result tr:nth-child(even) {
  background-color: #dddddd;
}
</style>
</head>
<body>

<?php


$conn = new mysqli($servername, $ro_username, $ro_password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = $get = $version_value = $maint_value = "";

if (isset($_GET['v'])){
    $get = intval($_GET['v']);

    $sql = "SELECT version_id, version_value, maint_value FROM version WHERE version_id = '".$get."'; ";
    
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $version_value = $row["version_value"];
            $maint_value = $row["maint_value"];
        }
    }


    $sql = "SELECT issue.* , version.* FROM versionmap map, issue issue, version version WHERE map.version_id = version.version_id ";
    $sql .= "AND ((version_value = '".$version_value."' AND maint_value > '".$maint_value."') OR (version_value > '".$version_value."'))";
    $sql .= "AND issue.issue_id = map.issue_id ";
    $sql .= "ORDER BY version_value, mainnt_value; ";

    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        print "<table id='result'>\n";
        while($row = $result->fetch_assoc()) {
            echo "<tr><td>" . $row["issue_code"]. "</td><td>" . $row["issue_description"]. "</td><td>" . $row["version_name"]. "</td></td>\n";
        }
        print "</table>";
    } else {
        print "nothing to display";
    }    
    
}
$conn->close(); 

?>
</body>
</html>