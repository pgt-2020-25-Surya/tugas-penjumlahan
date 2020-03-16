<?php
	
	//koneksi database
	$koneksi= mysqli_connect("localhost", "root", "", "angka");

	//cek jika sqli gagal
	if(mysqli_connect_error()){
		echo "gagal melakukan koneksi ke Mysqli:" .mysqli_connect_error();
	 }

	?>

<!DOCTYPE html>
<html>
<head>
	<title>Menghitung</title>
</head>

<body>

	<form method="POST">
	<h1>Penjumlahan</h1>

	<label for="a"> a: </label>
	<input type="text" name="a">
	<br>

	<label for="b"> b:</label>
	<input type="text" name="b">
	<br>

	<input type="submit" name="submit" value="Hitung"><br>

	<label for="c">c:</label>
	<input type="text" name="c">
	

	</form>

	<?php
	if(isset($_POST ['submit']))
	{
		$a	=$_POST['a'];
		$b  =$_POST['b'];
		$c  =$a+$b;
		echo "Hitung=$c";
		$sql = mysqli_query($koneksi, "INSERT INTO penjumlahan(a, b, 
c,  keterangan)  VALUES('$a',  '$b',  '$c',  '')") ;
	}
	
	?>

	

	<table border="1" cellpadding="10" cellspacing="">
	<thead>
	<tr>
		<th>id</th>
		<th>a</th>
		<th>b</th>
		<th>c</th>
		<th>Keterangan</th>

	</tr>
	</thead>
	<tbody>
		<tbody>
<?php
//query  ke  database  SELECT  tabel  mahasiswa  urut  berdasarkan  id yang paling besar
$sql = mysqli_query($koneksi, "SELECT * FROM penjumlahan") or die(mysqli_error($koneksi));
//jika query diatas menghasilkan nilai > 0 maka menjalankan script di bawah if...
if(mysqli_num_rows($sql) > 0){
//membuat variabel $no untuk menyimpan nomor urut
$no = 1;
//melakukan perulangan while dengan dari dari query $sql
while($data = mysqli_fetch_assoc($sql)){
//menampilkan data perulangan
echo '
<tr>
<td>'.$no.'</td>
<td>'.$data['a'].'</td>
<td>'.$data['b'].'</td>
<td>'.$data['c'].'</td>
<td>'.$data['keterangan'].'</td>

</tr>
';
$no++;
}
//jika query menghasilkan nilai 0
}else{
echo '
<tr>
<td colspan="6">Tidak ada data.</td>
</tr>
';
}
?>

	</tbody>
	</table>
	
</body>

</html>
