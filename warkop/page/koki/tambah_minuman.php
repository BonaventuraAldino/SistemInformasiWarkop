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
  $insertSQL = sprintf("INSERT INTO minuman (kd_minuman, kd_bahan, nm_menu, harga_min, jumlah) VALUES (%s, %s, %s, %s, %s)",
                       GetSQLValueString($_POST['kd_minuman'], "text"),
                       GetSQLValueString($_POST['kd_bahan'], "text"),
                       GetSQLValueString($_POST['nm_menu'], "text"),
                       GetSQLValueString($_POST['harga_min'], "int"),
                   	   GetSQLValueString($_POST['jumlah'], "int"));

  mysql_select_db($database_koneksiku, $koneksiku);
  $Result1 = mysql_query($insertSQL, $koneksiku) or die(mysql_error());

  $insertGoTo = "data_minuman.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
    $insertGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $insertGoTo));
}

mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = "SELECT * FROM minuman";
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>

<?php 
	mysql_select_db($database_koneksiku, $koneksiku);
	$query_Recordset2 = "SELECT kd_minuman FROM minuman ORDER BY kd_minuman DESC";
	$Recordset2= mysql_query($query_Recordset2, $koneksiku) or die(mysql_error());
	$kd_bhn = mysql_fetch_array($Recordset2);
	$kode = $kd_bhn['kd_minuman'];

	$urut = substr($kode,1,2);
	$tambah = (int) $urut + 1;

	if (strlen($tambah)==1) {
		$format = "D"."0".$tambah;
	} else {
		$format = "D".$tambah;
	}
?>

<!DOCTYPE HTML>
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
				<h1><strong><a href="index.php"><img src="../../images/Warkop.png" height="20 px" width="100 px"></a></strong></h1>
				<nav id="nav">
					<ul>
						<li><a href="data_minuman.php">BACK</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>TAMBAH DATA MENU</h2>
						
					</header>
						<!-- Form -->
						<section>
							<form action="<?php echo $editFormAction; ?>" name="form1" method="POST">
									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="kd_minuman" id="kd_minuman" value="<?php echo $format ?>" readonly placeholder="Kode Minuman" />
									  </p>
									</div>

									<div class="6u 12u$(xsmall)">
										<div class="select-wrapper">
											<div>
											<select name="kd_bahan">
												<option>-----Nama Bahan-----</option>
												<?php
												$sql = mysql_query("SELECT * FROM bahan_baku ORDER BY kd_bhn ASC");
												if(mysql_num_rows($sql) !=0){
													while($row = mysql_fetch_assoc($sql)){
														echo "<option value=\"".$row["kd_bhn"]."\">".$row["nm_bhn"]."</option>";
													}
												}
												?>
										  </select>
										  </div> 
									</div>
								</div>
									<br>

									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="nm_menu" id="nm_menu" value="" placeholder="Nama Menu" />
									  </p>
									</div>
									
									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="harga_min" id="harga" value="" placeholder="Harga Minuman" />
									  </p>
									</div>

									<div class="6u 12u$(xsmall)">
										<p>
										  <input type="text" name="jumlah" id="jumlah" value="" placeholder="Jumlah" />
									  </p>
									</div>
									
									<div class="12u$">
										<ul class="actions">
											<li><input type="submit" value="Tambah Menu" class="special" /></li>
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