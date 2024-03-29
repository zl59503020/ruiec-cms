﻿
//=============================切换验证码======================================
function ToggleCode(obj, codeurl) {
    $(obj).attr("src", codeurl + "?time=" + Math.random());
}

//表格隔行变色
$(function () {
    $(".msgtable tr:nth-child(odd)").addClass("tr_odd_bg"); //隔行变色
    $(".msgtable tr").hover(
			    function () {
			        $(this).addClass("tr_hover_col");
			    },
			    function () {
			        $(this).removeClass("tr_hover_col");
			    }
		    );
});
//==========================页面加载时JS函数结束===============================

//===========================系统管理JS函数开始================================

//Tab控制函数
function tabs(tabId, tabNum) {
    //设置点击后的切换样式
    $(tabId + " .tab_nav li").removeClass("selected");
    $(tabId + " .tab_nav li").eq(tabNum).addClass("selected");
    //根据参数决定显示内容
    $(tabId + " .tab_con").hide();
    $(tabId + " .tab_con").eq(tabNum).show();
}

//可以自动关闭的提示
function jsprint(msgtitle, url, msgcss, callback) {
    $("#msgprint").remove();
    var cssname = "";
    switch (msgcss) {
        case "Success":
            cssname = "pcent success";
            break;
        case "Error":
            cssname = "pcent error";
            break;
        default:
            cssname = "pcent warning";
            break;
    }
    var str = "<div id=\"msgprint\" class=\"" + cssname + "\">" + msgtitle + "</div>";
    $("body").append(str);
    $("#msgprint").show();
	var itemiframe = "#framecenter .l-tab-content .l-tab-content-item";
    var curriframe = "";
    $(itemiframe).each(function () {
        if ($(this).css("display") != "none") {
			curriframe = $(itemiframe).index($(this));
            return false;
        }
    });
    if (url == "back" && curriframe != "") {
        frames[curriframe].history.back(-1);
    } else if (url != "" && curriframe != "") {
        frames[curriframe].location.href = url;
    }
    //3秒后清除提示
    setTimeout(function () {
        $("#msgprint").fadeOut(500);
        //如果动画结束则删除节点
        if (!$("#msgprint").is(":animated")) {
            $("#msgprint").remove();
        }
    }, 3000);
    //执行回调函数
    if (typeof (callback) == "function") callback();
}

//全选取消按钮函数，调用样式如：
function checkAll(chkobj){
	if($(chkobj).find("span b").text()=="全选")
	{
	    $(chkobj).find("span b").text("取消");
		$(".checkall input").attr("checked", true);
	}else{
    $(chkobj).find("span b").text("全选");
		$(".checkall input").attr("checked", false);
	}
}

//执行回传函数
function ExePostBack(objId, objmsg) {
    if ($(".checkall input:checked").size() < 1) {
        $.ligerDialog.warn("对不起，请选中您要操作的记录！");
        return false;
    }
    var msg = "删除记录后不可恢复，您确定吗？";
    if (arguments.length == 2) {
        msg = objmsg;
    }
    $.ligerDialog.confirm(msg, "提示信息", function (result) {
        if (result) {
            __doPostBack(objId, '');
        }
    });
    return false;
}

//关闭提示窗口
function CloseTip(objId) {
    $("#" + objId).hide();
}

//弹窗提示
function MsgBox(msg,title){
	title = (title) ? title : '提示';
	art.dialog({
		title: title,
		lock: true,
		background: '#fff',
		opacity: 0.5,
		content: msg,
		ok: true
	});
}


function FmSubmit(fm){
	
	alert('False');
	
	return false;

}

function _upfile(id){
	var upArt = art.dialog({
		title: '上传文件',
		content: '<form method="POST" id="fm_art_f_'+id+'" action="/upload.php" enctype="multipart/form-data"><div style="margin:10px;"><input type="hidden" name="su" value="downfile" /><input type="file" id="upfile" name="upfile" style="width:18em;padding:6px 4px" /></div></form>',
		lock: true,
		background: '#fff',
		opacity: 0.5,
		ok: function(){
			if($('#upfile').val() != ''){
				$('#fm_art_f_'+id).submit();
				return false;
			}else{
				return true;
			}
		},
		cancel: true
	});
	$('#fm_art_f_'+id).ajaxForm({
		beforeSend: function() {},
		uploadProgress: function(event, position, total, percentComplete) {},
		complete: function(xhr) {},
		success: function(responseText, statusText, xhr, $form){
			if(statusText == 'success'){
				if(responseText.substr(0,5) != 'error'){
					$('#'+id).val(responseText);
					upArt.close();
				}else{
					alert(responseText);
				}
			}
		}
	}); 

}


