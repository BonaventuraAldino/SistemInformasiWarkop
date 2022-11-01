<?php require_once('../../Connections/koneksiku.php'); ?>
<?php
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = (!get_magic_quotes_gpc()) ? addslashes($theValue) : $theValue;

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE pegawai SET nm_pegawai=%s, username=%s, password=%s, alamat=%s, level=%s WHERE id_pegawai=%s",
                       GetSQLValueString($_POST['nm_pegawai'], "text"),
                       GetSQLValueString($_POST['username'], "text"),
                       GetSQLValueString($_POST['password'], "text"),
                       GetSQLValueString($_POST['alamat'], "text"),
                       GetSQLValueString($_POST['level'], "text"),
                       GetSQLValueString($_POST['id_pegawai'], "text"));

  mysql_select_db($database_koneksiku, $koneksiku);
  $Result1 = mysql_query($updateSQL, $koneksiku) or die(mysql_error());

  $updateGoTo = "data_pegawai.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['id_pegawai'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['id_pegawai'] : addslashes($_GET['id_pegawai']);
}
mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = sprintf("SELECT * FROM pegawai WHERE id_pegawai = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE HTML>
<html>
<head>
<title>DATA PEGAWAI WARKOP</title>
		<meta charset="utf-8" />	
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
</head>
<body>
			<!-- Header -->
			<header id="header">
				<h1><strong><a href="#"> <img src="../../images/Warkop.png" height="20 px" width="100 px"> </a></strong></h1>
				<nav id="nav">
					<ul>
						<li><a href="data_pegawai.php">BACK</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		  <!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>EDIT DATA PEGAWAI</h2>
					</header>
					<!-- Tabel  -->
                        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                          <table align="center">
                            <tr valign="baseline">
                              <td nowrap align="right">Id Pegawai:</td>
                              <td><?php echo $row_Recordset1['id_pegawai']; ?></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">Nama pegawai:</td>
                              <td><input required type="text" name="nm_pegawai" value="<?php echo $row_Recordset1['nm_pegawai']; ?>" size="32" required></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">Username:</td>
                              <td><input required type="text" name="username" value="<?php echo $row_Recordset1['username'];?>" size="32" required></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">Password:</td>
                              <td><input required type="text" name="password" value="<?php echo $row_Recordset1['password']; ?>" size="32" required></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">Alamat:</td>
                              <td><input required type="text" name="alamat" value="<?php echo $row_Recordset1['alamat']; ?>" size="32" required></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">Level:</td>
                              <td><input required type="text" name="level" value="<?php echo $row_Recordset1['level']; ?>" size="32" required></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">&nbsp;</td>
                              <td><input type="submit" value="Update record"></td>
                            </tr>
                          </table>
                          <input type="hidden" name="MM_update" value="form1">
                          <input type="hidden" name="id_pegawai" value="<?php echo $row_Recordset1['id_pegawai']; ?>">
                        </form>
                        <p>&nbsp;</p>
      <!-- Footer -->
			<footer id="footer">
				<div class="container">
					<ul class="icons">
						<li><a href="#" class="icon fa-facebook"></a></li>
						<li><a href="#" class="icon fa-twitter"></a></li>
						<li><a href="#" class="icon fa-instagram"></a></li>
					</ul>
					<ul class="copyright">
						<li>&copy; Copyright 2020</li>
						<li>WARKOP MURAH TAPI GAK MURAHAN</li>
					</ul>
				</div>
			</footer>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<script src="assets/js/main.js"></script>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
