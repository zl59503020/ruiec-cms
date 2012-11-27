<?php
defined('IN_RUIEC') or exit('Access Denied');
?>
<form action="" method="post" id="myform_dict" name="myform_dict" >
<input type="hidden" name="file" value="<?php echo $file;?>"/>
<input type="hidden" name="action" value="<?php echo $action;?>"/>
<input type="hidden" name="table" value="<?php echo $table;?>"/>
<input type="hidden" name="nt" value="<?php echo $note;?>"/>
<input type="hidden" name="v_ruiec_sm_dict" value="ruiec" />
<div class="tab_nav tab_nav_ex"><?php echo $note;?>[<?php echo $table;?>]</div>
<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
	<tr>
		<th>字段名</th>
		<th>注释</th>
		<th>备注</th>
		<th>类型</th>
	</tr>
<?php
	foreach($fields as $k=>$v) {
?>
	<tr>
		<td>&nbsp;&nbsp;<strong><?php echo $v['Field'];?></strong></td>
		<td>&nbsp;<input type="text" size="20" name="name[<?php echo $v['Field'];?>]" value="<?php echo $v['Comment'];?>"/></td>
		<td>&nbsp;<input type="text" size="20" name="note[<?php echo $v['Field'];?>]" value="<?php echo $v['cn_note'];?>" title="<?php echo $v['cn_note'];?>"/></td>
		<td>&nbsp;<strong><?php echo $v['Type'];?></strong><input type="hidden" name="type[<?php echo $v['Field'];?>]" value="<?php echo $v['Type'];?>"/></td>
	</tr>
<?php
	}
?>
	<tr>
		<td>&nbsp;</td>
		<td colspan="3">&nbsp;
			<input type="submit" value=" 更 新 " class="btnSubmit" />&nbsp;&nbsp;
		</td>
	</tr>
</table>
</form>