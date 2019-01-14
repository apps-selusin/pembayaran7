<?php

// Global variable for table object
$t0202_siswaiuran = NULL;

//
// Table class for t0202_siswaiuran
//
class ct0202_siswaiuran extends cTable {
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;
	var $id;
	var $tahunajaran_id;
	var $siswa_id;
	var $iuran_id;
	var $Nilai;
	var $Terbayar;
	var $Sisa;
	var $P01;
	var $P02;
	var $P03;
	var $P04;
	var $P05;
	var $P06;
	var $P07;
	var $P08;
	var $P09;
	var $P10;
	var $P11;
	var $P12;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 't0202_siswaiuran';
		$this->TableName = 't0202_siswaiuran';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`t0202_siswaiuran`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->DetailAdd = TRUE; // Allow detail add
		$this->DetailEdit = TRUE; // Allow detail edit
		$this->DetailView = TRUE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 5;
		$this->AllowAddDeleteRow = ew_AllowAddDeleteRow(); // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// tahunajaran_id
		$this->tahunajaran_id = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_tahunajaran_id', 'tahunajaran_id', '`tahunajaran_id`', '`tahunajaran_id`', 3, -1, FALSE, '`tahunajaran_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tahunajaran_id->Sortable = TRUE; // Allow sort
		$this->tahunajaran_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tahunajaran_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->tahunajaran_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tahunajaran_id'] = &$this->tahunajaran_id;

		// siswa_id
		$this->siswa_id = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_siswa_id', 'siswa_id', '`siswa_id`', '`siswa_id`', 3, -1, FALSE, '`siswa_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->siswa_id->Sortable = TRUE; // Allow sort
		$this->siswa_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['siswa_id'] = &$this->siswa_id;

		// iuran_id
		$this->iuran_id = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_iuran_id', 'iuran_id', '`iuran_id`', '`iuran_id`', 3, -1, FALSE, '`iuran_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->iuran_id->Sortable = TRUE; // Allow sort
		$this->iuran_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->iuran_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->iuran_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['iuran_id'] = &$this->iuran_id;

		// Nilai
		$this->Nilai = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_Nilai', 'Nilai', '`Nilai`', '`Nilai`', 4, -1, FALSE, '`Nilai`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Nilai->Sortable = TRUE; // Allow sort
		$this->Nilai->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Nilai'] = &$this->Nilai;

		// Terbayar
		$this->Terbayar = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_Terbayar', 'Terbayar', '`Terbayar`', '`Terbayar`', 4, -1, FALSE, '`Terbayar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Terbayar->Sortable = TRUE; // Allow sort
		$this->Terbayar->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Terbayar'] = &$this->Terbayar;

		// Sisa
		$this->Sisa = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_Sisa', 'Sisa', '`Sisa`', '`Sisa`', 4, -1, FALSE, '`Sisa`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->Sisa->Sortable = TRUE; // Allow sort
		$this->Sisa->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['Sisa'] = &$this->Sisa;

		// P01
		$this->P01 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P01', 'P01', '`P01`', '`P01`', 202, -1, FALSE, '`P01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P01->Sortable = TRUE; // Allow sort
		$this->P01->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P01->OptionCount = 2;
		$this->fields['P01'] = &$this->P01;

		// P02
		$this->P02 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P02', 'P02', '`P02`', '`P02`', 202, -1, FALSE, '`P02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P02->Sortable = TRUE; // Allow sort
		$this->P02->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P02->OptionCount = 2;
		$this->fields['P02'] = &$this->P02;

