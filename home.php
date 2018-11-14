<!DOCTYPE html>
<html>
<head>
<title>Register winners</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<!-- jQuery library -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
* {box-sizing: border-box}
body {font-family: "Lato", sans-serif;}

/* Style the tab */
div.tab {
    float: left;
    border: 1px solid #ccc;
    background-color: #f1f1f1;
    width: 30%;
    height: 300px;
}

/* Style the buttons inside the tab */
div.tab button {
    display: block;
    background-color: inherit;
    color: black;
    padding: 22px 16px;
    width: 100%;
    border: none;
    outline: none;
    text-align: left;
    cursor: pointer;
    transition: 0.3s;
    font-size: 17px;
}

/* Change background color of buttons on hover */
div.tab button:hover {
    background-color: #ddd;
}

/* Create an active/current "tab button" class */
div.tab button.active {
    background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
    float: left;
    padding: 0px 12px;
    border: 1px solid #ccc;
    width: 70%;
    border-left: none;
    height: 300px;
}
</style>
</head>
<body>
<br>
<br>
<?php
include('conn.php');
session_start();
$admn_no = $_SESSION['admn'];
$pass = $_SESSION['pass'];


$sql_a=mysql_query("SELECT group_name FROM tb_login WHERE login_id='". $admn_no ."' AND password='". $pass ."'");
$group_name=mysql_result($sql_a, 0);

$sql_b=mysql_query("SELECT event1 FROM tb_group_event WHERE grp_id='". $group_name ."'");
$event1 = mysql_result($sql_b, 0);								

$sql_c=mysql_query("SELECT event2 FROM tb_group_event WHERE grp_id='". $group_name ."'");
$event2 = mysql_result($sql_c, 0);

?>
<?php
if(isset($_POST['submit']))
{
	$event1_pos1 = $_REQUEST['event1_position1'];
	$event1_pos2 = $_REQUEST['event1_position2'];
	$event1_pos3 = $_REQUEST['event1_position3'];
	$event1_point1 = mysql_result(mysql_query("SELECT pos1 FROM tb_events WHERE event ='$event1'"), 0);
	$event1_point2 = mysql_result(mysql_query("SELECT pos2 FROM tb_events WHERE event ='$event1'"), 0);
	$event1_point3 = mysql_result(mysql_query("SELECT pos3 FROM tb_events WHERE event ='$event1'"), 0);
	
	$pos1_query = mysql_query("INSERT INTO ".$event1."(pos1, pos2, pos3) VALUES ('$event1_pos1', '$event1_pos2', '$event1_pos3')");
	$point1 = mysql_query("UPDATE tb_school_points SET points = points + '$event1_point1' WHERE school='$event1_pos1'");
	if($event2 != 'NIL')
	{
		$event2_pos1 = $_REQUEST['event2_position1'];
	$event2_pos2 = $_REQUEST['event2_position2'];
	$event2_pos3 = $_REQUEST['event2_position3'];

	$pos1_query = mysql_query("INSERT INTO ".$event2."(pos1, pos2, pos3) VALUES ('$event2_pos1', '$event2_pos2', '$event2_pos3')");
	}
	header('Location:index.php');
}
?>
<div class="container">
<div class="tab">
  <button class="tablinks" onclick="openCity(event, 'London')" id="defaultOpen"><?php echo strtoupper($event1); ?></button>
  <button class="tablinks" onclick="openCity(event, 'Paris')"><?php echo strtoupper($event2); ?></button>
  
</div>

<div id="London" class="tabcontent">
  <h3>Register the winners to the portal</h3>
  <div class="col-md-8 col-md-offset-0">
  <form method="post" action="<?php echo<select class="form-control" name="event1_position1" id="event1_position1" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event1." = '1'");
										while($data=mysql_fetch_assoc($sql_pos1)){
										extract($data);
										$cat_value=$data['id'];
										echo '<option value="' . $data['school'] . '">' . $data['school'] . '</option>';
										}
										?>
                                    </optgroup>
                                </select> "".$_SERVER['PHP_SELF']."";?>" name="pos1_form" >
  
                                
                                </div>
                                <br>
                                <br>
                                <div class="col-md-8 col-md-offset-0">
  <select class="form-control" name="event1_position2" id="event1_position2" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event1." = '1'");
										while($data=mysql_fetch_assoc($sql_pos1)){
										extract($data);
										$cat_value=$data['id'];
										echo '<option value="' . $data['school'] . '">' . $data['school'] . '</option>';
										}
										?>
                                    </optgroup>
                                </select>
                                
                                </div>
                                <br>
                                <br>
                                <div class="col-md-8 col-md-offset-0">
  <select class="form-control" name="event1_position3" id="event1_position3" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event1." = '1'");
										while($data=mysql_fetch_assoc($sql_pos1)){
										extract($data);
										$cat_value=$data['id'];
										echo '<option value="' . $data['school'] . '">' . $data['school'] . '</option>';
										}
										?>
                                    </optgroup>
                                </select>
                                
                                </div>
</div>

<div id="Paris" class="tabcontent">
  <h3>Register the winners to the portal</h3>
  <div class="col-md-8 col-md-offset-0">
  <?php
  if($event2 != 'NIL'){
	  ?>
      <select class="form-control" name="event2_position1" id="event2_position1" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event2." = '1'");
										while($data=mysql_fetch_assoc($sql_pos1)){
										extract($data);
										$cat_value=$data['id'];
										echo '<option value="' . $data['school'] . '">' . $data['school'] . '</option>';
										}
										?>
                                    </optgroup>
                                </select>
                                
                                </div>
                                <br>
                                <br>
                                <div class="col-md-8 col-md-offset-0">
  <select class="form-control" name="event2_position2" id="event3_position3" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event2." = '1'");
										while($data=mysql_fetch_assoc($sql_pos1)){
										extract($data);
										$cat_value=$data['id'];
										echo '<option value="' . $data['school'] . '">' . $data['school'] . '</option>';
										}
										?>
                                    </optgroup>
                                </select>
                                
                                </div>
                                <br>
                                <br>
                                <div class="col-md-8 col-md-offset-0">
  <select class="form-control" name="event2_position3" id="event2_position3" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event2." = '1'");
										while($data=mysql_fetch_assoc($sql_pos1)){
										extract($data);
										$cat_value=$data['id'];
										echo '<option value="' . $data['school'] . '">' . $data['school'] . '</option>';
										}
										?>
                                    </optgroup>
                                </select>
                                
                                </div>
                                        <?php
  }
  else{
	  ?>
      <label>DISABLED</label>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      <br>
      </div>
      <?php
  }
  ?>
</div>
<br>
<br>
<div class="col-md-10 col-md-offset-5">
                              
                                <button class="btn btn-default btn-lg" type="submit" style="margin-left:16px;" name="submit" id="submit">Submit </button>
                            </div>
</form>


<script>
function openCity(evt, cityName) {
    var i, tabcontent, tablinks;
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }
    document.getElementById(cityName).style.display = "block";
    evt.currentTarget.className += " active";
}

// Get the element with id="defaultOpen" and click on it
document.getElementById("defaultOpen").click();
</script>
     
</body>
</html> 
