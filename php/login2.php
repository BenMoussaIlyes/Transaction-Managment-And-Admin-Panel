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
         if ($donnees["email"] == $_POST["email"]){
                   
  
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
					  echo '<script> alert("no such email !") ; </script>';
    }
     
/* echo 'test = '. $test ;
 echo '<br> test2 = '. $test2 ;  */
  

?>











<!DOCTYPE html>
<html lang="en" >

<head>
  <meta charset="UTF-8">
  <title>Login</title>
  
  
  
      <link rel="stylesheet" href="../css/login.css">
  
</head>
<body>
<div class="login-page">
  <div class="form">

    <form class="login-form" method="post">
      <input name="email" type="text" placeholder="email"/>
      <input name="password" type="password" placeholder="password"/>
      <button name="login_submit" >login</button>
      <p class="message">Not registered? <a href="signin.php">Create an account</a></p>
    </form>
  </div>
</div>
</body>
</html>
