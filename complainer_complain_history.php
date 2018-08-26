<!DOCTYPE html>
<html>
<head>
    <?php
    session_start();
    
    $conn=mysql_connect("localhost","root","");
    if(!$conn)
    {
        die("could not connect".mysql_error());
    }
    mysql_select_db("crime_portal",$conn);
    
    if(!isset($_SESSION['x']))
    header("location:userlogin.php");
    
        $u_id=$_SESSION['u_id'];
        $result1=mysql_query("SELECT a_no FROM user where u_id='$u_id'",$conn);
      
        $q2=mysql_fetch_assoc($result1);
        $a_no=$q2['a_no'];
    
    
    
    
    if(isset($_POST['s2']))
    {
        if($_SERVER["REQUEST_METHOD"]=="POST")
        {
            
            $cid=$_POST['cid'];

            $_SESSION['cid']=$cid;
            
            $resu=mysql_query("SELECT a_no FROM complaint where c_id='$cid'",$conn);
            $qn=mysql_fetch_assoc($resu);
                
            
           if($qn['a_no']==$q2['a_no'])
           {
                header("location:complainer_complain_details.php"); 
           }
            else
            {
              $message = "Not Your Case";
              echo "<script type='text/javascript'>alert('$message');</script>";
            }
        }
    }
    
    
    
    $query="select c_id,type_crime,d_o_c,location from complaint where a_no='$a_no' order by c_id desc";
    $result=mysql_query($query,$conn);  
    ?>
    
	<title>Complaint History</title>
    
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
                  alert("Space Not Allowed");
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
                        <li ><a href="complainer_page.php">User Login</a></li>
                        <li class="active"><a href="complainer_page.php">User Home</a></li>
                    </ul>
   
                    <ul class="nav navbar-nav navbar-right">
                        <li ><a href="complainer_page.php">Log New Complain</a></li>
                        <li class="active"><a href="complainer_complain_history.php">Complaint History</a></li>
                        <li><a href="logout.php">Logout &nbsp <i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
                    </ul>
                  </div>
              </div>
        </nav>


    <div>
        <form style="float: right; margin-right: 100px; margin-top: 65px;" method="post">
            <input type="text" name="cid" style="width: 250px; height: 30px; color: black;" placeholder="&nbsp Complain Id" id="ciid" onfocusout="f1()" required>
            <input class="btn btn-primary btn-sm" type="submit" value="Search" style="margin-top:2px; margin-left:20px;" name="s2">
        </form>
    </div>


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
<div style="position: fixed;
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