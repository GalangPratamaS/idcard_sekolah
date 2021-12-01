<!DOCTYPE html>
<html>
<!-- Bagian halaman HTML yang akan konvert -->

<head>
	<meta charset='UTF-8'>
	<link rel="shortcut icon" href="<?= base_url('asset/kartu/logo/') . $sekolah['logo']; ?>">
	<title>Cetak Kartu Pelajar</title>
</head>
<style>
	@media print {
		* {
			-webkit-print-color-adjust: exact;
		}
	}

	.barcode {
		position: absolute;
		padding-left: 0px;
		padding-top: 5px;
		margin-top:170px;
		margin-left:94px;
		width:500px;
		height:52px;
	}
	.barcode-text {
		font-size: 24px	;
		font-weight:  bold;
		position: absolute;
		padding-left: 12px;
		padding-top: 5px;
		margin-top:225px;
		margin-left:190px;
		width:350px
	}
	
</style>

<body style="font-family: arial;font-size: 12px;position:absolute;">
	<div id="idcard" style="width: 1044px;height: 673px;margin: 50px;background-image: url('<?= base_url('asset/kartu/desain/alazhar_depan.png'); ?>');">
		<img style="position: absolute;padding-left: 12px;padding-top: 5px;margin-top:60px;margin-left:752px" class="img-responsive img" alt="logo image" src="<?= base_url('asset/kartu/logo/') . $sekolah['logo']; ?>" width="95px">
		<img style="position: absolute;padding-left: 12px;padding-top: 5px;margin-top:60px;margin-left:859px" class="img-responsive img" alt="logo image" src="<?= base_url('asset/kartu/logo/yayasan.png') ; ?>" width="95px">
		
		<p style="padding-left: 123px;padding-top: 240px; "> </p>
		<img style="border-radius:5px; solid #ffffff;position: absolute;margin-left: 68px;margin-top: -13px;" alt="foto" src="<?= base_url('asset/kartu/foto/') . $siswa['foto_siswa']; ?>" width="155px" height="200px">
		<table style="margin-top: 27px;padding-left: 250px; position: relative;font-family: arial;font-size: 26px;color:#ffffff;">
			<tr>
				<td style="padding-right: 20px;text-align: left;">Nama</td>
				<td>:</td>
				<td style="text-align: left;">
				<?php 
				if(strlen($siswa['nama_siswa']) > 21){
				echo $this->CI->cutText(ucwords(strtolower($siswa['nama_siswa'])),22);
				} else {
					echo ucwords(strtolower($siswa['nama_siswa']));
				}  ?></td>
			</tr>
			<tr>
				<td style="padding-right: 20px;text-align: left;">NIS/NISN</td>
				<td>:</td>
				<td style="text-align: left;"><?= $siswa['nomor_induk_siswa']; ?></td>
			</tr>
			</tr>			
			<tr>
				<td style="padding-right: 20px;text-align: left;">Alamat</td>
				<td>:</td>
				<td style="text-align: left; max-height: 1.1em;">
				<?php 
				if(strlen($siswa['alamat']) > 23){
					echo ucwords(strtolower($this->CI->cutText($siswa['alamat'],24)));
				} else {
					echo ucwords(strtolower($siswa['alamat']));
				}
				 ?></td>
			</tr>			
		</table>
		<?php
		$kode_kartu = $siswa['nomor_kartu'];
		$kodemotor = substr($kode_kartu,0,4);
		$kodearea = substr($kode_kartu,4,4);
		$kode1 = substr($kode_kartu,8,4);
		$kode2 = substr($kode_kartu,12,4);
		//echo $kodemotor .' '.$kodearea.' '.$kode1.' '.$kode2;

		$generator = new Picqer\Barcode\BarcodeGeneratorPNG();
		echo '<img class="barcode img-responsive img" src="data:image/png;base64,' . base64_encode($generator->getBarcode($siswa['nomor_kartu'], $generator::TYPE_CODE_128)) . '">'; ?>

		<p class="barcode-text">* <?=$kodemotor .' '.$kodearea.' '.$kode1.' '.$kode2; ?> *</p>
		
		
	</div>


</body>
<script src="<?= base_url() ?>assets/js/html2canvas.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

  html2canvas($('#idcard')[0], {
  scale:1
});   
</script>
</html>
