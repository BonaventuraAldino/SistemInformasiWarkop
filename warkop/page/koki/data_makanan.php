<?php require_once('../../Connections/koneksiku.php'); ?>
<?php
mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = "SELECT p.kd_makanan, p.nm_menu, p.harga_mkn, p.jumlah, k.nm_bhn nm_bhn FROM makanan p JOIN bahan_baku k ON p.kd_bahan= k.kd_bhn";
$Recordset1 = mysql_query($query_Recordset1, $koneksiku) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?><!DOCTYPE HTML>
<html>
	<head>
		<title>DATA MENU WARKOP</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link rel="stylesheet" href="../../assets/css/main.css" />
	</head>
	<body>

<!-- Header -->
			<header id="header">
				<h1><strong><a href="#"><img src="../../images/Warkop.png" height="20 px" width="100 px"></a></strong></h1>
				<nav id="nav">
					<ul>
						<li><a href="index.php">BACK</a></li>
					</ul>
				</nav>
			</header>

			<a href="#menu" class="navPanelToggle"><span class="fa fa-bars"></span></a>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>DATA MENU</h2>
						<p>DATA MENU MAKANAN DI WARKOP MURAH TAPI GAK MURAHAN </p>
					</header>
						<!-- Table -->
						<section>
							<ul class="actions">
								<li><a href="tambah_makanan.php" class="button special">TAMBAH</a></li>
							<div class="table-wrapper">
								<table>
									<thead>
										<tr>
											<th>Kode Menu</th>
											<th>Nama Bahan</th>
											<th>Nama Menu</th>
											<th>Harga </th>
											<th>Jumlah </th>
											<th colspan="2"><center>Aksi</th>
										</tr>
									</thead>
									<tbody>
                                      <?php do { ?>
                                      <tr>
                                        <td><?php echo $row_Recordset1['kd_makanan']; ?></td>
                                        <td><?php echo $row_Recordset1['nm_bhn']; ?></td>
                                        <td><?php echo $row_Recordset1['nm_menu']; ?></td>
                                        <td><?php echo $row_Recordset1['harga_mkn']; ?></td>
                                        <td><?php echo $row_Recordset1['jumlah']; ?></td>
                                        <td colspan="2"><li><a href="edit_makanan.php?kd_makanan=<?php echo $row_Recordset1['kd_makanan']; ?>" class="button">Edit</a></li></td>
                                        <td><li><a href="hapus_makanan.php?kd_makanan=<?php echo $row_Recordset1['kd_makanan']; ?>" class="button alt">Hapus</a></li></td>
                                          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?></tbody>
								</table>
	</div>
	
    
                           
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