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
  $updateSQL = sprintf("UPDATE bahan_baku SET nm_bhn=%s, kategori_bhn=%s, jumlah=%s WHERE kd_bhn=%s",
                       GetSQLValueString($_POST['nm_bhn'], "text"),
                       GetSQLValueString($_POST['kategori_bhn'], "text"),
                       GetSQLValueString($_POST['jumlah'], "int"),
                       GetSQLValueString($_POST['kd_bhn'], "text"));

  mysql_select_db($database_koneksiku, $koneksiku);
  $Result1 = mysql_query($updateSQL, $koneksiku) or die(mysql_error());

  $updateGoTo = "data_bahan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['kd_bhn'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['kd_bhn'] : addslashes($_GET['kd_bhn']);
}
mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = sprintf("SELECT * FROM bahan_baku WHERE kd_bhn = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE HTML>
<html>
<head>
<title>DATA BAHAN BAKU WARKOP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
</head>
<body>

			<!-- Header -->
			<header id="header">
				<h1><strong><a href="index.php"><img src="../../images/Warkop.png" height="20 px" width="100 px"></a></strong></h1>
				<nav id="nav">
					<ul>
						<li><a href="data_bahan.php">BACK</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>EDIT DATA BAHAN BAKU</h2>
						
					</header>
						<!-- Tabel  -->
                        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                          <table align="center">
                            <tr valign="baseline">
                              <td nowrap align="right">Kode Bahan:</td>
                              <td><?php echo $row_Recordset1['kd_bhn']; ?></td>
                            </tr>

                            <tr valign="baseline">
                              <td nowrap align="right">Nama Bahan:</td>
                              <td><input type="text" name="nm_bhn" value="<?php echo $row_Recordset1['nm_bhn']; ?>" size="32" required></td>
                            </tr>
                            
                            <tr valign="baseline">
                              <td nowrap align="right">Kategori Bahan:</td>
                              <td><input type="text" name="kategori_bhn" value="<?php echo $row_Recordset1['kategori_bhn']; ?>" size="32" required></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">Jumlah:</td>
                              <td><input type="text" name="jumlah" value="<?php echo $row_Recordset1['jumlah']; ?>" size="32" required></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">&nbsp;</td>
                              <td><input type="submit" value="Update record"></td>
                            </tr>
                          </table>
                          <input type="hidden" name="MM_update" value="form1">
                          <input type="hidden" name="kd_bhn" value="<?php echo $row_Recordset1['kd_bhn']; ?>">
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
