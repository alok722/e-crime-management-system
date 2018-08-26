<!DOCTYPE html>
<html>
<head>
	<title>Complainer Home Page</title>

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">

	<link href="complainer_page.css" rel="stylesheet" type="text/css" media="all" />
	<?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:inchargelogin.php");
    
    $con=mysql_connect('localhost','root','');
    if(!$con)
    {
        die('could not connect: '.mysql_error());
    }
     mysql_select_db("crime_portal");
    
    $i_id=$_SESSION['email'];

    $result1=mysql_query("SELECT location FROM police_station where i_id='$i_id'",$con);
      
    $q2=mysql_fetch_assoc($result1);
    $location=$q2['location'];
    
if(isset($_POST['s'])){
    
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $p_name=$_POST['police_name'];
        $p_id=$_POST['police_id'];
        $spec=$_POST['police_spec'];
        $p_pass=$_POST['password'];

    $reg="insert into police values('$p_name','$p_id','$spec','$location','$p_pass')";
    
        $res=mysql_query($reg,$con);
        if(!$res)
         {
          $message = "User already Exists.";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
        else
        {
          $message = "Police Added Successfully";
          echo "<script type='text/javascript'>alert('$message');</script>";
        }
    }
}
?>
    
     <script>
     function f1()
    {
      var sta=document.getElementById("pname").value;
      var sta1=document.getElementById("pid").value;
      var sta2=document.getElementById("pspec").value;
      var sta3=document.getElementById("pas").value;
      var x=sta.trim();
      var x1=sta1.indexOf(' ');
      var x2=sta2.trim();
      var x3=sta3.indexOf(' ');
  if(sta!="" && x==""){
    document.getElementById("pname").value="";
    document.getElementById("pname1p").focus();
      alert("Space Not Allowed");
        }
        
         else if(sta1!="" && x1>=0){
    document.getElementById("pid").value="";
    document.getElementById("pid").focus();
      alert("Space Not Allowed");
        }
        else if(sta2!="" && x2==""){
    document.getElementById("pspec").value="";
    document.getElementById("pspec").focus();
      alert("Space Not Allowed");
        }
        else if(sta3!="" && x3>=0){
    document.getElementById("pas").value="";
    document.getElementById("pas").focus();
      alert("Space Not Allowed");
        }      
}
</script>
</head>

<body style="background-size: cover;
    background-image: url(home_bg1.jpeg);
    background-position: center;">
	<nav  class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><b>Home</b></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li ><a href="official_login.php">Official Login</a></li>
        <li><a href="incharge_view_police.php">Incharge Home</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="police_add.php">Log Police Officer</a></li>
        <li><a href="Incharge_complain_page.php">Complaint History</a></li>
        <li><a href="inc_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>
<div class="video" style="margin-top: 5%"> 
	<div class="center-container">
		 <div class="bg-agile">
			<br><br>
			<div class="login-form"><p><h2>Log Police Officer</h2></p><br>	
				<form action="#" method="post" style="color: gray">Police Name
					<input type="text"  name="police_name" placeholder="Police Name" required="" id="pname" onfocusout="f1()"/>
					Police Id<input type="text"  name="police_id" placeholder="Police Id" required="" id="pid" onfocusout="f1()"/>
                    Specialist<input type="text"  name="police_spec" placeholder="Specialist" id="pspec" required onfocusout="f1()"/>
                    
                    Location of Police Officer<input type="text" required  name="location" disabled value="<?php echo "$location"; ?>">
          <br>
					Password<input type="text"  name="password" placeholder="Password" id="pas" onfocusout="f1()" required/>
					<input type="submit" value="Submit" name="s">
				</form>	
			</div>	
		</div>
	</div>	
</div>	
 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>