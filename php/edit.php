	<?php 

include("database.php");

include("header.php");

 if(isset($_POST["submit_edit"])){

    extract($_POST)    ;
           $requete2="SELECT * FROM  `customer` WHERE CustID =  '$name'" ;
        
         $resultat2 = $bdd->query($requete2) ;
        
          $nbligne = $resultat2->rowCount();
		  
		  
          if($nbligne==0 or $name==$prevname)   {
		 $requete =	 "UPDATE  `customer` SET  `CustID` =  '$name' ,`Email`='$email',`Phone`='$phone'  WHERE  `customer`.`CustID` =  '$prevname';" ;
		           $resultat = $bdd->exec($requete) ;
				  echo ' <script>window.location.replace("index.php");</script> ' ;
	

		  }
		  else {
			  echo "<script>alert('name already in use');</script>";
		  }


		  
 }
 
?>


	
	<?php
	if(isset($_GET['name'])){ 
	
		           $req="SELECT * FROM  `customer` WHERE CustID =  '".$_GET['name']."'" ;
         $res = $bdd->query($req) ;
		 foreach ($res as $i ){
			 extract($i);
?>
	
	<div id="editCostumerModal" >
		<div class="modal-dialog">
			<div class="modal-content">
				<form method="post" >
					<div class="modal-header">						
						<h4 class="modal-title">Edit Costumer</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div class="modal-body">					
						<div class="form-group">
							<label>Name</label>
							<input type="text" name="name" class="form-control"  value="<?php echo $CustID ;  ?>" required>
							<input type="text" name="prevname"  value="<?php echo $CustID ;  ?>" hidden>
						</div>
						<div class="form-group">
							<label>Email</label>
							<input type="email" name="email" value="<?php echo $Email ;  ?>"  class="form-control" required>
						</div>
						<div class="form-group">
							<label>Phone</label>
							<input type="text" name="phone" value="<?php echo $Phone ; ?>"  class="form-control" required>
						</div>					
					</div>
	<?php						 }

	}
	
	?>
					<div class="modal-footer">
						<a href="index.php"><input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel"></a>
						<input type="submit" name="submit_edit"  class="btn btn-info" value="Save">
					</div>
				</form>
			</div>
		</div>
	</div>