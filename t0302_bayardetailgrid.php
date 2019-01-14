<?php include_once "t9996_employeesinfo.php" ?>
<?php

// Create page object
if (!isset($t0302_bayardetail_grid)) $t0302_bayardetail_grid = new ct0302_bayardetail_grid();

// Page init
$t0302_bayardetail_grid->Page_Init();

// Page main
$t0302_bayardetail_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$t0302_bayardetail_grid->Page_Render();
?>
<?php if ($t0302_bayardetail->Export == "") { ?>
<script type="text/javascript">

// Form object
var ft0302_bayardetailgrid = new ew_Form("ft0302_bayardetailgrid", "grid");
ft0302_bayardetailgrid.FormKeyCountName = '<?php echo $t0302_bayardetail_grid->FormKeyCountName ?>';

// Validate form
ft0302_bayardetailgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_iuran_id");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0302_bayardetail->iuran_id->FldCaption(), $t0302_bayardetail->iuran_id->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_iuran_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t0302_bayardetail->iuran_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $t0302_bayardetail->Jumlah->FldCaption(), $t0302_bayardetail->Jumlah->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_Jumlah");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($t0302_bayardetail->Jumlah->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
ft0302_bayardetailgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "iuran_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Periode1", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Periode2", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Keterangan", false)) return false;
	if (ew_ValueChanged(fobj, infix, "Jumlah", false)) return false;
	return true;
}

// Form_CustomValidate event
ft0302_bayardetailgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }

// Use JavaScript validation or not
<?php if (EW_CLIENT_VALIDATE) { ?>
ft0302_bayardetailgrid.ValidateRequired = true;
<?php } else { ?>
ft0302_bayardetailgrid.ValidateRequired = false; 
<?php } ?>

