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
<title>Results</title>
</head>

<body>
<?php
session_start();
include('conn.php');

?>

<div class="container">
        <div>
                <div class="form-group">
                    <div id="formdiv">
                      <table class="table table-striped">
						<thead>
      <tr>
        <th>Event</th>
        <th>School</th>
        <th>Position</th>
      </tr>
      </thead>
      <tbody>
      <tr>
      <?php
	  $quer = mysql_query("SELECT * FROM tb_events");
	  while($data=mysql_fetch_assoc($quer))
	  {
		  extract($data);
		  $quer1 = mysql_result(mysql_query("SELECT school FROM ".str_replace(' ', '', $data['event'])."_1 WHERE standings = '1'"), 0);
		  $quer2 = mysql_result(mysql_query("SELECT school FROM ".str_replace(' ', '', $data['event'])."_1 WHERE standings = '2'"), 0);
		  $quer3 = mysql_result(mysql_query("SELECT school FROM ".str_replace(' ', '', $data['event'])."_1 WHERE standings = '3'"), 0);
		  echo '<tr>';
		  echo '<td><strong>'.$data['event'].'</strong></td>';
		  echo '<td>'.$quer1.'</td>';
		  echo '<td>1</td>';
		  echo '</tr>';
		  echo '<tr>';
		  echo '<td><strong>'.$data['event'].'</strong></td>';
		  echo '<td>'.$quer2.'</td>';
		  echo '<td>2</td>';
		  echo '</tr>';
		  echo '<tr>';
		  echo '<td><strong>'.$data['event'].'</strong></td>';
		  echo '<td>'.$quer3.'</td>';
		  echo '<td>3</td>';
		  echo '</tr>';
		  echo '<tr>';
		   echo '<td></td>';
		   echo '<td></td>';
		   echo '<td></td>';
		  echo '</tr>';
	  }
	  ?>
      </tr>
      </tbody>
      </table>
      <label><center><strong></strong><h2>Top 5 Schools</h2><strong></strong></center></label>
                            <table class="table table-striped">
                            <tbody>
                            <tr>
                            <th>Event</th>
        					<th>School</th>
        					<th>Position</th>
        					</tr>
                            <?php
							$top = mysql_query("SELECT * FROM tb_school_points ORDER BY points DESC LIMIT 5");
							while($data1=mysql_fetch_assoc($top)){
								extract($data1);
								echo '<tr>';
		  echo '<td><strong>Top School</strong></td>';
		  echo '<td>'.$data1['school'].'</td>';
		  echo '<td>'.$data1['points'].'</td>';
		  echo '</tr>';
		  
							}
							?>
                            </tbody>
                            </table>
                            
                            <label><center><strong></strong><h2>School Listing</h2><strong></strong></center></label>
                            <table class="table table-striped">
                            <tbody>
                            <tr>
                            <th>Event</th>
        					<th>School</th>
        					<th>Position</th>
        					</tr>
                            <?php
							$top = mysql_query("SELECT * FROM tb_school_points ORDER BY points DESC");
							while($data1=mysql_fetch_assoc($top)){
								extract($data1);
								echo '<tr>';
		  echo '<td><strong>School Listing</strong></td>';
		  echo '<td>'.$data1['school'].'</td>';
		  echo '<td>'.$data1['points'].'</td>';
		  echo '</tr>';
		  
							}
							?>
                            </tbody>
                            </table>
                        
                            

                    </div>
                  </div>
                </div>
            </div>
                    
</body>
</html>