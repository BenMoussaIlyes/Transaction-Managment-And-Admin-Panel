<?php

include("database.php");
function fetch_customer_data($bdd,$cust)
{
        
    	$req='SELECT * FROM dataflex ' ;
    $req.="	where `CustID` = '$cust'" ;
    if (date('n')-1 != 0 ){
            $req.="	and month(`Dates`) = ".(date('n')-1) ;
            $req.="	and year(`Dates`) = ".(date('Y')) ;

    }
    else {
    $req.="	and year(`Dates`) = ".(date('Y')-1) ;
    }
    
    $rep=$bdd->query($req);
    
    	$output = '          <table class="table table-striped table-hover">
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
                    <tbody> ' ;
    	
              foreach ( $rep as $i ){ 
    		  extract($i);
    		  $balance = $Credit-$Debit ;
    				$output.= '
                        <tr> ' ;
    						
    
    
    						
                          $output.= "  <td>$TransID</td> " ;
                          $output.= "  <td>$Dates</td> " ;
                          $output.= "  <td>$CustID</td> " ;
                          $output.= "  <td>$Debit</td> " ;
                          $output.= "  <td>$Credit</td> " ;
                          $output.= "  <td>$Balance</td> " ;
                          $output.= '   </tr>'	 ;
    		  }
    		  
    		  
    	return $output;

}
$req2="	SELECT * FROM `customer` ";
$rep2=$bdd->query($req2);
foreach ($rep2 as $j){
    				echo fetch_customer_data($bdd , $j['CustID'] );
}


?>







