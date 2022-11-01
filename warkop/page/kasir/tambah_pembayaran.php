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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
  $insertSQL = sprintf("INSERT INTO pembayaran (no_pmbyr, kd_pemesanan, total_bayar) VALUES (%s, %s, %s)",
                       GetSQLValueString($_POST['no_pmbyr'], "text"),
                       GetSQLValueString($_POST['kd_pemesanan'], "text"),
                       GetSQLValueString($_POST['total_bayar'], "int"));

  mysql_select_db($database_koneksiku, $koneksiku);
  $Result1 = mysql_query($insertSQL, $koneksiku) or die(mysql_error());

  $insertGoTo = "data_pembayaran.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = "SELECT * FROM pembayaran";
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<?php 
	 
	mysql_select_db($database_koneksiku, $koneksiku);
	$query_Recordset2 = "SELECT no_pmbyr FROM pembayaran ORDER BY no_pmbyr DESC";
	$Recordset2= mysql_query($query_Recordset2, $koneksiku) or die(mysql_error());
	$kd_bhn = mysql_fetch_array($Recordset2);
	$kode = $kd_bhn['no_pmbyr'];

	$urut = substr($kode,1,2);
	$tambah = (int) $urut + 1;

	if (strlen($tambah)==1) {
		$format = "C"."0".$tambah;
	} else {
		$format = "C".$tambah;
	}
?>
<?php
$jsArray = "var total = new Array();\n"; 
?>

<!DOCTYPE HTML>
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
						<h2>TAMBAH DATA PEMBAYARAN</h2>
						
					</header>
						<!-- Form -->
						<section>
							<form action="<?php echo $editFormAction;?>" name="form1" method="POST">
									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="no_pmbyr" id="no_pmbyr" value="<?php echo $format?>" readonly placeholder="Kode Pembayaran" />
									  </p>
									</div>
									
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

<div class="6u 12u$(xsmall)">
<div class="select-wrapper">
<select name="kd_pemesanan" onchange ="changeValue(this.value)" >
<option>- Pilih -</option>
<?php if(mysqli_num_rows($barang)) {?>
<?php while($row_brg= mysqli_fetch_array($barang)) {?>
<option value="<?php echo $row_brg["kd_pemesanan"]?>"> <?php echo $row_brg["kd_pemesanan"]?> </option>
<?php $jsArray .= "total['" . $row_brg['kd_pemesanan'] . "'] = {total_harga:'" . addslashes($row_brg['total_harga'])."'};\n"; } ?>
<?php } ?>

</select>
</div>
</div>

									<br>

									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" class="form-control" name="total_bayar" id="total_harga" value="0" readonly="readonly" />
									  	</p>
									</div>
									
									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Tambah Pembayaran" class="special" /></li>
											<li><input type="reset" value="Reset" /></li>
										</ul>
							  		</div>
		                            <input type="hidden" name="MM_insert" value="form1">
	                            </div>
						  </form>
						</section>
                   
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