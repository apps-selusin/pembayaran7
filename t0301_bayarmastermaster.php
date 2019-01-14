<?php

// Nomor
// Tanggal
// tahunajaran_id
// siswa_id
// Total

?>
<?php if ($t0301_bayarmaster->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t0301_bayarmaster->TableCaption() ?></h4> -->
<table id="tbl_t0301_bayarmastermaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t0301_bayarmaster->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t0301_bayarmaster->Nomor->Visible) { // Nomor ?>
		<tr id="r_Nomor">
			<td><?php echo $t0301_bayarmaster->Nomor->FldCaption() ?></td>
			<td<?php echo $t0301_bayarmaster->Nomor->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_Nomor">
<span<?php echo $t0301_bayarmaster->Nomor->ViewAttributes() ?>>
<?php echo $t0301_bayarmaster->Nomor->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t0301_bayarmaster->Tanggal->Visible) { // Tanggal ?>
		<tr id="r_Tanggal">
			<td><?php echo $t0301_bayarmaster->Tanggal->FldCaption() ?></td>
			<td<?php echo $t0301_bayarmaster->Tanggal->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_Tanggal">
<span<?php echo $t0301_bayarmaster->Tanggal->ViewAttributes() ?>>
<?php echo $t0301_bayarmaster->Tanggal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t0301_bayarmaster->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<tr id="r_tahunajaran_id">
			<td><?php echo $t0301_bayarmaster->tahunajaran_id->FldCaption() ?></td>
			<td<?php echo $t0301_bayarmaster->tahunajaran_id->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_tahunajaran_id">
<span<?php echo $t0301_bayarmaster->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t0301_bayarmaster->tahunajaran_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t0301_bayarmaster->siswa_id->Visible) { // siswa_id ?>
		<tr id="r_siswa_id">
			<td><?php echo $t0301_bayarmaster->siswa_id->FldCaption() ?></td>
			<td<?php echo $t0301_bayarmaster->siswa_id->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_siswa_id">
<span<?php echo $t0301_bayarmaster->siswa_id->ViewAttributes() ?>>
<?php echo $t0301_bayarmaster->siswa_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t0301_bayarmaster->Total->Visible) { // Total ?>
		<tr id="r_Total">
			<td><?php echo $t0301_bayarmaster->Total->FldCaption() ?></td>
			<td<?php echo $t0301_bayarmaster->Total->CellAttributes() ?>>
<span id="el_t0301_bayarmaster_Total">
<span<?php echo $t0301_bayarmaster->Total->ViewAttributes() ?>>
<?php echo $t0301_bayarmaster->Total->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
