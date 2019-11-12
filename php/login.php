       <?php include("database.php");
                
  ?>
   <?php 
    
            $test="nolog";
            $test2="nopass";
  if(isset($_POST["login_submit"])){ 
   $requete = "SELECT *   FROM `staff` ";    
   $resultat = $bdd->query($requete ) ;
  $nbligne = $resultat->rowCount(); 
	$test="errlog";
   $test2="errpass";  
  while ($donnees = $resultat->fetch()){ 
         if ($donnees["email"] == $_POST["user"] || $donnees["username"] == $_POST["user"]){
                   
  
                      if ( $donnees["password"] === $_POST["password"]){
                                 $test2="okpass";     
                                 $_SESSION["staffID"] = $donnees["staffID"];  
                                 $_SESSION["staffNames"] = $donnees["staffNames"];  
                                 $_SESSION["email"] = $donnees["email"];
                                 $_SESSION["priv"] = $donnees["priv"];;
          echo '<script> alert("Successfully logged in !"); window.location.replace("index.php"); </script>';
		  } else { echo '<script> alert("wrong password !") ; window.location.replace("login.php"); </script>';}

                                           
                                            }
                      }  
					  echo '<script> alert("no such user !") ; </script>';
    }
     
/* echo 'test = '. $test ;
 echo '<br> test2 = '. $test2 ;  */
  

?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">

    <title>Login</title>

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
		        <h2 class="form-login-heading">sign in now</h2>
		        <div class="login-wrap">
		            <input type="text" name="user" class="form-control" placeholder="Username or Email" autofocus>
		            <br>
		            <input type="password" name="password" class="form-control" placeholder="Password">

		            <button class="btn btn-theme btn-block" name="login_submit" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
		            <hr>
	
		            <div class="registration">
		                Don't have an account yet?<br/>
		                <a class="" href="signin.php">
		                    Create an account
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
