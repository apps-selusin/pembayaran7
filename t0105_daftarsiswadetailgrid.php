<?php include_once "t9996_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t0105_daftarsiswadetail_grid)) $t0105_daftarsiswadetail_grid = new ct0105_daftarsiswadetail_grid();

// Page init
$t0105_daftarsiswadetail_grid->Page_Init();

// Page main
$t0105_daftarsiswadetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t0105_daftarsiswadetail_grid->Page_Render();
?>
<?php if ($t0105_daftarsiswadetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft0105_daftarsiswadetailgrid = new ew_Form("ft0105_daftarsiswadetailgrid", "grid");
ft0105_daftarsiswadetailgrid.FormKeyCountName = '<?php echo $t0105_daftarsiswadetail_grid->FormKeyCountName ?>';

// Validate form
ft0105_daftarsiswadetailgrid.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_siswa_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0105_daftarsiswadetail->siswa_id->FldCaption(), $t0105_daftarsiswadetail->siswa_id->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft0105_daftarsiswadetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "siswa_id", false)) return false;
	return true;
}

// Form_CustomValidate event
ft0105_daftarsiswadetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft0105_daftarsiswadetailgrid.ValidateRequired = true;
<?php } else { ?>
ft0105_daftarsiswadetailgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft0105_daftarsiswadetailgrid.Lists["x_siswa_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_NIS","x_Nama","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0201_siswa"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t0105_daftarsiswadetail->CurrentAction == "gridadd") {
	if ($t0105_daftarsiswadetail->CurrentMode == "copy") {
		$bSelectLimit = $t0105_daftarsiswadetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t0105_daftarsiswadetail_grid->TotalRecs = $t0105_daftarsiswadetail->SelectRecordCount();
			$t0105_daftarsiswadetail_grid->Recordset = $t0105_daftarsiswadetail_grid->LoadRecordset($t0105_daftarsiswadetail_grid->StartRec-1, $t0105_daftarsiswadetail_grid->DisplayRecs);
		} else {
			if ($t0105_daftarsiswadetail_grid->Recordset = $t0105_daftarsiswadetail_grid->LoadRecordset())
				$t0105_daftarsiswadetail_grid->TotalRecs = $t0105_daftarsiswadetail_grid->Recordset->RecordCount();
		}
		$t0105_daftarsiswadetail_grid->StartRec = 1;
		$t0105_daftarsiswadetail_grid->DisplayRecs = $t0105_daftarsiswadetail_grid->TotalRecs;
	} else {
		$t0105_daftarsiswadetail->CurrentFilter = "0=1";
		$t0105_daftarsiswadetail_grid->StartRec = 1;
		$t0105_daftarsiswadetail_grid->DisplayRecs = $t0105_daftarsiswadetail->GridAddRowCount;
	}
	$t0105_daftarsiswadetail_grid->TotalRecs = $t0105_daftarsiswadetail_grid->DisplayRecs;
	$t0105_daftarsiswadetail_grid->StopRec = $t0105_daftarsiswadetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t0105_daftarsiswadetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t0105_daftarsiswadetail_grid->TotalRecs <= 0)
			$t0105_daftarsiswadetail_grid->TotalRecs = $t0105_daftarsiswadetail->SelectRecordCount();
	} else {
		if (!$t0105_daftarsiswadetail_grid->Recordset && ($t0105_daftarsiswadetail_grid->Recordset = $t0105_daftarsiswadetail_grid->LoadRecordset()))
			$t0105_daftarsiswadetail_grid->TotalRecs = $t0105_daftarsiswadetail_grid->Recordset->RecordCount();
	}
	$t0105_daftarsiswadetail_grid->StartRec = 1;
	$t0105_daftarsiswadetail_grid->DisplayRecs = $t0105_daftarsiswadetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t0105_daftarsiswadetail_grid->Recordset = $t0105_daftarsiswadetail_grid->LoadRecordset($t0105_daftarsiswadetail_grid->StartRec-1, $t0105_daftarsiswadetail_grid->DisplayRecs);

	// Set no record found message
	if ($t0105_daftarsiswadetail->CurrentAction == "" && $t0105_daftarsiswadetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t0105_daftarsiswadetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t0105_daftarsiswadetail_grid->SearchWhere == "0=101")
			$t0105_daftarsiswadetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t0105_daftarsiswadetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t0105_daftarsiswadetail_grid->RenderOtherOptions();
