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

	@page {
		size: 8cm 8cm;
		margin: 5mm 0mm 0mm 0mm;
		/* change the margins as you want them to be. */
	}

	table {
		border-spacing: 0px;
	}

	/* cellspacing */

	th,
	td {
		padding: 0px;
	}
</style>

<body style="font-size: 12px;margin-top:0;position:absolute;">
	
	<div id="idcard" style="width: 430px; height: 267px; margin-bottom:10px; background-image: url('<?= base_url('asset/kartu/desain/birunom_kiri.png') ; ?>');">
		<img style="border: 1px solid #ffffff;position: absolute;margin-left: 323px;margin-top: 112px;" src="<?= base_url('asset/kartu/foto/') . "muhammad andri fahrizal.png"; ?>" width="75.5px" height="94.4px">
		<img style="position: absolute;margin-left: 65px;margin-top: 135px;" src="<?= base_url('asset/kartu/qr/').$s['qr']; ?>" width="75.5px" height="75.5px">
		<img style="position: absolute;margin-left: 20px;margin-top: 20px;" src="<?= base_url('asset/kartu/logo/') . $sekolah['logo']; ?>" width="65.5px" height="75.5px">
		<div style="padding-top: 5px;">
			<p style="margin-top: 10px; right:30px; position: absolute;font-family: Cambria;font-size: 18px;text-transform: uppercase;"><strong><?= $sekolah['sekolah']; ?></strong></p>
			<p style="margin-top: 30px; right:30px; position: absolute;font-family: Cambria;font-size: 18px;text-transform: uppercase;"><strong><?= $sekolah['lokasi']; ?></strong></p>
			<p style="margin-top: 50px; right:30px; position: absolute;font-family: Cambria;font-size: 25px;"><strong>KARTU PELAJAR</strong></p>
			<table style="margin-top: 90px; position: absolute; right:115px; text-align: right; font-family: Cambria;font-size: 12px;">
				<tr>
					<td>NIS</td>
				</tr>
				<tr>
					<td><?= $s['nis']; ?></td>
				</tr>
				</tr>
				<tr>
					<td>Nama</td>
				</tr>
				<tr>
					<td><strong style="font-size: 12px;"><?= $s['nama']; ?></strong></td>
				</tr>
				</tr>
				<tr>
					<td>Tempat,tanggal lahir</td>
				</tr>
				<tr>
					<td><?= $s['tempat_lahir']; ?>, <?= $s['tanggal_lahir']; ?></td>
				</tr>
				</tr>
				<tr>
					<td>Alamat</td>
				</tr>
				<tr>
					<td><?= $s['alamat']; ?></td>
				</tr>
				</tr>
			</table>
		</div>
		<p style="font-family:Verdana; right:30px; margin-top: 210px; text-align:right; padding-left: 10px;font-size: 8px;  position: absolute;">Alamat: <?= $sekolah['alamat']; ?> - Kode Pos <?= $sekolah['kode_pos']; ?><br> Email: <?= $sekolah['email']; ?> | Telp. <?= $sekolah['telepon']; ?></p>
	</div>
	
</body>
<script src="http://localhost/idcard/assets/js/html2canvas.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>
html2canvas($('#idcard')[0], {
  scale:3
}).then(function(canvas) {
  var a = document.createElement('a');
  a.href = canvas.toDataURL("image/png");
  a.download = '<?= $s['nis'].'-'.$s['nama']; ?>';
  a.click();
});
</script>
</html>