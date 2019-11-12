<?php 

include("database.php");

require_once("header.php");
?>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Privilege Requests</h2>
					</div>
	
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th >RequestID</th>
                        <th >username</th>
                        <th >Name</th>
                        <th>Email</th>
                        <th >Phone</th>
                        <th style="width:10%" >Actions</th>

                    </tr>
                </thead>
                <tbody>
				<form method="post" id="delete_form">
				<?php			


				$messagesParPage=50;  


//Une connexion SQL doit être ouverte avant cette ligne...
$rep=$bdd->query('SELECT COUNT(*) AS total FROM customer'); //Nous récupérons le contenu de la requête dans $retour_total
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
 
$req='SELECT * FROM requests LIMIT '.$premiereEntree.', '.$messagesParPage ;
$rep=$bdd->query($req);
 ?>
				<?php
        
        
          foreach ( $rep as $i ){ 
		  extract($i);
				echo '
                    <tr>';
                      echo "  <td>$requestID</td> " ;
                      $req="select * from staff where staffID = ".$userID ;
                      $rep=$bdd->query($req);
                      foreach ($rep as $i){
                      echo "  <td>".$i['username']."</td> " ;
                      echo "  <td>".$i['staffNames']."</td> " ;
                      echo "  <td>".$i['email']."</td> " ;
                      echo "  <td>".$i['mobile']."</td> " ;

                      }
                     echo '  <td>
                           <a class="btn btn-success btn-xs" href="privSubmit.php?grant='.$userID.'"><i class="fa fa-check"></i></a>
                            <a  href="privSubmit.php?deny='.$userID.'" class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i>
                        </td>
                    </tr>'	 ;
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
include('footer.php');
?>