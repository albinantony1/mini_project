<?php require_once('Connections/osc.php'); 
$osc = mysqli_connect("localhost", "root", "", "osc");


?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$maxRows_Recordset1 = 10;
$pageNum_Recordset1 = 0;
if (isset($_GET['pageNum_Recordset1'])) {
  $pageNum_Recordset1 = $_GET['pageNum_Recordset1'];
}
$startRow_Recordset1 = $pageNum_Recordset1 * $maxRows_Recordset1;

mysqli_select_db($osc, "osc");
$query_Recordset1 = "SELECT * FROM product_details ORDER BY product_id DESC";
$query_limit_Recordset1 = sprintf("%s LIMIT %d, %d", $query_Recordset1, $startRow_Recordset1, $maxRows_Recordset1);
//$Recordset1 = mysqli_query($query_limit_Recordset1, $osc) or die(mysql_error());
$Recordset1 = mysqli_query($osc, $query_limit_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);

if (isset($_GET['totalRows_Recordset1'])) {
  $totalRows_Recordset1 = $_GET['totalRows_Recordset1'];
} else {
  $all_Recordset1 = mysqli_query($osc, $query_Recordset1);
  $totalRows_Recordset1 = mysqli_num_rows($all_Recordset1);
}
$totalPages_Recordset1 = ceil($totalRows_Recordset1/$maxRows_Recordset1)-1;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Electronix Store</title>
<link rel="stylesheet" type="text/css" href="style.css" />
<!--[if IE 6]>
<link rel="stylesheet" type="text/css" href="iecss.css" />
<![endif]-->
<script type="text/javascript" src="js/boxOver.js"></script>
</head>
<body><div id="content"></div>

<div id="main_container">
	<div class="top_bar"></div>
	<div id="header">
        
        <div id="logo">
            <a href="index.php"><img src="images/logo.png" alt="" title="" border="0" width="237" height="140" /></a>
	    </div><!-- end of oferte_content-->
        

    </div>
    
   <div id="main_content"> 
   
            <div id="menu_tab">
            <div class="left_menu_corner"></div>
                    <ul class="menu">
                         <li><a href="index.php" class="nav1">  Home </a></li>
                         <li class="divider"></li>
                         <li></li>
                         <li class="divider"></li>
                         <li></li>
                         <li class="divider"></li> 
                         <li><a href="login.php" class="nav4">Log In</a></li>
                         <li class="divider"></li>
                         <li><a href="register.php" class="nav4">Register</a>                        <li class="divider"></li>
                         <li><a href="shipping.php" class="nav5">Shipping </a></li>
                        </li>
                         <li class="divider"></li>                         
                         <li><a href="about us.php" class="nav6">About Us</a></li>
                         <li class="divider"></li>
                         <li><a href="contact.php" class="nav6">Contact Us</a></li>
                         <li class="divider"></li>
                         </li>
                         
                    </ul>

             <div class="right_menu_corner"></div>
            </div><!-- end of menu tab -->
            
    <div class="crumb_navigation">
    Navigation: <span class="current"><a href="index.php">Home</a></span>
    
    </div>        
    
   <?php include('includes/sidebar.php'); ?>
   <!-- end of left content -->
   
   
   <div class="center_content">
   	<div class="center_title_bar">Latest Products</div>
    

    	<?php do { ?>
    	  <div class="prod_box">
    	    <div class="top_prod_box"></div>
    	    <div class="center_prod_box">            
    	      <div class="product_title"><a href="details.php?id=<?php echo $row_Recordset1['product_id']; ?>"><?php echo $row_Recordset1['title']; ?></a></div>
    	      <div class="product_img"><a href="details.php?id=<?php echo $row_Recordset1['product_id']; ?>"> <img src="upload/<?php echo $row_Recordset1['image']; ?>" height="120" width="100" alt="" title="" border="0" /></a></div>
    	      <div class="prod_price"> <span class="price"><img src="images/rs.jpg" alt="" title="" width="18" height="18" border="0" /></span><?php echo $row_Recordset1['price']; ?></div>                        
    	      </div>
    	    <div class="bottom_prod_box"></div>             
    	    <div class="prod_details_tab">
    	      <a href="#" title="header=[Add to cart] body=[&nbsp;] fade=[on]"><img src="images/cart.gif" alt="" title="" border="0" class="left_bt" /></a><a href="details.php?id=<?php echo $row_Recordset1['product_id']; ?>" class="prod_details">details</a>            
    	      </div>                     
   	      </div>
    	  <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
   </div><!-- end of center content -->
   
   <div class="right_content">
     <div class="title_box">Manufacturers</div>
    
        <ul class="left_menu">
        <li class="odd"><a href="#">Intel</a></li>
        <li class="even"><a href="#">Samsung</a></li>
         <li class="odd"><a href="#">Seagate</a></li>
        <li class="even"><a href="#">AMD</a></li>
         <li class="odd"><a href="#">Western Digital</a></li>
         <li class="even"><a href="#">Asus</a></li>
        <li class="odd"><a href="#">Giagabyte</a></li>
        <li class="even"><a href="#">HP</a></li>
        </ul>      
     
     <div class="banner_adds"></div>        
     
   </div><!-- end of right content -->   
   
            
   </div><!-- end of main content -->
   <?php include('includes/footer.php'); ?>     
</div>
<!-- end of main_container -->
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