// Dynamic selection lists
ft0302_bayardetailgrid.Lists["x_iuran_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_Iuran","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"t0106_iuran"};
ft0302_bayardetailgrid.Lists["x_Periode1"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft0302_bayardetailgrid.Lists["x_Periode1"].Options = <?php echo json_encode($t0302_bayardetail->Periode1->Options()) ?>;
ft0302_bayardetailgrid.Lists["x_Periode2"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
ft0302_bayardetailgrid.Lists["x_Periode2"].Options = <?php echo json_encode($t0302_bayardetail->Periode2->Options()) ?>;

// Form object for search
</script>
<?php } ?>
<?php
if ($t0302_bayardetail->CurrentAction == "gridadd") {
	if ($t0302_bayardetail->CurrentMode == "copy") {
		$bSelectLimit = $t0302_bayardetail_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$t0302_bayardetail_grid->TotalRecs = $t0302_bayardetail->SelectRecordCount();
			$t0302_bayardetail_grid->Recordset = $t0302_bayardetail_grid->LoadRecordset($t0302_bayardetail_grid->StartRec-1, $t0302_bayardetail_grid->DisplayRecs);
		} else {
			if ($t0302_bayardetail_grid->Recordset = $t0302_bayardetail_grid->LoadRecordset())
				$t0302_bayardetail_grid->TotalRecs = $t0302_bayardetail_grid->Recordset->RecordCount();
		}
		$t0302_bayardetail_grid->StartRec = 1;
		$t0302_bayardetail_grid->DisplayRecs = $t0302_bayardetail_grid->TotalRecs;
	} else {
		$t0302_bayardetail->CurrentFilter = "0=1";
		$t0302_bayardetail_grid->StartRec = 1;
		$t0302_bayardetail_grid->DisplayRecs = $t0302_bayardetail->GridAddRowCount;
	}
	$t0302_bayardetail_grid->TotalRecs = $t0302_bayardetail_grid->DisplayRecs;
	$t0302_bayardetail_grid->StopRec = $t0302_bayardetail_grid->DisplayRecs;
} else {
	$bSelectLimit = $t0302_bayardetail_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($t0302_bayardetail_grid->TotalRecs <= 0)
			$t0302_bayardetail_grid->TotalRecs = $t0302_bayardetail->SelectRecordCount();
	} else {
		if (!$t0302_bayardetail_grid->Recordset && ($t0302_bayardetail_grid->Recordset = $t0302_bayardetail_grid->LoadRecordset()))
			$t0302_bayardetail_grid->TotalRecs = $t0302_bayardetail_grid->Recordset->RecordCount();
	}
	$t0302_bayardetail_grid->StartRec = 1;
	$t0302_bayardetail_grid->DisplayRecs = $t0302_bayardetail_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$t0302_bayardetail_grid->Recordset = $t0302_bayardetail_grid->LoadRecordset($t0302_bayardetail_grid->StartRec-1, $t0302_bayardetail_grid->DisplayRecs);

	// Set no record found message
	if ($t0302_bayardetail->CurrentAction == "" && $t0302_bayardetail_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$t0302_bayardetail_grid->setWarningMessage(ew_DeniedMsg());
		if ($t0302_bayardetail_grid->SearchWhere == "0=101")
			$t0302_bayardetail_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$t0302_bayardetail_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$t0302_bayardetail_grid->RenderOtherOptions();
?>
<?php $t0302_bayardetail_grid->ShowPageHeader(); ?>
<?php
$t0302_bayardetail_grid->ShowMessage();
?>
<?php if ($t0302_bayardetail_grid->TotalRecs > 0 || $t0302_bayardetail->CurrentAction <> "") { ?>
<div class="panel panel-default ewGrid t0302_bayardetail">
<div id="ft0302_bayardetailgrid" class="ewForm form-inline">
<div id="gmp_t0302_bayardetail" class="<?php if (ew_IsResponsiveLayout()) { echo "table-responsive "; } ?>ewGridMiddlePanel">
<table id="tbl_t0302_bayardetailgrid" class="table ewTable">
<?php echo $t0302_bayardetail->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Header row
$t0302_bayardetail_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$t0302_bayardetail_grid->RenderListOptions();

// Render list options (header, left)
$t0302_bayardetail_grid->ListOptions->Render("header", "left");
?>
<?php if ($t0302_bayardetail->iuran_id->Visible) { // iuran_id ?>
	<?php if ($t0302_bayardetail->SortUrl($t0302_bayardetail->iuran_id) == "") { ?>
		<th data-name="iuran_id"><div id="elh_t0302_bayardetail_iuran_id" class="t0302_bayardetail_iuran_id"><div class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->iuran_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="iuran_id"><div><div id="elh_t0302_bayardetail_iuran_id" class="t0302_bayardetail_iuran_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->iuran_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0302_bayardetail->iuran_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0302_bayardetail->iuran_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t0302_bayardetail->Periode1->Visible) { // Periode1 ?>
	<?php if ($t0302_bayardetail->SortUrl($t0302_bayardetail->Periode1) == "") { ?>
		<th data-name="Periode1"><div id="elh_t0302_bayardetail_Periode1" class="t0302_bayardetail_Periode1"><div class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Periode1->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Periode1"><div><div id="elh_t0302_bayardetail_Periode1" class="t0302_bayardetail_Periode1">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Periode1->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0302_bayardetail->Periode1->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0302_bayardetail->Periode1->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t0302_bayardetail->Periode2->Visible) { // Periode2 ?>
	<?php if ($t0302_bayardetail->SortUrl($t0302_bayardetail->Periode2) == "") { ?>
		<th data-name="Periode2"><div id="elh_t0302_bayardetail_Periode2" class="t0302_bayardetail_Periode2"><div class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Periode2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Periode2"><div><div id="elh_t0302_bayardetail_Periode2" class="t0302_bayardetail_Periode2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Periode2->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0302_bayardetail->Periode2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0302_bayardetail->Periode2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t0302_bayardetail->Keterangan->Visible) { // Keterangan ?>
	<?php if ($t0302_bayardetail->SortUrl($t0302_bayardetail->Keterangan) == "") { ?>
		<th data-name="Keterangan"><div id="elh_t0302_bayardetail_Keterangan" class="t0302_bayardetail_Keterangan"><div class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Keterangan->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Keterangan"><div><div id="elh_t0302_bayardetail_Keterangan" class="t0302_bayardetail_Keterangan">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Keterangan->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0302_bayardetail->Keterangan->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0302_bayardetail->Keterangan->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php if ($t0302_bayardetail->Jumlah->Visible) { // Jumlah ?>
	<?php if ($t0302_bayardetail->SortUrl($t0302_bayardetail->Jumlah) == "") { ?>
		<th data-name="Jumlah"><div id="elh_t0302_bayardetail_Jumlah" class="t0302_bayardetail_Jumlah"><div class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Jumlah->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="Jumlah"><div><div id="elh_t0302_bayardetail_Jumlah" class="t0302_bayardetail_Jumlah">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $t0302_bayardetail->Jumlah->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($t0302_bayardetail->Jumlah->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($t0302_bayardetail->Jumlah->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
        </div></div></th>
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$t0302_bayardetail_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$t0302_bayardetail_grid->StartRec = 1;
$t0302_bayardetail_grid->StopRec = $t0302_bayardetail_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($t0302_bayardetail_grid->FormKeyCountName) && ($t0302_bayardetail->CurrentAction == "gridadd" || $t0302_bayardetail->CurrentAction == "gridedit" || $t0302_bayardetail->CurrentAction == "F")) {
		$t0302_bayardetail_grid->KeyCount = $objForm->GetValue($t0302_bayardetail_grid->FormKeyCountName);
		$t0302_bayardetail_grid->StopRec = $t0302_bayardetail_grid->StartRec + $t0302_bayardetail_grid->KeyCount - 1;
	}
}
$t0302_bayardetail_grid->RecCnt = $t0302_bayardetail_grid->StartRec - 1;
if ($t0302_bayardetail_grid->Recordset && !$t0302_bayardetail_grid->Recordset->EOF) {
	$t0302_bayardetail_grid->Recordset->MoveFirst();
	$bSelectLimit = $t0302_bayardetail_grid->UseSelectLimit;
	if (!$bSelectLimit && $t0302_bayardetail_grid->StartRec > 1)
		$t0302_bayardetail_grid->Recordset->Move($t0302_bayardetail_grid->StartRec - 1);
} elseif (!$t0302_bayardetail->AllowAddDeleteRow && $t0302_bayardetail_grid->StopRec == 0) {
	$t0302_bayardetail_grid->StopRec = $t0302_bayardetail->GridAddRowCount;
}

// Initialize aggregate
$t0302_bayardetail->RowType = EW_ROWTYPE_AGGREGATEINIT;
$t0302_bayardetail->ResetAttrs();
$t0302_bayardetail_grid->RenderRow();
if ($t0302_bayardetail->CurrentAction == "gridadd")
	$t0302_bayardetail_grid->RowIndex = 0;
if ($t0302_bayardetail->CurrentAction == "gridedit")
	$t0302_bayardetail_grid->RowIndex = 0;
while ($t0302_bayardetail_grid->RecCnt < $t0302_bayardetail_grid->StopRec) {
	$t0302_bayardetail_grid->RecCnt++;
	if (intval($t0302_bayardetail_grid->RecCnt) >= intval($t0302_bayardetail_grid->StartRec)) {
		$t0302_bayardetail_grid->RowCnt++;
		if ($t0302_bayardetail->CurrentAction == "gridadd" || $t0302_bayardetail->CurrentAction == "gridedit" || $t0302_bayardetail->CurrentAction == "F") {
			$t0302_bayardetail_grid->RowIndex++;
			$objForm->Index = $t0302_bayardetail_grid->RowIndex;
			if ($objForm->HasValue($t0302_bayardetail_grid->FormActionName))
				$t0302_bayardetail_grid->RowAction = strval($objForm->GetValue($t0302_bayardetail_grid->FormActionName));
			elseif ($t0302_bayardetail->CurrentAction == "gridadd")
				$t0302_bayardetail_grid->RowAction = "insert";
			else
				$t0302_bayardetail_grid->RowAction = "";
		}

		// Set up key count
		$t0302_bayardetail_grid->KeyCount = $t0302_bayardetail_grid->RowIndex;

		// Init row class and style
		$t0302_bayardetail->ResetAttrs();
		$t0302_bayardetail->CssClass = "";
		if ($t0302_bayardetail->CurrentAction == "gridadd") {
			if ($t0302_bayardetail->CurrentMode == "copy") {
				$t0302_bayardetail_grid->LoadRowValues($t0302_bayardetail_grid->Recordset); // Load row values
				$t0302_bayardetail_grid->SetRecordKey($t0302_bayardetail_grid->RowOldKey, $t0302_bayardetail_grid->Recordset); // Set old record key
			} else {
				$t0302_bayardetail_grid->LoadDefaultValues(); // Load default values
				$t0302_bayardetail_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$t0302_bayardetail_grid->LoadRowValues($t0302_bayardetail_grid->Recordset); // Load row values
		}
		$t0302_bayardetail->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($t0302_bayardetail->CurrentAction == "gridadd") // Grid add
			$t0302_bayardetail->RowType = EW_ROWTYPE_ADD; // Render add
		if ($t0302_bayardetail->CurrentAction == "gridadd" && $t0302_bayardetail->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$t0302_bayardetail_grid->RestoreCurrentRowFormValues($t0302_bayardetail_grid->RowIndex); // Restore form values
		if ($t0302_bayardetail->CurrentAction == "gridedit") { // Grid edit
			if ($t0302_bayardetail->EventCancelled) {
				$t0302_bayardetail_grid->RestoreCurrentRowFormValues($t0302_bayardetail_grid->RowIndex); // Restore form values
			}
			if ($t0302_bayardetail_grid->RowAction == "insert")
				$t0302_bayardetail->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$t0302_bayardetail->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($t0302_bayardetail->CurrentAction == "gridedit" && ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT || $t0302_bayardetail->RowType == EW_ROWTYPE_ADD) && $t0302_bayardetail->EventCancelled) // Update failed
			$t0302_bayardetail_grid->RestoreCurrentRowFormValues($t0302_bayardetail_grid->RowIndex); // Restore form values
		if ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT) // Edit row
			$t0302_bayardetail_grid->EditRowCnt++;
		if ($t0302_bayardetail->CurrentAction == "F") // Confirm row
			$t0302_bayardetail_grid->RestoreCurrentRowFormValues($t0302_bayardetail_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$t0302_bayardetail->RowAttrs = array_merge($t0302_bayardetail->RowAttrs, array('data-rowindex'=>$t0302_bayardetail_grid->RowCnt, 'id'=>'r' . $t0302_bayardetail_grid->RowCnt . '_t0302_bayardetail', 'data-rowtype'=>$t0302_bayardetail->RowType));

		// Render row
		$t0302_bayardetail_grid->RenderRow();

		// Render list options
		$t0302_bayardetail_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($t0302_bayardetail_grid->RowAction <> "delete" && $t0302_bayardetail_grid->RowAction <> "insertdelete" && !($t0302_bayardetail_grid->RowAction == "insert" && $t0302_bayardetail->CurrentAction == "F" && $t0302_bayardetail_grid->EmptyRow())) {
?>
	<tr<?php echo $t0302_bayardetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t0302_bayardetail_grid->ListOptions->Render("body", "left", $t0302_bayardetail_grid->RowCnt);
?>
	<?php if ($t0302_bayardetail->iuran_id->Visible) { // iuran_id ?>
		<td data-name="iuran_id"<?php echo $t0302_bayardetail->iuran_id->CellAttributes() ?>>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_iuran_id" class="form-group t0302_bayardetail_iuran_id">
<?php
$wrkonchange = trim(" " . @$t0302_bayardetail->iuran_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t0302_bayardetail->iuran_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t0302_bayardetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="sv_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo $t0302_bayardetail->iuran_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->getPlaceHolder()) ?>"<?php echo $t0302_bayardetail->iuran_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" data-value-separator="<?php echo $t0302_bayardetail->iuran_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="q_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo $t0302_bayardetail->iuran_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft0302_bayardetailgrid.CreateAutoSuggest({"id":"x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->OldValue) ?>">
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_iuran_id" class="form-group t0302_bayardetail_iuran_id">
<?php
$wrkonchange = trim(" " . @$t0302_bayardetail->iuran_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t0302_bayardetail->iuran_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t0302_bayardetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="sv_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo $t0302_bayardetail->iuran_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->getPlaceHolder()) ?>"<?php echo $t0302_bayardetail->iuran_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" data-value-separator="<?php echo $t0302_bayardetail->iuran_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="q_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo $t0302_bayardetail->iuran_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft0302_bayardetailgrid.CreateAutoSuggest({"id":"x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id","forceSelect":false});
</script>
</span>
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_iuran_id" class="t0302_bayardetail_iuran_id">
<span<?php echo $t0302_bayardetail->iuran_id->ViewAttributes() ?>>
<?php echo $t0302_bayardetail->iuran_id->ListViewValue() ?></span>
</span>
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" name="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" name="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->OldValue) ?>">
<?php } ?>
<?php } ?>
<a id="<?php echo $t0302_bayardetail_grid->PageObjName . "_row_" . $t0302_bayardetail_grid->RowCnt ?>"></a></td>
	<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_id" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_id" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->id->CurrentValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_id" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_id" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->id->OldValue) ?>">
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT || $t0302_bayardetail->CurrentMode == "edit") { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_id" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_id" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($t0302_bayardetail->Periode1->Visible) { // Periode1 ?>
		<td data-name="Periode1"<?php echo $t0302_bayardetail->Periode1->CellAttributes() ?>>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Periode1" class="form-group t0302_bayardetail_Periode1">
<select data-table="t0302_bayardetail" data-field="x_Periode1" data-value-separator="<?php echo $t0302_bayardetail->Periode1->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1"<?php echo $t0302_bayardetail->Periode1->EditAttributes() ?>>
<?php echo $t0302_bayardetail->Periode1->SelectOptionListHtml("x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1") ?>
</select>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode1" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode1->OldValue) ?>">
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Periode1" class="form-group t0302_bayardetail_Periode1">
<select data-table="t0302_bayardetail" data-field="x_Periode1" data-value-separator="<?php echo $t0302_bayardetail->Periode1->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1"<?php echo $t0302_bayardetail->Periode1->EditAttributes() ?>>
<?php echo $t0302_bayardetail->Periode1->SelectOptionListHtml("x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1") ?>
</select>
</span>
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Periode1" class="t0302_bayardetail_Periode1">
<span<?php echo $t0302_bayardetail->Periode1->ViewAttributes() ?>>
<?php echo $t0302_bayardetail->Periode1->ListViewValue() ?></span>
</span>
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode1" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode1->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode1" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode1->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode1" name="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" id="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode1->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode1" name="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" id="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode1->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t0302_bayardetail->Periode2->Visible) { // Periode2 ?>
		<td data-name="Periode2"<?php echo $t0302_bayardetail->Periode2->CellAttributes() ?>>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Periode2" class="form-group t0302_bayardetail_Periode2">
<select data-table="t0302_bayardetail" data-field="x_Periode2" data-value-separator="<?php echo $t0302_bayardetail->Periode2->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2"<?php echo $t0302_bayardetail->Periode2->EditAttributes() ?>>
<?php echo $t0302_bayardetail->Periode2->SelectOptionListHtml("x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2") ?>
</select>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode2" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode2->OldValue) ?>">
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Periode2" class="form-group t0302_bayardetail_Periode2">
<select data-table="t0302_bayardetail" data-field="x_Periode2" data-value-separator="<?php echo $t0302_bayardetail->Periode2->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2"<?php echo $t0302_bayardetail->Periode2->EditAttributes() ?>>
<?php echo $t0302_bayardetail->Periode2->SelectOptionListHtml("x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2") ?>
</select>
</span>
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Periode2" class="t0302_bayardetail_Periode2">
<span<?php echo $t0302_bayardetail->Periode2->ViewAttributes() ?>>
<?php echo $t0302_bayardetail->Periode2->ListViewValue() ?></span>
</span>
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode2" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode2->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode2" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode2->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode2" name="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" id="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode2->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode2" name="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" id="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode2->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t0302_bayardetail->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan"<?php echo $t0302_bayardetail->Keterangan->CellAttributes() ?>>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Keterangan" class="form-group t0302_bayardetail_Keterangan">
<input type="text" data-table="t0302_bayardetail" data-field="x_Keterangan" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t0302_bayardetail->Keterangan->EditValue ?>"<?php echo $t0302_bayardetail->Keterangan->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Keterangan" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->OldValue) ?>">
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Keterangan" class="form-group t0302_bayardetail_Keterangan">
<input type="text" data-table="t0302_bayardetail" data-field="x_Keterangan" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t0302_bayardetail->Keterangan->EditValue ?>"<?php echo $t0302_bayardetail->Keterangan->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Keterangan" class="t0302_bayardetail_Keterangan">
<span<?php echo $t0302_bayardetail->Keterangan->ViewAttributes() ?>>
<?php echo $t0302_bayardetail->Keterangan->ListViewValue() ?></span>
</span>
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Keterangan" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Keterangan" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Keterangan" name="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Keterangan" name="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($t0302_bayardetail->Jumlah->Visible) { // Jumlah ?>
		<td data-name="Jumlah"<?php echo $t0302_bayardetail->Jumlah->CellAttributes() ?>>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Jumlah" class="form-group t0302_bayardetail_Jumlah">
<input type="text" data-table="t0302_bayardetail" data-field="x_Jumlah" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" size="10" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t0302_bayardetail->Jumlah->EditValue ?>"<?php echo $t0302_bayardetail->Jumlah->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Jumlah" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->OldValue) ?>">
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Jumlah" class="form-group t0302_bayardetail_Jumlah">
<input type="text" data-table="t0302_bayardetail" data-field="x_Jumlah" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" size="10" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t0302_bayardetail->Jumlah->EditValue ?>"<?php echo $t0302_bayardetail->Jumlah->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $t0302_bayardetail_grid->RowCnt ?>_t0302_bayardetail_Jumlah" class="t0302_bayardetail_Jumlah">
<span<?php echo $t0302_bayardetail->Jumlah->ViewAttributes() ?>>
<?php echo $t0302_bayardetail->Jumlah->ListViewValue() ?></span>
</span>
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Jumlah" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Jumlah" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Jumlah" name="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="ft0302_bayardetailgrid$x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->FormValue) ?>">
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Jumlah" name="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="ft0302_bayardetailgrid$o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t0302_bayardetail_grid->ListOptions->Render("body", "right", $t0302_bayardetail_grid->RowCnt);
?>
	</tr>
<?php if ($t0302_bayardetail->RowType == EW_ROWTYPE_ADD || $t0302_bayardetail->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
ft0302_bayardetailgrid.UpdateOpts(<?php echo $t0302_bayardetail_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($t0302_bayardetail->CurrentAction <> "gridadd" || $t0302_bayardetail->CurrentMode == "copy")
		if (!$t0302_bayardetail_grid->Recordset->EOF) $t0302_bayardetail_grid->Recordset->MoveNext();
}
?>
<?php
	if ($t0302_bayardetail->CurrentMode == "add" || $t0302_bayardetail->CurrentMode == "copy" || $t0302_bayardetail->CurrentMode == "edit") {
		$t0302_bayardetail_grid->RowIndex = '$rowindex$';
		$t0302_bayardetail_grid->LoadDefaultValues();

		// Set row properties
		$t0302_bayardetail->ResetAttrs();
		$t0302_bayardetail->RowAttrs = array_merge($t0302_bayardetail->RowAttrs, array('data-rowindex'=>$t0302_bayardetail_grid->RowIndex, 'id'=>'r0_t0302_bayardetail', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($t0302_bayardetail->RowAttrs["class"], "ewTemplate");
		$t0302_bayardetail->RowType = EW_ROWTYPE_ADD;

		// Render row
		$t0302_bayardetail_grid->RenderRow();

		// Render list options
		$t0302_bayardetail_grid->RenderListOptions();
		$t0302_bayardetail_grid->StartRowCnt = 0;
?>
	<tr<?php echo $t0302_bayardetail->RowAttributes() ?>>
<?php

// Render list options (body, left)
$t0302_bayardetail_grid->ListOptions->Render("body", "left", $t0302_bayardetail_grid->RowIndex);
?>
	<?php if ($t0302_bayardetail->iuran_id->Visible) { // iuran_id ?>
		<td data-name="iuran_id">
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0302_bayardetail_iuran_id" class="form-group t0302_bayardetail_iuran_id">
<?php
$wrkonchange = trim(" " . @$t0302_bayardetail->iuran_id->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$t0302_bayardetail->iuran_id->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" style="white-space: nowrap; z-index: <?php echo (9000 - $t0302_bayardetail_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="sv_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo $t0302_bayardetail->iuran_id->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->getPlaceHolder()) ?>"<?php echo $t0302_bayardetail->iuran_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" data-value-separator="<?php echo $t0302_bayardetail->iuran_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<input type="hidden" name="q_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="q_x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo $t0302_bayardetail->iuran_id->LookupFilterQuery(true) ?>">
<script type="text/javascript">
ft0302_bayardetailgrid.CreateAutoSuggest({"id":"x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id","forceSelect":false});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_t0302_bayardetail_iuran_id" class="form-group t0302_bayardetail_iuran_id">
<span<?php echo $t0302_bayardetail->iuran_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0302_bayardetail->iuran_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_iuran_id" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_iuran_id" value="<?php echo ew_HtmlEncode($t0302_bayardetail->iuran_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t0302_bayardetail->Periode1->Visible) { // Periode1 ?>
		<td data-name="Periode1">
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0302_bayardetail_Periode1" class="form-group t0302_bayardetail_Periode1">
<select data-table="t0302_bayardetail" data-field="x_Periode1" data-value-separator="<?php echo $t0302_bayardetail->Periode1->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1"<?php echo $t0302_bayardetail->Periode1->EditAttributes() ?>>
<?php echo $t0302_bayardetail->Periode1->SelectOptionListHtml("x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_t0302_bayardetail_Periode1" class="form-group t0302_bayardetail_Periode1">
<span<?php echo $t0302_bayardetail->Periode1->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0302_bayardetail->Periode1->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode1" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode1->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode1" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode1" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode1->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t0302_bayardetail->Periode2->Visible) { // Periode2 ?>
		<td data-name="Periode2">
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0302_bayardetail_Periode2" class="form-group t0302_bayardetail_Periode2">
<select data-table="t0302_bayardetail" data-field="x_Periode2" data-value-separator="<?php echo $t0302_bayardetail->Periode2->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2"<?php echo $t0302_bayardetail->Periode2->EditAttributes() ?>>
<?php echo $t0302_bayardetail->Periode2->SelectOptionListHtml("x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_t0302_bayardetail_Periode2" class="form-group t0302_bayardetail_Periode2">
<span<?php echo $t0302_bayardetail->Periode2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0302_bayardetail->Periode2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode2" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode2->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Periode2" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Periode2" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Periode2->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t0302_bayardetail->Keterangan->Visible) { // Keterangan ?>
		<td data-name="Keterangan">
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0302_bayardetail_Keterangan" class="form-group t0302_bayardetail_Keterangan">
<input type="text" data-table="t0302_bayardetail" data-field="x_Keterangan" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->getPlaceHolder()) ?>" value="<?php echo $t0302_bayardetail->Keterangan->EditValue ?>"<?php echo $t0302_bayardetail->Keterangan->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t0302_bayardetail_Keterangan" class="form-group t0302_bayardetail_Keterangan">
<span<?php echo $t0302_bayardetail->Keterangan->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0302_bayardetail->Keterangan->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Keterangan" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Keterangan" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Keterangan" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Keterangan->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($t0302_bayardetail->Jumlah->Visible) { // Jumlah ?>
		<td data-name="Jumlah">
<?php if ($t0302_bayardetail->CurrentAction <> "F") { ?>
<span id="el$rowindex$_t0302_bayardetail_Jumlah" class="form-group t0302_bayardetail_Jumlah">
<input type="text" data-table="t0302_bayardetail" data-field="x_Jumlah" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" size="10" placeholder="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->getPlaceHolder()) ?>" value="<?php echo $t0302_bayardetail->Jumlah->EditValue ?>"<?php echo $t0302_bayardetail->Jumlah->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_t0302_bayardetail_Jumlah" class="form-group t0302_bayardetail_Jumlah">
<span<?php echo $t0302_bayardetail->Jumlah->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $t0302_bayardetail->Jumlah->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Jumlah" name="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="x<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="t0302_bayardetail" data-field="x_Jumlah" name="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" id="o<?php echo $t0302_bayardetail_grid->RowIndex ?>_Jumlah" value="<?php echo ew_HtmlEncode($t0302_bayardetail->Jumlah->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$t0302_bayardetail_grid->ListOptions->Render("body", "right", $t0302_bayardetail_grid->RowCnt);
?>
<script type="text/javascript">
ft0302_bayardetailgrid.UpdateOpts(<?php echo $t0302_bayardetail_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($t0302_bayardetail->CurrentMode == "add" || $t0302_bayardetail->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $t0302_bayardetail_grid->FormKeyCountName ?>" id="<?php echo $t0302_bayardetail_grid->FormKeyCountName ?>" value="<?php echo $t0302_bayardetail_grid->KeyCount ?>">
<?php echo $t0302_bayardetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t0302_bayardetail->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $t0302_bayardetail_grid->FormKeyCountName ?>" id="<?php echo $t0302_bayardetail_grid->FormKeyCountName ?>" value="<?php echo $t0302_bayardetail_grid->KeyCount ?>">
<?php echo $t0302_bayardetail_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($t0302_bayardetail->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="ft0302_bayardetailgrid">
</div>
<?php

// Close recordset
if ($t0302_bayardetail_grid->Recordset)
	$t0302_bayardetail_grid->Recordset->Close();
?>
<?php if ($t0302_bayardetail_grid->ShowOtherOptions) { ?>
<div class="panel-footer ewGridLowerPanel">
<?php
	foreach ($t0302_bayardetail_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($t0302_bayardetail_grid->TotalRecs == 0 && $t0302_bayardetail->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($t0302_bayardetail_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($t0302_bayardetail->Export == "") { ?>
<script type="text/javascript">
ft0302_bayardetailgrid.Init();
</script>
<?php } ?>
<?php
$t0302_bayardetail_grid->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php
$t0302_bayardetail_grid->Page_Terminate();
?>
