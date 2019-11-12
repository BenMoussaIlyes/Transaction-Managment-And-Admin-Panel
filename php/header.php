<!DOCTYPE html>
<html lang=''>
<head>
   
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    
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


    <title>BranDB</title>
  <!-- Bootstrap core CSS -->
    <link href="assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="assets/js/gritter/css/jquery.gritter.css" />
    <link rel="stylesheet" type="text/css" href="assets/lineicons/style.css">    
    
    <!-- Custom styles for this template -->
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/style-responsive.css" rel="stylesheet">

    <script src="assets/js/chart-master/Chart.js"></script>
    
    

  </head>

  <body>

  <section id="container" >
      <!-- **********************************************************************************************************************************************************
      TOP BAR CONTENT & NOTIFICATIONS
      *********************************************************************************************************************************************************** -->
      <!--header start-->
      <header class="header black-bg">
              <div class="sidebar-toggle-box">
                  <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
              </div>
            <!--logo start-->
            <a href="index.php" class="logo"><b>BranDB</b></a>
            
            <!--logo end-->
           
<?php if(isset($_SESSION['staffID'])) {
    echo '
        <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="logout.php">Logout</a></li>
            	</ul>
            	 <ul class="nav pull-right top-menu">
                    <li><a class="logout" href="sendemails/index.php">Send Emails</a></li>
            	</ul>
            </div>
            
' ;

        }
        else
        echo '
                <div class="top-menu">
            	<ul class="nav pull-right top-menu">
                    <li><a class="logout" href="login.php">Login</a></li>
            	</ul>
            </div>
            ' ;
?>
    <?php
  if(isset($_SESSION["priv"]) ){
   if( $_SESSION["priv"]  == 1) {
       
        
        
       require_once('database.php');
$rep=$bdd->query("select * from stats where label='smsService'") ;

foreach ( $rep as $i) {
$state=$i['state'] ;
}

  echo <<<EOL
      <li class="nav pull-right top-menu" style="padding-right:30px;padding-top:4px;" >
        <label class="tgl" style="font-size:14px">  
    <input onclick="openInNewTab('toggle.php');" name="ont" type="checkbox" $state />
    <span data-on="SMS Enabled" data-off="SMS Disabled"></span>
  </label>
  
  </li>

EOL;
        }
      }
   ?>

        </header>
      <!--header end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN SIDEBAR MENU
      *********************************************************************************************************************************************************** -->
      <!--sidebar start-->
      <aside>
          <div id="sidebar"  class="nav-collapse ">
              <!-- sidebar menu start-->
              <ul class="sidebar-menu" id="nav-accordion">
              
              	  <h5 class="centered"><?php if(isset($_SESSION['staffNames'])) echo $_SESSION['staffNames']; ?></h5>
              	  <h6 class="centered"><?php if(isset($_SESSION['priv']))
              	  if($_SESSION['priv']){
              	  echo '(admin)';}
              	  else{ echo '(normal user)' ;$normal="yes"; } ?></h6>
              	  <?php
              	  if(isset($normal)) {
              	      $req="SELECT * FROM `requests` WHERE `userID`= ".$_SESSION['staffID'];
              	      $rep=$bdd->query($req);
              	      $nbligne=$rep->rowCount();
              	      if($nbligne==0)
echo <<<End
              	  <h6 class="centered"><button type="button" onclick="openInNewTab('request.php');" class=" btn btn-round btn-info btn-xs ">Request Admin Privilege</button></h6>
End;
              	  	}
              	  	?>




   <!--             <li class="sub-menu">
                      <a href="javascript:;" >
                          <span>Extra Pages</span>
                      </a>
                        <ul class="sub">
                          <li><a  href="blank.html">Blank Page</a></li>
                          <li><a  href="login.html">Login</a></li>
                          <li><a  href="lock_screen.html">Lock Screen</a></li>
                        </ul> 
                    </li> -->
      <li class="sub-menu">
        <a  href="searchOp.php">Search Operations </a>
      </li>
      <li class="sub-menu">
        <a href="debitOp.php">Debit Operations</a>
      </li>
      <li class="sub-menu">
        <a href="credOp.php">Credit Operations</a>
      </li>    
      <li class="sub-menu">
        <a  href="custView.php">Customer Operations </a>
      </li>
   

                  

     <?php
  if(isset($_SESSION["priv"]) ){
   if( $_SESSION["priv"]  == 1) {
                     	      $req="SELECT * FROM `requests` where `responded` = '0' ";
              	      $rep=$bdd->query($req);
              	      $nbligne=$rep->rowCount();
         echo 
        ' <li class="sub-menu">
              <a  href="recMaint.php">
                  Record Maintenance
              </a>
          </li>
        <li class="sub-menu">
        <a  href="privOp.php">Privilege Requests <span class="badge bg-theme sm">'.$nbligne.'</span></a>
      </li>
          ' ;
        }     
      }

   ?>

              </ul>
              <!-- sidebar menu end-->
          </div>
      </aside>
<script>

   
  
function openInNewTab(url) {
  var win = window.open(url, '_blank');
 window.opener.focus();
    
}
</script>
      <!--sidebar end-->
      
      <!-- **********************************************************************************************************************************************************
      MAIN CONTENT
      *********************************************************************************************************************************************************** -->
       <!--main content start-->
      <section id="main-content">
          <section class="wrapper">





