<?php include 'constants.php';?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">

<?php

$conn_ro = new mysqli($servername, $ro_username, $ro_password,$dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql ="";
?>

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
<script>
function showVersion(str) {
    if (str == "") {
        document.getElementById("display").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("display").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","display.php?v="+str,true);
        xmlhttp.send();
    }
}
</script>
<script>
function showWord(str) {
    if (str.length < 2) {
        document.getElementById("display").innerHTML = "";
        return;
    } else {
        var version = ;
        var url = "";
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("display").innerHTML = this.responseText;
            }
        };
        if (version == ""){
            url = "?word="+str;
        }else{
            url = "?v="+version+"&?word="+str;
        }
        xmlhttp.open("GET","display.php"+url,true);
        xmlhttp.send();
    }
}
</script>

</head>
<body>
<form>
<table id="form">
<tr>
<td><label for="form_version">Version :</label></td>
<td><select id="form_version" name="form_version" onchange="showversion(this.value)" >
<option value=""></option>
<?php
$sql = "SELECT * FROM version WHERE version_status = '1' ;";

$result = $conn->query($sql);
    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["version_id"]."' >".$row["version_name"]."</option>";
    }
}
?>
</select></td>
</tr>
<tr>
<td><label for="form_tag">Tags :</label></td>
<td><select id="form_tag" name="form_tag" >
<option value=""></option>
<?php
$sql = "SELECT * FROM tag ;";

$result = $conn->query($sql);
    
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "<option value='".$row["tag_id"]."' >".$row["tag_name"]."</option>";
    }
}
?>
</select></td>
</tr>
<tr>
<td><label for="form_text">Word :</label></td>
<td><input type="text" id="form_text"></input></td>
</tr>
<tr>
<td colspan="2">
<input type = "reset" name = "reset"  value = "Reset" />
</td>
</tr>
</table>
</form>

<div id="display"></div>

<?php
$conn->close(); 
?>
</body>
</html>