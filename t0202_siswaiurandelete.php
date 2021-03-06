<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t0202_siswaiuraninfo.php" ?>
<?php include_once "t0201_siswainfo.php" ?>
<?php include_once "t9996_employeesinfo.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t0202_siswaiuran_delete = NULL; // Initialize page object first

class ct0202_siswaiuran_delete extends ct0202_siswaiuran {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = "{6E7B9E1D-9A99-4CA8-B431-15847F998A66}";

	// Table name
	var $TableName = 't0202_siswaiuran';

	// Page object name
	var $PageObjName = 't0202_siswaiuran_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsHttpPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (t0202_siswaiuran)
		if (!isset($GLOBALS["t0202_siswaiuran"]) || get_class($GLOBALS["t0202_siswaiuran"]) == "ct0202_siswaiuran") {
			$GLOBALS["t0202_siswaiuran"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t0202_siswaiuran"];
		}

		// Table object (t0201_siswa)
		if (!isset($GLOBALS['t0201_siswa'])) $GLOBALS['t0201_siswa'] = new ct0201_siswa();

		// Table object (t9996_employees)
		if (!isset($GLOBALS['t9996_employees'])) $GLOBALS['t9996_employees'] = new ct9996_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't0202_siswaiuran', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"])) $GLOBALS["gTimer"] = new cTimer();

		// Open connection
		if (!isset($conn)) $conn = ew_Connect($this->DBID);

		// User table object (t9996_employees)
		if (!isset($UserTable)) {
			$UserTable = new ct9996_employees();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t0202_siswaiuranlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->tahunajaran_id->SetVisibility();
		$this->iuran_id->SetVisibility();
		$this->Nilai->SetVisibility();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $t0202_siswaiuran;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t0202_siswaiuran);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		 // Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("t0202_siswaiuranlist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in t0202_siswaiuran class, t0202_siswaiuraninfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("t0202_siswaiuranlist.php"); // Return to list
			}
		}
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->SelectSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		if (!$rs || $rs->EOF) return;

		// Call Row Selected event
		$row = &$rs->fields;
		$this->Row_Selected($row);
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

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->tahunajaran_id->DbValue = $row['tahunajaran_id'];
		$this->siswa_id->DbValue = $row['siswa_id'];
		$this->iuran_id->DbValue = $row['iuran_id'];
		$this->Nilai->DbValue = $row['Nilai'];
		$this->Terbayar->DbValue = $row['Terbayar'];
		$this->Sisa->DbValue = $row['Sisa'];
		$this->P01->DbValue = $row['P01'];
		$this->P02->DbValue = $row['P02'];
		$this->P03->DbValue = $row['P03'];
		$this->P04->DbValue = $row['P04'];
		$this->P05->DbValue = $row['P05'];
		$this->P06->DbValue = $row['P06'];
		$this->P07->DbValue = $row['P07'];
		$this->P08->DbValue = $row['P08'];
		$this->P09->DbValue = $row['P09'];
		$this->P10->DbValue = $row['P10'];
		$this->P11->DbValue = $row['P11'];
		$this->P12->DbValue = $row['P12'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Nilai->FormValue == $this->Nilai->CurrentValue && is_numeric(ew_StrToFloat($this->Nilai->CurrentValue)))
			$this->Nilai->CurrentValue = ew_StrToFloat($this->Nilai->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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

			// tahunajaran_id
			$this->tahunajaran_id->LinkCustomAttributes = "";
			$this->tahunajaran_id->HrefValue = "";
			$this->tahunajaran_id->TooltipValue = "";

			// iuran_id
			$this->iuran_id->LinkCustomAttributes = "";
			$this->iuran_id->HrefValue = "";
			$this->iuran_id->TooltipValue = "";

			// Nilai
			$this->Nilai->LinkCustomAttributes = "";
			$this->Nilai->HrefValue = "";
			$this->Nilai->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;

		//} else {
		//	$this->LoadRowValues($rs); // Load row values

		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();
		if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteBegin")); // Batch delete begin

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteSuccess")); // Batch delete success
		} else {
			$conn->RollbackTrans(); // Rollback changes
			if ($this->AuditTrailOnDelete) $this->WriteAuditTrailDummy($Language->Phrase("BatchDeleteRollback")); // Batch delete rollback
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up master/detail based on QueryString
	function SetUpMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t0201_siswa") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["t0201_siswa"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->siswa_id->setQueryStringValue($GLOBALS["t0201_siswa"]->id->QueryStringValue);
					$this->siswa_id->setSessionValue($this->siswa_id->QueryStringValue);
					if (!is_numeric($GLOBALS["t0201_siswa"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "t0201_siswa") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["t0201_siswa"]->id->setFormValue($_POST["fk_id"]);
					$this->siswa_id->setFormValue($GLOBALS["t0201_siswa"]->id->FormValue);
					$this->siswa_id->setSessionValue($this->siswa_id->FormValue);
					if (!is_numeric($GLOBALS["t0201_siswa"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);

			// Clear previous master key from Session
			if ($sMasterTblVar <> "t0201_siswa") {
				if ($this->siswa_id->CurrentValue == "") $this->siswa_id->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t0202_siswaiuranlist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t0202_siswaiuran_delete)) $t0202_siswaiuran_delete = new ct0202_siswaiuran_delete();

// Page init
$t0202_siswaiuran_delete->Page_Init();

// Page main
$t0202_siswaiuran_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t0202_siswaiuran_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = ft0202_siswaiurandelete = new ew_Form("ft0202_siswaiurandelete", "delete");

// Form_CustomValidate event
ft0202_siswaiurandelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft0202_siswaiurandelete.ValidateRequired = true;
<?php } else { ?>
ft0202_siswaiurandelete.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft0202_siswaiurandelete.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TahunAjaran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0101_tahunajaran"};
ft0202_siswaiurandelete.Lists["x_iuran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Iuran","x_Jenis","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0106_iuran"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php $t0202_siswaiuran_delete->ShowPageHeader(); ?>
<?php
$t0202_siswaiuran_delete->ShowMessage();
?>
<form name="ft0202_siswaiurandelete" id="ft0202_siswaiurandelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t0202_siswaiuran_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t0202_siswaiuran_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t0202_siswaiuran">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($t0202_siswaiuran_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table class="table ewTable">
<?php echo $t0202_siswaiuran->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
<?php if ($t0202_siswaiuran->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<th><span id="elh_t0202_siswaiuran_tahunajaran_id" class="t0202_siswaiuran_tahunajaran_id"><?php echo $t0202_siswaiuran->tahunajaran_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t0202_siswaiuran->iuran_id->Visible) { // iuran_id ?>
		<th><span id="elh_t0202_siswaiuran_iuran_id" class="t0202_siswaiuran_iuran_id"><?php echo $t0202_siswaiuran->iuran_id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($t0202_siswaiuran->Nilai->Visible) { // Nilai ?>
		<th><span id="elh_t0202_siswaiuran_Nilai" class="t0202_siswaiuran_Nilai"><?php echo $t0202_siswaiuran->Nilai->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$t0202_siswaiuran_delete->RecCnt = 0;
$i = 0;
while (!$t0202_siswaiuran_delete->Recordset->EOF) {
	$t0202_siswaiuran_delete->RecCnt++;
	$t0202_siswaiuran_delete->RowCnt++;

	// Set row properties
	$t0202_siswaiuran->ResetAttrs();
	$t0202_siswaiuran->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$t0202_siswaiuran_delete->LoadRowValues($t0202_siswaiuran_delete->Recordset);

	// Render row
	$t0202_siswaiuran_delete->RenderRow();
?>
	<tr<?php echo $t0202_siswaiuran->RowAttributes() ?>>
<?php if ($t0202_siswaiuran->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td<?php echo $t0202_siswaiuran->tahunajaran_id->CellAttributes() ?>>
<span id="el<?php echo $t0202_siswaiuran_delete->RowCnt ?>_t0202_siswaiuran_tahunajaran_id" class="t0202_siswaiuran_tahunajaran_id">
<span<?php echo $t0202_siswaiuran->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t0202_siswaiuran->tahunajaran_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t0202_siswaiuran->iuran_id->Visible) { // iuran_id ?>
		<td<?php echo $t0202_siswaiuran->iuran_id->CellAttributes() ?>>
<span id="el<?php echo $t0202_siswaiuran_delete->RowCnt ?>_t0202_siswaiuran_iuran_id" class="t0202_siswaiuran_iuran_id">
<span<?php echo $t0202_siswaiuran->iuran_id->ViewAttributes() ?>>
<?php echo $t0202_siswaiuran->iuran_id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($t0202_siswaiuran->Nilai->Visible) { // Nilai ?>
		<td<?php echo $t0202_siswaiuran->Nilai->CellAttributes() ?>>
<span id="el<?php echo $t0202_siswaiuran_delete->RowCnt ?>_t0202_siswaiuran_Nilai" class="t0202_siswaiuran_Nilai">
<span<?php echo $t0202_siswaiuran->Nilai->ViewAttributes() ?>>
<?php echo $t0202_siswaiuran->Nilai->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$t0202_siswaiuran_delete->Recordset->MoveNext();
}
$t0202_siswaiuran_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t0202_siswaiuran_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
ft0202_siswaiurandelete.Init();
</script>
<?php
$t0202_siswaiuran_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t0202_siswaiuran_delete->Page_Terminate();
?>
