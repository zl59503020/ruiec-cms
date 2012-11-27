<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; 控制面板 &gt; 管理员管理</div>
	
	<div class="tools_box">
		<div class="tools_bar">
			<a href="?file=<?php echo $file; ?>&action=add" class="tools_btn"><span><b class="add">添加管理员</b></span></a>
		</div>
	</div>
	
	<div class="tab_nav tab_nav_ex">管理员管理</div>
	
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="msgtable">
		<tr>
			<th width="10%">姓名</th>
			<th width="10%">用户名</th>
			<th width="10%">管理级别</th>
			<th width="10%">上次登录时间</th>
			<th width="10%">登录IP</th>
			<th width="10%">登录地区</th>
			<th width="10%">登录次数</th>
			<th>管理</th>
		</tr>
<?php
	foreach($lists as $v) {
?>
		<tr align="center">
			<td><?php echo $v['truename'];?></td>
			<td><a href="javascript:_user('<?php echo $v['username'];?>');"><?php echo $v['username'];?></a></td>
			<td><?php echo $v['adminname'];?></td>
			<td class="px11"><?php echo $v['lastlogintime'];?></td>
			<td class="px11"><a href="javascript:_ip('<?php echo $v['lastloginip'];?>');"><?php echo $v['lastloginip'];?></a></td>
			<td><?php echo ip2area($v['lastloginip']);?></td>
			<td><?php echo $v['logincount'];?></td>
			<td>
<?php
		if($CFG['founderid'] != $v['userid']){
?>
				<a href="?file=<?php echo $file;?>&action=edit&userid=<?php echo $v['userid'];?>" title="修改管理级别、角色、分站">修改</a> | 
				<a href="?file=<?php echo $file;?>&action=right&userid=<?php echo $v['userid'];?>" title="分配权限 / 管理面板">权限/面板</a> | 
				<a href="?file=<?php echo $file;?>&action=delete&username=<?php echo $v['username'];?>" onclick="return _delete();" title="撤销管理员">撤销</a>
<?php
		}else{
?>
				网站创始人不可操作
<?php
		}
?>
			</td>
		</tr>
<?php
	}
?>
	</table>
	
<?php include tpl('footer'); ?>