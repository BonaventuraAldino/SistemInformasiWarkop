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
  $updateSQL = sprintf("UPDATE pembayaran SET kd_pemesanan=%s, total_bayar=%s WHERE no_pmbyr=%s",
                       GetSQLValueString($_POST['kd_pemesanan'], "text"),
                       GetSQLValueString($_POST['total_bayar'], "int"),
                       GetSQLValueString($_POST['no_pmbyr'], "text"));

  mysql_select_db($database_koneksiku, $koneksiku);
  $Result1 = mysql_query($updateSQL, $koneksiku) or die(mysql_error());

  $updateGoTo = "data_pembayaran.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['no_pmbyr'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['no_pmbyr'] : addslashes($_GET['no_pmbyr']);
}
mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = sprintf("SELECT * FROM pembayaran WHERE no_pmbyr = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE HTML>
<html>
<head>
<title>DATA PEMBAYARAN WARKOP</title>
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
						<li><a href="data_pembayaran.php">BACK</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>EDIT DATA PEMBAYARAN</h2>
						
					</header>
						<!-- Tabel  -->
                        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                          <table align="center">
                            <tr valign="baseline">
                              <td nowrap align="right">No. Pembayaran</td>
                              <td><?php echo $row_Recordset1['no_pmbyr']; ?></td>
                            </tr>

<?php 
//KONEKSI DATABASE
$servername="localhost";
$user="root";
$pass="";
$db="warkop";

$connection= mysqli_connect($servername, $user, $pass, $db);

if(!$connection){
  die ("Connection failed: ".mysqli_connect_error());
}

// TAMPILKAN DATA BARANG DAN HARGA
$barang=mysqli_query($connection, "SELECT * FROM pemesanan");
  $jsArray = "var total = new Array();\n"; 
?>  

<tr valign="baseline">
  <td nowrap align="right">Kode Pembayaran</td>
  <td>
    <select name="kd_pemesanan" onchange ="changeValue(this.value)" >
<option>- Pilih -</option>
<?php if(mysqli_num_rows($barang)) {?>
<?php while($row_brg= mysqli_fetch_array($barang)) {?>
<option value="<?php echo $row_brg["kd_pemesanan"]?>"> <?php echo $row_brg["kd_pemesanan"]?> </option>
<?php $jsArray .= "total['" . $row_brg['kd_pemesanan'] . "'] = {total_harga:'" . addslashes($row_brg['total_harga'])."'};\n"; } ?>
<?php } ?>
</select>
  </td>
</tr>

<tr valign="baseline">
    <td nowrap align="right">Total Bayar</td>
  <td>
    <input type="text" class="form-control" name="total_bayar" id="total_harga" value="0" readonly="readonly" />
  </td>
</tr>
                            <tr valign="baseline">
                              <td nowrap align="right">&nbsp;</td>
                              <td><input type="submit" value="Update record"></td>
                            </tr>
                          </table>
                          <input type="hidden" name="MM_update" value="form1">
                          <input type="hidden" name="no_pmbyr" value="<?php echo $row_Recordset1['no_pmbyr']; ?>">
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

      <script type="text/javascript">
        <?php echo $jsArray; ?>
        function changeValue(kd_pemesanan) {
          document.getElementById("total_harga").value = total[kd_pemesanan].total_harga;
        };
        </script>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>