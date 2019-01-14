<?php include_once "t9996_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t0202_siswaiuran_grid)) $t0202_siswaiuran_grid = new ct0202_siswaiuran_grid();

// Page init
$t0202_siswaiuran_grid->Page_Init();

// Page main
$t0202_siswaiuran_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t0202_siswaiuran_grid->Page_Render();
?>
<?php if ($t0202_siswaiuran->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft0202_siswaiurangrid = new ew_Form("ft0202_siswaiurangrid", "grid");
ft0202_siswaiurangrid.FormKeyCountName = '<?php echo $t0202_siswaiuran_grid->FormKeyCountName ?>';

// Validate form
ft0202_siswaiurangrid.Validate = function() {
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
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft0202_siswaiurangrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "tahunajaran_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "iuran_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Nilai", false)) return false;
	return true;
}

// Form_CustomValidate event
ft0202_siswaiurangrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft0202_siswaiurangrid.ValidateRequired = true;
<?php } else { ?>
ft0202_siswaiurangrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft0202_siswaiurangrid.Lists["x_tahunajaran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_TahunAjaran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0101_tahunajaran"};
ft0202_siswaiurangrid.Lists["x_iuran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Iuran","x_Jenis","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0106_iuran"};

// Form object for search
</script>
<?php } ?>
<?php
if ($t0202_siswaiuran->CurrentAction == "gridadd") {
	if ($t0202_siswaiuran->CurrentMode == "copy") {
		$bSelectLimit = $t0202_siswaiuran_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t0202_siswaiuran_grid->TotalRecs = $t0202_siswaiuran->SelectRecordCount();
			$t0202_siswaiuran_grid->Recordset = $t0202_siswaiuran_grid->LoadRecordset($t0202_siswaiuran_grid->StartRec-1, $t0202_siswaiuran_grid->DisplayRecs);
		} else {
			if ($t0202_siswaiuran_grid->Recordset = $t0202_siswaiuran_grid->LoadRecordset())
				$t0202_siswaiuran_grid->TotalRecs = $t0202_siswaiuran_grid->Recordset->RecordCount();
		}
		$t0202_siswaiuran_grid->StartRec = 1;
		$t0202_siswaiuran_grid->DisplayRecs = $t0202_siswaiuran_grid->TotalRecs;
	} else {
		$t0202_siswaiuran->CurrentFilter = "0=1";
		$t0202_siswaiuran_grid->StartRec = 1;
		$t0202_siswaiuran_grid->DisplayRecs = $t0202_siswaiuran->GridAddRowCount;
	}
	$t0202_siswaiuran_grid->TotalRecs = $t0202_siswaiuran_grid->DisplayRecs;
	$t0202_siswaiuran_grid->StopRec = $t0202_siswaiuran_grid->DisplayRecs;
} else {
	$bSelectLimit = $t0202_siswaiuran_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t0202_siswaiuran_grid->TotalRecs <= 0)
			$t0202_siswaiuran_grid->TotalRecs = $t0202_siswaiuran->SelectRecordCount();
	} else {
		if (!$t0202_siswaiuran_grid->Recordset && ($t0202_siswaiuran_grid->Recordset = $t0202_siswaiuran_grid->LoadRecordset()))
			$t0202_siswaiuran_grid->TotalRecs = $t0202_siswaiuran_grid->Recordset->RecordCount();
	}
	$t0202_siswaiuran_grid->StartRec = 1;
	$t0202_siswaiuran_grid->DisplayRecs = $t0202_siswaiuran_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t0202_siswaiuran_grid->Recordset = $t0202_siswaiuran_grid->LoadRecordset($t0202_siswaiuran_grid->StartRec-1, $t0202_siswaiuran_grid->DisplayRecs);

	// Set no record found message
	if ($t0202_siswaiuran->CurrentAction == "" && $t0202_siswaiuran_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t0202_siswaiuran_grid->setWarningMessage(ew_DeniedMsg());
		if ($t0202_siswaiuran_grid->SearchWhere == "0=101")
			$t0202_siswaiuran_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t0202_siswaiuran_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t0202_siswaiuran_grid->RenderOtherOptions();
?>
<?php $t0202_siswaiuran_grid->ShowPageHeader(); ?>
<?php
$t0202_siswaiuran_grid->ShowMessage();
?>
<?php if ($t0202_siswaiuran_grid->TotalRecs > 0 || $t0202_siswaiuran->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t0202_siswaiuran">
<div id="ft0202_siswaiurangrid" class="ewForm form-inline">
<div id="gmp_t0202_siswaiuran" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t0202_siswaiurangrid" class="table ewTable">
<?php echo $t0202_siswaiuran->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t0202_siswaiuran_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t0202_siswaiuran_grid->RenderListOptions();

// Render list options (header, left)
$t0202_siswaiuran_grid->ListOptions->Render("header", "left");
?>
<?php if ($t0202_siswaiuran->tahunajaran_id->Visible) { // tahunajaran_id ?>
	<?php if ($t0202_siswaiuran->SortUrl($t0202_siswaiuran->tahunajaran_id) == "") { ?>
		<th data-name="tahunajaran_id"><div id="elh_t0202_siswaiuran_tahunajaran_id" class="t0202_siswaiuran_tahunajaran_id"><div class="ewTableHeaderCaption"><?php echo $t0202_siswaiuran->tahunajaran_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tahunajaran_id"><div><div id="elh_t0202_siswaiuran_tahunajaran_id" class="t0202_siswaiuran_tahunajaran_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0202_siswaiuran->tahunajaran_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0202_siswaiuran->tahunajaran_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0202_siswaiuran->tahunajaran_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t0202_siswaiuran->iuran_id->Visible) { // iuran_id ?>
	<?php if ($t0202_siswaiuran->SortUrl($t0202_siswaiuran->iuran_id) == "") { ?>
		<th data-name="iuran_id"><div id="elh_t0202_siswaiuran_iuran_id" class="t0202_siswaiuran_iuran_id"><div class="ewTableHeaderCaption"><?php echo $t0202_siswaiuran->iuran_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="iuran_id"><div><div id="elh_t0202_siswaiuran_iuran_id" class="t0202_siswaiuran_iuran_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0202_siswaiuran->iuran_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0202_siswaiuran->iuran_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0202_siswaiuran->iuran_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t0202_siswaiuran->Nilai->Visible) { // Nilai ?>
	<?php if ($t0202_siswaiuran->SortUrl($t0202_siswaiuran->Nilai) == "") { ?>
		<th data-name="Nilai"><div id="elh_t0202_siswaiuran_Nilai" class="t0202_siswaiuran_Nilai"><div class="ewTableHeaderCaption"><?php echo $t0202_siswaiuran->Nilai->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Nilai"><div><div id="elh_t0202_siswaiuran_Nilai" class="t0202_siswaiuran_Nilai">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0202_siswaiuran->Nilai->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0202_siswaiuran->Nilai->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0202_siswaiuran->Nilai->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t0202_siswaiuran_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t0202_siswaiuran_grid->StartRec = 1;
$t0202_siswaiuran_grid->StopRec = $t0202_siswaiuran_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t0202_siswaiuran_grid->FormKeyCountName) && ($t0202_siswaiuran->CurrentAction == "gridadd" || $t0202_siswaiuran->CurrentAction == "gridedit" || $t0202_siswaiuran->CurrentAction == "F")) {
		$t0202_siswaiuran_grid->KeyCount = $objForm->GetValue($t0202_siswaiuran_grid->FormKeyCountName);
		$t0202_siswaiuran_grid->StopRec = $t0202_siswaiuran_grid->StartRec + $t0202_siswaiuran_grid->KeyCount - 1;
	}
}
$t0202_siswaiuran_grid->RecCnt = $t0202_siswaiuran_grid->StartRec - 1;
if ($t0202_siswaiuran_grid->Recordset && !$t0202_siswaiuran_grid->Recordset->EOF) {
	$t0202_siswaiuran_grid->Recordset->MoveFirst();
	$bSelectLimit = $t0202_siswaiuran_grid->UseSelectLimit;
	if (!$bSelectLimit && $t0202_siswaiuran_grid->StartRec > 1)
		$t0202_siswaiuran_grid->Recordset->Move($t0202_siswaiuran_grid->StartRec - 1);
} elseif (!$t0202_siswaiuran->AllowAddDeleteRow && $t0202_siswaiuran_grid->StopRec == 0) {
	$t0202_siswaiuran_grid->StopRec = $t0202_siswaiuran->GridAddRowCount;
}

// Initialize aggregate
$t0202_siswaiuran->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t0202_siswaiuran->ResetAttrs();
$t0202_siswaiuran_grid->RenderRow();
if ($t0202_siswaiuran->CurrentAction == "gridadd")
	$t0202_siswaiuran_grid->RowIndex = 0;
if ($t0202_siswaiuran->CurrentAction == "gridedit")
	$t0202_siswaiuran_grid->RowIndex = 0;
while ($t0202_siswaiuran_grid->RecCnt < $t0202_siswaiuran_grid->StopRec) {
	$t0202_siswaiuran_grid->RecCnt++;
	if (intval($t0202_siswaiuran_grid->RecCnt) >= intval($t0202_siswaiuran_grid->StartRec)) {
		$t0202_siswaiuran_grid->RowCnt++;
		if ($t0202_siswaiuran->CurrentAction == "gridadd" || $t0202_siswaiuran->CurrentAction == "gridedit" || $t0202_siswaiuran->CurrentAction == "F") {
			$t0202_siswaiuran_grid->RowIndex++;
			$objForm->Index = $t0202_siswaiuran_grid->RowIndex;
			if ($objForm->HasValue($t0202_siswaiuran_grid->FormActionName))
				$t0202_siswaiuran_grid->RowAction = strval($objForm->GetValue($t0202_siswaiuran_grid->FormActionName));
			elseif ($t0202_siswaiuran->CurrentAction == "gridadd")
				$t0202_siswaiuran_grid->RowAction = "insert";
			else
				$t0202_siswaiuran_grid->RowAction = "";
		}

		// Set up key count
		$t0202_siswaiuran_grid->KeyCount = $t0202_siswaiuran_grid->RowIndex;

		// Init row class and style
		$t0202_siswaiuran->ResetAttrs();
		$t0202_siswaiuran->CssClass = "";
		if ($t0202_siswaiuran->CurrentAction == "gridadd") {
			if ($t0202_siswaiuran->CurrentMode == "copy") {
				$t0202_siswaiuran_grid->LoadRowValues($t0202_siswaiuran_grid->Recordset); // Load row values
				$t0202_siswaiuran_grid->SetRecordKey($t0202_siswaiuran_grid->RowOldKey, $t0202_siswaiuran_grid->Recordset); // Set old record key
			} else {
				$t0202_siswaiuran_grid->LoadDefaultValues(); // Load default values
				$t0202_siswaiuran_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t0202_siswaiuran_grid->LoadRowValues($t0202_siswaiuran_grid->Recordset); // Load row values
		}
		$t0202_siswaiuran->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t0202_siswaiuran->CurrentAction == "gridadd") // Grid add
			$t0202_siswaiuran->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t0202_siswaiuran->CurrentAction == "gridadd" && $t0202_siswaiuran->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t0202_siswaiuran_grid->RestoreCurrentRowFormValues($t0202_siswaiuran_grid->RowIndex); // Restore form values
		if ($t0202_siswaiuran->CurrentAction == "gridedit") { // Grid edit
			if ($t0202_siswaiuran->EventCancelled) {
				$t0202_siswaiuran_grid->RestoreCurrentRowFormValues($t0202_siswaiuran_grid->RowIndex); // Restore form values
			}
			if ($t0202_siswaiuran_grid->RowAction == "insert")
				$t0202_siswaiuran->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t0202_siswaiuran->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t0202_siswaiuran->CurrentAction == "gridedit" && ($t0202_siswaiuran->RowType == EW_ROWTYPE_EDIT || $t0202_siswaiuran->RowType == EW_ROWTYPE_ADD) && $t0202_siswaiuran->EventCancelled) // Update failed
			$t0202_siswaiuran_grid->RestoreCurrentRowFormValues($t0202_siswaiuran_grid->RowIndex); // Restore form values
		if ($t0202_siswaiuran->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t0202_siswaiuran_grid->EditRowCnt++;
		if ($t0202_siswaiuran->CurrentAction == "F") // Confirm row
			$t0202_siswaiuran_grid->RestoreCurrentRowFormValues($t0202_siswaiuran_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t0202_siswaiuran->RowAttrs = array_merge($t0202_siswaiuran->RowAttrs, array('data-rowindex'=>$t0202_siswaiuran_grid->RowCnt, 'id'=>'r' . $t0202_siswaiuran_grid->RowCnt . '_t0202_siswaiuran', 'data-rowtype'=>$t0202_siswaiuran->RowType));

		// Render row
		$t0202_siswaiuran_grid->RenderRow();

		// Render list options
		$t0202_siswaiuran_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t0202_siswaiuran_grid->RowAction <> "delete" && $t0202_siswaiuran_grid->RowAction <> "insertdelete" && !($t0202_siswaiuran_grid->RowAction == "insert" && $t0202_siswaiuran->CurrentAction == "F" && $t0202_siswaiuran_grid->EmptyRow())) {
?>
	<tr<?php echo $t0202_siswaiuran->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t0202_siswaiuran_grid->ListOptions->Render("body", "left", $t0202_siswaiuran_grid->RowCnt);
?>
	<?php if ($t0202_siswaiuran->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td data-name="tahunajaran_id"<?php echo $t0202_siswaiuran->tahunajaran_id->CellAttributes() ?>>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_tahunajaran_id" class="form-group t0202_siswaiuran_tahunajaran_id">
<select data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t0202_siswaiuran->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id"<?php echo $t0202_siswaiuran->tahunajaran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->tahunajaran_id->SelectOptionListHtml("x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t0202_siswaiuran->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->tahunajaran_id->OldValue) ?>">
<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_tahunajaran_id" class="form-group t0202_siswaiuran_tahunajaran_id">
<select data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t0202_siswaiuran->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id"<?php echo $t0202_siswaiuran->tahunajaran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->tahunajaran_id->SelectOptionListHtml("x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t0202_siswaiuran->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_tahunajaran_id" class="t0202_siswaiuran_tahunajaran_id">
<span<?php echo $t0202_siswaiuran->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t0202_siswaiuran->tahunajaran_id->ListViewValue() ?></span>
</span>
<?php if ($t0202_siswaiuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->tahunajaran_id->FormValue) ?>">
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->tahunajaran_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" name="ft0202_siswaiurangrid$x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="ft0202_siswaiurangrid$x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->tahunajaran_id->FormValue) ?>">
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" name="ft0202_siswaiurangrid$o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="ft0202_siswaiurangrid$o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->tahunajaran_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t0202_siswaiuran_grid->PageObjName . "_row_" . $t0202_siswaiuran_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_id" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->id->CurrentValue) ?>">
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_id" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_id" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->id->OldValue) ?>">
<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_EDIT || $t0202_siswaiuran->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_id" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t0202_siswaiuran->iuran_id->Visible) { // iuran_id ?>
		<td data-name="iuran_id"<?php echo $t0202_siswaiuran->iuran_id->CellAttributes() ?>>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_iuran_id" class="form-group t0202_siswaiuran_iuran_id">
<select data-table="t0202_siswaiuran" data-field="x_iuran_id" data-value-separator="<?php echo $t0202_siswaiuran->iuran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id"<?php echo $t0202_siswaiuran->iuran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->iuran_id->SelectOptionListHtml("x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo $t0202_siswaiuran->iuran_id->LookupFilterQuery() ?>">
</span>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_iuran_id" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->iuran_id->OldValue) ?>">
<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_iuran_id" class="form-group t0202_siswaiuran_iuran_id">
<select data-table="t0202_siswaiuran" data-field="x_iuran_id" data-value-separator="<?php echo $t0202_siswaiuran->iuran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id"<?php echo $t0202_siswaiuran->iuran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->iuran_id->SelectOptionListHtml("x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo $t0202_siswaiuran->iuran_id->LookupFilterQuery() ?>">
</span>
<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_iuran_id" class="t0202_siswaiuran_iuran_id">
<span<?php echo $t0202_siswaiuran->iuran_id->ViewAttributes() ?>>
<?php echo $t0202_siswaiuran->iuran_id->ListViewValue() ?></span>
</span>
<?php if ($t0202_siswaiuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_iuran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->iuran_id->FormValue) ?>">
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_iuran_id" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->iuran_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_iuran_id" name="ft0202_siswaiurangrid$x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="ft0202_siswaiurangrid$x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->iuran_id->FormValue) ?>">
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_iuran_id" name="ft0202_siswaiurangrid$o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="ft0202_siswaiurangrid$o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->iuran_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t0202_siswaiuran->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai"<?php echo $t0202_siswaiuran->Nilai->CellAttributes() ?>>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_Nilai" class="form-group t0202_siswaiuran_Nilai">
<input type="text" data-table="t0202_siswaiuran" data-field="x_Nilai" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->getPlaceHolder()) ?>" value="<?php echo $t0202_siswaiuran->Nilai->EditValue ?>"<?php echo $t0202_siswaiuran->Nilai->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_Nilai" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->OldValue) ?>">
<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_Nilai" class="form-group t0202_siswaiuran_Nilai">
<input type="text" data-table="t0202_siswaiuran" data-field="x_Nilai" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->getPlaceHolder()) ?>" value="<?php echo $t0202_siswaiuran->Nilai->EditValue ?>"<?php echo $t0202_siswaiuran->Nilai->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0202_siswaiuran_grid->RowCnt ?>_t0202_siswaiuran_Nilai" class="t0202_siswaiuran_Nilai">
<span<?php echo $t0202_siswaiuran->Nilai->ViewAttributes() ?>>
<?php echo $t0202_siswaiuran->Nilai->ListViewValue() ?></span>
</span>
<?php if ($t0202_siswaiuran->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_Nilai" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->FormValue) ?>">
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_Nilai" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_Nilai" name="ft0202_siswaiurangrid$x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="ft0202_siswaiurangrid$x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->FormValue) ?>">
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_Nilai" name="ft0202_siswaiurangrid$o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="ft0202_siswaiurangrid$o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t0202_siswaiuran_grid->ListOptions->Render("body", "right", $t0202_siswaiuran_grid->RowCnt);
?>
	</tr>
<?php if ($t0202_siswaiuran->RowType == EW_ROWTYPE_ADD || $t0202_siswaiuran->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft0202_siswaiurangrid.UpdateOpts(<?php echo $t0202_siswaiuran_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t0202_siswaiuran->CurrentAction <> "gridadd" || $t0202_siswaiuran->CurrentMode == "copy")
		if (!$t0202_siswaiuran_grid->Recordset->EOF) $t0202_siswaiuran_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t0202_siswaiuran->CurrentMode == "add" || $t0202_siswaiuran->CurrentMode == "copy" || $t0202_siswaiuran->CurrentMode == "edit") {
		$t0202_siswaiuran_grid->RowIndex = '$rowindex$';
		$t0202_siswaiuran_grid->LoadDefaultValues();

		// Set row properties
		$t0202_siswaiuran->ResetAttrs();
		$t0202_siswaiuran->RowAttrs = array_merge($t0202_siswaiuran->RowAttrs, array('data-rowindex'=>$t0202_siswaiuran_grid->RowIndex, 'id'=>'r0_t0202_siswaiuran', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t0202_siswaiuran->RowAttrs["class"], "ewTemplate");
		$t0202_siswaiuran->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t0202_siswaiuran_grid->RenderRow();

		// Render list options
		$t0202_siswaiuran_grid->RenderListOptions();
		$t0202_siswaiuran_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t0202_siswaiuran->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t0202_siswaiuran_grid->ListOptions->Render("body", "left", $t0202_siswaiuran_grid->RowIndex);
?>
	<?php if ($t0202_siswaiuran->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<td data-name="tahunajaran_id">
<?php if ($t0202_siswaiuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0202_siswaiuran_tahunajaran_id" class="form-group t0202_siswaiuran_tahunajaran_id">
<select data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" data-value-separator="<?php echo $t0202_siswaiuran->tahunajaran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id"<?php echo $t0202_siswaiuran->tahunajaran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->tahunajaran_id->SelectOptionListHtml("x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo $t0202_siswaiuran->tahunajaran_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t0202_siswaiuran_tahunajaran_id" class="form-group t0202_siswaiuran_tahunajaran_id">
<span<?php echo $t0202_siswaiuran->tahunajaran_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0202_siswaiuran->tahunajaran_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->tahunajaran_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_tahunajaran_id" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_tahunajaran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->tahunajaran_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t0202_siswaiuran->iuran_id->Visible) { // iuran_id ?>
		<td data-name="iuran_id">
<?php if ($t0202_siswaiuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0202_siswaiuran_iuran_id" class="form-group t0202_siswaiuran_iuran_id">
<select data-table="t0202_siswaiuran" data-field="x_iuran_id" data-value-separator="<?php echo $t0202_siswaiuran->iuran_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id"<?php echo $t0202_siswaiuran->iuran_id->EditAttributes() ?>>
<?php echo $t0202_siswaiuran->iuran_id->SelectOptionListHtml("x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id") ?>
</select>
<input type="hidden" name="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="s_x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo $t0202_siswaiuran->iuran_id->LookupFilterQuery() ?>">
</span>
<?php } else { ?>
<span id="el$rowindex$_t0202_siswaiuran_iuran_id" class="form-group t0202_siswaiuran_iuran_id">
<span<?php echo $t0202_siswaiuran->iuran_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0202_siswaiuran->iuran_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_iuran_id" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->iuran_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_iuran_id" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->iuran_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t0202_siswaiuran->Nilai->Visible) { // Nilai ?>
		<td data-name="Nilai">
<?php if ($t0202_siswaiuran->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0202_siswaiuran_Nilai" class="form-group t0202_siswaiuran_Nilai">
<input type="text" data-table="t0202_siswaiuran" data-field="x_Nilai" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" size="10" placeholder="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->getPlaceHolder()) ?>" value="<?php echo $t0202_siswaiuran->Nilai->EditValue ?>"<?php echo $t0202_siswaiuran->Nilai->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t0202_siswaiuran_Nilai" class="form-group t0202_siswaiuran_Nilai">
<span<?php echo $t0202_siswaiuran->Nilai->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0202_siswaiuran->Nilai->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_Nilai" name="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="x<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0202_siswaiuran" data-field="x_Nilai" name="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" id="o<?php echo $t0202_siswaiuran_grid->RowIndex ?>_Nilai" value="<?php echo ew_HtmlEncode($t0202_siswaiuran->Nilai->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t0202_siswaiuran_grid->ListOptions->Render("body", "right", $t0202_siswaiuran_grid->RowCnt);
?>
<script type="text/javascript">
ft0202_siswaiurangrid.UpdateOpts(<?php echo $t0202_siswaiuran_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t0202_siswaiuran->CurrentMode == "add" || $t0202_siswaiuran->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t0202_siswaiuran_grid->FormKeyCountName ?>" id="<?php echo $t0202_siswaiuran_grid->FormKeyCountName ?>" value="<?php echo $t0202_siswaiuran_grid->KeyCount ?>">
<?php echo $t0202_siswaiuran_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t0202_siswaiuran->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t0202_siswaiuran_grid->FormKeyCountName ?>" id="<?php echo $t0202_siswaiuran_grid->FormKeyCountName ?>" value="<?php echo $t0202_siswaiuran_grid->KeyCount ?>">
<?php echo $t0202_siswaiuran_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t0202_siswaiuran->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft0202_siswaiurangrid">
</div>
<?php

// Close recordset
if ($t0202_siswaiuran_grid->Recordset)
	$t0202_siswaiuran_grid->Recordset->Close();
?>
<?php if ($t0202_siswaiuran_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t0202_siswaiuran_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t0202_siswaiuran_grid->TotalRecs == 0 && $t0202_siswaiuran->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t0202_siswaiuran_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t0202_siswaiuran->Export == "") { ?>
<script type="text/javascript">
ft0202_siswaiurangrid.Init();
</script>
<?php } ?>
<?php
$t0202_siswaiuran_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t0202_siswaiuran_grid->Page_Terminate();
?>
