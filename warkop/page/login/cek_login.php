<?php 
$connection = mysqli_connect("localhost","root","","warkop");
//Mengecek Koneksi Ke Database
if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
} 
?>

<?php 
// mengaktifkan session pada php
session_start();

// menangkap data yang dikirim dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// menyeleksi data user dengan username dan password yang sesuai
$login = mysqli_query($connection,"select * from pegawai where username='$username' and password='$password'");
// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($login);

// cek apakah username dan password di temukan pada database
if($cek > 0){

	$data = mysqli_fetch_assoc($login);

	// cek jika user login sebagai admin
	if($data['level']=="admin"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		// alihkan ke halaman dashboard admin
		header("location:../admin/index.php");

	// cek jika user login sebagai pegawai
	}else if($data['level']=="kasir"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "kasir";
		// alihkan ke halaman dashboard pegawai
		header("location:../kasir/index.php");

	}else if($data['level']=="pantry"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pantry";
		// alihkan ke halaman dashboard pegawai
		header("location:../pantry/index.php");

	}else if($data['level']=="pelayan"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pelayan";
		// alihkan ke halaman dashboard pegawai
		header("location:../pelayan/index.php");

	// cek jika user login sebagai pengurus
	}else if($data['level']=="koki"){
		// buat session login dan username
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "koki";
		// alihkan ke halaman dashboard pengurus
		header("location:../koki/index.php");

	}else{
		// alihkan ke halaman login kembali
		header("location:login.php?pesan=gagal");
	}

}else{
	header("location:login.php?pesan=gagal");
}

?>