?>
<?php $t0105_daftarsiswadetail_grid->ShowPageHeader(); ?>
<?php
$t0105_daftarsiswadetail_grid->ShowMessage();
?>
<?php if ($t0105_daftarsiswadetail_grid->TotalRecs > 0 || $t0105_daftarsiswadetail->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t0105_daftarsiswadetail">
<div id="ft0105_daftarsiswadetailgrid" class="ewForm form-inline">
<div id="gmp_t0105_daftarsiswadetail" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t0105_daftarsiswadetailgrid" class="table ewTable">
<?php echo $t0105_daftarsiswadetail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t0105_daftarsiswadetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t0105_daftarsiswadetail_grid->RenderListOptions();

// Render list options (header, left)
$t0105_daftarsiswadetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t0105_daftarsiswadetail->siswa_id->Visible) { // siswa_id ?>
	<?php if ($t0105_daftarsiswadetail->SortUrl($t0105_daftarsiswadetail->siswa_id) == "") { ?>
		<th data-name="siswa_id"><div id="elh_t0105_daftarsiswadetail_siswa_id" class="t0105_daftarsiswadetail_siswa_id"><div class="ewTableHeaderCaption"><?php echo $t0105_daftarsiswadetail->siswa_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="siswa_id"><div><div id="elh_t0105_daftarsiswadetail_siswa_id" class="t0105_daftarsiswadetail_siswa_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0105_daftarsiswadetail->siswa_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0105_daftarsiswadetail->siswa_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0105_daftarsiswadetail->siswa_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t0105_daftarsiswadetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t0105_daftarsiswadetail_grid->StartRec = 1;
$t0105_daftarsiswadetail_grid->StopRec = $t0105_daftarsiswadetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t0105_daftarsiswadetail_grid->FormKeyCountName) && ($t0105_daftarsiswadetail->CurrentAction == "gridadd" || $t0105_daftarsiswadetail->CurrentAction == "gridedit" || $t0105_daftarsiswadetail->CurrentAction == "F")) {
		$t0105_daftarsiswadetail_grid->KeyCount = $objForm->GetValue($t0105_daftarsiswadetail_grid->FormKeyCountName);
		$t0105_daftarsiswadetail_grid->StopRec = $t0105_daftarsiswadetail_grid->StartRec + $t0105_daftarsiswadetail_grid->KeyCount - 1;
	}
}
$t0105_daftarsiswadetail_grid->RecCnt = $t0105_daftarsiswadetail_grid->StartRec - 1;
if ($t0105_daftarsiswadetail_grid->Recordset && !$t0105_daftarsiswadetail_grid->Recordset->EOF) {
	$t0105_daftarsiswadetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t0105_daftarsiswadetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t0105_daftarsiswadetail_grid->StartRec > 1)
		$t0105_daftarsiswadetail_grid->Recordset->Move($t0105_daftarsiswadetail_grid->StartRec - 1);
} elseif (!$t0105_daftarsiswadetail->AllowAddDeleteRow && $t0105_daftarsiswadetail_grid->StopRec == 0) {
	$t0105_daftarsiswadetail_grid->StopRec = $t0105_daftarsiswadetail->GridAddRowCount;
}

// Initialize aggregate
$t0105_daftarsiswadetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t0105_daftarsiswadetail->ResetAttrs();
$t0105_daftarsiswadetail_grid->RenderRow();
if ($t0105_daftarsiswadetail->CurrentAction == "gridadd")
	$t0105_daftarsiswadetail_grid->RowIndex = 0;
if ($t0105_daftarsiswadetail->CurrentAction == "gridedit")
	$t0105_daftarsiswadetail_grid->RowIndex = 0;