		// P03
		$this->P03 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P03', 'P03', '`P03`', '`P03`', 202, -1, FALSE, '`P03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P03->Sortable = TRUE; // Allow sort
		$this->P03->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P03->OptionCount = 2;
		$this->fields['P03'] = &$this->P03;

		// P04
		$this->P04 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P04', 'P04', '`P04`', '`P04`', 202, -1, FALSE, '`P04`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P04->Sortable = TRUE; // Allow sort
		$this->P04->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P04->OptionCount = 2;
		$this->fields['P04'] = &$this->P04;

		// P05
		$this->P05 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P05', 'P05', '`P05`', '`P05`', 202, -1, FALSE, '`P05`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P05->Sortable = TRUE; // Allow sort
		$this->P05->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P05->OptionCount = 2;
		$this->fields['P05'] = &$this->P05;

		// P06
		$this->P06 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P06', 'P06', '`P06`', '`P06`', 202, -1, FALSE, '`P06`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P06->Sortable = TRUE; // Allow sort
		$this->P06->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P06->OptionCount = 2;
		$this->fields['P06'] = &$this->P06;

		// P07
		$this->P07 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P07', 'P07', '`P07`', '`P07`', 202, -1, FALSE, '`P07`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P07->Sortable = TRUE; // Allow sort
		$this->P07->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P07->OptionCount = 2;
		$this->fields['P07'] = &$this->P07;

		// P08
		$this->P08 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P08', 'P08', '`P08`', '`P08`', 202, -1, FALSE, '`P08`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P08->Sortable = TRUE; // Allow sort
		$this->P08->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P08->OptionCount = 2;
		$this->fields['P08'] = &$this->P08;

		// P09
		$this->P09 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P09', 'P09', '`P09`', '`P09`', 202, -1, FALSE, '`P09`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P09->Sortable = TRUE; // Allow sort
		$this->P09->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P09->OptionCount = 2;
		$this->fields['P09'] = &$this->P09;

		// P10
		$this->P10 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P10', 'P10', '`P10`', '`P10`', 202, -1, FALSE, '`P10`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P10->Sortable = TRUE; // Allow sort
		$this->P10->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P10->OptionCount = 2;
		$this->fields['P10'] = &$this->P10;

		// P11
		$this->P11 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P11', 'P11', '`P11`', '`P11`', 202, -1, FALSE, '`P11`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P11->Sortable = TRUE; // Allow sort
		$this->P11->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P11->OptionCount = 2;
		$this->fields['P11'] = &$this->P11;

		// P12
		$this->P12 = new cField('t0202_siswaiuran', 't0202_siswaiuran', 'x_P12', 'P12', '`P12`', '`P12`', 202, -1, FALSE, '`P12`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'RADIO');
		$this->P12->Sortable = TRUE; // Allow sort
		$this->P12->FldDataType = EW_DATATYPE_BOOLEAN;
		$this->P12->OptionCount = 2;
		$this->fields['P12'] = &$this->P12;
	}

	// Set Field Visibility
	function SetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Multiple column sort
	function UpdateSort(&$ofld, $ctrl) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			if ($ctrl) {
				$sOrderBy = $this->getSessionOrderBy();
				if (strpos($sOrderBy, $sSortField . " " . $sLastSort) !== FALSE) {
					$sOrderBy = str_replace($sSortField . " " . $sLastSort, $sSortField . " " . $sThisSort, $sOrderBy);
				} else {
					if ($sOrderBy <> "") $sOrderBy .= ", ";
					$sOrderBy .= $sSortField . " " . $sThisSort;
				}
				$this->setSessionOrderBy($sOrderBy); // Save to Session
			} else {
				$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
			}
		} else {
			if (!$ctrl) $ofld->setSort("");
		}
	}

	// Current master table name
	function getCurrentMasterTable() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE];
	}

	function setCurrentMasterTable($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_MASTER_TABLE] = $v;
	}

	// Session master WHERE clause
	function GetMasterFilter() {

		// Master filter
		$sMasterFilter = "";
		if ($this->getCurrentMasterTable() == "t0201_siswa") {
			if ($this->siswa_id->getSessionValue() <> "")
				$sMasterFilter .= "`id`=" . ew_QuotedValue($this->siswa_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sMasterFilter;
	}

	// Session detail WHERE clause
	function GetDetailFilter() {

		// Detail filter
		$sDetailFilter = "";
		if ($this->getCurrentMasterTable() == "t0201_siswa") {
			if ($this->siswa_id->getSessionValue() <> "")
				$sDetailFilter .= "`siswa_id`=" . ew_QuotedValue($this->siswa_id->getSessionValue(), EW_DATATYPE_NUMBER, "DB");
			else
				return "";
		}
		return $sDetailFilter;
	}

	// Master filter
	function SqlMasterFilter_t0201_siswa() {
		return "`id`=@id@";
	}

	// Detail filter
	function SqlDetailFilter_t0201_siswa() {
		return "`siswa_id`=@siswa_id@";
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`t0202_siswaiuran`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		$cnt = -1;
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match("/^SELECT \* FROM/i", $sSql)) {
			$sSql = "SELECT COUNT(*) FROM" . preg_replace('/^SELECT\s([\s\S]+)?\*\sFROM/i', "", $sSql);
			$sOrderBy = $this->GetOrderBy();
			if (substr($sSql, strlen($sOrderBy) * -1) == $sOrderBy)
				$sSql = substr($sSql, 0, strlen($sSql) - strlen($sOrderBy)); // Remove ORDER BY clause
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);

		//$sSql = $this->SQL();
		$sSql = $this->GetSQL($this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sSql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($names, -1) == ",")
			$names = substr($names, 0, -1);
		while (substr($values, -1) == ",")
			$values = substr($values, 0, -1);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
			if ($this->AuditTrailOnAdd)
				$this->WriteAuditTrailOnAdd($rs);
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		while (substr($sql, -1) == ",")
			$sql = substr($sql, 0, -1);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		if ($bUpdate && $this->AuditTrailOnEdit) {
			$rsaudit = $rs;
			$fldname = 'id';
			if (!array_key_exists($fldname, $rsaudit)) $rsaudit[$fldname] = $rsold[$fldname];
			$this->WriteAuditTrailOnEdit($rsold, $rsaudit);
		}
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		if ($bDelete && $this->AuditTrailOnDelete)
			$this->WriteAuditTrailOnDelete($rs);
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "t0202_siswaiuranlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function GetListUrl() {
		return "t0202_siswaiuranlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("t0202_siswaiuranview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("t0202_siswaiuranview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "t0202_siswaiuranadd.php?" . $this->UrlParm($parm);
		else
			$url = "t0202_siswaiuranadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("t0202_siswaiuranedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("t0202_siswaiuranadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("t0202_siswaiurandelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		if ($this->getCurrentMasterTable() == "t0201_siswa" && strpos($url, EW_TABLE_SHOW_MASTER . "=") === FALSE) {
			$url .= (strpos($url, "?") !== FALSE ? "&" : "?") . EW_TABLE_SHOW_MASTER . "=" . $this->getCurrentMasterTable();
			$url .= "&fk_id=" . urlencode($this->siswa_id->CurrentValue);
		}
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = ew_StripSlashes($_POST["key_m"]);
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = ew_StripSlashes($_GET["key_m"]);
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsHttpPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = ew_StripSlashes($_POST["id"]);
			elseif (isset($_GET["id"]))
				$arKeys[] = ew_StripSlashes($_GET["id"]);
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $sFilter;
		//$sSql = $this->SQL();

		$sSql = $this->GetSQL($sFilter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sSql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->tahunajaran_id->setDbValue($rs->fields('tahunajaran_id'));
		$this->siswa_id->setDbValue($rs->fields('siswa_id'));
		$this->iuran_id->setDbValue($rs->fields('iuran_id'));
		$this->Nilai->setDbValue($rs->fields('Nilai'));
		$this->Terbayar->setDbValue($rs->fields('Terbayar'));
		$this->Sisa->setDbValue($rs->fields('Sisa'));
		$this->P01->setDbValue($rs->fields('P01'));
		$this->P02->setDbValue($rs->fields('P02'));
		$this->P03->setDbValue($rs->fields('P03'));
		$this->P04->setDbValue($rs->fields('P04'));
		$this->P05->setDbValue($rs->fields('P05'));
		$this->P06->setDbValue($rs->fields('P06'));
		$this->P07->setDbValue($rs->fields('P07'));
		$this->P08->setDbValue($rs->fields('P08'));
		$this->P09->setDbValue($rs->fields('P09'));
		$this->P10->setDbValue($rs->fields('P10'));
		$this->P11->setDbValue($rs->fields('P11'));
		$this->P12->setDbValue($rs->fields('P12'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id
		// tahunajaran_id
		// siswa_id
		// iuran_id
		// Nilai
		// Terbayar
		// Sisa
		// P01
		// P02
		// P03
		// P04
		// P05
		// P06
		// P07
		// P08
		// P09
		// P10
		// P11
		// P12
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// tahunajaran_id
		if (strval($this->tahunajaran_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->tahunajaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `TahunAjaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t0101_tahunajaran`";
		$sWhereWrk = "";
		$this->tahunajaran_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tahunajaran_id->ViewValue = $this->tahunajaran_id->CurrentValue;
			}
		} else {
			$this->tahunajaran_id->ViewValue = NULL;
		}
		$this->tahunajaran_id->ViewCustomAttributes = "";

		// siswa_id
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
		if (strval($this->siswa_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswa_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `NIS` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t0201_siswa`";
		$sWhereWrk = "";
		$this->siswa_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->siswa_id->ViewValue = $this->siswa_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
			}
		} else {
			$this->siswa_id->ViewValue = NULL;
		}
		$this->siswa_id->ViewCustomAttributes = "";

		// iuran_id
		if (strval($this->iuran_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->iuran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `Iuran` AS `DispFld`, `Jenis` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t0106_iuran`";
		$sWhereWrk = "";
		$this->iuran_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->iuran_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->iuran_id->ViewValue = $this->iuran_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->iuran_id->ViewValue = $this->iuran_id->CurrentValue;
			}
		} else {
			$this->iuran_id->ViewValue = NULL;
		}
		$this->iuran_id->ViewCustomAttributes = "";

		// Nilai
		$this->Nilai->ViewValue = $this->Nilai->CurrentValue;
		$this->Nilai->ViewValue = ew_FormatNumber($this->Nilai->ViewValue, 2, -2, -2, -2);
		$this->Nilai->CellCssStyle .= "text-align: right;";
		$this->Nilai->ViewCustomAttributes = "";

		// Terbayar
		$this->Terbayar->ViewValue = $this->Terbayar->CurrentValue;
		$this->Terbayar->ViewValue = ew_FormatNumber($this->Terbayar->ViewValue, 2, -2, -2, -2);
		$this->Terbayar->CellCssStyle .= "text-align: right;";
		$this->Terbayar->ViewCustomAttributes = "";

		// Sisa
		$this->Sisa->ViewValue = $this->Sisa->CurrentValue;
		$this->Sisa->ViewValue = ew_FormatNumber($this->Sisa->ViewValue, 2, -2, -2, -2);
		$this->Sisa->CellCssStyle .= "text-align: right;";
		$this->Sisa->ViewCustomAttributes = "";

		// P01
		if (ew_ConvertToBool($this->P01->CurrentValue)) {
			$this->P01->ViewValue = $this->P01->FldTagCaption(2) <> "" ? $this->P01->FldTagCaption(2) : "1";
		} else {
			$this->P01->ViewValue = $this->P01->FldTagCaption(1) <> "" ? $this->P01->FldTagCaption(1) : "0";
		}
		$this->P01->ViewCustomAttributes = "";

		// P02
		if (ew_ConvertToBool($this->P02->CurrentValue)) {
			$this->P02->ViewValue = $this->P02->FldTagCaption(2) <> "" ? $this->P02->FldTagCaption(2) : "1";
		} else {
			$this->P02->ViewValue = $this->P02->FldTagCaption(1) <> "" ? $this->P02->FldTagCaption(1) : "0";
		}
		$this->P02->ViewCustomAttributes = "";

		// P03
		if (ew_ConvertToBool($this->P03->CurrentValue)) {
			$this->P03->ViewValue = $this->P03->FldTagCaption(2) <> "" ? $this->P03->FldTagCaption(2) : "1";
		} else {
			$this->P03->ViewValue = $this->P03->FldTagCaption(1) <> "" ? $this->P03->FldTagCaption(1) : "0";
		}
		$this->P03->ViewCustomAttributes = "";

		// P04
		if (ew_ConvertToBool($this->P04->CurrentValue)) {
			$this->P04->ViewValue = $this->P04->FldTagCaption(2) <> "" ? $this->P04->FldTagCaption(2) : "1";
		} else {
			$this->P04->ViewValue = $this->P04->FldTagCaption(1) <> "" ? $this->P04->FldTagCaption(1) : "0";
		}
		$this->P04->ViewCustomAttributes = "";

		// P05
		if (ew_ConvertToBool($this->P05->CurrentValue)) {
			$this->P05->ViewValue = $this->P05->FldTagCaption(2) <> "" ? $this->P05->FldTagCaption(2) : "1";
		} else {
			$this->P05->ViewValue = $this->P05->FldTagCaption(1) <> "" ? $this->P05->FldTagCaption(1) : "0";
		}
		$this->P05->ViewCustomAttributes = "";

		// P06
		if (ew_ConvertToBool($this->P06->CurrentValue)) {
			$this->P06->ViewValue = $this->P06->FldTagCaption(2) <> "" ? $this->P06->FldTagCaption(2) : "1";
		} else {
			$this->P06->ViewValue = $this->P06->FldTagCaption(1) <> "" ? $this->P06->FldTagCaption(1) : "0";
		}
		$this->P06->ViewCustomAttributes = "";

		// P07
		if (ew_ConvertToBool($this->P07->CurrentValue)) {
			$this->P07->ViewValue = $this->P07->FldTagCaption(2) <> "" ? $this->P07->FldTagCaption(2) : "1";
		} else {
			$this->P07->ViewValue = $this->P07->FldTagCaption(1) <> "" ? $this->P07->FldTagCaption(1) : "0";
		}
		$this->P07->ViewCustomAttributes = "";

		// P08
		if (ew_ConvertToBool($this->P08->CurrentValue)) {
			$this->P08->ViewValue = $this->P08->FldTagCaption(2) <> "" ? $this->P08->FldTagCaption(2) : "1";
		} else {
			$this->P08->ViewValue = $this->P08->FldTagCaption(1) <> "" ? $this->P08->FldTagCaption(1) : "0";
		}
		$this->P08->ViewCustomAttributes = "";

		// P09
		if (ew_ConvertToBool($this->P09->CurrentValue)) {
			$this->P09->ViewValue = $this->P09->FldTagCaption(2) <> "" ? $this->P09->FldTagCaption(2) : "1";
		} else {
			$this->P09->ViewValue = $this->P09->FldTagCaption(1) <> "" ? $this->P09->FldTagCaption(1) : "0";
		}
		$this->P09->ViewCustomAttributes = "";

		// P10
		if (ew_ConvertToBool($this->P10->CurrentValue)) {
			$this->P10->ViewValue = $this->P10->FldTagCaption(2) <> "" ? $this->P10->FldTagCaption(2) : "1";
		} else {
			$this->P10->ViewValue = $this->P10->FldTagCaption(1) <> "" ? $this->P10->FldTagCaption(1) : "0";
		}
		$this->P10->ViewCustomAttributes = "";

		// P11
		if (ew_ConvertToBool($this->P11->CurrentValue)) {
			$this->P11->ViewValue = $this->P11->FldTagCaption(2) <> "" ? $this->P11->FldTagCaption(2) : "1";
		} else {
			$this->P11->ViewValue = $this->P11->FldTagCaption(1) <> "" ? $this->P11->FldTagCaption(1) : "0";
		}
		$this->P11->ViewCustomAttributes = "";

		// P12
		if (ew_ConvertToBool($this->P12->CurrentValue)) {
			$this->P12->ViewValue = $this->P12->FldTagCaption(2) <> "" ? $this->P12->FldTagCaption(2) : "1";
		} else {
			$this->P12->ViewValue = $this->P12->FldTagCaption(1) <> "" ? $this->P12->FldTagCaption(1) : "0";
		}
		$this->P12->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// tahunajaran_id
		$this->tahunajaran_id->LinkCustomAttributes = "";
		$this->tahunajaran_id->HrefValue = "";
		$this->tahunajaran_id->TooltipValue = "";

		// siswa_id
		$this->siswa_id->LinkCustomAttributes = "";
		$this->siswa_id->HrefValue = "";
		$this->siswa_id->TooltipValue = "";

		// iuran_id
		$this->iuran_id->LinkCustomAttributes = "";
		$this->iuran_id->HrefValue = "";
		$this->iuran_id->TooltipValue = "";

		// Nilai
		$this->Nilai->LinkCustomAttributes = "";
		$this->Nilai->HrefValue = "";
		$this->Nilai->TooltipValue = "";

		// Terbayar
		$this->Terbayar->LinkCustomAttributes = "";
		$this->Terbayar->HrefValue = "";
		$this->Terbayar->TooltipValue = "";

		// Sisa
		$this->Sisa->LinkCustomAttributes = "";
		$this->Sisa->HrefValue = "";
		$this->Sisa->TooltipValue = "";

		// P01
		$this->P01->LinkCustomAttributes = "";
		$this->P01->HrefValue = "";
		$this->P01->TooltipValue = "";

		// P02
		$this->P02->LinkCustomAttributes = "";
		$this->P02->HrefValue = "";
		$this->P02->TooltipValue = "";

		// P03
		$this->P03->LinkCustomAttributes = "";
		$this->P03->HrefValue = "";
		$this->P03->TooltipValue = "";

		// P04
		$this->P04->LinkCustomAttributes = "";
		$this->P04->HrefValue = "";
		$this->P04->TooltipValue = "";

		// P05
		$this->P05->LinkCustomAttributes = "";
		$this->P05->HrefValue = "";
		$this->P05->TooltipValue = "";

		// P06
		$this->P06->LinkCustomAttributes = "";
		$this->P06->HrefValue = "";
		$this->P06->TooltipValue = "";

		// P07
		$this->P07->LinkCustomAttributes = "";
		$this->P07->HrefValue = "";
		$this->P07->TooltipValue = "";

		// P08
		$this->P08->LinkCustomAttributes = "";
		$this->P08->HrefValue = "";
		$this->P08->TooltipValue = "";

		// P09
		$this->P09->LinkCustomAttributes = "";
		$this->P09->HrefValue = "";
		$this->P09->TooltipValue = "";

		// P10
		$this->P10->LinkCustomAttributes = "";
		$this->P10->HrefValue = "";
		$this->P10->TooltipValue = "";

		// P11
		$this->P11->LinkCustomAttributes = "";
		$this->P11->HrefValue = "";
		$this->P11->TooltipValue = "";

		// P12
		$this->P12->LinkCustomAttributes = "";
		$this->P12->HrefValue = "";
		$this->P12->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// tahunajaran_id
		$this->tahunajaran_id->EditAttrs["class"] = "form-control";
		$this->tahunajaran_id->EditCustomAttributes = "";

		// siswa_id
		$this->siswa_id->EditAttrs["class"] = "form-control";
		$this->siswa_id->EditCustomAttributes = "";
		if ($this->siswa_id->getSessionValue() <> "") {
			$this->siswa_id->CurrentValue = $this->siswa_id->getSessionValue();
		$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
		if (strval($this->siswa_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->siswa_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `NIS` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t0201_siswa`";
		$sWhereWrk = "";
		$this->siswa_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->siswa_id->ViewValue = $this->siswa_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->siswa_id->ViewValue = $this->siswa_id->CurrentValue;
			}
		} else {
			$this->siswa_id->ViewValue = NULL;
		}
		$this->siswa_id->ViewCustomAttributes = "";
		} else {
		$this->siswa_id->EditValue = $this->siswa_id->CurrentValue;
		$this->siswa_id->PlaceHolder = ew_RemoveHtml($this->siswa_id->FldCaption());
		}

		// iuran_id
		$this->iuran_id->EditAttrs["class"] = "form-control";
		$this->iuran_id->EditCustomAttributes = "";

		// Nilai
		$this->Nilai->EditAttrs["class"] = "form-control";
		$this->Nilai->EditCustomAttributes = "";
		$this->Nilai->EditValue = $this->Nilai->CurrentValue;
		$this->Nilai->PlaceHolder = ew_RemoveHtml($this->Nilai->FldCaption());
		if (strval($this->Nilai->EditValue) <> "" && is_numeric($this->Nilai->EditValue)) $this->Nilai->EditValue = ew_FormatNumber($this->Nilai->EditValue, -2, -2, -2, -2);

		// Terbayar
		$this->Terbayar->EditAttrs["class"] = "form-control";
		$this->Terbayar->EditCustomAttributes = "";
		$this->Terbayar->EditValue = $this->Terbayar->CurrentValue;
		$this->Terbayar->PlaceHolder = ew_RemoveHtml($this->Terbayar->FldCaption());
		if (strval($this->Terbayar->EditValue) <> "" && is_numeric($this->Terbayar->EditValue)) $this->Terbayar->EditValue = ew_FormatNumber($this->Terbayar->EditValue, -2, -2, -2, -2);

		// Sisa
		$this->Sisa->EditAttrs["class"] = "form-control";
		$this->Sisa->EditCustomAttributes = "";
		$this->Sisa->EditValue = $this->Sisa->CurrentValue;
		$this->Sisa->PlaceHolder = ew_RemoveHtml($this->Sisa->FldCaption());
		if (strval($this->Sisa->EditValue) <> "" && is_numeric($this->Sisa->EditValue)) $this->Sisa->EditValue = ew_FormatNumber($this->Sisa->EditValue, -2, -2, -2, -2);

		// P01
		$this->P01->EditCustomAttributes = "";
		$this->P01->EditValue = $this->P01->Options(FALSE);

		// P02
		$this->P02->EditCustomAttributes = "";
		$this->P02->EditValue = $this->P02->Options(FALSE);

		// P03
		$this->P03->EditCustomAttributes = "";
		$this->P03->EditValue = $this->P03->Options(FALSE);

		// P04
		$this->P04->EditCustomAttributes = "";
		$this->P04->EditValue = $this->P04->Options(FALSE);

		// P05
		$this->P05->EditCustomAttributes = "";
		$this->P05->EditValue = $this->P05->Options(FALSE);

		// P06
		$this->P06->EditCustomAttributes = "";
		$this->P06->EditValue = $this->P06->Options(FALSE);

		// P07
		$this->P07->EditCustomAttributes = "";
		$this->P07->EditValue = $this->P07->Options(FALSE);

		// P08
		$this->P08->EditCustomAttributes = "";
		$this->P08->EditValue = $this->P08->Options(FALSE);

		// P09
		$this->P09->EditCustomAttributes = "";
		$this->P09->EditValue = $this->P09->Options(FALSE);

		// P10
		$this->P10->EditCustomAttributes = "";
		$this->P10->EditValue = $this->P10->Options(FALSE);

		// P11
		$this->P11->EditCustomAttributes = "";
		$this->P11->EditValue = $this->P11->Options(FALSE);

		// P12
		$this->P12->EditCustomAttributes = "";
		$this->P12->EditValue = $this->P12->Options(FALSE);

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->tahunajaran_id->Exportable) $Doc->ExportCaption($this->tahunajaran_id);
					if ($this->iuran_id->Exportable) $Doc->ExportCaption($this->iuran_id);
					if ($this->Nilai->Exportable) $Doc->ExportCaption($this->Nilai);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->tahunajaran_id->Exportable) $Doc->ExportCaption($this->tahunajaran_id);
					if ($this->siswa_id->Exportable) $Doc->ExportCaption($this->siswa_id);
					if ($this->iuran_id->Exportable) $Doc->ExportCaption($this->iuran_id);
					if ($this->Nilai->Exportable) $Doc->ExportCaption($this->Nilai);
					if ($this->Terbayar->Exportable) $Doc->ExportCaption($this->Terbayar);
					if ($this->Sisa->Exportable) $Doc->ExportCaption($this->Sisa);
					if ($this->P01->Exportable) $Doc->ExportCaption($this->P01);
					if ($this->P02->Exportable) $Doc->ExportCaption($this->P02);
					if ($this->P03->Exportable) $Doc->ExportCaption($this->P03);
					if ($this->P04->Exportable) $Doc->ExportCaption($this->P04);
					if ($this->P05->Exportable) $Doc->ExportCaption($this->P05);
					if ($this->P06->Exportable) $Doc->ExportCaption($this->P06);
					if ($this->P07->Exportable) $Doc->ExportCaption($this->P07);
					if ($this->P08->Exportable) $Doc->ExportCaption($this->P08);
					if ($this->P09->Exportable) $Doc->ExportCaption($this->P09);
					if ($this->P10->Exportable) $Doc->ExportCaption($this->P10);
					if ($this->P11->Exportable) $Doc->ExportCaption($this->P11);
					if ($this->P12->Exportable) $Doc->ExportCaption($this->P12);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->tahunajaran_id->Exportable) $Doc->ExportField($this->tahunajaran_id);
						if ($this->iuran_id->Exportable) $Doc->ExportField($this->iuran_id);
						if ($this->Nilai->Exportable) $Doc->ExportField($this->Nilai);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->tahunajaran_id->Exportable) $Doc->ExportField($this->tahunajaran_id);
						if ($this->siswa_id->Exportable) $Doc->ExportField($this->siswa_id);
						if ($this->iuran_id->Exportable) $Doc->ExportField($this->iuran_id);
						if ($this->Nilai->Exportable) $Doc->ExportField($this->Nilai);
						if ($this->Terbayar->Exportable) $Doc->ExportField($this->Terbayar);
						if ($this->Sisa->Exportable) $Doc->ExportField($this->Sisa);
						if ($this->P01->Exportable) $Doc->ExportField($this->P01);
						if ($this->P02->Exportable) $Doc->ExportField($this->P02);
						if ($this->P03->Exportable) $Doc->ExportField($this->P03);
						if ($this->P04->Exportable) $Doc->ExportField($this->P04);
						if ($this->P05->Exportable) $Doc->ExportField($this->P05);
						if ($this->P06->Exportable) $Doc->ExportField($this->P06);
						if ($this->P07->Exportable) $Doc->ExportField($this->P07);
						if ($this->P08->Exportable) $Doc->ExportField($this->P08);
						if ($this->P09->Exportable) $Doc->ExportField($this->P09);
						if ($this->P10->Exportable) $Doc->ExportField($this->P10);
						if ($this->P11->Exportable) $Doc->ExportField($this->P11);
						if ($this->P12->Exportable) $Doc->ExportField($this->P12);
					}
					$Doc->EndExportRow();
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
	}

	// Write Audit Trail start/end for grid update
	function WriteAuditTrailDummy($typ) {
		$table = 't0202_siswaiuran';
		$usr = CurrentUserID();
		ew_WriteAuditTrail("log", ew_StdCurrentDateTime(), ew_ScriptName(), $usr, $typ, $table, "", "", "", "");
	}

	// Write Audit Trail (add page)
	function WriteAuditTrailOnAdd(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnAdd) return;
		$table = 't0202_siswaiuran';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$newvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$newvalue = $rs[$fldname];
					else
						$newvalue = "[MEMO]"; // Memo Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$newvalue = "[XML]"; // XML Field
				} else {
					$newvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $usr, "A", $table, $fldname, $key, "", $newvalue);
			}
		}
	}

	// Write Audit Trail (edit page)
	function WriteAuditTrailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		if (!$this->AuditTrailOnEdit) return;
		$table = 't0202_siswaiuran';

		// Get key value
		$key = "";
		if ($key <> "") $key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rsold['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$usr = CurrentUserID();
		foreach (array_keys($rsnew) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && array_key_exists($fldname, $rsold) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldDataType == EW_DATATYPE_DATE) { // DateTime field
					$modified = (ew_FormatDateTime($rsold[$fldname], 0) <> ew_FormatDateTime($rsnew[$fldname], 0));
				} else {
					$modified = !ew_CompareValue($rsold[$fldname], $rsnew[$fldname]);
				}
				if ($modified) {
					if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") { // Password Field
						$oldvalue = $Language->Phrase("PasswordMask");
						$newvalue = $Language->Phrase("PasswordMask");
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) { // Memo field
						if (EW_AUDIT_TRAIL_TO_DATABASE) {
							$oldvalue = $rsold[$fldname];
							$newvalue = $rsnew[$fldname];
						} else {
							$oldvalue = "[MEMO]";
							$newvalue = "[MEMO]";
						}
					} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) { // XML field
						$oldvalue = "[XML]";
						$newvalue = "[XML]";
					} else {
						$oldvalue = $rsold[$fldname];
						$newvalue = $rsnew[$fldname];
					}
					ew_WriteAuditTrail("log", $dt, $id, $usr, "U", $table, $fldname, $key, $oldvalue, $newvalue);
				}
			}
		}
	}

	// Write Audit Trail (delete page)
	function WriteAuditTrailOnDelete(&$rs) {
		global $Language;
		if (!$this->AuditTrailOnDelete) return;
		$table = 't0202_siswaiuran';

		// Get key value
		$key = "";
		if ($key <> "")
			$key .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$key .= $rs['id'];

		// Write Audit Trail
		$dt = ew_StdCurrentDateTime();
		$id = ew_ScriptName();
		$curUser = CurrentUserID();
		foreach (array_keys($rs) as $fldname) {
			if (array_key_exists($fldname, $this->fields) && $this->fields[$fldname]->FldDataType <> EW_DATATYPE_BLOB) { // Ignore BLOB fields
				if ($this->fields[$fldname]->FldHtmlTag == "PASSWORD") {
					$oldvalue = $Language->Phrase("PasswordMask"); // Password Field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_MEMO) {
					if (EW_AUDIT_TRAIL_TO_DATABASE)
						$oldvalue = $rs[$fldname];
					else
						$oldvalue = "[MEMO]"; // Memo field
				} elseif ($this->fields[$fldname]->FldDataType == EW_DATATYPE_XML) {
					$oldvalue = "[XML]"; // XML field
				} else {
					$oldvalue = $rs[$fldname];
				}
				ew_WriteAuditTrail("log", $dt, $id, $curUser, "D", $table, $fldname, $key, $oldvalue, "");
			}
		}
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>