function upfile(id,w,h,c){
	w = (typeof w == 'undefined') ? '' : w;
	h = (typeof h == 'undefined') ? '' : h;
	c = (typeof c == 'undefined') ? '' : 'checked';
	var upArt = art.dialog({
		title: '上传文件',
		content: '<form method="POST" id="fm_art_'+id+'" action="/upload.php" enctype="multipart/form-data"><div style="margin:10px;"><input type="hidden" name="su" value="upImage" /><input type="file" id="upfile" name="upfile" style="width:18em;padding:6px 4px" /></div><div>宽:<input type="text" id="upfilew" name="upimgsize[w]" size="10" class="txtInput" value="'+w+'" />&nbsp;&nbsp;高:<input type="text" id="upfileh" name="upimgsize[h]" size="10" class="txtInput"  value="'+h+'" />&nbsp;&nbsp;<input  type="checkbox" name="upimgsize[s]" '+c+'/>约束比例</div></form>',
		lock: true,
		background: '#fff',
		opacity: 0.5,
		ok: function(){
			if(isNaN($('#upfilew').val())){
				$('#upfilew').val('0');
			}
			if(isNaN($('#upfileh').val())){
				$('#upfileh').val('0');
			}
			if($('#upfile').val() != ''){
				$('#fm_art_'+id).submit();
				return false;
			}else{
				return true;
			}
		},
		cancel: true
	});
	$('#fm_art_'+id).ajaxForm({
		beforeSend: function() {},
		uploadProgress: function(event, position, total, percentComplete) {},
		complete: function(xhr) {},
		success: function(responseText, statusText, xhr, $form){
			if(statusText == 'success'){
				if(responseText.substr(0,5) != 'error'){
					$('#'+id).val(responseText);
					upArt.close();
				}else{
					alert(responseText);
				}
			}
		}
	}); 

}

function showImg(src){
	if(src == ''){
		art.dialog({
			title: '图片预览',
			content: '<div style="margin:5px;"><h3>图片地址为空,无法预览</h3></div>',
			lock: true,
			background: '#fff',
			opacity: 0.5,
			ok: true
		});
	}else{
		art.dialog({
			title: '图片预览',
			content: '<div style="margin:5px;"><img src="' + src + '" /></div>',
			lock: true,
			background: '#fff',
			opacity: 0.5,
			ok: true
		});
	}
}

// open url
function zopen(url,opt){
	art.dialog.open(url,opt);
}

function _ip(ip){
	$.ajax({
		url:'?file=ajax&action=ip&ip='+ip,
		success:function(responseText){
			art.dialog({
				title: 'IP',
				lock: true,
				background: '#fff',
				opacity: 0.5,
				content: responseText,
				ok: true
			});
		}
	});
}


function checkAll(name,v){
	var cks = z.$('#'+name);
	for(var i in cks){
		if(v == '!')cks[i].checked = !cks[i].checked;
		else cks[i].checked = v;
	}
}

function _url(url,p){
	if(typeof p == 'undefined'){
		window.location = url;
	}else{
		window.parent.f_addTab(p.n, p.t, url);
	}
}

function tpl_edit(f,d,i){
	var v = document.getElementById('ruiec_template_'+i).firstChild.value;
	var n = v ? v : f;
	window.parent.f_addTab('sys_template_edit_'+d+i, '模板风格', '?file=template&action=edit&fileid='+n+'&dir='+d);
}
	
function tpl_add(f,d){
	window.parent.f_addTab('sys_template_add_'+d+f, '模板风格', '?file=template&action=add&type='+f+'&dir='+d);
}
var ajax_obj = null;
// Form 表单 提交check init
function form_check_init(fmname,classname,ajaxopt){
	if(typeof fmname == 'undefined' || fmname == '') fmname = '#myform';
	if(typeof classname == 'undefined' || classname == '') classname = '.tab_con';
	$(fmname).validate({
		invalidHandler: function (e, validator) {
			parent.jsprint("有 " + validator.numberOfInvalids() + " 项填写有误，请检查！", "", "Warning");
		},
		errorPlacement: function (lable, element) {
			//可见元素显示错误提示
			if (element.parents(classname).css('display') != 'none') {
				element.ligerTip({ content: lable.html(), appendIdTo: lable });
			}
		},
		success: function (lable) {
			lable.ligerHideTip();
		}
	});
	//ajax form
	$(fmname).ajaxForm({
		beforeSend : function() {art.dialog({id:'lock',title:false,lock:true,background:'#fff',opacity:0.3});},
		success : function(responseText, statusText, xhr, $form){
			if(typeof ajaxopt.success != 'undefined'){
				ajaxopt.success.call({document:document,statusText:statusText,responseText:responseText});
			}else{
				art.dialog.list['lock'].close();
				if(statusText == 'success'){
					if(responseText == '0'){
						parent.jsprint(ajaxopt.title+"成功!", "", "Success");
						if(typeof ajaxopt.url == 'undefined')
							window.location.reload();
						else
							window.location = ajaxopt.url;
					}else{
						parent.jsprint(ajaxopt.title+"失败!", "", "Error");
						art.dialog({
							title: ajaxopt.title+'失败',
							lock: true,
							background: '#fff',
							opacity: 0.5,
							content: responseText,
							ok: true
						});
					}
					if(typeof ajaxopt.callback != 'undefined') ajaxopt.callback.call({document:document,responseText:responseText});
				}else{
					return true;
				}
			}
		}
	});
}

// base
function _cf(opt){
	art.dialog.confirm(opt.info, function(){
		$.ajax({
			url:opt.url,
			success:function(data){
				if(data == '0'){
					parent.jsprint(opt.title+"成功!", "", "Success");
					window.location.reload();
				}else{
					parent.jsprint(opt.title+"失败!", "", "Error");
					art.dialog({
						title: opt.title+'失败',
						lock: true,
						background: '#fff',
						opacity: 0.5,
						content: data,
						ok: true
					});
				}
				if(typeof opt.callback != 'undefined') opt.callback.call(document);
			}
		});
	});
}

// check selected
function ck_sel(name){
	var sels = z.$('#'+name);
	var ib = false;
	for(var i in sels){
		if(sels[i].checked) return true;
	}
	return false;
}
