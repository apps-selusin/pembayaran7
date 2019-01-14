<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg13.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql13.php") ?>
<?php include_once "phpfn13.php" ?>
<?php include_once "t0301_bayarmasterinfo.php" ?>
<?php include_once "t9996_employeesinfo.php" ?>
<?php include_once "t0302_bayardetailgridcls.php" ?>
<?php include_once "userfn13.php" ?>
<?php

//
// Page class
//

$t0301_bayarmaster_edit = NULL; // Initialize page object first

class ct0301_bayarmaster_edit extends ct0301_bayarmaster {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = "{6E7B9E1D-9A99-4CA8-B431-15847F998A66}";

	// Table name
	var $TableName = 't0301_bayarmaster';

	// Page object name
	var $PageObjName = 't0301_bayarmaster_edit';

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

		// Table object (t0301_bayarmaster)
		if (!isset($GLOBALS["t0301_bayarmaster"]) || get_class($GLOBALS["t0301_bayarmaster"]) == "ct0301_bayarmaster") {
			$GLOBALS["t0301_bayarmaster"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["t0301_bayarmaster"];
		}

		// Table object (t9996_employees)
		if (!isset($GLOBALS['t9996_employees'])) $GLOBALS['t9996_employees'] = new ct9996_employees();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 't0301_bayarmaster', TRUE);

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
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("t0301_bayarmasterlist.php"));
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
		$this->Nomor->SetVisibility();
		$this->Tanggal->SetVisibility();
		$this->tahunajaran_id->SetVisibility();
		$this->siswa_id->SetVisibility();
		$this->Total->SetVisibility();

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

			// Process auto fill for detail table 't0302_bayardetail'
			if (@$_POST["grid"] == "ft0302_bayardetailgrid") {
				if (!isset($GLOBALS["t0302_bayardetail_grid"])) $GLOBALS["t0302_bayardetail_grid"] = new ct0302_bayardetail_grid;
				$GLOBALS["t0302_bayardetail_grid"]->Page_Init();
				$this->Page_Terminate();
				exit();
			}
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
		global $EW_EXPORT, $t0301_bayarmaster;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($t0301_bayarmaster);
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
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;

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

		// Load key from QueryString
		if (@$_GET["id"] <> "") {
			$this->id->setQueryStringValue($_GET["id"]);
		}

		// Process form if post back
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetUpDetailParms();
		} else {
			$this->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($this->id->CurrentValue == "") {
			$this->Page_Terminate("t0301_bayarmasterlist.php"); // Invalid key, return to list
		}

		// Validate form if post back
		if (@$_POST["a_edit"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("t0301_bayarmasterlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetUpDetailParms();
				break;
			Case "U": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$sReturnUrl = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "t0301_bayarmasterlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to list page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->SetUpDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->Nomor->FldIsDetailKey) {
			$this->Nomor->setFormValue($objForm->GetValue("x_Nomor"));
		}
		if (!$this->Tanggal->FldIsDetailKey) {
			$this->Tanggal->setFormValue($objForm->GetValue("x_Tanggal"));
			$this->Tanggal->CurrentValue = ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7);
		}
		if (!$this->tahunajaran_id->FldIsDetailKey) {
			$this->tahunajaran_id->setFormValue($objForm->GetValue("x_tahunajaran_id"));
		}
		if (!$this->siswa_id->FldIsDetailKey) {
			$this->siswa_id->setFormValue($objForm->GetValue("x_siswa_id"));
		}
		if (!$this->Total->FldIsDetailKey) {
			$this->Total->setFormValue($objForm->GetValue("x_Total"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->LoadRow();
		$this->id->CurrentValue = $this->id->FormValue;
		$this->Nomor->CurrentValue = $this->Nomor->FormValue;
		$this->Tanggal->CurrentValue = $this->Tanggal->FormValue;
		$this->Tanggal->CurrentValue = ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7);
		$this->tahunajaran_id->CurrentValue = $this->tahunajaran_id->FormValue;
		$this->siswa_id->CurrentValue = $this->siswa_id->FormValue;
		$this->Total->CurrentValue = $this->Total->FormValue;
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
		$this->Nomor->setDbValue($rs->fields('Nomor'));
		$this->Tanggal->setDbValue($rs->fields('Tanggal'));
		$this->tahunajaran_id->setDbValue($rs->fields('tahunajaran_id'));
		$this->siswa_id->setDbValue($rs->fields('siswa_id'));
		if (array_key_exists('EV__siswa_id', $rs->fields)) {
			$this->siswa_id->VirtualValue = $rs->fields('EV__siswa_id'); // Set up virtual field value
		} else {
			$this->siswa_id->VirtualValue = ""; // Clear value
		}
		$this->Total->setDbValue($rs->fields('Total'));
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF) return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->Nomor->DbValue = $row['Nomor'];
		$this->Tanggal->DbValue = $row['Tanggal'];
		$this->tahunajaran_id->DbValue = $row['tahunajaran_id'];
		$this->siswa_id->DbValue = $row['siswa_id'];
		$this->Total->DbValue = $row['Total'];
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Convert decimal values if posted back

		if ($this->Total->FormValue == $this->Total->CurrentValue && is_numeric(ew_StrToFloat($this->Total->CurrentValue)))
			$this->Total->CurrentValue = ew_StrToFloat($this->Total->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// Nomor
		// Tanggal
		// tahunajaran_id
		// siswa_id
		// Total

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// Nomor
		$this->Nomor->ViewValue = $this->Nomor->CurrentValue;
		$this->Nomor->ViewCustomAttributes = "";

		// Tanggal
		$this->Tanggal->ViewValue = $this->Tanggal->CurrentValue;
		$this->Tanggal->ViewValue = ew_FormatDateTime($this->Tanggal->ViewValue, 7);
		$this->Tanggal->ViewCustomAttributes = "";

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
		if ($this->siswa_id->VirtualValue <> "") {
			$this->siswa_id->ViewValue = $this->siswa_id->VirtualValue;
		} else {
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
		}
		$this->siswa_id->ViewCustomAttributes = "";

		// Total
		$this->Total->ViewValue = $this->Total->CurrentValue;
		$this->Total->ViewValue = ew_FormatNumber($this->Total->ViewValue, 2, -2, -2, -2);
		$this->Total->CellCssStyle .= "text-align: right;";
		$this->Total->ViewCustomAttributes = "";

			// Nomor
			$this->Nomor->LinkCustomAttributes = "";
			$this->Nomor->HrefValue = "";
			$this->Nomor->TooltipValue = "";

			// Tanggal
			$this->Tanggal->LinkCustomAttributes = "";
			$this->Tanggal->HrefValue = "";
			$this->Tanggal->TooltipValue = "";

			// tahunajaran_id
			$this->tahunajaran_id->LinkCustomAttributes = "";
			$this->tahunajaran_id->HrefValue = "";
			$this->tahunajaran_id->TooltipValue = "";

			// siswa_id
			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";
			$this->siswa_id->TooltipValue = "";

			// Total
			$this->Total->LinkCustomAttributes = "";
			$this->Total->HrefValue = "";
			$this->Total->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Nomor
			$this->Nomor->EditAttrs["class"] = "form-control";
			$this->Nomor->EditCustomAttributes = "";
			$this->Nomor->EditValue = ew_HtmlEncode($this->Nomor->CurrentValue);
			$this->Nomor->PlaceHolder = ew_RemoveHtml($this->Nomor->FldCaption());

			// Tanggal
			$this->Tanggal->EditAttrs["class"] = "form-control";
			$this->Tanggal->EditCustomAttributes = "style: 'width=115px;'";
			$this->Tanggal->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->Tanggal->CurrentValue, 7));
			$this->Tanggal->PlaceHolder = ew_RemoveHtml($this->Tanggal->FldCaption());

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

			// siswa_id
			$this->siswa_id->EditAttrs["class"] = "form-control";
			$this->siswa_id->EditCustomAttributes = "";
			$this->siswa_id->EditValue = ew_HtmlEncode($this->siswa_id->CurrentValue);
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
					$this->siswa_id->EditValue = $this->siswa_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->siswa_id->EditValue = ew_HtmlEncode($this->siswa_id->CurrentValue);
				}
			} else {
				$this->siswa_id->EditValue = NULL;
			}
			$this->siswa_id->PlaceHolder = ew_RemoveHtml($this->siswa_id->FldCaption());

			// Total
			$this->Total->EditAttrs["class"] = "form-control";
			$this->Total->EditCustomAttributes = "";
			$this->Total->EditValue = ew_HtmlEncode($this->Total->CurrentValue);
			$this->Total->PlaceHolder = ew_RemoveHtml($this->Total->FldCaption());
			if (strval($this->Total->EditValue) <> "" && is_numeric($this->Total->EditValue)) $this->Total->EditValue = ew_FormatNumber($this->Total->EditValue, -2, -2, -2, -2);

			// Edit refer script
			// Nomor

			$this->Nomor->LinkCustomAttributes = "";
			$this->Nomor->HrefValue = "";

			// Tanggal
			$this->Tanggal->LinkCustomAttributes = "";
			$this->Tanggal->HrefValue = "";

			// tahunajaran_id
			$this->tahunajaran_id->LinkCustomAttributes = "";
			$this->tahunajaran_id->HrefValue = "";

			// siswa_id
			$this->siswa_id->LinkCustomAttributes = "";
			$this->siswa_id->HrefValue = "";

			// Total
			$this->Total->LinkCustomAttributes = "";
			$this->Total->HrefValue = "";
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
		if (!$this->Nomor->FldIsDetailKey && !is_null($this->Nomor->FormValue) && $this->Nomor->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Nomor->FldCaption(), $this->Nomor->ReqErrMsg));
		}
		if (!$this->Tanggal->FldIsDetailKey && !is_null($this->Tanggal->FormValue) && $this->Tanggal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Tanggal->FldCaption(), $this->Tanggal->ReqErrMsg));
		}
		if (!ew_CheckEuroDate($this->Tanggal->FormValue)) {
			ew_AddMessage($gsFormError, $this->Tanggal->FldErrMsg());
		}
		if (!$this->tahunajaran_id->FldIsDetailKey && !is_null($this->tahunajaran_id->FormValue) && $this->tahunajaran_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->tahunajaran_id->FldCaption(), $this->tahunajaran_id->ReqErrMsg));
		}
		if (!$this->siswa_id->FldIsDetailKey && !is_null($this->siswa_id->FormValue) && $this->siswa_id->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->siswa_id->FldCaption(), $this->siswa_id->ReqErrMsg));
		}
		if (!$this->Total->FldIsDetailKey && !is_null($this->Total->FormValue) && $this->Total->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->Total->FldCaption(), $this->Total->ReqErrMsg));
		}
		if (!ew_CheckNumber($this->Total->FormValue)) {
			ew_AddMessage($gsFormError, $this->Total->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("t0302_bayardetail", $DetailTblVar) && $GLOBALS["t0302_bayardetail"]->DetailEdit) {
			if (!isset($GLOBALS["t0302_bayardetail_grid"])) $GLOBALS["t0302_bayardetail_grid"] = new ct0302_bayardetail_grid(); // get detail page object
			$GLOBALS["t0302_bayardetail_grid"]->ValidateGridForm();
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

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// Nomor
			$this->Nomor->SetDbValueDef($rsnew, $this->Nomor->CurrentValue, "", $this->Nomor->ReadOnly);

			// Tanggal
			$this->Tanggal->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->Tanggal->CurrentValue, 7), ew_CurrentDate(), $this->Tanggal->ReadOnly);

			// tahunajaran_id
			$this->tahunajaran_id->SetDbValueDef($rsnew, $this->tahunajaran_id->CurrentValue, 0, $this->tahunajaran_id->ReadOnly);

			// siswa_id
			$this->siswa_id->SetDbValueDef($rsnew, $this->siswa_id->CurrentValue, 0, $this->siswa_id->ReadOnly);

			// Total
			$this->Total->SetDbValueDef($rsnew, $this->Total->CurrentValue, 0, $this->Total->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("t0302_bayardetail", $DetailTblVar) && $GLOBALS["t0302_bayardetail"]->DetailEdit) {
						if (!isset($GLOBALS["t0302_bayardetail_grid"])) $GLOBALS["t0302_bayardetail_grid"] = new ct0302_bayardetail_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "t0302_bayardetail"); // Load user level of detail table
						$EditRow = $GLOBALS["t0302_bayardetail_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetUpDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("t0302_bayardetail", $DetailTblVar)) {
				if (!isset($GLOBALS["t0302_bayardetail_grid"]))
					$GLOBALS["t0302_bayardetail_grid"] = new ct0302_bayardetail_grid;
				if ($GLOBALS["t0302_bayardetail_grid"]->DetailEdit) {
					$GLOBALS["t0302_bayardetail_grid"]->CurrentMode = "edit";
					$GLOBALS["t0302_bayardetail_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["t0302_bayardetail_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["t0302_bayardetail_grid"]->setStartRecordNumber(1);
					$GLOBALS["t0302_bayardetail_grid"]->bayarmaster_id->FldIsDetailKey = TRUE;
					$GLOBALS["t0302_bayardetail_grid"]->bayarmaster_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["t0302_bayardetail_grid"]->bayarmaster_id->setSessionValue($GLOBALS["t0302_bayardetail_grid"]->bayarmaster_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("t0301_bayarmasterlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
		case "x_siswa_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `NIS` AS `DispFld`, `Nama` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `t0201_siswa`";
			$sWhereWrk = "{filter}";
			$this->siswa_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` = {filter_value}', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
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
		case "x_siswa_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `NIS` AS `DispFld`, `Nama` AS `Disp2Fld` FROM `t0201_siswa`";
			$sWhereWrk = "`NIS` LIKE '%{query_value}%' OR `Nama` LIKE '%{query_value}%' OR CONCAT(`NIS`,'" . ew_ValueSeparator(1, $this->siswa_id) . "',`Nama`) LIKE '{query_value}%'";
			$this->siswa_id->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->siswa_id, $sWhereWrk); // Call Lookup selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$sSqlWrk .= " LIMIT " . EW_AUTO_SUGGEST_MAX_ENTRIES;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($t0301_bayarmaster_edit)) $t0301_bayarmaster_edit = new ct0301_bayarmaster_edit();

// Page init
$t0301_bayarmaster_edit->Page_Init();

// Page main
$t0301_bayarmaster_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t0301_bayarmaster_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = ft0301_bayarmasteredit = new ew_Form("ft0301_bayarmasteredit", "edit");

// Validate form
ft0301_bayarmasteredit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_Nomor");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0301_bayarmaster->Nomor->FldCaption(), $t0301_bayarmaster->Nomor->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0301_bayarmaster->Tanggal->FldCaption(), $t0301_bayarmaster->Tanggal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Tanggal");
			if (elm && !ew_CheckEuroDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t0301_bayarmaster->Tanggal->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_tahunajaran_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0301_bayarmaster->tahunajaran_id->FldCaption(), $t0301_bayarmaster->tahunajaran_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0301_bayarmaster->siswa_id->FldCaption(), $t0301_bayarmaster->siswa_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Total");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0301_bayarmaster->Total->FldCaption(), $t0301_bayarmaster->Total->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Total");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t0301_bayarmaster->Total->FldErrMsg()) ?>");

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
ft0301_bayarmasteredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft0301_bayarmasteredit.ValidateRequired = true;
<?php } else { ?>
ft0301_bayarmasteredit.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft0301_bayarmasteredit.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TahunAjaran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0101_tahunajaran"};
ft0301_bayarmasteredit.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_NIS","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0201_siswa"};

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php if (!$t0301_bayarmaster_edit->IsModal) { ?>
<div class="ewToolbar">
<?php $Breadcrumb->Render(); ?>
<?php echo $Language->SelectionForm(); ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php $t0301_bayarmaster_edit->ShowPageHeader(); ?>
<?php
$t0301_bayarmaster_edit->ShowMessage();
?>
<form name="ft0301_bayarmasteredit" id="ft0301_bayarmasteredit" class="<?php echo $t0301_bayarmaster_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($t0301_bayarmaster_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $t0301_bayarmaster_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="t0301_bayarmaster">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<?php if ($t0301_bayarmaster_edit->IsModal) { ?>
<input type="hidden" name="modal" value="1">
<?php } ?>
<div>
<?php if ($t0301_bayarmaster->Nomor->Visible) { // Nomor ?>
	<div id="r_Nomor" class="form-group">
		<label id="elh_t0301_bayarmaster_Nomor" for="x_Nomor" class="col-sm-2 control-label ewLabel"><?php echo $t0301_bayarmaster->Nomor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0301_bayarmaster->Nomor->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_Nomor">
<input type="text" data-table="t0301_bayarmaster" data-field="x_Nomor" name="x_Nomor" id="x_Nomor" size="30" maxlength="25" placeholder="<?php echo ew_HtmlEncode($t0301_bayarmaster->Nomor->getPlaceHolder()) ?>" value="<?php echo $t0301_bayarmaster->Nomor->EditValue ?>"<?php echo $t0301_bayarmaster->Nomor->EditAttributes() ?>>
</span>
<?php echo $t0301_bayarmaster->Nomor->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t0301_bayarmaster->Tanggal->Visible) { // Tanggal ?>
	<div id="r_Tanggal" class="form-group">
		<label id="elh_t0301_bayarmaster_Tanggal" for="x_Tanggal" class="col-sm-2 control-label ewLabel"><?php echo $t0301_bayarmaster->Tanggal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0301_bayarmaster->Tanggal->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_Tanggal">
<input type="text" data-table="t0301_bayarmaster" data-field="x_Tanggal" data-format="7" name="x_Tanggal" id="x_Tanggal" size="10" placeholder="<?php echo ew_HtmlEncode($t0301_bayarmaster->Tanggal->getPlaceHolder()) ?>" value="<?php echo $t0301_bayarmaster->Tanggal->EditValue ?>"<?php echo $t0301_bayarmaster->Tanggal->EditAttributes() ?>>
<?php if (!$t0301_bayarmaster->Tanggal->ReadOnly && !$t0301_bayarmaster->Tanggal->Disabled && !isset($t0301_bayarmaster->Tanggal->EditAttrs["readonly"]) && !isset($t0301_bayarmaster->Tanggal->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateCalendar("ft0301_bayarmasteredit", "x_Tanggal", 7);
</script>
<?php } ?>
</span>
<?php echo $t0301_bayarmaster->Tanggal->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t0301_bayarmaster->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<div id="r_tahunajaran_id" class="form-group">
		<label id="elh_t0301_bayarmaster_tahunajaran_id" for="x_tahunajaran_id" class="col-sm-2 control-label ewLabel"><?php echo $t0301_bayarmaster->tahunajaran_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0301_bayarmaster->tahunajaran_id->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_tahunajaran_id">
<select data-table="t0301_bayarmaster" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t0301_bayarmaster->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x_tahunajaran_id" name="x_tahunajaran_id"<?php echo $t0301_bayarmaster->tahunajaran_id->EditAttributes() ?>>
<?php echo $t0301_bayarmaster->tahunajaran_id->SelectOptionListHtml("x_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x_tahunajaran_id" id="s_x_tahunajaran_id" value="<?php echo $t0301_bayarmaster->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php echo $t0301_bayarmaster->tahunajaran_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t0301_bayarmaster->siswa_id->Visible) { // siswa_id ?>
	<div id="r_siswa_id" class="form-group">
		<label id="elh_t0301_bayarmaster_siswa_id" class="col-sm-2 control-label ewLabel"><?php echo $t0301_bayarmaster->siswa_id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0301_bayarmaster->siswa_id->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_siswa_id">
<?php
$wrkonchange = trim(" " . @$t0301_bayarmaster->siswa_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t0301_bayarmaster->siswa_id->EditAttrs["onchange"] = "";
?>
<span id="as_x_siswa_id" style="white-space: nowrap; z-index: 8950">
	<input type="text" name="sv_x_siswa_id" id="sv_x_siswa_id" value="<?php echo $t0301_bayarmaster->siswa_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t0301_bayarmaster->siswa_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t0301_bayarmaster->siswa_id->getPlaceHolder()) ?>"<?php echo $t0301_bayarmaster->siswa_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t0301_bayarmaster" data-field="x_siswa_id" data-value-separator="<?php echo $t0301_bayarmaster->siswa_id->DisplayValueSeparatorAttribute() ?>" name="x_siswa_id" id="x_siswa_id" value="<?php echo ew_HtmlEncode($t0301_bayarmaster->siswa_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x_siswa_id" id="q_x_siswa_id" value="<?php echo $t0301_bayarmaster->siswa_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft0301_bayarmasteredit.CreateAutoSuggest({"id":"x_siswa_id","forceSelect":true});
</script>
</span>
<?php echo $t0301_bayarmaster->siswa_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($t0301_bayarmaster->Total->Visible) { // Total ?>
	<div id="r_Total" class="form-group">
		<label id="elh_t0301_bayarmaster_Total" for="x_Total" class="col-sm-2 control-label ewLabel"><?php echo $t0301_bayarmaster->Total->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="col-sm-10"><div<?php echo $t0301_bayarmaster->Total->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_Total">
<input type="text" data-table="t0301_bayarmaster" data-field="x_Total" name="x_Total" id="x_Total" size="10" placeholder="<?php echo ew_HtmlEncode($t0301_bayarmaster->Total->getPlaceHolder()) ?>" value="<?php echo $t0301_bayarmaster->Total->EditValue ?>"<?php echo $t0301_bayarmaster->Total->EditAttributes() ?>>
</span>
<?php echo $t0301_bayarmaster->Total->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div>
<input type="hidden" data-table="t0301_bayarmaster" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($t0301_bayarmaster->id->CurrentValue) ?>">
<?php
	if (in_array("t0302_bayardetail", explode(",", $t0301_bayarmaster->getCurrentDetailTable())) && $t0302_bayardetail->DetailEdit) {
?>
<?php if ($t0301_bayarmaster->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("t0302_bayardetail", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "t0302_bayardetailgrid.php" ?>
<?php } ?>
<?php if (!$t0301_bayarmaster_edit->IsModal) { ?>
<div class="form-group">
	<div class="col-sm-offset-2 col-sm-10">
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $t0301_bayarmaster_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div>
</div>
<?php } ?>
</form>
<script type="text/javascript">
ft0301_bayarmasteredit.Init();
</script>
<?php
$t0301_bayarmaster_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$t0301_bayarmaster_edit->Page_Terminate();
?>
