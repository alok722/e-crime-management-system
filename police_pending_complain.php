<!DOCTYPE html>
<html>
<head>
	<title>Police pending complain</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
	
     <?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:policelogin.php");
    $conn=mysql_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysql_error());
    }
    mysql_select_db("crime_portal",$conn);
    if(isset($_POST['s2']))
    {
      if($_SERVER["REQUEST_METHOD"]=="POST")
      {
       $cid=$_POST['cid'];
       $_SESSION['cid']=$cid;
       $alok=mysql_query("select p_id from complaint where c_id='$cid'",$conn);
       $row = mysql_fetch_assoc($alok);
       $p_id=$_SESSION['pol'];
     if($row['p_id']==$p_id){
     header("location:police_complainDetails.php");}
     else{
         $message = "Not in your scope";
        echo "<script type='text/javascript'>alert('$message');</script>";
     }
 }
}
    
    $p_id=$_SESSION['pol'];
     $result=mysql_query("SELECT c_id,type_crime,d_o_c,location FROM complaint where p_id='$p_id' and pol_status='In Process' order by c_id desc",$conn);
    ?>
 <script>
     function f1()
        {
        var sta2=document.getElementById("ciid").value;
        var x2=sta2.indexOf(' ');
      if(sta2!="" && x2>=0){
          document.getElementById("ciid").value="";
          alert("Blank Field Found");
        }
}
</script>
</head>
<body>
	<nav  class="navbar navbar-default navbar-fixed-top">
  <div class="container">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="home.php"><b>Crime Portal</b></a>
    </div>
    <div id="navbar" class="collapse navbar-collapse">
      <ul class="nav navbar-nav">
        <li ><a href="official_login.php">Official Login</a></li>
        <li ><a href="policelogin.php">Police Login</a></li>
        <li class="active"><a href="police_pending_complain.php">Police Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active" ><a href="police_pending_complain.php">Pending Complaints</a></li>
        <li ><a href="police_complete.php">Completed Complaints</a></li>
        <li><a href="p_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>
    
    <form style="margin-top: 7%; margin-left: 40%;" method="post">
    <input type="text" name="cid" style="width: 250px; height: 30px; background-color:white; color:grey; margin-top:5px;" placeholder="&nbsp Complaint Id" onfocusout="f1()" required id="ciid">
        <div>
      <input class="btn btn-primary" type="submit" value="Search" name="s2" style="margin-top: 10px; margin-left: 11%;">
        </div>
    </form>
    
 <div style="padding:50px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
      <tr>
        <th scope="col">Complaint Id</th>
        <th scope="col">Type of Crime</th>
        <th scope="col">Date of Crime</th>
        <th scope="col">Location of Crime</th>
        
      </tr>
    </thead>

<?php
      while($rows=mysql_fetch_assoc($result)){
    ?> 

    <tbody style="background-color: white; color: black;">
      <tr>
        <td><?php echo $rows['c_id']; ?></td>
        <td><?php echo $rows['type_crime']; ?></td>     
        <td><?php echo $rows['d_o_c']; ?></td> 
        <td><?php echo $rows['location']; ?></td> 
                  
      </tr>
    </tbody>
    
    <?php
    } 
    ?>
  
</table>
 </div>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>