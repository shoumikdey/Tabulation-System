<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto">
    <link rel="stylesheet" href="assets/css/Responsive-Form.css">
    <link rel="stylesheet" href="assets/css/Responsive-Form1.css">
    <link rel="stylesheet" href="assets/css/styles.css">
<title>Select Event</title>
</head>

<body>
<?php
session_start();
include('auth.inc.php');
include("conn.php");
if($_SESSION['logged']!=1)
{
	header('Location: login.php');
}
$admn_no = $_SESSION['admn'];
$pass = $_SESSION['pass'];
$sql_a=mysql_query("SELECT group_name FROM tb_login WHERE login_id='". $admn_no ."' AND password='". $pass ."'");
$group_name=mysql_result($sql_a, 0);
?>
<?php
if(isset($_POST['submit']))
{
		
	$_SESSION['event'] = $_REQUEST['event'];
	if($_SESSION['event'] == 'goal' || $_SESSION['event'] == 'khamoshiyaan' || $_SESSION['event'] == 'lego house')
	{
			header('Location: individual.php');

	}
	else
	{
	header('Location: insertpts2.php');
	}
}
if(isset($_POST['logout']))
{
	$_SESSION['logged'] = 0;
	header('Location: index.php');
}
?>
<r>
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
                            <div class="col-md-8 col-md-offset-0">
                                <p style="margin-left:2%;font-family:Roboto, sans-serif;font-size:20px;"><strong>Welcome <?php echo $group_name?> Group</strong></p>
                            </div>
  <div class="col-md-8 col-md-offset-0">
  
  <select class="form-control" name="event" id="event" style="font-family:Roboto, sans-serif;">
                                    <optgroup label="EVENT">
                                 
                                        <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_group_event WHERE grp_id = '$group_name'");
										while($data=mysql_fetch_assoc($sql_pos1)){
										extract($data);
										$cat_value=$data['id'];
										echo '<option value="' . $data['event1'] . '">' . strtoupper($data['event1']) . '</option>';
										if($data['event2'] != 'NIL')
										echo '<option value="' . $data['event2'] . '">' . strtoupper($data['event2']) . '</option>';
										if($data['event3'] != 'NIL')
										echo '<option value="' . $data['event3'] . '">' . strtoupper($data['event3']) . '</option>';
										if($data['event4'] != 'NIL')
										echo '<option value="' . $data['event4'] . '">' . strtoupper($data['event4']) . '</option>';
										}
										?>
                                    </optgroup>
                                </select>
                                <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-10 col-md-offset-7 col-xs-12 col-xs-offset-0">
                                
                                <button class="btn btn-default btn-lg" type="submit" name="submit" id="submit" style="margin-left:16px;">Submit </button>
                                <button class="btn btn-default btn-lg" type="submit" name="logout" id="logout" style="margin-left:16px;">Logout </button>
                            </div>
                        </div>
                                </form>
                                </div>
                                </div>
</body>
</html>