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
