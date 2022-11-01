<?php require_once('../../Connections/koneksiku.php'); ?>
<?php
mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = "SELECT pembayaran.no_pmbyr, pemesanan.nm_pemesan nm_pemesan, pembayaran.total_bayar
	FROM pembayaran JOIN pemesanan ON pembayaran.kd_pemesanan = pemesanan.kd_pemesanan";
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
				<h1><strong>
					<a href="../../index.php">
						<img src="../../images/Warkop.png" height="20 px" width="100 px">
					</a>
					</strong>
				</h1>
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
						<h2>DATA PEMBAYARAN </h2>
						<p>DATA SELURUH PEMBAYARAN DI WARKOP MURAH TAPI GAK MURAHAN </p>
					</header>
						<!-- Table -->
						<section>
							<ul class="actions">
								<li><a href="tambah_pembayaran.php" class="button special">TAMBAH</a></li>
							<div class="table-wrapper">
								<table>
									<thead>
										<tr>
											<th>Kode Pembayaran</th>
											<th>Nama Pemesan</th>
											<th>Total Bayar</th> 
											<th colspan="2"><center>Aksi</th>
										</tr>
									</thead>

                                  <tbody>
                                      <?php do { ?>
                                      <tr>
                                        <td><?php echo $row_Recordset1['no_pmbyr']; ?></td>
                                        <td><?php echo $row_Recordset1['nm_pemesan']; ?></td>
                                        <td><?php echo $row_Recordset1['total_bayar']; ?></td>

                                        <td colspan="2"><li><a href="edit_pembayaran.php?no_pmbyr=<?php echo $row_Recordset1['no_pmbyr']; ?>" class="button">Edit</a></li></td>

                                        <td><li><a href="hapus_pembayaran.php?no_pmbyr=<?php echo $row_Recordset1['no_pmbyr'];?>" class="button alt">Hapus</a></li></td>
                                    	</tr>
                                          <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
                                      </tbody>
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