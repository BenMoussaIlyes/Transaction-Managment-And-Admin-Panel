       <?php include("database.php");
                
  ?>
   <?php 

  if(isset($_POST["submit_add"])){

    extract($_POST)    ;
           $requete2="SELECT * FROM  `staff` WHERE username =  '$user' or email='$email'" ;
        
         $resultat2 = $bdd->query($requete2) ;
        
          $nbligne = $resultat2->rowCount();
		  
		  
          if($nbligne==0)   {
		 $requete =	 "INSERT INTO `staff`(`staffID`, `username`, `password`, `staffNames`, `mobile`, `email`, `priv`) VALUES (NULL,'$user','$password','$name','$phone','$email','0')" ;
		           $resultat = $bdd->exec($requete) ;
		          echo' <script> alert("Successfully signed in !"); window.location.replace("login.php"); </script> ' ;
		  }
		  else {
			  echo "<script>alert('username/email already in use');</script>";
		  }
		  
 }

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">

    <title>Sign Up</title>

    <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
        
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->

	  <div id="login-page">
	  	<div class="container">
	  	
		      <form class="form-login" method="post">
		        <h2 class="form-login-heading">sign up now</h2>
		        <div class="login-wrap">
		            <input type="text" name="user" class="form-control" placeholder="Username" autofocus>
		            <br>
		            <input type="text" name="name" class="form-control" placeholder="Full Name">
		            <br>
		            <input type="email" name="email" class="form-control" placeholder="Email">
		            <br>
		            <input type="number" name="phone" class="form-control" placeholder="Phone Number">
		            <br>		            
		            <input type="password" name="password" class="form-control" placeholder="Password">
		            <br>
		            <button class="btn btn-theme btn-block" name="submit_add" type="submit"><i class="fa fa-lock"></i> SIGN UP</button>
		            <hr>
	
		            <div class="registration">
		                Already have an account?<br/>
		                <a class="" href="login.php">
		                    Login
		                </a>
		            </div>
		
		        </div>
		
		         
		
		      </form>	  	
	  	
	  	</div>
	  </div>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>

    <!--BACKSTRETCH-->
    <!-- You can use an image of whatever size. This script will stretch to fit in any screen size.-->
    <script type="text/javascript" src="assets/js/jquery.backstretch.min.js"></script>
    <script>
        $.backstretch("assets/img/login-bg.jpg", {speed: 500});
    </script>


  </body>
</html>
