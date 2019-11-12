<?php
include('database.php');
$rep=$bdd->query("select * from stats where label='smsService'") ;
foreach ( $rep as $i) {
    $state=$i['state'] ;
}
if ($state==''){
$repidc=$bdd->exec("UPDATE `stats` SET `state` = 'checked' WHERE `stats`.`label` = 'smsService'; ") ;
}
else{
$repidc=$bdd->exec("UPDATE `stats` SET `state` = '' WHERE `stats`.`label` = 'smsService'; ") ;
}
echo '<script>window.close();</script>'
?>