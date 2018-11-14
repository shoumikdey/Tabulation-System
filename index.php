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
	include("conn.php");
	//include("log.php");
	$_SESSION['logged'] = 0;
	
	if(isset($_POST['submit'])){
		if(isset($_SESSION['logged']) | $_SESSION['logged'] != 1){
			$admn_no = mysql_real_escape_string($_REQUEST['login_id']);
	$pass = mysql_real_escape_string($_REQUEST['password']);
			$result=mysql_query("SELECT * FROM tb_login WHERE BINARY login_id='". $admn_no ."' AND BINARY password='". $pass ."'");
			
			if(mysql_num_rows($result)!=0){
				$_SESSION['logged'] = 1;
   $_SESSION['admn']=$admn_no;
     $_SESSION['pass']=$pass;
	 
     
	 //die($_SESSION['logged']);
	 header('Location: home1.php');
	 
		}
		else if(empty($_POST['login_id']) && empty($_POST['password'])){
			$_SESSION['logged'] = 0;
   		
				  echo "<script>
alert('Login ID or password not entered!');


</script>";
				  
   }
   else 
   {
	   $_SESSION['logged'] = 0;
	   echo "<script>
alert('Login ID or password was incorrect!');


</script>";
   }
		}
	}
?>
<div class="container">
        <div>
            <form method="post" action="<?php echo "".$_SERVER['PHP_SELF']."";?>" name="login_form" >
                <div class="form-group">
                    <div id="formdiv">
                    
                            
                    <div class="row" style="margin-right:0px;margin-left:0px;padding-top:5px;">
                            <div class="col-md-8 col-md-offset-3">
                                <p style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;"><strong>Login ID: </strong></p>
                            </div>
                            </div>
                            <div class="col-md-5 col-md-offset-3">
                                <input class="form-control" type="text" name="login_id" id="login_id" placeholder="Login" style="margin-left:0px;font-family:Roboto, sans-serif;">
                            </div>
                            <div class="row" style="margin-right:0px;margin-left:0px;padding-top:24px;">
                            <div class="col-md-8 col-md-offset-3">
                                <p style="margin-left:2%;font-family:Roboto, sans-serif;font-size:24px;"><strong>Password </strong></p>
                            </div>
                            </div>
                            <div class="col-md-5 col-md-offset-3">
                                <input class="form-control" type="password" name="password" id="password" placeholder="Password" style="margin-left:0px;font-family:Roboto, sans-serif;">
                                </div>
                              <div class="row" style="margin-right:0px;margin-left:0px;padding-top:50px;">
                            <div class="col-md-13 col-md-offset-4 col-xs-12 col-xs-offset-1">
                              
                                <button class="btn btn-default btn-lg" type="submit" style="margin-left:16px;" name="submit" id="submit">Submit </button>
                            </div>
                            </div>
                            </div>
                            
                            </form>
                            </div>
                            </div>
                            </div>
                            </div>
                            
</body>
</html>