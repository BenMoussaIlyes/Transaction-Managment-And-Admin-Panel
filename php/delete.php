	<?php 

include("database.php");

include("header.php");

 if(isset($_POST["submit_delete"])){

    extract($_GET)    ;

		 $requete =	 "DELETE FROM `customer` WHERE `CustID`='$name'" ;
		           $resultat = $bdd->exec($requete) ;
		 $requete =	 "DELETE FROM `dataflex` WHERE `CustID`='$name'" ;
		           $resultat = $bdd->exec($requete) ;
				  echo ' <script>window.location.replace("index.php");</script> ' ;

		  
 }
 
?>




	<div id="deleteCostumerModal" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post">
					<div class="modal-header">						
						<h4 class="modal-title">Delete Custumer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<p>Are you sure you want to delete these Records?</p>
						<p class="text-warning"><small>This action cannot be undone.</small></p>
					</div>
					<div class="modal-footer">
						<a href="index.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"></a>
						<input type="submit" name="submit_delete"  class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>