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
  $updateSQL = sprintf("UPDATE pemesanan SET nm_pemesan=%s, kd_makanan=%s, jumlah_mkn=%s, kd_minuman=%s, jumlah_min=%s, total_harga=%s WHERE kd_pemesanan=%s",
                       GetSQLValueString($_POST['nm_pemesan'], "text"),
                       GetSQLValueString($_POST['kd_makanan'], "text"),
                       GetSQLValueString($_POST['jumlah_mkn'], "int"),
                       GetSQLValueString($_POST['kd_minuman'], "text"),
                       GetSQLValueString($_POST['jumlah_min'], "int"),
                       GetSQLValueString($_POST['total_harga'], "int"),
                       GetSQLValueString($_POST['kd_pemesanan'], "text"));

  mysql_select_db($database_koneksiku, $koneksiku);
  $Result1 = mysql_query($updateSQL, $koneksiku) or die(mysql_error());

  $updateGoTo = "data_pemesanan.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_Recordset1 = "-1";
if (isset($_GET['kd_pemesanan'])) {
  $colname_Recordset1 = (get_magic_quotes_gpc()) ? $_GET['kd_pemesanan'] : addslashes($_GET['kd_pemesanan']);
}
mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = sprintf("SELECT * FROM pemesanan WHERE kd_pemesanan = '%s'", $colname_Recordset1);
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE HTML>
<html>
<head>
<title>DATA PEMESANAN WARKOP</title>
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
						<li><a href="data_pemesanan.php">BACK</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>EDIT DATA PEMESANAN</h2>
						
					</header>
						<!-- Tabel  -->
                        <form method="post" name="form1" action="<?php echo $editFormAction; ?>">
                          <table align="center">
                            <tr valign="baseline">
                              <td nowrap align="right">Kode Pemesanan:</td>
                              <td><?php echo $row_Recordset1['kd_pemesanan']; ?></td>
                            </tr>
                            <tr valign="baseline">
                              <td nowrap align="right">Nama Pemesan:</td>
                              <td><input type="text" name="nm_pemesan" value="<?php echo $row_Recordset1['nm_pemesan']; ?>" size="32"></td>
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
$minuman=mysqli_query($connection, "SELECT * FROM minuman");
$barang1=mysqli_query($connection, "SELECT * FROM makanan");
?>

<?php
$jsArray1 = "var total1 = new Array();\n"; 
?>


<tr valign="baseline">
  <td nowrap align="right">Kode Makanan</td>
  <td>
    <select name="kd_makanan" onchange ="changeValue1(this.value)" >
<option>- Pilih -</option>
<?php if(mysqli_num_rows($barang1)) {?>
<?php while($row_brg1= mysqli_fetch_array($barang1)) {?>
<option value="<?php echo $row_brg1["kd_makanan"]?>"> <?php echo $row_brg1["nm_menu"]?> </option>

<?php $jsArray1 .= "total1['" . $row_brg1['kd_makanan'] . "'] = {harga_mkn:'" . addslashes($row_brg1['harga_mkn'])."'};\n"; } ?>
<?php } ?>

</select>
  </td>
</tr>

<tr valign="baseline">
  <td nowrap align="right">Harga Makanan</td>
  <td>
    <input type="text" class="form-control" name="total_bayar" id="harga_mkn" value="0" readonly="readonly" />
  </td>
</tr>

<tr valign="baseline">
  <td nowrap align="right">Jumlah Makanan</td>
  <td>
    <select name="jumlah_mkn" id="jumlah_mkn">
                              <option>-----Jumlah Makanan-----</option>
                              <?php
                              $sql = mysql_query("SELECT jumlah FROM makanan WHERE kd_makanan=$kd_makanan");
                                    for($i = 1; $i < 10; $i++){ ?>
                                      <option value="<?php echo $i?>"><?php echo $i ?></option>
                                  <?php } ?>
                              </select>
  </td>
</tr>


<?php
$jsArray = "var total_min = new Array();\n";
?>
<tr valign="baseline">
  <td nowrap align="right">Kode Minuman</td>
  <td>
    <select name="kd_minuman" onchange="changeValue(this.value)" >
<option>- Pilih -</option>
<?php if(mysqli_num_rows($minuman)) {?>
<?php while($row_min= mysqli_fetch_array($minuman)) {?>
<option value="<?php echo $row_min["kd_minuman"]?>"> <?php echo $row_min["nm_menu"]?> </option>

<?php $jsArray .= "total_min['" . $row_min['kd_minuman'] . "'] = {harga_min:'" . addslashes($row_min['harga_min'])."'};\n"; } ?>
<?php } ?>

</select>
  </td>
</tr>

<tr valign="baseline">
  <td nowrap align="right">Harga Minuman</td>
  <td>
    <input type="text" class="form-control" name="total_bayar" id="harga_min" value="0" readonly="readonly" />
  </td>
</tr>

<tr valign="baseline">
  <td nowrap align="right">Jumlah Makanan</td>
  <td>
    <select name="jumlah_min" id="jumlah_min">
                              <option>-----Jumlah Minuman-----</option>
                              <?php
                              $sql = mysql_query("SELECT jumlah FROM minuman WHERE kd_minuman=$kd_minuman");
                                    for($i = 1; $i < 10; $i++){ ?>
                                      <option value="<?php echo $i?>"><?php echo $i ?></option>
                                    <?php } ?>
                              </select>
  </td>
</tr>    
                              
<tr valign="baseline">
  <td nowrap align="right">Jumlah Makanan</td>
  <td>
  <input type="text" name="total_harga" id="total_harga" value="0" placeholder="Total Harga" onclick="totalharga()" readonly="readonly"/> 
  </td>
</tr>                           
                  
                            <tr valign="baseline">
                              <td nowrap align="right">&nbsp;</td>
                              <td><input type="submit" value="Update record"></td>
                            </tr>
                  </table>
                  <input type="hidden" name="MM_update" value="form1">
                  <input type="hidden" name="kd_pemesanan" value="<?php echo $row_Recordset1['kd_pemesanan']; ?>">
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
        function changeValue(kd_minuman) {
          document.getElementById("harga_min").value = total_min[kd_minuman].harga_min;
          };

          <?php echo $jsArray1; ?>
        function changeValue1(kd_makanan) {
          document.getElementById("harga_mkn").value = total1[kd_makanan].harga_mkn;
        };

        function totalharga(){
          var harga_mkn = document.getElementById("harga_mkn").value;
          var harga_min = document.getElementById("harga_min").value;
          var jumlah_mkn = document.getElementById("jumlah_mkn").value;
          var jumlah_min = document.getElementById("jumlah_min").value;

          var hrg_mkn=parseInt(harga_mkn) * parseInt (jumlah_mkn);
          var hrg_min=parseInt(harga_min) * parseInt (jumlah_min);

          var total_harga=parseInt(hrg_min) + parseInt (hrg_mkn);

          document.getElementById ("total_harga").value=total_harga;
        }

        </script>

</body>
</html>
<?php
mysql_free_result($Recordset1);
?>
