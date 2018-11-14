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
<title>Result Entry</title>
</head>

<body>
<br>
<br>
<?php
session_start();
include('auth.inc.php');
include('conn.php');
$event = $_SESSION['event'];

$result = mysql_query("SELECT COUNT(*) as total FROM ".str_replace(' ', '', $event)."_1");
		//die("SELECT COUNT(*) as total FROM ".str_replace(' ', '', $event)."_1");
			$count_result=mysql_result($result, 0);
			if($count_result>0){
				echo "<script type='text/javascript'> document.location = 'blocked.php'; </script>";
			}
//die($event);
$point1 = mysql_result(mysql_query("SELECT pos1 FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);
	$point2 = mysql_result(mysql_query("SELECT pos2 FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);
	$point3 = mysql_result(mysql_query("SELECT pos3 FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);
		$pts = mysql_result(mysql_query("SELECT part FROM tb_events WHERE event ='".str_replace(' ', '', $event)."'"), 0);

?>
<?php
$db_school = array_map("mysql_real_escape_string", $_POST['school']);;
	$db_part1 = $_POST['part1'];
	$db_pos1 = $_POST['pos1'];
	$db_part2 = $_POST['part2'];
	$db_pos2 = $_POST['pos2'];
	print_r($db_part1);
if(isset($_POST['submit']))
{
	
	$i = count($db_school);
	for($j = 0; $j < $i; $j++)
	{
		$school1 = $db_school[$j].'('.$db_part1[$j].')';
		$school2 = $db_school[$j].'('.$db_part2[$j].')';
		$insert_in = mysql_query("INSERT INTO ".str_replace(' ', '', $event)."_1 (school, standings) VALUES ('$school1', '$db_pos1[$j]')");
		$insert_in2 = mysql_query("INSERT INTO ".str_replace(' ', '', $event)."_1 (school, standings) VALUES ('$school2', '$db_pos2[$j]')");
		//$insert_grp = mysql_query("INSERT INTO ".str_replace(' ', '', $event)."_1 (school, points) VALUES('$db_school[$j]', '$db_pos1[$j]')");
		
		
		if($db_pos1[$j] == '1')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point1' WHERE school='$db_school[$j]'");
		}
		else if($db_pos1[$j] == '2')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point2' WHERE school='$db_school[$j]'");
		}
		else if($db_pos1[$j] == '3')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point3' WHERE school='$db_school[$j]'");
		}
		else if($db_pos1[$j] == '4')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '1' WHERE school='$db_school[$j]'");
		}
		else
		{}
		if($db_pos2[$j] == '1')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point1' WHERE school='$db_school[$j]'");
		}
		else if($db_pos2[$j] == '2')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point2' WHERE school='$db_school[$j]'");
		}
		else if($db_pos2[$j] == '3')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$point3' WHERE school='$db_school[$j]'");
		}
		else if($db_pos2[$j] == '4')
		{
			$point = mysql_query("UPDATE tb_school_points SET points = points + '$pts' WHERE school='$db_school[$j]'");
		}
		else
		{}
}
header('Location: home1.php');

}

?>

<div class="container">
        <div>
            <form method="post"  name="points_form" >
                <div class="form-group">
                    <div id="formdiv">
                    
<?php
$query_1=mysql_query("SELECT * FROM tb_school WHERE ".str_replace(' ', '', $event)." = '1'");

while($data=mysql_fetch_assoc($query_1)){
extract($data);
$part1 = mysql_result(mysql_query("SELECT part_1 from part_".str_replace(' ', '', $event)." WHERE school = '".$data['school']."'"), 0);
$part2 = mysql_result(mysql_query("SELECT part_2 from part_".str_replace(' ', '', $event)." WHERE school = '".$data['school']."'"), 0);



?>
<div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
<h3><center><input name="school[]" class="form-control" type="text" readonly value="<?php echo $data['school']; ?>" style="text-align:center; color: #000000; font-weight:bold;"/></center></h3>
<div class="col-xs-4 col-xs-offset-2">

									    <input type="text" class="form-control"   name="part1[]" value="<?php echo $part1 ?>" readonly />
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
       
       <div class="col-xs-4 col-xs-offset-2">
									    <input type="text" class="form-control"  id="ex3" name="part2[]" value="<?php echo $part2 ?>" readonly />
                                        </div>

                                        <div class="col-xs-4">
                    <select class="form-control" name="pos2[]" id="ex3" style="font-family:Roboto, sans-serif;">
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
?>
<div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-10 col-md-offset-5 col-xs-12 col-xs-offset-0">
                                
                                <button class="btn btn-default btn-lg" type="submit" name="submit" id="submit" style="margin-left:16px;">Submit </button>

                            </div>
                            </div>
</div>
</div>

</form>
</div>
</div>
</body>

</html>