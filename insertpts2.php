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
<title>Result Entry Login</title>
</head>

<body>
<br>
<br>
<?php
session_start();
	//include("header1.php");
	include('conn.php');
	include('auth.inc.php');

	//include("log.php");
	$event = $_SESSION['event'];
	
?>
<?php
$type=mysql_result(mysql_query("SELECT type FROM tb_events WHERE event='".str_replace(' ', '', $event)."'"), 0);
$point1 = mysql_result(mysql_query("SELECT pos1 FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);
	$point2 = mysql_result(mysql_query("SELECT pos2 FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);
	$point3 = mysql_result(mysql_query("SELECT pos3 FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);
	$pts = mysql_result(mysql_query("SELECT part FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);
if($type=='sin')
{
$db_school = array_map("mysql_real_escape_string", $_POST['school']);
$db_pos = array_map("mysql_real_escape_string", $_POST['pos']);
$db_name = array_map("mysql_real_escape_string", $_POST['name']);
}
else
{
	$db_school1 = array_map("mysql_real_escape_string", $_POST['school1']);
	$db_pos1 = array_map("mysql_real_escape_string", $_POST['pos1']);;
}
$result = mysql_query("SELECT COUNT(*) as total FROM ".str_replace(' ', '', $event)."_1");
		//die("SELECT COUNT(*) as total FROM ".str_replace(' ', '', $event)."_1");
			$count_result=mysql_result($result, 0);
			if($count_result>0){
				echo "<script type='text/javascript'> document.location = 'blocked.php'; </script>";
			}
if(isset($_POST['submit']))
{
	/*if($type=='grp'){
foreach ($_POST as $key => $value) {
    //do something
	if($key != 'submit'){
		if($value == '1')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point1' WHERE school='$pos1'");
		}
		else if($value == '2')
		{
		}
		else if($value == '3')
		{
		}
		else if($value == '4')
		{
		}
		else
		{}
	$insert = mysql_query("INSERT INTO ".$event."_1 (school, points) VALUES('$key', '$value')");
	}
			}
	}
	//echo "<tr>";
        //echo "<td>";
        //echo $key;
        //echo "</td>";
        //echo "<td>";
        //echo $value;
        //echo "</td>";
        //echo "</tr>";
		
		//print_r($db_pos);*/
		//print_r($db_pos1);
		
		if($type == 'grp')
		{
			$i=count($db_school1);
			for($j = 0; $j < $i; $j++)
			{
				$insert_grp = mysql_query("INSERT INTO ".str_replace(' ', '', $event)."_1 (school, standings) VALUES('$db_school1[$j]', '$db_pos1[$j]')");
				
		if($db_pos1[$j] == '1')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point1' WHERE school='".str_replace('(TEAM B)', '', $db_school1[$j])."'");
		}
		else if($db_pos1[$j] == '2')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point2' WHERE school='".str_replace('(TEAM B)', '', $db_school1[$j])."'");
		}
		else if($db_pos1[$j] == '3')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point3' WHERE school='".str_replace('(TEAM B)', '', $db_school1[$j])."'");
		}
		else if($db_pos1[$j] == '4')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$pts' WHERE school='".str_replace('(TEAM B)', '', $db_school1[$j])."'");
		}
		else
		{}
			}
		}
		/*else
		{
		$i = count($db_school);
		for($j = 0; $j < $i; $j++)
		{
			$school_ins=$db_school[$j].'('.$db_name[$j].')';
			$position = $db_pos[$j];
			$insert=mysql_query("INSERT INTO ".str_replace(' ', '', $event)."_1 (school, points) VALUES('$school_ins', '$position')");
			
			if($db_pos[$j] == '1')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point1' WHERE school='$db_school[$j]'");
		}
		else if($db_pos[$j] == '2')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point2' WHERE school='$db_school[$j]'");
		}
		else if($db_pos[$j] == '3')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point3' WHERE school='$db_school[$j]'");
		}
		else if($db_pos[$j] == '4')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '1' WHERE school='$db_school[$j]'");
		}
		else
		{}
		}
		
		}*/
		
header('Location: home1.php');
		
    
}
$_POST = array();
?>
<div class="container">
        <div>
            <form method="post"  name="points_form" >
                <div class="form-group">
                    <div id="formdiv">
                    
                            
                                       <?php
										$sql_pos1 = mysql_query("SELECT * FROM tb_school WHERE ".str_replace(' ', '', $event)." = '1'");
										
										while($data=mysql_fetch_assoc($sql_pos1)){
											
										extract($data);
										//die($data['school']);
										$cat_value=$data['id'];
										if($type == 'grp')
										{
										?>
										<div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
										<div class="col-xs-4 col-xs-offset-2">
									    <input type="text" class="form-control"  id="ex3" name="school1[]" value="<?php echo $data['school'] ?>" readonly />
                                        										</div>

                                        <div class="col-xs-4">
                    <select class="form-control" name="pos1[]" id="ex3" style="font-family:Roboto, sans-serif;">
                    <optgroup label="POSITION">
                    <option value="4">Participated</option>
                    <option value="1">1st Position</option>
                    <option value="2">2nd Position</option>

                    <option value="3">3rd Position</option>

                    <option value="0">Not Participated</option>
                    </optgroup>
                    </select>
</div>
                                        </div>
                                        <?php
										}
										}
										//else
										$sql_pos2 = mysql_query("SELECT * FROM tb_school WHERE ".str_replace(' ', '', $event)."_b = '1'");
										while($data=mysql_fetch_assoc($sql_pos2)){
										extract($data);
										$cat_value=$data['id'];
										if($type == 'grp')
										{
										?>
                                        <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
										<div class="col-xs-4 col-xs-offset-2">
									    <input type="text" class="form-control"  id="ex3" name="school1[]" value="<?php echo $data['school'] ?>(TEAM B)" readonly />
                                        										</div>

                                        <div class="col-xs-4">
                    <select class="form-control" name="pos1[]" id="ex3" style="font-family:Roboto, sans-serif;">
                    <optgroup label="POSITION">
                    <option value="4">Participated</option>
                    <option value="1">1st Position</option>
                    <option value="2">2nd Position</option>

                    <option value="3">3rd Position</option>

                    <option value="0">Not Participated</option>
                    </optgroup>
                    </select>
</div>
                                        </div>
                    <?php
										}
										}
										

										?>
                    
                    <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-10 col-md-offset-5 col-xs-12 col-xs-offset-0">
                                
                                <button class="btn btn-default btn-lg" type="submit" name="submit" id="submit" style="margin-left:16px;">Submit </button>

                            </div>
                            </div>
                            
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            
</body>
</html>