while ($t0105_daftarsiswadetail_grid->RecCnt < $t0105_daftarsiswadetail_grid->StopRec) {
	$t0105_daftarsiswadetail_grid->RecCnt++;
	if (intval($t0105_daftarsiswadetail_grid->RecCnt) >= intval($t0105_daftarsiswadetail_grid->StartRec)) {
		$t0105_daftarsiswadetail_grid->RowCnt++;
		if ($t0105_daftarsiswadetail->CurrentAction == "gridadd" || $t0105_daftarsiswadetail->CurrentAction == "gridedit" || $t0105_daftarsiswadetail->CurrentAction == "F") {
			$t0105_daftarsiswadetail_grid->RowIndex++;
			$objForm->Index = $t0105_daftarsiswadetail_grid->RowIndex;
			if ($objForm->HasValue($t0105_daftarsiswadetail_grid->FormActionName))
				$t0105_daftarsiswadetail_grid->RowAction = strval($objForm->GetValue($t0105_daftarsiswadetail_grid->FormActionName));
			elseif ($t0105_daftarsiswadetail->CurrentAction == "gridadd")
				$t0105_daftarsiswadetail_grid->RowAction = "insert";
			else
				$t0105_daftarsiswadetail_grid->RowAction = "";
		}

		// Set up key count
		$t0105_daftarsiswadetail_grid->KeyCount = $t0105_daftarsiswadetail_grid->RowIndex;

		// Init row class and style
		$t0105_daftarsiswadetail->ResetAttrs();
		$t0105_daftarsiswadetail->CssClass = "";
		if ($t0105_daftarsiswadetail->CurrentAction == "gridadd") {
			if ($t0105_daftarsiswadetail->CurrentMode == "copy") {
				$t0105_daftarsiswadetail_grid->LoadRowValues($t0105_daftarsiswadetail_grid->Recordset); // Load row values
				$t0105_daftarsiswadetail_grid->SetRecordKey($t0105_daftarsiswadetail_grid->RowOldKey, $t0105_daftarsiswadetail_grid->Recordset); // Set old record key
			} else {
				$t0105_daftarsiswadetail_grid->LoadDefaultValues(); // Load default values
				$t0105_daftarsiswadetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t0105_daftarsiswadetail_grid->LoadRowValues($t0105_daftarsiswadetail_grid->Recordset); // Load row values
		}
		$t0105_daftarsiswadetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t0105_daftarsiswadetail->CurrentAction == "gridadd") // Grid add
			$t0105_daftarsiswadetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t0105_daftarsiswadetail->CurrentAction == "gridadd" && $t0105_daftarsiswadetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t0105_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t0105_daftarsiswadetail_grid->RowIndex); // Restore form values
		if ($t0105_daftarsiswadetail->CurrentAction == "gridedit") { // Grid edit
			if ($t0105_daftarsiswadetail->EventCancelled) {
				$t0105_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t0105_daftarsiswadetail_grid->RowIndex); // Restore form values
			}
			if ($t0105_daftarsiswadetail_grid->RowAction == "insert")
				$t0105_daftarsiswadetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t0105_daftarsiswadetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t0105_daftarsiswadetail->CurrentAction == "gridedit" && ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT || $t0105_daftarsiswadetail->RowType == EW_ROWTYPE_ADD) && $t0105_daftarsiswadetail->EventCancelled) // Update failed
			$t0105_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t0105_daftarsiswadetail_grid->RowIndex); // Restore form values
		if ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t0105_daftarsiswadetail_grid->EditRowCnt++;
		if ($t0105_daftarsiswadetail->CurrentAction == "F") // Confirm row
			$t0105_daftarsiswadetail_grid->RestoreCurrentRowFormValues($t0105_daftarsiswadetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t0105_daftarsiswadetail->RowAttrs = array_merge($t0105_daftarsiswadetail->RowAttrs, array('data-rowindex'=>$t0105_daftarsiswadetail_grid->RowCnt, 'id'=>'r' . $t0105_daftarsiswadetail_grid->RowCnt . '_t0105_daftarsiswadetail', 'data-rowtype'=>$t0105_daftarsiswadetail->RowType));

		// Render row
		$t0105_daftarsiswadetail_grid->RenderRow();

		// Render list options
		$t0105_daftarsiswadetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t0105_daftarsiswadetail_grid->RowAction <> "delete" && $t0105_daftarsiswadetail_grid->RowAction <> "insertdelete" && !($t0105_daftarsiswadetail_grid->RowAction == "insert" && $t0105_daftarsiswadetail->CurrentAction == "F" && $t0105_daftarsiswadetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t0105_daftarsiswadetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t0105_daftarsiswadetail_grid->ListOptions->Render("body", "left", $t0105_daftarsiswadetail_grid->RowCnt);
?>
	<?php if ($t0105_daftarsiswadetail->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id"<?php echo $t0105_daftarsiswadetail->siswa_id->CellAttributes() ?>>
<?php if ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0105_daftarsiswadetail_grid->RowCnt ?>_t0105_daftarsiswadetail_siswa_id" class="form-group t0105_daftarsiswadetail_siswa_id">
<select data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" data-value-separator="<?php echo $t0105_daftarsiswadetail->siswa_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" name="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id"<?php echo $t0105_daftarsiswadetail->siswa_id->EditAttributes() ?>>
<?php echo $t0105_daftarsiswadetail->siswa_id->SelectOptionListHtml("x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t0105_daftarsiswadetail->siswa_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" name="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->siswa_id->OldValue) ?>">
<?php } ?>
<?php if ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0105_daftarsiswadetail_grid->RowCnt ?>_t0105_daftarsiswadetail_siswa_id" class="form-group t0105_daftarsiswadetail_siswa_id">
<select data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" data-value-separator="<?php echo $t0105_daftarsiswadetail->siswa_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" name="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id"<?php echo $t0105_daftarsiswadetail->siswa_id->EditAttributes() ?>>
<?php echo $t0105_daftarsiswadetail->siswa_id->SelectOptionListHtml("x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t0105_daftarsiswadetail->siswa_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0105_daftarsiswadetail_grid->RowCnt ?>_t0105_daftarsiswadetail_siswa_id" class="t0105_daftarsiswadetail_siswa_id">
<span<?php echo $t0105_daftarsiswadetail->siswa_id->ViewAttributes() ?>>
<?php echo $t0105_daftarsiswadetail->siswa_id->ListViewValue() ?></span>
</span>
<?php if ($t0105_daftarsiswadetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" name="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" name="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->siswa_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" name="ft0105_daftarsiswadetailgrid$x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="ft0105_daftarsiswadetailgrid$x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->siswa_id->FormValue) ?>">
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" name="ft0105_daftarsiswadetailgrid$o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="ft0105_daftarsiswadetailgrid$o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->siswa_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t0105_daftarsiswadetail_grid->PageObjName . "_row_" . $t0105_daftarsiswadetail_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_id" name="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_id" id="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->id->CurrentValue) ?>">
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_id" name="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_id" id="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT || $t0105_daftarsiswadetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_id" name="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_id" id="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->id->CurrentValue) ?>">
<?php } ?>
<?php

// Render list options (body, right)
$t0105_daftarsiswadetail_grid->ListOptions->Render("body", "right", $t0105_daftarsiswadetail_grid->RowCnt);
?>
	</tr>
<?php if ($t0105_daftarsiswadetail->RowType == EW_ROWTYPE_ADD || $t0105_daftarsiswadetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft0105_daftarsiswadetailgrid.UpdateOpts(<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t0105_daftarsiswadetail->CurrentAction <> "gridadd" || $t0105_daftarsiswadetail->CurrentMode == "copy")
		if (!$t0105_daftarsiswadetail_grid->Recordset->EOF) $t0105_daftarsiswadetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t0105_daftarsiswadetail->CurrentMode == "add" || $t0105_daftarsiswadetail->CurrentMode == "copy" || $t0105_daftarsiswadetail->CurrentMode == "edit") {
		$t0105_daftarsiswadetail_grid->RowIndex = '$rowindex$';
		$t0105_daftarsiswadetail_grid->LoadDefaultValues();

		// Set row properties
		$t0105_daftarsiswadetail->ResetAttrs();
		$t0105_daftarsiswadetail->RowAttrs = array_merge($t0105_daftarsiswadetail->RowAttrs, array('data-rowindex'=>$t0105_daftarsiswadetail_grid->RowIndex, 'id'=>'r0_t0105_daftarsiswadetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t0105_daftarsiswadetail->RowAttrs["class"], "ewTemplate");
		$t0105_daftarsiswadetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t0105_daftarsiswadetail_grid->RenderRow();

		// Render list options
		$t0105_daftarsiswadetail_grid->RenderListOptions();
		$t0105_daftarsiswadetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t0105_daftarsiswadetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t0105_daftarsiswadetail_grid->ListOptions->Render("body", "left", $t0105_daftarsiswadetail_grid->RowIndex);
?>
	<?php if ($t0105_daftarsiswadetail->siswa_id->Visible) { // siswa_id ?>
		<td data-name="siswa_id">
<?php if ($t0105_daftarsiswadetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0105_daftarsiswadetail_siswa_id" class="form-group t0105_daftarsiswadetail_siswa_id">
<select data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" data-value-separator="<?php echo $t0105_daftarsiswadetail->siswa_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" name="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id"<?php echo $t0105_daftarsiswadetail->siswa_id->EditAttributes() ?>>
<?php echo $t0105_daftarsiswadetail->siswa_id->SelectOptionListHtml("x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="s_x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo $t0105_daftarsiswadetail->siswa_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t0105_daftarsiswadetail_siswa_id" class="form-group t0105_daftarsiswadetail_siswa_id">
<span<?php echo $t0105_daftarsiswadetail->siswa_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0105_daftarsiswadetail->siswa_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" name="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="x<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->siswa_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0105_daftarsiswadetail" data-field="x_siswa_id" name="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" id="o<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>_siswa_id" value="<?php echo ew_HtmlEncode($t0105_daftarsiswadetail->siswa_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t0105_daftarsiswadetail_grid->ListOptions->Render("body", "right", $t0105_daftarsiswadetail_grid->RowCnt);
?>
<script type="text/javascript">
ft0105_daftarsiswadetailgrid.UpdateOpts(<?php echo $t0105_daftarsiswadetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t0105_daftarsiswadetail->CurrentMode == "add" || $t0105_daftarsiswadetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t0105_daftarsiswadetail_grid->FormKeyCountName ?>" id="<?php echo $t0105_daftarsiswadetail_grid->FormKeyCountName ?>" value="<?php echo $t0105_daftarsiswadetail_grid->KeyCount ?>">
<?php echo $t0105_daftarsiswadetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t0105_daftarsiswadetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t0105_daftarsiswadetail_grid->FormKeyCountName ?>" id="<?php echo $t0105_daftarsiswadetail_grid->FormKeyCountName ?>" value="<?php echo $t0105_daftarsiswadetail_grid->KeyCount ?>">
<?php echo $t0105_daftarsiswadetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t0105_daftarsiswadetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft0105_daftarsiswadetailgrid">
</div>
<?php

// Close recordset
if ($t0105_daftarsiswadetail_grid->Recordset)
	$t0105_daftarsiswadetail_grid->Recordset->Close();
?>
<?php if ($t0105_daftarsiswadetail_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t0105_daftarsiswadetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t0105_daftarsiswadetail_grid->TotalRecs == 0 && $t0105_daftarsiswadetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t0105_daftarsiswadetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t0105_daftarsiswadetail->Export == "") { ?>
<script type="text/javascript">
ft0105_daftarsiswadetailgrid.Init();
</script>
<?php } ?>
<?php
$t0105_daftarsiswadetail_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t0105_daftarsiswadetail_grid->Page_Terminate();
?>
