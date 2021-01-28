<!DOCTYPE html>
<html>
<!-- Bagian halaman HTML yang akan konvert -->

<head>
	<meta charset='UTF-8'>
	<link rel="shortcut icon" href="<?= base_url('asset/kartu/logo/') . $sekolah['logo']; ?>">
	<title>Cetak Kartu Pelajar</title>
</head>
<style>
.center {
  margin: auto;
  width: 50%;
}
</style>
<body class="center" style="font-family: arial;font-size: 12px;position:relative;">
	<div id="idcard" style="width: 430px;height: 247px;margin: 50px;background-image: url('<?= base_url('asset/kartu/desain/birunom_kiri.png'); ?>');">
		<img style="position: absolute;padding-left: 12px;padding-top: 5px;" class="img-responsive img" alt="logo image" src="<?= base_url('asset/kartu/logo/') . $sekolah['logo']; ?>" width="40px">
		<img style="position: absolute;margin-left: 360px;margin-top: 135px;" src="<?= base_url('asset/kartu/qr/').$siswa['qr_siswa']; ?>" width="50px" height="50px">
		<p style="position: absolute; font-family: arial; font-size: 10px; color: #fff; text-shadow: 2px 2px 5px #000000; padding-left: 110px;text-transform: uppercase; text-align: center;"><?= $sekolah['lembaga']; ?><br><?= $sekolah['domisili']; ?> <?= $sekolah['kota']; ?> <br><b style="font-size: 12px"><?= $sekolah['sekolah']; ?> <?= $sekolah['lokasi']; ?></b></p>
		<p style="padding-left: 123px;padding-top: 70px; "><b>KARTU PELAJAR</b></p>
		<img style="border: 1px solid #ffffff;position: absolute;margin-left: 20px;margin-top: -20px;" alt="foto" src="<?= base_url('asset/kartu/foto/')  . "muhammad andri fahrizal.png"; ?>" width="75.5px" height="94.4px">
		<table style="margin-top: -10px;padding-left: 120px; position: relative;font-family: arial;font-size: 11px;">
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $siswa['nama_siswa']; ?></td>
			</tr>
			<tr>
				<td>NIS</td>
				<td>:</td>
				<td><?= $siswa['nomor_induk_siswa']; ?></td>
			</tr>
			</tr>
			<tr>
				<td>Tempat Lahir</td>
				<td>:</td>
				<td><?= $siswa['tempat_lahir']; ?></td>
			</tr>
			<tr>
				<td>Tanggal Lahir</td>
				<td>:</td>
				<td><?= $siswa['tanggal_lahir']; ?></td>
			</tr>
			<tr>
				<td>Jenis Kelamin</td>
				<td>:</td>
				<td><?= $siswa['jk']; ?></td>
			</tr>
			<tr>
				<td>Alamat</td>
				<td>:</td>
				<td><?= $siswa['alamat']; ?></td>
			</tr>
			<tr>
				<td>Berlaku</td>
				<td>:</td>
				<td>Selama Menjadi Siswa/i</td>
			</tr>
		</table>
		<p style="padding-left: 10px;font-size: 8px; font-family: arial;position: absolute;">Alamat: <?= $sekolah['alamat']; ?> - Kode Pos <?= $sekolah['kode_pos']; ?><br> Email: <?= $sekolah['email']; ?>| Telp: <?= $sekolah['telepon']; ?><br>Website: <?= $sekolah['website']; ?></p>
		
	</div>


</body>
<script src="http://localhost/idcard/assets/js/html2canvas.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

</html>
