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

$t0202_siswaiuran_add = NULL; // Initialize page object first

class ct0202_siswaiuran_add extends ct0202_siswaiuran {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = "{6E7B9E1D-9A99-4CA8-B431-15847F998A66}";

	// Table name
	var $TableName = 't0202_siswaiuran';

	// Page object name
	var $PageObjName = 't0202_siswaiuran_add';

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
			define("EW_PAGE_ID", 'add', TRUE);

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
		if (!$Security->CanAdd()) {
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

		// Create form object
		$objForm = new cFormObj();
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

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
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

			// Handle modal response
			if ($this->IsModal) {
				$row = array();
				$row["url"] = $url;
				echo ew_ArrayToJson(array($row));
			} else {
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;

		// Set up master/detail parameters
		$this->SetUpMasterParms();

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
			$this->CopyRecord = $this->LoadOldRecord(); // Load old recordset
			$this->LoadFormValues(); // Load form values
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		} else {
			if ($this->CurrentAction == "I") // Load default values for blank record
				$this->LoadDefaultValues();
		}

		// Perform action based on action code
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "C": // Copy an existing record
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t0202_siswaiuranlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "t0202_siswaiuranlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "t0202_siswaiuranview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to view page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->tahunajaran_id->CurrentValue = NULL;
		$this->tahunajaran_id->OldValue = $this->tahunajaran_id->CurrentValue;
		$this->iuran_id->CurrentValue = NULL;
		$this->iuran_id->OldValue = $this->iuran_id->CurrentValue;
		$this->Nilai->CurrentValue = 0.00;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->tahunajaran_id->FldIsDetailKey) {
			$this->tahunajaran_id->setFormValue($objForm->GetValue("x_tahunajaran_id"));
		}
		if (!$this->iuran_id->FldIsDetailKey) {
			$this->iuran_id->setFormValue($objForm->GetValue("x_iuran_id"));
		}
		if (!$this->Nilai->FldIsDetailKey) {
			$this->Nilai->setFormValue($objForm->GetValue("x_Nilai"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadOldRecord();
		$this->tahunajaran_id->CurrentValue = $this->tahunajaran_id->FormValue;
		$this->iuran_id->CurrentValue = $this->iuran_id->FormValue;
		$this->Nilai->CurrentValue = $this->Nilai->FormValue;
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

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old recordset
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
			$this->LoadRowValues($this->OldRecordset); // Load row values
		} else {
			$this->OldRecordset = NULL;
		}
		return $bValidKey;
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
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// tahunajaran_id
			$this->tahunajaran_id->EditAttrs["class"] = "form-control";
			$this->tahunajaran_id->EditCustomAttributes = "";
			if (trim(strval($this->tahunajaran_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->tahunajaran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `TahunAjaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t0101_tahunajaran`";
			$sWhereWrk = "";
			$this->tahunajaran_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tahunajaran_id->EditValue = $arwrk;

			// iuran_id
			$this->iuran_id->EditAttrs["class"] = "form-control";
			$this->iuran_id->EditCustomAttributes = "";
			if (trim(strval($this->iuran_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->iuran_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `Iuran` AS `DispFld`, `Jenis` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `t0106_iuran`";
			$sWhereWrk = "";
			$this->iuran_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->iuran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->iuran_id->EditValue = $arwrk;

			// Nilai
			$this->Nilai->EditAttrs["class"] = "form-control";
			$this->Nilai->EditCustomAttributes = "";
			$this->Nilai->EditValue = ew_HtmlEncode($this->Nilai->CurrentValue);
			$this->Nilai->PlaceHolder = ew_RemoveHtml($this->Nilai->FldCaption());
			if (strval($this->Nilai->EditValue) <> "" && is_numeric($this->Nilai->EditValue)) $this->Nilai->EditValue = ew_FormatNumber($this->Nilai->EditValue, -2, -2, -2, -2);

			// Add refer script
			// tahunajaran_id

			$this->tahunajaran_id->LinkCustomAttributes = "";
			$this->tahunajaran_id->HrefValue = "";

			// iuran_id
			$this->iuran_id->LinkCustomAttributes = "";
			$this->iuran_id->HrefValue = "";

			// Nilai
			$this->Nilai->LinkCustomAttributes = "";
			$this->Nilai->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD ||
			$this->RowType == EW_ROWTYPE_EDIT ||
			$this->RowType == EW_ROWTYPE_SEARCH) { // Add / Edit / Search row
			$this->SetupFieldTitles();
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->tahunajaran_id->FldIsDetailKey && !is_null($this->tahunajaran_id->FormValue) && $this->tahunajaran_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tahunajaran_id->FldCaption(), $this->tahunajaran_id->ReqErrMsg));
		}
		if (!$this->iuran_id->FldIsDetailKey && !is_null($this->iuran_id->FormValue) && $this->iuran_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->iuran_id->FldCaption(), $this->iuran_id->ReqErrMsg));
		}
		if (!$this->Nilai->FldIsDetailKey && !is_null($this->Nilai->FormValue) && $this->Nilai->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nilai->FldCaption(), $this->Nilai->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Nilai->FormValue)) {
			ew_AddMessage($gsFormError, $this->Nilai->FldErrMsg());
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;

		// Check referential integrity for master table 't0201_siswa'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_t0201_siswa();
		if ($this->siswa_id->getSessionValue() <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->siswa_id->getSessionValue(), "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["t0201_siswa"])) $GLOBALS["t0201_siswa"] = new ct0201_siswa();
			$rsmaster = $GLOBALS["t0201_siswa"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "t0201_siswa", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		if ($rsold) {
			$this->LoadDbValues($rsold);
		}
		$rsnew = array();

		// tahunajaran_id
		$this->tahunajaran_id->SetDbValueDef($rsnew, $this->tahunajaran_id->CurrentValue, 0, FALSE);

		// iuran_id
		$this->iuran_id->SetDbValueDef($rsnew, $this->iuran_id->CurrentValue, 0, FALSE);

		// Nilai
		$this->Nilai->SetDbValueDef($rsnew, $this->Nilai->CurrentValue, 0, strval($this->Nilai->CurrentValue) == "");

		// siswa_id
		if ($this->siswa_id->getSessionValue() <> "") {
			$rsnew['siswa_id'] = $this->siswa_id->getSessionValue();
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
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
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_tahunajaran_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `TahunAjaran` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t0101_tahunajaran`";
			$sWhereWrk = "";
			$this->tahunajaran_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tahunajaran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_iuran_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `Iuran` AS `DispFld`, `Jenis` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t0106_iuran`";
			$sWhereWrk = "";
			$this->iuran_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->iuran_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($t0202_siswaiuran_add)) $t0202_siswaiuran_add = new ct0202_siswaiuran_add();

// Page init
$t0202_siswaiuran_add->Page_Init();

// Page main
$t0202_siswaiuran_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t0202_siswaiuran_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = ft0202_siswaiuranadd = new ew_Form("ft0202_siswaiuranadd", "add");

// Validate form
ft0202_siswaiuranadd.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_tahunajaran_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0202_siswaiuran->tahunajaran_id->FldCaption(), $t0202_siswaiuran->tahunajaran_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_iuran_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0202_siswaiuran->iuran_id->FldCaption(), $t0202_siswaiuran->iuran_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nilai");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0202_siswaiuran->Nilai->FldCaption(), $t0202_siswaiuran->Nilai->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Nilai");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t0202_siswaiuran->Nilai->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
ft0202_siswaiuranadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft0202_siswaiuranadd.ValidateRequired = true;
<?php } else { ?>
ft0202_siswaiuranadd.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft0202_siswaiuranadd.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TahunAjaran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0101_tahunajaran"};
ft0202_siswaiuranadd.Lists["x_iuran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Iuran","x_Jenis","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0106_iuran"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t0202_siswaiuran_add->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t0202_siswaiuran_add->ShowPageHeader(); ?>
<?php
$t0202_siswaiuran_add->ShowMessage();
?>
<form name="ft0202_siswaiuranadd" id="ft0202_siswaiuranadd" class="<?php echo $t0202_siswaiuran_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t0202_siswaiuran_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t0202_siswaiuran_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t0202_siswaiuran">
<input type="hidden" name="a_add" id="a_add" value="A">
<?php if ($t0202_siswaiuran_add->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<?php if ($t0202_siswaiuran->getCurrentMasterTable() == "t0201_siswa") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="t0201_siswa">
<input type="hidden" name="fk_id" value="<?php echo $t0202_siswaiuran->siswa_id->getSessionValue() ?>">
<?php } ?>
<div>
<?php if ($t0202_siswaiuran->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<div id="r_tahunajaran_id" class="form-group">
		<label id="elh_t0202_siswaiuran_tahunajaran_id" for="x_tahunajaran_id" class="col-sm-2 control-label ewLabel"><?php echo $t0202_siswaiuran->tahunajaran_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0202_siswaiuran->tahunajaran_id->CellAttributes() ?>>
<span id="el_t0202_siswaiuran_tahunajaran_id">
<select data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t0202_siswaiuran->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x_tahunajaran_id" name="x_tahunajaran_id"<?php echo $t0202_siswaiuran->tahunajaran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->tahunajaran_id->SelectOptionListHtml("x_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x_tahunajaran_id" id="s_x_tahunajaran_id" value="<?php echo $t0202_siswaiuran->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php echo $t0202_siswaiuran->tahunajaran_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t0202_siswaiuran->iuran_id->Visible) { // iuran_id ?>
	<div id="r_iuran_id" class="form-group">
		<label id="elh_t0202_siswaiuran_iuran_id" for="x_iuran_id" class="col-sm-2 control-label ewLabel"><?php echo $t0202_siswaiuran->iuran_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0202_siswaiuran->iuran_id->CellAttributes() ?>>
<span id="el_t0202_siswaiuran_iuran_id">
<select data-table="t0202_siswaiuran" data-field="x_iuran_id" data-value-separator="<?php echo $t0202_siswaiuran->iuran_id->DisplayValueSeparatorAttribute() ?>" id="x_iuran_id" name="x_iuran_id"<?php echo $t0202_siswaiuran->iuran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->iuran_id->SelectOptionListHtml("x_iuran_id") ?>
</select>
<input type="hidden" name="s_x_iuran_id" id="s_x_iuran_id" value="<?php echo $t0202_siswaiuran->iuran_id->LookupFilterQuery() ?>">
</span>
<?php echo $t0202_siswaiuran->iuran_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t0202_siswaiuran->Nilai->Visible) { // Nilai ?>
	<div id="r_Nilai" class="form-group">
		<label id="elh_t0202_siswaiuran_Nilai" for="x_Nilai" class="col-sm-2 control-label ewLabel"><?php echo $t0202_siswaiuran->Nilai->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0202_siswaiuran->Nilai->CellAttributes() ?>>
<span id="el_t0202_siswaiuran_Nilai">
<input type="text" data-table="t0202_siswaiuran" data-field="x_Nilai" name="x_Nilai" id="x_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->getPlaceHolder()) ?>" value="<?php echo $t0202_siswaiuran->Nilai->EditValue ?>"<?php echo $t0202_siswaiuran->Nilai->EditAttributes() ?>>
</span>
<?php echo $t0202_siswaiuran->Nilai->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<?php if (strval($t0202_siswaiuran->siswa_id->getSessionValue()) <> "") { ?>
<input type="hidden" name="x_siswa_id" id="x_siswa_id" value="<?php echo ew_HtmlEncode(strval($t0202_siswaiuran->siswa_id->getSessionValue())) ?>">
<?php } ?>
<?php if (!$t0202_siswaiuran_add->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t0202_siswaiuran_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft0202_siswaiuranadd.Init();
</script>
<?php
$t0202_siswaiuran_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t0202_siswaiuran_add->Page_Terminate();
?>
