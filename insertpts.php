<!doctype html>
<html>
<head>
<meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/Responsive-Form.css">
    <link rel="stylesheet" href="assets/css/Responsive-Form1.css">
    <link rel="stylesheet" href="assets/css/styles.css">
<title>Register the Winners</title>
</head>

<body>
<?php
session_start();
include('conn.php');
if($_SESSION['logged']!=1)
{
	header('Location: login.php');
}
$event = $_SESSION['event'];

?>
<?php
$result = mysql_query("SELECT COUNT(*) as total FROM ".$event."");
			$count_result=mysql_result($result, 0);
			if($count_result>0){
				echo "<script type='text/javascript'> document.location = 'blocked.php'; </script>";
			}
if(isset($_POST['submit']))
{
	$pos1 = $_REQUEST['position1'];
	$pos2 = $_REQUEST['position2'];
	$pos3 = $_REQUEST['position3'];
	$point1 = mysql_result(mysql_query("SELECT pos1 FROM tb_events WHERE event ='$event'"), 0);
	$point2 = mysql_result(mysql_query("SELECT pos2 FROM tb_events WHERE event ='$event'"), 0);
	$point3 = mysql_result(mysql_query("SELECT pos3 FROM tb_events WHERE event ='$event'"), 0);
	
	$pos1_query = mysql_query("INSERT INTO ".$event."(pos1, pos2, pos3) VALUES ('$pos1', '$pos2', '$pos3')");
	$point1 = mysql_query("UPDATE tb_school_points SET points = points + '$point1' WHERE school='$pos1'");
	$point2 = mysql_query("UPDATE tb_school_points SET points = points + '$point2' WHERE school='$pos2'");
	$point3 = mysql_query("UPDATE tb_school_points SET points = points + '$point3' WHERE school='$pos3'");
	
	$particip=mysql_query("SELECT school FROM tb_school WHERE ".$event." = '1'");
	while($data1=mysql_fetch_assoc($particip))
	{
		extract($data1);
		if($data1['school'] != $pos1 && $data1['school'] != $pos2 && $data1['school'] != $pos3)
		{
			$participation = mysql_query("UPDATE tb_school_points SET points = points + '1' WHERE school = '".$data1['school']."'");
		}
	}
	$type = mysql_result(mysql_query("SELECT type FROM tb_events WHERE event ='$event'"), 0);
	header('Location: registered.php');
}
?>
<br>
<br>
<div class="container">
        <div>
              <form method="post" action="<?php echo "".$_SERVER['PHP_SELF']."";?>" name="pos1_form" >

                <div class="form-group">
                    <div id="formdiv">
                    <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-8 col-md-offset-0">
                                <p style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;"><strong>Register the winners to the portal</strong></p>
                            </div>
                           <br>
                           <br> 
 
  <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-8 col-md-offset-0">
                                <p style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;"><strong>Position 1</strong></p>
                            </div>
                             <div class="col-md-8 col-md-offset-0">
                    <select class="form-control" name="position1" id="position1" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event." = '1'");
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
                         <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-8 col-md-offset-0">
                                <p style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;"><strong>Position 2</strong></p>
                            </div>
                             <div class="col-md-8 col-md-offset-0">
                    <select class="form-control" name="position2" id="position2" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event." = '1'");
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
                         <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-8 col-md-offset-0">
                                <p style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;"><strong>Position 3</strong></p>
                            </div>
                             <div class="col-md-8 col-md-offset-0">
                    <select class="form-control" name="position3" id="position3" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="SCHOOL">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".$event." = '1'");
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
                         <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-10 col-md-offset-5 col-xs-12 col-xs-offset-0">
                                
                                <button class="btn btn-default btn-lg" type="submit" name="submit" id="submit" style="margin-left:16px;">Submit </button>
                            </div>
                        </div>
                        </div>
                        </div>
                        
                        </form>
                        
                        
                        

</body>
</html>