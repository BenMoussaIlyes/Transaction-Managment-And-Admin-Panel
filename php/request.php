<?php 
if (isset($_SESSION['priv'])){
    if($_SESSION['priv']!=1){
        include('database.php');
        $req="INSERT INTO `requests`(`requestID`, `userID`, `responded`) VALUES (NULL,'".$_SESSION['staffID']."','0')" ;
        $rep=$bdd->exec($req);

    }
    
}
echo '<script>window.close();</script>'

?>