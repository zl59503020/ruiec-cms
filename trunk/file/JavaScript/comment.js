/*
	评论相关操作JS函数
*/
// 获取评论列表
function getComments(moduleid,itemid,pageid,pagecount){
	if(typeof pagecount == 'undefined') pagecount = 10;
	$.ajax({
		url: '/api/comment.php?moduleid='+moduleid+'&itemid='+itemid+'&action=list&v_ajax=ruiec&c_page='+pageid+'&pagesize='+pagecount,
		dataType: 'json',
		error: function(e){
			$('#comment_list').html('<li>加载评论失败...</li>');
			alert('加载评论失败!\r\n'+e);
		},
		success: function(data){
			var commText = '';
			for(var i in data.items){
				commText += '<li><div class="floor">#'+(Number(i)+1)+'</div>';
				commText += '<div class="avatar"><img src="'+data.items[i].thumb+'" width="36" height="36"></div>';
				commText += '<div class="inner">';
				commText += '<p>'+data.items[i].content+'</p>';
				commText += '<div class="meta"><span class="blue">'+data.items[i].username+'</span>';
				commText += '<span class="time">'+data.items[i].addtime+'</span></div>';
				commText += '</div></li>';			
			}
			$('.sp_comment_count').html(data.count);
			$('#comment_list').html(commText);
			$('#comment_page').html(data.page);
		}
	});
	$('#comment_list').html('<li>数据加载中...</li>');
}

// 刷新验证码
function re_captcha(img){
	img = z.$(img);
	if(z.att(img,'_src') == null) z.att(img,'_src',img.src);
	img.src = z.att(img,'_src') + '?' + Math.random();
}

$(function(){
	if($('#comment_form') != null){
		$('#comment_form').ajaxForm({
			beforeSend : function() { $('#sp_cm_wait').html('正在提交中...'); },
			success : function(responseText, statusText, xhr, $form){
				if(statusText == 'success'){
					if(responseText == '0'){
						$('#sp_cm_wait').html('提交成功'); 
						$('#comment_form').resetForm();
						alert('提交成功,待审核后显示.');
						setTimeout(function(){$('#sp_cm_wait').html('');},3000);
						getComments(_MODULEID,_ITEMID,1);
					}else{
						$('#sp_cm_wait').html('提交失败'); 
						alert("评论失败!\r\n"+responseText);
					}
				}else{
					return true;
				}
			}
		});
		getComments(_MODULEID,_ITEMID,1);
	}
});