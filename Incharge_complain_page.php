<!DOCTYPE html>
<html>
<head>
    
    <?php
    session_start();
    if(!isset($_SESSION['x']))
        header("location:inchargelogin.php");
    
    $conn=mysql_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysql_error());
    }
    mysql_select_db("crime_portal",$conn);
    
    $i_id=$_SESSION['email'];
    $result1=mysql_query("SELECT location FROM police_station where i_id='$i_id'",$conn);
    $q2=mysql_fetch_assoc($result1);
    $location=$q2['location'];
    
    if(isset($_POST['s2']))
    {
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        $cid=$_POST['cid'];
        
        $_SESSION['cid']=$cid;
        $qu=mysql_query("select inc_status,location from complaint where c_id='$cid'");
        
        $q=mysql_fetch_assoc($qu);
        $inc_st=$q['inc_status'];
        $loc=$q['location'];
        
        if(strcmp("$loc","$location")!=0)
        {
            $msg="Case Not of your Location";
            echo "<script type='text/javascript'>alert('$msg');</script>";
        }
        else if(strcmp("$inc_st","Unassigned")==0)
        {   
            header("location:Incharge_complain_details.php");
            
        }
        else{
            header("location:incharge_complain_details1.php");
        }
    }
    }
    
    $query="select c_id,type_crime,d_o_c,location,inc_status,p_id from complaint where location='$location' order by c_id desc";
    $result=mysql_query($query,$conn);  
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
     if(sta2!="" && x2>=0)
     {
        document.getElementById("ciid").value="";
        alert("Blank Field not Allowed");
      }       
}
</script>
    
</head>
<body style="background-color: #dfdfdf">
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
        <li ><a href="inchargelogin.php">Incharge Login</a></li>
        <li class="active"><a href="Incharge_complain_page.php">Incharge Home</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active" ><a href="Incharge_complain_page.php">View Complaints</a></li>
        <li ><a href="incharge_view_police.php">Police Officers</a></li>
        <li><a href="inc_logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
      </ul>
    </div>
  </div>
 </nav>
    
    <form style="margin-top: 7%; margin-left: 40%;" method="post">
      <input type="text" name="cid" style="width: 250px; height: 30px; background-color:white;" placeholder="&nbsp Complaint Id" id="ciid" onfocusout="f1()" required>
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
        <th scope="col">Location</th>
        <th scope="col">Complaint Status</th>
          <th scope="col">Police ID</th>
      </tr>
    </thead>

            <?php
              while($rows=mysql_fetch_assoc($result)){

             ?> 

            <tbody style="background-color: white; color: black;">
      <tr>
        <td><?php echo $rows['c_id'];?></td>
        <td><?php echo $rows['type_crime'];?></td>     
        <td><?php echo $rows['d_o_c'];?></td>
          <td><?php echo $rows['location'];?></td>
          <td><?php echo $rows['inc_status']; ?></td>
          <td><?php echo $rows['p_id']; ?></td>
      </tr>
    </tbody>
    
    <?php
    } 
    ?>
  
</table>
 </div>
    <div style="position: fixed;
   left: 0;
   bottom: 0;
   width: 100%;
   height: 30px;
   background-color: rgba(0,0,0,0.8);
   color: white;
   text-align: center;">
  <h4 style="color: white;">&copy <b>2018 Crime Portal | All Right Reserved</b></h4>
</div>

 <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.4.js"></script>
 <script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>