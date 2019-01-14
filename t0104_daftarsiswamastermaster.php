<?php

// tahunajaran_id
// sekolah_id
// kelas_id

?>
<?php if ($t0104_daftarsiswamaster->Visible) { ?>
<!-- <h4 class="ewMasterCaption"><?php echo $t0104_daftarsiswamaster->TableCaption() ?></h4> -->
<table id="tbl_t0104_daftarsiswamastermaster" class="table table-bordered table-striped ewViewTable">
<?php echo $t0104_daftarsiswamaster->TableCustomInnerHtml ?>
	<tbody>
<?php if ($t0104_daftarsiswamaster->tahunajaran_id->Visible) { // tahunajaran_id ?>
		<tr id="r_tahunajaran_id">
			<td><?php echo $t0104_daftarsiswamaster->tahunajaran_id->FldCaption() ?></td>
			<td<?php echo $t0104_daftarsiswamaster->tahunajaran_id->CellAttributes() ?>>
<span id="el_t0104_daftarsiswamaster_tahunajaran_id">
<span<?php echo $t0104_daftarsiswamaster->tahunajaran_id->ViewAttributes() ?>>
<?php echo $t0104_daftarsiswamaster->tahunajaran_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t0104_daftarsiswamaster->sekolah_id->Visible) { // sekolah_id ?>
		<tr id="r_sekolah_id">
			<td><?php echo $t0104_daftarsiswamaster->sekolah_id->FldCaption() ?></td>
			<td<?php echo $t0104_daftarsiswamaster->sekolah_id->CellAttributes() ?>>
<span id="el_t0104_daftarsiswamaster_sekolah_id">
<span<?php echo $t0104_daftarsiswamaster->sekolah_id->ViewAttributes() ?>>
<?php echo $t0104_daftarsiswamaster->sekolah_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($t0104_daftarsiswamaster->kelas_id->Visible) { // kelas_id ?>
		<tr id="r_kelas_id">
			<td><?php echo $t0104_daftarsiswamaster->kelas_id->FldCaption() ?></td>
			<td<?php echo $t0104_daftarsiswamaster->kelas_id->CellAttributes() ?>>
<span id="el_t0104_daftarsiswamaster_kelas_id">
<span<?php echo $t0104_daftarsiswamaster->kelas_id->ViewAttributes() ?>>
<?php echo $t0104_daftarsiswamaster->kelas_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
<?php } ?>
