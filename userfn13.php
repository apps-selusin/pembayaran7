<?php

// Global user functions
// Page Loading event
function Page_Loading() {

	//echo "Page Loading";
	// variabel global tahunajaran_id

	$q = "select * from t0101_tahunajaran where Aktif = 'Y'";
	$r = ew_ExecuteRow($q);
	$_SESSION["tahunajaran_id"] = $r["id"];

	// array periode
	$_SESSION["aperiode"] = array(1 =>
		"Juli ".$r["AwalTahun"], "Agustus ".$r["AwalTahun"], "September ".$r["AwalTahun"],
		"Oktober ".$r["AwalTahun"], "November ".$r["AwalTahun"], "Desember ".$r["AwalTahun"],
		"Januari ".$r["AkhirTahun"], "Februari ".$r["AkhirTahun"], "Maret ".$r["AkhirTahun"],
		"April ".$r["AkhirTahun"], "Mei ".$r["AkhirTahun"], "Juni ".$r["AkhirTahun"]);
	$_SESSION["aperiode"] = array(1 =>
		"Juli", "Agustus", "September", "Oktober", "November", "Desember",
		"Januari", "Februari", "Maret", "April", "Mei", "Juni");
}

// Page Rendering event
function Page_Rendering() {

	//echo "Page Rendering";
}

// Page Unloaded event
function Page_Unloaded() {

	//echo "Page Unloaded";
}

function f_updatesiswaiuran($rs) {

	// nol-kan dulu di data pembayaran sesuai tahun ajaran dan siswa
	$q = "
		update
			t0202_siswaiuran
		set
			P01 = '0', P02 = '0', P03 = '0', P04 = '0', P05 = '0', P06 = '0',
			P07 = '0', P08 = '0', P09 = '0', P10 = '0', P11 = '0', P12 = '0'
		where
			tahunajaran_id = ".$rs["tahunajaran_id"]."
			and siswa_id = ".$rs["siswa_id"]."";
	ew_Execute($q);

	// ambil data pembayaran sesuai tahunajaran_id dan siswa_id
	$q = "select * from v0301_bayarmasterdetail where
		tahunajaran_id = ".$rs["tahunajaran_id"]."
		and siswa_id = ".$rs["siswa_id"]."";
	$r = ew_Execute($q);

	// recordset dilooping hingga eof
	while (!$r->EOF) {
		if (!is_null($r->fields["Periode1"])) {
			$Periode1 = "P" . substr("00" . $r->fields["Periode1"], -2);
			$Periode1value = 
			$q = "update t0202_siswaiuran set " . $Periode1 . " = '1'
				where iuran_id = ".$r->fields["iuran_id"];
			ew_Execute($q);
		}
		if (!is_null($r->fields["Periode2"])) {
			for ($i = $r->fields["Periode1"]; $i <= $r->fields["Periode2"]; $i++) {
				$Periode2 = "P" . substr("00" . $i, -2);
				$q = "update t0202_siswaiuran set " . $Periode2 . " = '1'
					where iuran_id = ".$r->fields["iuran_id"];
				ew_Execute($q);
			}
		}
		$r->MoveNext();
	}
}

function GetNextNomor() {
	$sNextNomor = "";
	$sLastNomor = "";
	$value = ew_ExecuteScalar("SELECT Nomor FROM t0301_bayarmaster ORDER BY Nomor DESC");
	if ($value != "") { // jika sudah ada, langsung ambil dan proses...
		$sLastNomor = intval(substr($value, 3, 3)); // ambil 3 digit terakhir
		$sLastNomor = intval($sLastNomor) + 1; // konversi ke integer, lalu tambahkan satu
		$sNextNomor = "BYR" . sprintf('%03s', $sLastNomor); // format hasilnya dan tambahkan prefix
		if (strlen($sNextNomor) > 6) {
			$sNextNomor = "BYR999";
		}
	}
	else { // jika belum ada, gunakan kode yang pertama
		$sNextNomor = "BYR001";
	}
	return $sNextNomor;
}
?>
