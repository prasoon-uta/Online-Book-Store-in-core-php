<html>
<head><title>Message Board</title>
 <link rel="stylesheet" href="css/style.css">
</head>
<body>
<?php
error_reporting(E_ALL);
ini_set('display_errors','On');

try {
  $dbh = new PDO("mysql:host=127.0.0.1;dbname=cheapbook","root","",array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
 // print_r($dbh);
 session_start();
if(isset($_POST['bttLogin'])) {
	$username=$_POST['username'];
	$password=$_POST['password'];
	
	
  $dbh->beginTransaction();
 // $dbh->exec('SELECT * FROM customer where username="'.$username.'" and password="'.$password.'"');
  //$dbh->exec('delete from Customer where username="smith"');
  //$dbh->exec('insert into Customer values("smith","405 Austin St, Arlington, TX","smith@cse.uta.edu","705-666","'. md5("mypass") . '")')
    //    or die(print_r($dbh->errorInfo(), true));
  //$dbh->commit();
  //$stmt = $dbh->prepare('select * from Customer');

$stmt = $dbh->prepare('SELECT * FROM `customers` where `username` LIKE "'.$username.'" and `password` LIKE "'.md5($password).'"');
  $stmt->execute();
 
 
 
 if($row = $stmt->fetch())
	{
		$_SESSION['username']=$username;
		header('Location:welcome.php');
	}
	else
	{	
	echo '<script type="text/javascript">alert("Invalid Username/Password!");</script>';
	//header('Location:customer.php');
	
	
	}
	
/*
 print "<pre>";
  while ($row = $stmt->fetch()) {
    print_r($row);
  }
  print "</pre>";
*/
}
  } catch (PDOException $e) {
  print "Error!: " . $e->getMessage() . "<br/>";
  die();
}
?>

 <div id="clouds">
	<div class="cloud x1"></div>
	<!-- Time for multiple clouds to dance around -->
	<div class="cloud x2"></div>
	<div class="cloud x3"></div>
	<div class="cloud x4"></div>
	<div class="cloud x5"></div>
</div>

 <div class="container">


      <div id="login">

        <form method="post">

          <fieldset class="clearfix">

            <p><span class="fontawesome-user"></span><input type="text" value="Username" name="username" onBlur="if(this.value == '') this.value = 'Username'" onFocus="if(this.value == 'Username') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Username" -->
            <p><span class="fontawesome-lock"></span><input type="password"  value="Password" name="password" onBlur="if(this.value == '') this.value = 'Password'" onFocus="if(this.value == 'Password') this.value = ''" required></p> <!-- JS because of IE support; better: placeholder="Password" -->
            <p><input type="submit" value="Sign In" name="bttLogin"></p>
			
			
          </fieldset>

        </form>
		
		<form action="register.php">

          <fieldset class="clearfix">
        <p><input type="submit" value="New users must register here" name="bttLogin"></p>
        
         </fieldset>

        </form>
      </div> <!-- end login -->

    </div>
    
</body>
</html>
