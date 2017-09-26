<?php require_once('Connections/osc.php'); 
$osc = mysqli_connect("localhost", "root", "", "osc");
global $osc;
?>
<?php
if (!function_exists("GetSQLValueString")) {
	
	$osc = mysqli_connect("localhost", "root", "", "osc");
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

$theValue = function_exists("mysqli_real_escape_string") ? mysqli_real_escape_string($osc, $theValue) : mysqli_escape_string($osc, $theValue);

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

// *** Redirect if username exists
$MM_flag="MM_insert";
if (isset($_POST[$MM_flag])) {
  $MM_dupKeyRedirect="register_username.php";
  $loginUsername = $_POST['txt_username'];
  $LoginRS__query = sprintf("SELECT username FROM user_profile WHERE username=%s", GetSQLValueString($loginUsername, "text"));
  mysqli_select_db($osc, $database_osc);
  $LoginRS=mysqli_query($osc, $LoginRS__query) or die(mysql_error());
  $loginFoundUser = mysqli_num_rows($LoginRS);

  //if there is a row in the database, the username was found - can not add the requested username
  if($loginFoundUser){
    $MM_qsChar = "?";
    //append the username to the redirect page
    if (substr_count($MM_dupKeyRedirect,"?") >=1) $MM_qsChar = "&";
    $MM_dupKeyRedirect = $MM_dupKeyRedirect . $MM_qsChar ."requsername=".$loginUsername;
    header ("Location: $MM_dupKeyRedirect");
    exit;
  }
}

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form")) {
  $insertSQL = sprintf("INSERT INTO user_profile (username, password, first_name, last_name, address_line1, address_line2, city, `state`, pincode, email, phone) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['txt_username'], "text"),
                       GetSQLValueString($_POST['txt_password'], "text"),
                       GetSQLValueString($_POST['txt_first_name'], "text"),
                       GetSQLValueString($_POST['txt_last_name'], "text"),
                       GetSQLValueString($_POST['txt_address_line1'], "text"),
                       GetSQLValueString($_POST['txt_address_line2'], "text"),
                       GetSQLValueString($_POST['txt_city'], "text"),
                       GetSQLValueString($_POST['txt_state'], "text"),
                       GetSQLValueString($_POST['txt_pincode'], "int"),
                       GetSQLValueString($_POST['txt_email'], "text"),
                       GetSQLValueString($_POST['txt_phone'], "text"));

  //mysql_select_db($database_osc, $osc);
  mysqli_select_db($osc, "osc");
  $Result1 = mysqli_query($osc, $insertSQL) or die(mysqli_error());

  $insertGoTo = "register_sucess.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

//mysql_select_db($database_osc, $osc);
mysqli_select_db($osc, "osc");
$query_Recordset1 = "SELECT * FROM user_profile";
$Recordset1 = mysqli_query($osc, $query_Recordset1) or die(mysql_error());
$row_Recordset1 = mysqli_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysqli_num_rows($Recordset1);
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
<script src="SpryAssets/SpryValidationTextField.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationPassword.js" type="text/javascript"></script>
<script src="SpryAssets/SpryValidationConfirm.js" type="text/javascript"></script>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationPassword.css" rel="stylesheet" type="text/css" />
<link href="SpryAssets/SpryValidationConfirm.css" rel="stylesheet" type="text/css" />
</head>
<body>

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
                         <li><a href="register.php" class="nav4">Register</a></li>
                         <li class="divider"></li>                         
                         <li><a href="shipping.php" class="nav5">Shipping </a></li>
                         <li class="divider"></li>
                         <li><a href="about us.php" class="nav6">About Us</a></li>
                         <li class="divider"></li>
                      <li><a href="contact.php" class="nav6">Contact Us</a></li>
                         
                    </ul>

             <div class="right_menu_corner"></div>
            </div><!-- end of menu tab -->
            
     <div class="crumb_navigation">
    Navigation: <a href="index.php">Home</a> &lt; <span class="current">Register</a></span>
    
    </div>
    <?php //include('includes/sidebar.php'); ?>
    <!-- end of left content -->
  

   
   <div class="center_content">
   	<div class="center_title_bar">Registeration</div>
    
    	<div class="prod_box_big">
        	<div class="top_prod_box_big"></div>
            <div class="center_prod_box_big">            
                 <form name="form" action="<?php echo $editFormAction; ?>" method="POST">
              	<div class="contact_form">
                     <div class="form_row">
                    <label class="contact"><strong>Username:</strong></label>
                    <span id="sprytextfield1">
                    <input name="txt_username" type="text" class="contact_input" id="txt_username" />
                    <span class="textfieldRequiredMsg"> value is required.</span></span></div>        
                    <div class="form_row">
                    <label class="contact"><strong>Password:</strong></label>
                    <span id="sprypassword1">
                    <input name="txt_password" type="password" class="contact_input" id="txt_password" />
                    <span class="passwordRequiredMsg"> value is required.</span><span class="passwordMinCharsMsg">Minimum number of characters not met.</span><span class="passwordMaxCharsMsg">Exceeded maximum number of characters.</span></span></div>  
                    <div class="form_row">
                    <label class="contact"><strong>Confirm:</strong></label>
                    <span id="spryconfirm1">
                    <input name="txt_confirm" type="password" class="contact_input" id="txt_confirm" />
                    <span class="confirmRequiredMsg"> value is required.</span><span class="confirmInvalidMsg">The values don't match.</span></span></div>  
                    <div class="form_row">
                    <label class="contact"><strong>First Name:</strong></label>
                    <span id="sprytextfield2">
                    <input name="txt_first_name" type="text" class="contact_input" id="txt_first_name" />
                    <span class="textfieldRequiredMsg"> value is required.</span></span></div>  
<div class="form_row">
                    <label class="contact"><strong>Last Name:</strong></label>
                <span id="sprytextfield3">
                    <input name="txt_last_name" type="text" class="contact_input" id="txt_last_name" maxlength="20" />
                    <span class="textfieldRequiredMsg"> value is required.</span></span></div>
                  <div class="form_row">
                    <label class="contact"><strong>Address:1</strong></label>
                    <span id="sprytextfield4">
                    <input name="txt_address_line1" type="text" class="contact_input" id="txt_address_line1" maxlength="30" />
                    <span class="textfieldRequiredMsg"> value is required.</span></span></div>
                  <div class="form_row">
                    <label class="contact"><strong>Address:2</strong>.</label>
                    <span id="sprytextfield5">
                    <input name="txt_address_line2" type="text" class="contact_input" id="txt_address_line2" maxlength="30" />
                    <span class="textfieldRequiredMsg"> value is required.</span></span></div>
                  <div class="form_row">
                    <label class="contact"><strong>City</strong>:</label>
                    <span id="sprytextfield6">
                    <input name="txt_city" type="text" class="contact_input" id="txt_city" maxlength="25" />
                    <span class="textfieldRequiredMsg"> value is required.</span></span></div>

<div class="form_row">
                    <label class="contact"><strong>State:</strong></label>
                <span id="sprytextfield7">
                    <input name="txt_state" type="text" class="contact_input" id="txt_state" maxlength="25" />
                    <span class="textfieldRequiredMsg"> value is required.</span></span></div>
<div class="form_row">
                    <label class="contact"><strong>Pincode:</strong></label>
                <span id="sprytextfield8">
                <input name="txt_pincode" type="text" class="contact_input" id="txt_pincode" maxlength="6" />
                <span class="textfieldRequiredMsg"> value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div>


                  <div class="form_row">
                    <label class="contact"><strong>Email:</strong></label>
                    <span id="sprytextfield9">
                    <input name="txt_email" type="text" class="contact_input" id="txt_email" maxlength="30" />
                    <span class="textfieldRequiredMsg"> value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div>


                    <div class="form_row">
                    <label class="contact"><strong>Phone:</strong></label>
                    <span id="sprytextfield10">
                    <input name="txt_phone" type="text" class="contact_input" id="txt_phone" maxlength="12" />
                    <span class="textfieldRequiredMsg"> value is required.</span><span class="textfieldInvalidFormatMsg">Invalid format.</span></span></div>
                    
                    

                    
                  <div class="form_row">
                  <input name="submit" type="submit" value="submit" />
                  </div>      
                    
                </div>
              	<input type="hidden" name="MM_insert" value="form" />
                </form>
                                     
            </div>
            <div class="bottom_prod_box_big"></div>                                
        </div>
       
    
   
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
   </div>
   <!-- end of right content -->   
   
            
   </div><!-- end of main content -->
   <?php include('includes/footer.php'); ?> 
   </div>
<!-- end of main_container -->
<script type="text/javascript">
var sprytextfield1 = new Spry.Widget.ValidationTextField("sprytextfield1");
var sprypassword1 = new Spry.Widget.ValidationPassword("sprypassword1", {minChars:6, maxChars:15});
var spryconfirm1 = new Spry.Widget.ValidationConfirm("spryconfirm1", "txt_password");
var sprytextfield2 = new Spry.Widget.ValidationTextField("sprytextfield2");
var sprytextfield3 = new Spry.Widget.ValidationTextField("sprytextfield3");
var sprytextfield4 = new Spry.Widget.ValidationTextField("sprytextfield4");
var sprytextfield5 = new Spry.Widget.ValidationTextField("sprytextfield5");
var sprytextfield6 = new Spry.Widget.ValidationTextField("sprytextfield6");
var sprytextfield7 = new Spry.Widget.ValidationTextField("sprytextfield7");
var sprytextfield8 = new Spry.Widget.ValidationTextField("sprytextfield8", "integer");
var sprytextfield9 = new Spry.Widget.ValidationTextField("sprytextfield9", "email");
var sprytextfield10 = new Spry.Widget.ValidationTextField("sprytextfield10", "integer");
</script>
</body>
</html>
<?php
mysqli_free_result($Recordset1);
?>
