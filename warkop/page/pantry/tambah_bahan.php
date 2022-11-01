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
  $insertSQL = sprintf("INSERT INTO bahan_baku (kd_bhn, nm_bhn, kategori_bhn, jumlah) VALUES (%s, %s, %s, %s)",
                       GetSQLValueString($_POST['kd_bhn'], "text"),
                       GetSQLValueString($_POST['nm_bhn'], "text"),
                       GetSQLValueString($_POST['kategori_bhn'], "text"),
                       GetSQLValueString($_POST['jumlah'], "int"));

  mysql_select_db($database_koneksiku, $koneksiku);
  $Result1 = mysql_query($insertSQL, $koneksiku) or die(mysql_error());

  $insertGoTo = "data_bahan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = "SELECT * FROM bahan_baku";
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>


<!--Kode Otomatis-->
<?php 
	mysql_select_db($database_koneksiku, $koneksiku);
	$query_Recordset2 = "SELECT kd_bhn FROM bahan_baku ORDER BY kd_bhn DESC";
	$Recordset2= mysql_query($query_Recordset2, $koneksiku) or die(mysql_error());
	$kd_bhn = mysql_fetch_array($Recordset2);
	$kode = $kd_bhn['kd_bhn'];

	$urut = substr($kode,1,2);
	$tambah = (int) $urut + 1;

	if (strlen($tambah)==1) {
		$format = "B"."0".$tambah;
	} else {
		$format = "B".$tambah;
	}
	?>

<!DOCTYPE HTML>
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
						<li><a href="index_admin.php">HOME</a></li>
						<li><a href="kandungan_gizi_admin.php">KANDUNGAN GIZI</a></li>
						<li><a href="resep_makanan_admin.php">RESEP MAKANAN </a></li>
						<li><a href="menu_makanan_admin.php">MENU MAKANAN DAN MINUMAN </a></li>
						<li><a href="data_bahan.php">BACK</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>TAMBAH DATA BAHAN BAKU</h2>
						
					</header>
						<!-- Form -->
						<section>
							<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="kd_bhn" id="kd_bhn" value="<?php echo $format ?>" readonly placeholder="Kode Bahan"/>
									  </p>
									</div>

									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="nm_bhn" id="nm_bhn" value="" placeholder="Nama Bahan" required/>
									  </p>
									</div>
									
									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="kategori_bhn" id="kategori_bhn" value="" placeholder="Kategori Bahan" required/>
									  </p>
									</div>
									
									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="jumlah" id="jumlah" value="" placeholder="Jumlah" required/>
									  </p>
									</div>
									
									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Tambah Bahan Baku" class="special"/></li>
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

	</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
