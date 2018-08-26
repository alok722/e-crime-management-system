<!DOCTYPE html>
<html>
<head>
    
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
    
    $cid=$_SESSION['cid'];
    $p_id=$_SESSION['pol'];    
    
    $query="select c_id,type_crime,d_o_c,description,mob,u_addr from complaint natural join user where c_id='$cid' and p_id='$p_id'";
    $result=mysql_query($query,$conn);  
    
    if(isset($_POST['status'])){
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $upd=$_POST['update'];
            $qu1=mysql_query("insert into update_case(c_id,case_update) values('$cid','$upd')",$conn);
        }
    }
    
    if(isset($_POST['close'])){
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            $up=$_POST['final_report'];
            $qu2=mysql_query("insert into update_case(c_id,case_update) values('$cid','$up')",$conn);
            $q2=mysql_query("update complaint set pol_status='ChargeSheet Filed' where c_id='$cid'",$conn);
           
        }
    }
     $res2=mysql_query("select d_o_u,case_update from update_case where c_id='$cid'",$conn);
    
    ?>

	<title>Incharge Homepage</title>
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
	<link href="http://fonts.googleapis.com/css?family=Lato:300,400,700,300italic,400italic,700italic" rel="stylesheet" type="text/css">
<script>
     function f1()
        {
        var sta2=document.getElementById("ciid").value;
        var x2=sta2.indexOf(' ');
        if(sta2=="" && x2>=0){
          document.getElementById("ciid").value="";
          alert("Blank FIeld Not Allowed");
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
      
      <ul class="nav navbar-nav navbar-right">
        <li ><a href="police_pending_complain.php">View Complaints</a></li>
        <li class="active" ><a href="police_complainDetails.php">Complaints Details</a></li>
        <li><a href="p_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>
<div style="padding:50px; margin-top:10px;">
   <table class="table table-bordered">
    <thead class="thead-dark" style="background-color: black; color: white;">
    <tr>
      <th scope="col">Complaint Id</th>
      <th scope="col">Type of Crime</th>
      <th scope="col">Date of Crime</th>
      <th scope="col">Description</th>
        <th scope="col">Complainant Mobile</th>
        <th scope="col">Complainant Address</th>
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
        <td><?php echo $rows['description']; ?></td>
        <td><?php echo $rows['mob']; ?></td>
        <td><?php echo $rows['u_addr']; ?></td>
      </tr>
       </tbody>
       <?php
} 
?>
          
</table>
 </div>
    
<div style="padding:50px; margin-top:8px;">
   <table class="table table-bordered">
        <thead class="thead-dark" style="background-color: black; color: white;">
    <tr>
      <th scope="col">Date Of Update</th>
      <th scope="col">Case Update</th>
    </tr>
       </thead>
      <?php
              while($rows1=mysql_fetch_assoc($res2)){
             ?> 
       <tbody style="background-color: white; color: black;">
    <tr>
        
      <td><?php echo $rows1['d_o_u']; ?></td>
      <td><?php echo $rows1['case_update']; ?></td>
        
        
    </tr>
       </tbody>
       <?php
} 
?>
          
</table>
 </div>

  <div style="width: 100%; height: 250px;"> 
    
    <div style="width: 50%;float: left;height: 250px; background-color: #dcdcdc"> 
     
     <form method="post">
    
      <h5 style="text-align: center;"><b>Complaint ID</b></h5>                 
      <input type="text" name="cid" style="margin-left: 47%; width: 50px;" disabled value="<?php echo "$cid" ?>">
        
         
      <select class="form-control" style="align-content: center;margin-top: 20px; margin-left: 35%; width: 180px;" name="update">
          <option>Criminal Verified</option>
          <option>Criminal Caught</option>
          <option>Criminal Interrogated</option>
          <option>Criminal Accepted the Crime</option>
          <option>Criminal Charged</option>
      </select>

      <input class="btn btn-primary btn-sm" type="submit" value="Update Case Status" name="status" style="margin-top: 10px; margin-left: 40%;">
        
    </form>
    </div>     
     <div style="width: 50%;float: right;height: 250px; background-color: #dfdfdf;">
     <form method="post">
     <textarea name="final_report" cols="40" rows="5" placeholder="Final Report" style="margin-top: 20px;margin-left: 20px;" id="ciid" onfocusout="f1()" required></textarea>
     <div>
      <input  class="btn btn-danger" type="submit" value="Close Case" name="close" style="margin-left: 20px; margin-top: 10px; margin-bottom:20px;">
       </div> 
    </form>
  </div>

 </div>
    <div style="position: relative;
    float: left;
    margin-bottom: 0px;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: rgba(0,0,0,0.8);
   color: white;
   text-align: center;">
  <h4 style="color: white;">&copy <b>Crime Portal 2018</b></h4>
</div> 

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>