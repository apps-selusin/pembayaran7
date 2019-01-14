<!-- Begin Main Menu -->
<?php $RootMenu = new cMenu(EW_MENUBAR_ID) ?>
<?php

// Generate all menu items
$RootMenu->IsRoot = TRUE;
$RootMenu->AddMenuItem(40, "mci_Menu_Utama", $Language->MenuPhrase("40", "MenuText"), "", -1, "", TRUE, TRUE, TRUE);
$RootMenu->AddMenuItem(11, "mi_cf01_home_php", $Language->MenuPhrase("11", "MenuText"), "cf01_home.php", 40, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}cf01_home.php'), FALSE, TRUE);
$RootMenu->AddMenuItem(16, "mci_Data_Sekolah", $Language->MenuPhrase("16", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE);
$RootMenu->AddMenuItem(1, "mi_t0101_tahunajaran", $Language->MenuPhrase("1", "MenuText"), "t0101_tahunajaranlist.php", 16, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0101_tahunajaran'), FALSE, FALSE);
$RootMenu->AddMenuItem(2, "mi_t0102_sekolah", $Language->MenuPhrase("2", "MenuText"), "t0102_sekolahlist.php", 16, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0102_sekolah'), FALSE, FALSE);
$RootMenu->AddMenuItem(3, "mi_t0103_kelas", $Language->MenuPhrase("3", "MenuText"), "t0103_kelaslist.php", 16, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0103_kelas'), FALSE, FALSE);
$RootMenu->AddMenuItem(4, "mi_t0104_daftarsiswamaster", $Language->MenuPhrase("4", "MenuText"), "t0104_daftarsiswamasterlist.php", 16, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0104_daftarsiswamaster'), FALSE, FALSE);
$RootMenu->AddMenuItem(6, "mi_t0106_iuran", $Language->MenuPhrase("6", "MenuText"), "t0106_iuranlist.php", 16, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0106_iuran'), FALSE, FALSE);
$RootMenu->AddMenuItem(31, "mci_Data_Siswa", $Language->MenuPhrase("31", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE);
$RootMenu->AddMenuItem(7, "mi_t0201_siswa", $Language->MenuPhrase("7", "MenuText"), "t0201_siswalist.php", 31, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0201_siswa'), FALSE, FALSE);
$RootMenu->AddMenuItem(58, "mci_Data_Pembayaran", $Language->MenuPhrase("58", "MenuText"), "", -1, "", IsLoggedIn(), TRUE, TRUE);
$RootMenu->AddMenuItem(65, "mci_Entry", $Language->MenuPhrase("65", "MenuText"), "t0301_bayarmasteradd.php?showdetail=t0302_bayardetail", 58, "", IsLoggedIn(), FALSE, TRUE);
$RootMenu->AddMenuItem(9, "mi_t0301_bayarmaster", $Language->MenuPhrase("9", "MenuText"), "t0301_bayarmasterlist.php", 58, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t0301_bayarmaster'), FALSE, FALSE);
$RootMenu->AddMenuItem(12, "mi_t9999_audittrail", $Language->MenuPhrase("12", "MenuText"), "t9999_audittraillist.php", -1, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9999_audittrail'), FALSE, FALSE);
$RootMenu->AddMenuItem(13, "mi_t9996_employees", $Language->MenuPhrase("13", "MenuText"), "t9996_employeeslist.php", -1, "", AllowListMenu('{6E7B9E1D-9A99-4CA8-B431-15847F998A66}t9996_employees'), FALSE, FALSE);
$RootMenu->AddMenuItem(14, "mi_t9997_userlevels", $Language->MenuPhrase("14", "MenuText"), "t9997_userlevelslist.php", -1, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(15, "mi_t9998_userlevelpermissions", $Language->MenuPhrase("15", "MenuText"), "t9998_userlevelpermissionslist.php", -1, "", (@$_SESSION[EW_SESSION_USER_LEVEL] & EW_ALLOW_ADMIN) == EW_ALLOW_ADMIN, FALSE, FALSE);
$RootMenu->AddMenuItem(-2, "mi_changepwd", $Language->Phrase("ChangePwd"), "changepwd.php", -1, "", IsLoggedIn() && !IsSysAdmin());
$RootMenu->AddMenuItem(-1, "mi_logout", $Language->Phrase("Logout"), "logout.php", -1, "", IsLoggedIn());
$RootMenu->AddMenuItem(-1, "mi_login", $Language->Phrase("Login"), "login.php", -1, "", !IsLoggedIn() && substr(@$_SERVER["URL"], -1 * strlen("login.php")) <> "login.php");
$RootMenu->Render();
?>
<!-- End Main Menu -->
