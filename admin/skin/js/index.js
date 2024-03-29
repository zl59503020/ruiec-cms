﻿	var tab = null;
    var accordion = null;
    var tree = null;
    $(function () {
        //页面布局
        $("#global_layout").ligerLayout({ leftWidth: 180, height: '100%', topHeight: 65, bottomHeight: 24, allowTopResize: false, allowBottomResize: false, allowLeftCollapse: true, onHeightChanged: f_heightChanged });

        var height = $(".l-layout-center").height();

        //Tab
        $("#framecenter").ligerTab({ height: height });

        //左边导航面板
        $("#global_left_nav").ligerAccordion({ height: height - 25, speed: null });

        $(".l-link").hover(function () {
            $(this).addClass("l-link-over");
        }, function () {
            $(this).removeClass("l-link-over");
        });
		
		//获取控制面板Menu
		getControlPanelMenu();
		
		//获取我的面板
		getMyDiyMenu();
		
		//获取模块管理
        getModuleMenu();
		
        //加载插件菜单
        loadPluginsNav();

        //快捷菜单
        var menu = $.ligerMenu({ width: 120, items:
		[
			{ text: '管理首页', click: itemclick },
			{ text: '修改密码', click: itemclick },
			{ line: true },
			{ text: '关闭菜单', click: itemclick }
		]
        });
        $("#tab-tools-nav").bind("click", function () {
            var offset = $(this).offset(); //取得事件对象的位置
            menu.show({ top: offset.top + 27, left: offset.left - 106 });
            return false;
        });

        tab = $("#framecenter").ligerGetTabManager();
        accordion = $("#global_left_nav").ligerGetAccordionManager();
        //tree = $("#global_channel_tree").ligerGetTreeManager();
        //tree.expandAll(); //默认展开所有节点
        $("#pageloading_bg,#pageloading").hide();	//loading...
    });
	
	//加载控制面板菜单
	function getControlPanelMenu(){
		$.ajax({
			url:'?file=ajax&action=controlpanel',
			dataType: 'json',
			beforeSend: function (XMLHttpRequest) {
                $("#global_controlpanel").html("<div style=\"line-height:30px; text-align:center;\">正在加载，请稍候...</div>");
            },
			success:function(data){
				try{
					var menu = '';
					for(var o in data){
						var _mu = data[o];
						menu = menu + '<li><a class="l-link" href="javascript:;" onclick="f_addTab(\''+_mu.id+'\', \''+_mu.name+'\', \''+_mu.url+'\');">'+_mu.name+'</a></li>';
					}
					$('#global_controlpanel').html(menu);
				}catch(e){
					alert(e.message);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("#global_controlpanel").html("<div style=\"line-height:30px; text-align:center;\">加载数据出错！</div>");
            }
		});
	}
	
	// 加载频道菜单
	function getModuleMenu(){
		$("#global_channel_tree").ligerTree({
            url: '?file=ajax&action=module',
            checkbox: false,
            nodeWidth: 112,
            //attribute: ['nodename', 'url'],
            onSelect: function (node) {
                if (!node.data.url) return;
                var tabid = $(node.target).attr("tabid");
                if (!tabid) {
                    tabid = new Date().getTime();
                    $(node.target).attr("tabid", tabid)
                }
                f_addTab(tabid, node.data.text, node.data.url);
            }
        });
	}
	
	// 刷新频道菜单
	function reModuleMenu(){
		var _liger = $("#global_channel_tree").ligerTree();
		if(_liger != null){
			_liger.clear();
			_liger.loadData(null,'?file=ajax&action=module');
		}
	}
	
	// 获取我的面板
	function getMyDiyMenu(){
		$.ajax({
			url:'?file=ajax&action=diy',
			dataType: 'json',
			beforeSend: function (XMLHttpRequest) {
                $("#global_my_diy").html("<div style=\"line-height:30px; text-align:center;\">正在加载，请稍候...</div>");
            },
			success:function(data){
				try{
					var menu = '';
					for(var o in data){
						var _mu = data[o];
						menu = menu + '<li><a class="l-link" href="javascript:;" onclick="f_addTab(\''+_mu.id+'\', \''+_mu.name+'\', \''+_mu.url+'\');">'+_mu.name+'</a></li>';
					}
					$('#global_my_diy').html(menu);
				}catch(e){
					alert(e.message);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("#global_my_diy").html("<div style=\"line-height:30px; text-align:center;\">加载数据出错！</div>");
            }
		});
	}
	
    //加载插件管理菜单
    function loadPluginsNav() {
		$.ajax({
			url:'?file=ajax&action=plug',
			dataType: 'json',
			beforeSend: function (XMLHttpRequest) {
                $("#global_plugins").html("<div style=\"line-height:30px; text-align:center;\">正在加载，请稍候...</div>");
            },
			success:function(data){
				try{
					var menu = '';
					for(var o in data){
						var _mu = data[o];
						menu = menu + '<li><a class="l-link" href="javascript:;" onclick="f_addTab(\''+_mu.id+'\', \''+_mu.name+'\', \''+_mu.url+'\');">'+_mu.name+'</a></li>';
					}
					$('#global_plugins').html(menu);
				}catch(e){
					alert(e.message);
				}
			},
			error: function (XMLHttpRequest, textStatus, errorThrown) {
                $("#global_plugins").html("<div style=\"line-height:30px; text-align:center;\">加载数据出错！</div>");
            }
		});
    }

    //快捷菜单回调函数
    function itemclick(item) {
        switch (item.text) {
            case "管理首页":
                f_addTab('home', '管理中心', '');
                break;
            case "快捷导航":
                //调用函数
                break;
            case "修改密码":
                f_addTab('manager_pwd', '修改密码', '?action=password');
                break;
            default:
                //关闭窗口
                break;
        }
    }
	
	//
	function f_heightChanged(options) {
        if (tab)
            tab.addHeight(options.diff);
        if (accordion && options.middleHeight - 24 > 0)
            accordion.setHeight(options.middleHeight - 24);
    }
	
    //添加Tab，可传3个参数
    function f_addTab(tabid, text, url, iconcss) {
        if (arguments.length == 4) {
            tab.addTabItem({ tabid: tabid, text: text, url: url, iconcss: iconcss });
        } else {
            tab.addTabItem({ tabid: tabid, text: text, url: url });
        }
    }
    
	//提示Dialog并关闭Tab
    function f_errorTab(tit, msg) {
        $.ligerDialog.open({
            isDrag: false,
            allowClose: false,
            type: 'error',
            title: tit,
            content: msg,
            buttons: [{
                text: '确定',
                onclick: function (item, dialog, index) {
                    //查找当前iframe名称
                    var itemiframe = "#framecenter .l-tab-content .l-tab-content-item";
                    var curriframe = "";
                    $(itemiframe).each(function () {
                        if ($(this).css("display") != "none") {
                            curriframe = $(this).attr("tabid");
                            return false;
                        }
                    });
                    if (curriframe != "") {
                        tab.removeTabItem(curriframe);
                        dialog.close();
                    }
                }
            }]
        });
    }