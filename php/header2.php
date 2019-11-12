
<html lang=''>
<head>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
<link rel="stylesheet" href="../css/checkbox.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
   <script src="../js/crud.js"></script>
   <link rel="stylesheet" href="../css/crud.css">
   <link rel="stylesheet" href="../css/nav.css">

   <title>Index</title>
</head>
<body > <!-- style="top:0" style="background-image:url('../images/traiteur.jpg');background-attachement:fixed;background-size: 100%;" -->

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <a class="navbar-link active" href="index.php">BranDB</a>


  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="searchOp.php">Search Operations </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="debitOp.php">Debit Operations</a>
      </li>
      <li class="nav-item">
        <a class="nav-link " href="credOp.php">Credit Operations</a>
      </li>    
      <li class="nav-item">
        <a class="nav-link " href="custOp.php">Customer Operations</a>
      </li>





    




     <?php
  if(isset($_SESSION["priv"]) ){
   if( $_SESSION["priv"]  == 1) {
       
         echo 
        '<li class="nav-item">
            <a class="nav-link "href="recMaint.php">Record Maintenance</a>
        </li>' ;
        
        
       require_once('database.php');
$rep=$bdd->query("select * from stats where label='smsService'") ;

foreach ( $rep as $i) {
$state=$i['state'] ;
}

  echo <<<EOL
      <li class="nav-item" style="  position: relative;  right: 0px; " >
        <label class="tgl" style="font-size:14px">  
    <input onclick="openInNewTab('toggle.php');" name="ont" type="checkbox" $state />
    <span data-on="SMS Enabled" data-off="SMS Disabled"></span>
  </label>
  
  </li>
  
  <li class="nav-item" style=" position: absolute;  right: 0px;  " >
            <a class="nav-link "  href="logout.php">Logout</a>
        </li>
        
<script>
function openInNewTab(url) {
  var win = window.open(url, '_blank');
 window.opener.focus();
    
}
</script>
        
        
        
EOL;
        } 
      }
      else
      {
            echo <<<EOL
<li class="nav-item" style=" position: absolute;  right: 0px;  ">
            <a class="nav-link "   href="login.php">Login</a>
        </li>
  

        
        
        
EOL;
          
          
      }

   ?>
    </ul>

  </div>
</nav>
<br>

