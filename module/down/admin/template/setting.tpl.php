<?php
defined('IN_RUIEC') or exit('Access Denied');
include tpl('header');
?>

	<div class="navigation">首页 &gt; <?php echo $MOD['name']; ?>管理 &gt; 模块设置</div>
	
	<div id="contentTab">

		<ul class="tab_nav">
			<li class="selected"><a onclick="tabs('#contentTab',0);" href="javascript:;">基本设置</a></li>
			<li><a onclick="tabs('#contentTab',1);" href="javascript:void(0);">SEO优化</a></li>
			<li><a onclick="_url('?file=fields&tbname=<?php echo $table; ?>',{n:'sys_fields_m_<?php echo $table; ?>',t:'自定义字段管理'});" href="javascript:void(0);">自定义字段</a></li>
			<li><a onclick="_url('?file=template&dir=article',{n:'sys_template_m_<?php echo $moduleid; ?>',t:'模板管理'});" href="javascript:void(0);">模板管理</a></li>
		</ul>
		
		<form action="" method="post" id="myform" name="myform" enctype="multipart/form-data">
			<!--	网站基本设置	-->
			<div class="tab_con" style="display:block;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>首页默认模板</th>
							<td><?php echo tpl_select('index', $module, 'setting[template_index]', '默认模板', $template_index);?></td>
						</tr>
						<tr>
							<th>列表默认模板</th>
							<td><?php echo tpl_select('list', $module, 'setting[template_list]', '默认模板', $template_list);?></td>
						</tr>
						<tr>
							<th>内容默认模板</th>
							<td><?php echo tpl_select('show', $module, 'setting[template_show]', '默认模板', $template_show);?></td>
						</tr>
						<tr>
							<th>搜索默认模板</th>
							<td><?php echo tpl_select('search', $module, 'setting[template_search]', '默认模板', $template_search);?></td>
						</tr>
						<tr>
							<th>默认缩略图[宽X高]</th>
							<td>
								<input type="text" size="3" name="setting[thumb_width]" value="<?php echo $thumb_width;?>"/>X
								<input type="text" size="3" name="setting[thumb_height]" value="<?php echo $thumb_height;?>"/>px
							</td>
						</tr>
						<tr>
							<th>自动截取内容至简介</th>
							<td><input type="text" size="3" name="setting[introduce_length]" value="<?php echo $introduce_length;?>"/> 字符</td>
						</tr>
						<tr>
							<th>信息排序方式</th>
							<td>
								<input type="text" size="50" name="setting[order]" value="<?php echo $order;?>" id="order"/>
								<select onchange="if(this.value != '') $('#order').val(this.value);">
									<option value="">请选择</option>
									<option value="addtime desc"<?php if($order == 'addtime desc') echo ' selected';?>>添加时间</option>
									<option value="edittime desc"<?php if($order == 'edittime desc') echo ' selected';?>>更新时间</option>
									<option value="itemid desc"<?php if($order == 'itemid desc') echo ' selected';?>>信息ID</option>
								</select>
							</td>
						</tr>
						<tr>
							<th>下载内容远程图片</th>
							<td>
								<input type="radio" name="setting[save_remotepic]" value="1"  <?php if($save_remotepic) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[save_remotepic]" value="0"  <?php if(!$save_remotepic) echo 'checked';?>/> 关闭
							</td>
						</tr>
						<tr>
							<th>清除内容链接</th>
							<td>
								<input type="radio" name="setting[clear_link]" value="1"  <?php if($clear_link) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[clear_link]" value="0"  <?php if(!$clear_link) echo 'checked';?>/> 关闭
							</td>
						</tr>
						<tr>
							<th>级别中文别名</th>
							<td>
								<input type="text" name="setting[level]" style="width:98%;" value="<?php echo $level;?>"/>
								<br/>用 | 分隔不同别名 依次对应 1|2|3|4|5|6|7|8|9 级 <?php echo level_select('post[level]', '提交后点此预览效果');?>
							</td>
						</tr>
						<tr>
							<th>首页幻灯信息数量</th>
							<td><input type="text" size="3" name="setting[page_islide]" value="<?php echo $page_islide;?>"/></td>
						</tr>
						<tr>
							<th>首页分类信息数量</th>
							<td><input type="text" size="3" name="setting[page_icat]" value="<?php echo $page_icat;?>"/></td>
						</tr>
						<tr>
							<th>首页显示按分类浏览</th>
							<td>
								<input type="radio" name="setting[show_icat]" value="1"  <?php if($show_icat) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[show_icat]" value="0"  <?php if(!$show_icat) echo 'checked';?>/> 关闭
							</td>
						</tr>
						<tr>
							<th>首页推荐图文数量</th>
							<td><input type="text" size="3" name="setting[page_irecimg]" value="<?php echo $page_irecimg;?>"/></td>
						</tr>
						<tr>
							<th>首页点击排行数量</th>
							<td><input type="text" size="3" name="setting[page_ihits]" value="<?php echo $page_ihits;?>"/></td>
						</tr>
						<tr>
							<th>列表信息分页数量</th>
							<td><input type="text" size="3" name="setting[pagesize]" value="<?php echo $pagesize;?>"/></td>
						</tr>
						<tr>
							<th>列表子分类数量</th>
							<td><input type="text" size="3" name="setting[page_child]" value="<?php echo $page_child;?>"/></td>
						</tr>
						<tr>
							<th>列表显示按分类浏览</th>
							<td>
								<input type="radio" name="setting[show_lcat]" value="1"  <?php if($show_lcat) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[show_lcat]" value="0"  <?php if(!$show_lcat) echo 'checked';?>/> 关闭
							</td>
						</tr>
						<tr>
							<th>列表推荐图文数量</th>
							<td><input type="text" size="3" name="setting[page_lrecimg]" value="<?php echo $page_lrecimg;?>"/></td>
						</tr>
						<tr>
							<th>列表推荐信息数量</th>
							<td><input type="text" size="3" name="setting[page_lrec]" value="<?php echo $page_lrec;?>"/></td>
						</tr>
						<tr>
							<th>列表点击排行数量</th>
							<td><input type="text" size="3" name="setting[page_lhits]" value="<?php echo $page_lhits;?>"/></td>
						</tr>
						<tr>
							<th>内容同类信息数量</th>
							<td><input type="text" size="3" name="setting[page_srelate]" value="<?php echo $page_srelate;?>"/></td>
						</tr>
						<tr>
							<th>内容推荐图文数量</th>
							<td><input type="text" size="3" name="setting[page_srecimg]" value="<?php echo $page_srecimg;?>"/></td>
						</tr>
						<tr>
							<th>内容推荐信息数量</th>
							<td><input type="text" size="3" name="setting[page_srec]" value="<?php echo $page_srec;?>"/></td>
						</tr>
						<tr>
							<th>内容点击排行数量</th>
							<td><input type="text" size="3" name="setting[page_shits]" value="<?php echo $page_shits;?>"/></td>
						</tr>
						<tr>
							<th>内容图片最大宽度</th>
							<td><input type="text" size="3" name="setting[max_width]" value="<?php echo $max_width;?>"/> px</td>
						</tr>
						<tr>
							<th>是否开启评论</th>
							<td>
								<input type="radio" name="setting[comment]" value="1"  <?php if($comment) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[comment]" value="0"  <?php if(!$comment) echo 'checked';?>/> 关闭
							</td>
						</tr>
						<tr>
							<th>内容显示上一篇下一篇</th>
							<td>
								<input type="radio" name="setting[show_np]" value="1"  <?php if($show_np) echo 'checked';?>/> 开启&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[show_np]" value="0"  <?php if(!$show_np) echo 'checked';?>/> 关闭
								<?php tips('此项会略微增加服务器负担');?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<!--	SEO优化	-->
			<div class="tab_con" style="display:none;">
				<table class="form_table">
					<col width="180px"></col>
					<tbody>
						<tr>
							<th>首页是否生成html</th>
							<td>
								<input type="radio" name="setting[index_html]" value="1"  <?php if($index_html){ ?>checked <?php } ?>/> 是&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[index_html]" value="0"  <?php if(!$index_html){ ?>checked <?php } ?>/> 否
							</td>
						</tr>
						<tr>
							<th>列表页是否生成html</th>
							<td>
								<input type="radio" name="setting[list_html]" value="1"  <?php if($list_html){ ?>checked <?php } ?> onclick="$('#list_html').show();$('#list_php').hide();"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[list_html]" value="0"  <?php if(!$list_html){ ?>checked <?php } ?> onclick="$('#list_html').hide();$('#list_php').show();"/> 否
							</td>
						</tr>
					</tbody>
					<tbody id="list_html" style="display:<?php echo $list_html ? '' : 'none'; ?>">
						<tr>
							<th>HTML列表页文件名前缀</th>
							<td><input name="setting[htm_list_prefix]" type="text" id="htm_list_prefix" value="<?php echo $htm_list_prefix;?>" size="10"></td>
						</tr>
						<tr>
							<th>HTML列表页地址规则</th>
							<td><?php echo url_select('setting[htm_list_urlid]', 'htm', 'list', $htm_list_urlid);?><?php tips('提示:规则列表可在./api/url.inc.php文件里自定义');?></td>
						</tr>
					</tbody>
					<tbody>
						<tr id="list_php" style="display:<?php echo $list_html ? 'none' : ''; ?>">
							<th>PHP列表页地址规则</th>
							<td><?php echo url_select('setting[php_list_urlid]', 'php', 'list', $php_list_urlid);?></td>
						</tr>
						<tr>
							<th>内容页是否生成html</th>
							<td>
								<input type="radio" name="setting[show_html]" value="1"  <?php if($show_html){ ?>checked <?php } ?> onclick="$('#show_html').show();$('#show_php').hide();"/> 是&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="radio" name="setting[show_html]" value="0"  <?php if(!$show_html){ ?>checked <?php } ?> onclick="$('#show_html').hide();$('#show_php').show();"/> 否
							</td>
						</tr>
					</tbody>
					<tbody id="show_html" style="display:<?php echo $show_html ? '' : 'none'; ?>">
						<tr>
							<th>HTML内容页文件名前缀</th>
							<td><input name="setting[htm_item_prefix]" type="text" id="htm_item_prefix" value="<?php echo $htm_item_prefix;?>" size="10"></td>
						</tr>
						<tr>
							<th>HTML内容页地址规则</th>
							<td><?php echo url_select('setting[htm_item_urlid]', 'htm', 'item', $htm_item_urlid);?></td>
						</tr>
					</tbody>
					<tbody>
						<tr id="show_php" style="display:<?php echo $show_html ? 'none' : ''; ?>">
							<th>PHP内容页地址规则</td>
							<td><?php echo url_select('setting[php_item_urlid]', 'php', 'item', $php_item_urlid);?></td>
						</tr>
						<tr>
							<th>模块首页Title<br/>(网页标题)</th>
							<td>
								<input name="setting[seo_title_index]" type="text" id="seo_title_index" value="<?php echo $seo_title_index;?>" style="width:90%;"/><br/> 
								常用变量：<?php echo seo_title('seo_title_index', array('modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?><br/>
								支持页面PHP变量，例如{$MOD[name]}表示模块名称
							</td>
						</tr>
						<tr>
							<th>模块首页Keywords<br/>(网页关键词)</th>
							<td>
								<input name="setting[seo_keywords_index]" type="text" id="seo_keywords_index" value="<?php echo $seo_keywords_index;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_keywords_index', array('modulename', 'sitename', 'sitetitle'));?>
							</td>
						</tr>
						<tr>
							<th>模块首页Description<br/>(网页描述)</th>
							<td>
								<input name="setting[seo_description_index]" type="text" id="seo_description_index" value="<?php echo $seo_description_index;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_description_index', array('modulename', 'sitename', 'sitetitle'));?>
							</td>
						</tr>
						<tr>
							<th>列表页Title<br/>(网页标题)</th>
							<td>
								<input name="setting[seo_title_list]" type="text" id="seo_title_list" value="<?php echo $seo_title_list;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_title_list', array('catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
							</td>
						</tr>
						<tr>
							<th>列表页Keywords<br/>(网页关键词)</th>
							<td>
								<input name="setting[seo_keywords_list]" type="text" id="seo_keywords_list" value="<?php echo $seo_keywords_list;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_keywords_list', array('catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?>
							</td>
						</tr>
						<tr>
							<th>列表页Description<br/>(网页描述)</th>
							<td>
								<input name="setting[seo_description_list]" type="text" id="seo_description_list" value="<?php echo $seo_description_list;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_description_list', array('catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?>
							</td>
						</tr>
						<tr>
							<th>内容页Title<br/>(网页标题)</th>
							<td>
								<input name="setting[seo_title_show]" type="text" id="seo_title_show" value="<?php echo $seo_title_show;?>" style="width:90%;"/><br/>
								<?php echo seo_title('seo_title_show', array('showtitle', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'delimiter'));?>
							</td>
						</tr>
						<tr>
							<th>内容页Keywords<br/>(网页关键词)</th>
							<td>
								<input name="setting[seo_keywords_show]" type="text" id="seo_keywords_show" value="<?php echo $seo_keywords_show;?>" style="width:90%;"/><br/>
								<?php echo seo_title('seo_keywords_show', array('showtitle', 'catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?>
							</td>
						</tr>
						<tr>
							<th>内容页Description<br/>(网页描述)</th>
							<td>
								<input name="setting[seo_description_show]" type="text" id="seo_description_show" value="<?php echo $seo_description_show;?>" style="width:90%;"/><br/>
								<?php echo seo_title('seo_description_show', array('showtitle', 'showintroduce', 'catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?>
							</td>
						</tr>
						<tr>
							<th>搜索页Title<br/>(网页标题)</th>
							<td>
								<input name="setting[seo_title_search]" type="text" id="seo_title_search" value="<?php echo $seo_title_search;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_title_search', array('kw', 'areaname', 'catname', 'cattitle', 'modulename', 'sitename', 'sitetitle', 'page', 'delimiter'));?>
							</td>
						</tr>
						<tr>
							<th>搜索页Keywords<br/>(网页关键词)</th>
							<td>
								<input name="setting[seo_keywords_search]" type="text" id="seo_keywords_search" value="<?php echo $seo_keywords_search;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_keywords_search', array('kw', 'areaname', 'catname', 'catkeywords', 'modulename', 'sitename', 'sitekeywords'));?>
							</td>
						</tr>
						<tr>
							<th>搜索页Description<br/>(网页描述)</th>
							<td>
								<input name="setting[seo_description_search]" type="text" id="seo_description_search" value="<?php echo $seo_description_search;?>" style="width:90%;"/><br/> 
								<?php echo seo_title('seo_description_search', array('kw', 'areaname', 'catname', 'catdescription', 'modulename', 'sitename', 'sitedescription'));?>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
			
			<div class="foot_btn_box">
				<input type="hidden" name="file" value="<?php echo $file; ?>" />
				<input type="hidden" name="moduleid" value="<?php echo $moduleid; ?>" />
				<input type="hidden" name="v_ruiec_sm" value="ruiec" />
				<input name="提交" type="submit" value="提交保存" class="btnSubmit" />&nbsp;
				<input name="重置" type="reset" class="btnSearch" value="重 置" />
			</div>
			
		</form>

<script type="text/javascript">

	$(function () {
        form_check_init('','',{title:'更新'});
    });
	
</script>

<?php include tpl('footer');?>