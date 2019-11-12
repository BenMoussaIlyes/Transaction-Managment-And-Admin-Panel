<?php 

include("database.php");

require_once("header.php");
if(isset($_SESSION["priv"])){
  if($_SESSION["priv"]!="1"){
              echo '<script>window.location.replace("custView.php"); </script>';

}  
}
  if(isset($_POST["submit_add"])){

    extract($_POST)    ;
           $requete2="SELECT * FROM  `customer` WHERE CustID =  '$name'" ;
        
         $resultat2 = $bdd->query($requete2) ;
        
          $nbligne = $resultat2->rowCount();
		  
		  
          if($nbligne==0)   {
		 $requete =	 " INSERT INTO `customer`(`CustID`, `Email`, `Phone`) VALUES ('$name','$email','$phone')" ;
		           $resultat = $bdd->exec($requete) ;
		 $requete =	 "INSERT INTO `dataflex`(`TransID`, `Dates`, `CustID`, `Debit`, `Credit` , `Balance`) VALUES (NULL,CURRENT_DATE(),'$name','0','0','$balance')" ;
		           $resultat = $bdd->exec($requete) ;
		  }
		  else {
			  echo "<script>alert('name already in use');</script>";
		  }
		  
 }
 
   if(isset($_POST["delete_selected"])){
	   
if (isset($_POST["options"])){
    extract($_POST)    ;
	foreach ($options as $i ){
		
				 $requete =	 "DELETE FROM `customer` WHERE `CustID`='$i'" ;
		           $resultat = $bdd->exec($requete) ;
	}
  
		  
   }
}
?>

    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-6">
						<h2>Manage <b>Costumers</b></h2>
					</div>
					<div class="col-sm-6">
						<a href="#addCostumerModal" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Add New Costumer</span></a>
						<a href="#deleteCostumerModal" class="btn btn-danger" data-toggle="modal"><i class="material-icons">&#xE15C;</i> <span>Delete</span></a>						
					</div>
                </div>
            </div>
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
							<span class="custom-checkbox">
								<input type="checkbox" id="selectAll">
								<label for="selectAll"></label>
							</span>
						</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Actions</th>

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
 
$req='SELECT * FROM customer LIMIT '.$premiereEntree.', '.$messagesParPage ;
$rep=$bdd->query($req);
 ?>
				<?php
        
        
          foreach ( $rep as $i ){ 
		  extract($i);
				echo '
                    <tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" value="'.$CustID.'" name="options[]" value="1">
								<label for="checkbox1"></label>
							</span>
						</td> ' ;
                      echo "  <td>$CustID</td> " ;
                      echo "  <td>$Email</td> " ;
                      echo "  <td>$Phone</td> " ;
                     echo '  <td>
                            <a href="edit.php?name='.$CustID.'" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>
                            <a href="delete.php?name='.$CustID.'" class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>
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
	<!-- Edit Modal HTML -->
	<div id="addCostumerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Add Costumer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="number" name="phone"  class="form-control" required>
						</div>		
						<div class="form-group">
							<label>Initial Balance</label>
							<input type="number" name="balance"  class="form-control" required>
						</div>				
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" name="submit_add" class="btn btn-success" value="Add">
					</div>
				</form>
			</div>
		</div>
	</div>
	<!-- Edit Modal HTML -->

	<!-- Delete Modal HTML -->
	<div id="deleteCostumerModal" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Costumer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
						<input type="submit" class="btn btn-danger" name="delete_selected" form="delete_form" value="Delete">
					</div>
			</div>
		</div>
	</div>
<?php
include('footer.php');
?>