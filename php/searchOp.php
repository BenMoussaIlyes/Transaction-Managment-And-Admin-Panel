<?php 
include("database.php");

include("header.php");

						  require "vendor/autoload.php";
						  use telesign\sdk\messaging\MessagingClient;

  if(isset($_POST["submit_add"])){

    extract($_POST)    ;
           $requete2="SELECT * FROM  `dataflex` WHERE CustID =  '$name' order by `Dates` Desc , `TransID` Desc LIMIT 0, 1" ;

        $requete3="SELECT * FROM  `customer` WHERE CustID =  '$name'" ;
                 $resultat3 = $bdd->query($requete3) ;
                 foreach ( $resultat3 as $i ){
                 	$phone=$i['Phone'] ;
                 }

         $resultat2 = $bdd->query($requete2) ;
        
          $nbligne = $resultat3->rowCount();
		  
		  
          if($nbligne!=0)   {
			  foreach ($resultat2 as $i ) {
				  extract($i);
			  $balance= $Balance - $debit + $credit ;
		 $requete =	 "INSERT INTO `dataflex`(`TransID`, `Dates`, `CustID`, `Debit`, `Credit`, `Balance`) VALUES (NULL,'$date','$name','$debit','$credit','$balance')" ;

		           if($bdd->exec($requete) ) {
                            $rep=$bdd->query("select * from stats where label='smsService'") ;
                            foreach ( $rep as $i) {
                            $state=$i['state'] ;
                                }
                    if($state==="checked"){

				    	  $customer_id = "FC84FF47-70A0-4F86-8010-F1A6E6CE4680";
						  $api_key = "TcJXml1TIM9P0Nu1eH855HfQs8tjyc1U19aTeXmlLBGSQNJOIXwBZ5xSmE+V/dxk+UWtmRWGIIF79I5tGGY3GQ==" ;
						  $phone_number = $phone ; // "23408034588744";
						  $message = "Credit Amount posted into \nCustID : $name \nBalance: $balance ";
						  $message_type = "ARN";
						  $messaging = new MessagingClient($customer_id, $api_key);
						  $response = $messaging->message($phone_number, $message, $message_type); 
                        }
		           }
			  }
		  }
		  else {
			  echo "<script>alert('CustID does not exist');</script>";
		  }
		  
 }
 

?>




    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Transactions</b></h2>
					</div>
					<div class="col-sm-6">
						<div >
						<form >
						<table style=" border-radius: 15px; background-color:#5280e9 ; width:100%;   border-collapse: separate;  border-spacing: 10px;  ">
						<tr>
						<td style="text-align:left;font-size:15px;" >Add Filter : </td>
						</tr>
							<tr>
								<td>begin date</td>
								<td>end date</td>
							</tr>
							<tr>
								<td><input style="padding:2px;" type="date"  name="begin" class="form-control" placeholder="begin date"> </td>
								<td><input type="date" style="padding:2px;"  class="form-control"  name="end"   placeholder="end date"></td>
							</tr>
						
						<tr>
						<td><input type="text" name="cust" class="form-control" style="" placeholder="filter customer"></td>
                        <tr>
                                <td>
                                    <div>
                                      <input type="checkbox" id="debit" name="debit"
                                             checked>
                                      <label for="scales">Debit</label>
                                    </div>
                                </td>
                            
                                <td>
                                    <div>
                                      <input type="checkbox" id="credit" name="credit"
                                             checked>
                                      <label for="scales">Credit</label>
                                    </div>
                                </td>
                        </tr>


						<td><input type="submit" class="btn" style="border-radius: 5px;" value="Filter" ></td>
						</tr>
						</table>
						</form>
						</div>
					</div>
                </div>
	
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>


                        <th>TransID</th>
                        <th>Dates</th>
                        <th>CustID</th>
                        <th>Debit</th>
                        <th>Credit</th>
                        <th>Banace</th>
                    </tr>
                </thead>
                <tbody>
				<form method="post" id="delete_form">
		<?php			


				$messagesParPage=50;  

//Une connexion SQL doit être ouverte avant cette ligne...
$rep=$bdd->query('SELECT COUNT(*) AS total FROM dataflex'); //Nous récupérons le contenu de la requête dans $retour_total
foreach ($rep as $i ){ $total=$i['total']; } //On récupère le total pour le placer dans la variable $total.
 
//Nous allons maintenant compter le nombre de pages.
$nombreDePages=ceil($total/$messagesParPage);
 
if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle=intval($_GET['page']);
 
     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     {
          $pageActuelle=$nombreDePages;
     }
}
else // Sinon
{
     $pageActuelle=1;  
}
 
$premiereEntree=($pageActuelle-1)*$messagesParPage; 
 $append=0;
$req='SELECT * FROM dataflex ' ;
if(  isset($_GET['begin'])   ){ if ($_GET['begin']) {
	 $_GET['begin'] =str_replace("/", "-", $_GET['begin']  ) ;
	  $append=1;


	$req.="  WHERE `Dates` >= '".$_GET['begin']."'" ;

}}
if(   isset($_GET['end'])  ){ if($_GET['end']) {
 $_GET['end'] =str_replace("/", "-", $_GET['end']  ) ;
 if(    $append  ){ $req.= " and " ; }
 else { $req.= " Where " ; $append=1 ; }
$req.="	 `Dates` <= '".$_GET['end']."'" ;
} }
if(   isset($_GET['cust'])  ){ if ($_GET['cust']){
 if(   $append){ $req.= " and " ; }
 else { $req.= " Where " ;$append=1 ; }
$req.="	 `CustID` = '".$_GET['cust']."'" ;
}}
if (count($_GET) != 0 and ! isset($_GET['page'])){
if( !  isset($_GET['credit'])  ){
 if(  $append ){ $req.= " and " ;  }
 else { $req.= " Where " ; $append=1 ; }
$req.="	 `Credit` <> 0 " ;
}
if( !  isset($_GET['debit'])  ){
 if(   $append ){ $req.= " and " ; }
 else { $req.= " Where " ; }
$req.="	 `Debit` <> 0 " ;
}
}



$req.='   order by `Dates` Desc , `TransID` Desc  LIMIT '.$premiereEntree.', '.$messagesParPage ;

 //echo $req ;
$rep=$bdd->query($req);
 ?>
				<?php
        
        
          foreach ( $rep as $i ){ 
		  extract($i);
		  $balance = $Credit+$Debit ;
				echo '
                    <tr> ' ;
						


						
                      echo "  <td>$TransID</td> " ;
                      echo "  <td>$Dates</td> " ;
                      echo "  <td>$CustID</td> " ;
                      echo "  <td>$Debit</td> " ;
                      echo "  <td>$Credit</td> " ;
                      echo "  <td>$Balance</td> " ;
                      echo '   </tr>'	 ;
		  }
				
?>
</form>
                </tbody>
            </table>
	<?php	echo ' <div class="hint-text">Showing <b>'.$pageActuelle.'</b> out of <b>'.$nombreDePages.'</b> pages</div>';
	?>
							<div class="clearfix">
							                <ul class="pagination">


		<?php	
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
         echo ' <li class="page-item active"><a href="#" class="page-link">'.$i.'</a></li>' ;
     }	
     else //Sinon...
     {
          echo ' <li class="page-item"><a href="?page='.$i.'" class="page-link">'.$i.'</a></li>' ;

     }
}
?>


                </ul>
            </div>
        </div>
    </div>

<?php
include("footer.php");
                     	
?>	                            