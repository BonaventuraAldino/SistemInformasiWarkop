<?php require_once('../../Connections/koneksiku.php'); ?>
<?php
mysql_select_db($database_koneksiku, $koneksiku);
$query_Recordset1 = "SELECT * FROM pegawai";
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
		<h1><strong><a href="#"><img src="../../images/Warkop.png" height="20 px" width="100 px"></a></strong></h1>
			<nav id="nav">
				<ul>
					<li><a href="index.php">BACK</a></li>
				</ul>
			</nav>
	</header>
		<a href="#menu" class="navPanelToggle">
			<span class="fa fa-bars">
				
			</span>
		</a>

		<!-- Main -->
			<section id="main" class="wrapper">
				<div class="container">
					<header class="major special">
						<h2>DATA PEGAWAI</h2>
						<p>DATA SELURUH PEGAWAI DI WARKOP MURAH TAPI GAK MURAHAN </p>
					</header>
						<!-- Table -->
						<section>
							<ul class="actions">
								<li><a href="tambah_pegawai.php" class="button special">TAMBAH</a></li>
							<div class="table-wrapper">
								<table>
									<thead>
										<tr>
											<th>Id </th>
											<th>Nama</th>
											<th>Alamat</th>
											<th>Username</th>
											<th>Password</th>
											<th>Level</th>
											<th colspan="2"><center>Aksi</th>
										</tr>
									</thead>
									<tbody>
                                      <?php do { ?>
                                      <tr>
                                        <td><?php echo $row_Recordset1['id_pegawai']; ?></td>
                                        <td><?php echo $row_Recordset1['nm_pegawai']; ?></td>
                                        <td><?php echo $row_Recordset1['alamat']; ?></td>
                                        <td><?php echo $row_Recordset1['username']; ?></td>
                                        <td><?php echo $row_Recordset1['password']; ?></td>
                                        <td><?php echo $row_Recordset1['level']; ?></td>
                                        <td colspan="2"><li><a href="edit_pegawai.php?id_pegawai=<?php echo $row_Recordset1['id_pegawai']; ?>" class="button">Edit</a></li></td>
                                        <td><li><a href="hapus_pegawai.php?id_pegawai=<?php echo $row_Recordset1['id_pegawai']; ?>" class="button alt">Hapus</a></li></td>
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