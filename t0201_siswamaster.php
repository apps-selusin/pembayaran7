<?php

// NIS
// Nama

?>
<?php if ($t0201_siswa->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t0201_siswa->TableCaption() ?></h4> -->
<table id="tbl_t0201_siswamaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t0201_siswa->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t0201_siswa->NIS->Visible) { // NIS ?>
		<tr id="r_NIS">
			<td><?php echo $t0201_siswa->NIS->FldCaption() ?></td>
			<td<?php echo $t0201_siswa->NIS->CellAttributes() ?>>
<span id="el_t0201_siswa_NIS">
<span<?php echo $t0201_siswa->NIS->ViewAttributes() ?>>
<?php echo $t0201_siswa->NIS->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t0201_siswa->Nama->Visible) { // Nama ?>
		<tr id="r_Nama">
			<td><?php echo $t0201_siswa->Nama->FldCaption() ?></td>
			<td<?php echo $t0201_siswa->Nama->CellAttributes() ?>>
<span id="el_t0201_siswa_Nama">
<span<?php echo $t0201_siswa->Nama->ViewAttributes() ?>>
<?php echo $t0201_siswa->Nama->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
