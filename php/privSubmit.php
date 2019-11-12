<?php
include('database.php');
if(isset($_GET['grant'])){
    if($_GET['grant']){
        $req="UPDATE `staff` SET `priv` = '1' WHERE `staffID` = ".$_GET['grant'];
                $rep=$bdd->exec($req);

        $req="Delete from requests where `userID` =". $_GET['grant']; 
                $rep=$bdd->exec($req);

        echo' <script> window.location.replace("privOp.php"); </script> ' ;
 }
    
}
if(isset($_GET['deny'])){
    if($_GET['deny']){
        $req="Delete from requests where `userID` =". $_GET['deny']; 
        $rep=$bdd->exec($req);
      echo' <script> window.location.replace("privOp.php"); </script> ' ;

    }
    
}


?>