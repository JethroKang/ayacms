
var drag = new Drag();
drag.extend({
	
	setDefalutMenu : function () {
		this.addMenu('default', '删除', 'drag.removeBlock(event,true)');
		this.addMenu('block', '属性', 'drag.openBlockEdit(event)');
	},
	openBlockEdit : function (e,op) {
		e = Util.event(e);
		op = (op=='data') ? 'data' : 'block';
		var bid = e.aim.id.replace('cmd_portal_block_','');
		this.removeMenu();
		showWindow('xxx', ROOTPATH+'?template/diyedit/&ac=block&op='+op+'&bid='+bid+'&themefile='+document.diyform.themefile.value+'&themename='+document.diyform.themename.value, 'get', -1);
	},
	
	getRule : function (selector,attr) {
		selector = spaceDiy.checkSelector(selector);
		var value = (!selector || !attr) ? '' : spaceDiy.styleSheet.getRule(selector, attr);
		return value;
	},

	addTitleInput : function (c) {
		if (c  > 10) return false;
		var pre = $$('titleInput_'+(c-1));
		var dom = document.createElement('div');
		dom.className = 'tfm';
		var exp = new RegExp('_'+(c-1), 'g');
		dom.id = 'titleInput_'+c;
		dom.innerHTML = pre.innerHTML.replace(exp, '_'+c);
		Util.insertAfter(dom, pre);
		$$('addTitleInput').onclick = function () {drag.addTitleInput(c+1)};
	},
	saveTitleEdit : function (fid) {},
	_createTitleHtml : function (ele,tid) {
		var html = '',img = '';
		tid = '_' + tid ;
		var ttext = $$('titleText'+tid).value;
		var tlink = $$('titleLink'+tid).value;
		var tfloat = $$('titleFloat'+tid).value;
		var tmargin_ = tfloat != '' ? tfloat : 'left';
		var tmargin = $$('titleMargin'+tid).value;
		var tsize = $$('titleSize'+tid).value;
		var tcolor = $$('titleColor'+tid).value;
		var src = $$('titleSrc'+tid).value;
		var divStyle = 'float:'+tfloat+';margin-'+tmargin_+':'+tmargin+'px;font-size:'+tsize;
		var aStyle = 'color:'+tcolor+';';
		if (src) {
			img = '<img class="vm" src="'+src+'" alt="'+ttext+'" />';
		}
		if (ttext || img) {
			if (tlink) {
				Util.setStyle(ele, divStyle);
				html = '<a href='+tlink+' style="'+aStyle+'">'+img+ttext+'</a>';
			} else {
				Util.setStyle(ele, divStyle+';'+aStyle);
				html = img+ttext;
			}
		}
		ele.innerHTML = html;
		return true;
	},
	saveBlockTitle : function (id,title) {},
	removeBlock : function (e, flag) {
		if ( typeof e !== 'string') {
			e = Util.event(e);
			var id = e.aim.id.replace('cmd_','');
		} else {
			var id = e;
		}
		if ($$(id) == null) return false;
		var obj = this.getObjByName(id);
		
		if(flag===true){
		if (!confirm('您确定要删除吗')) return false;
		}
		
		if (obj instanceof Block) {
			this.delBlock(id);
		} else if (obj instanceof Frame) {
			this.delFrame(obj);
		}
		$$(id).parentNode.removeChild($$(id));		
		this.setClose();
		this.initPosition();
		this.initChkBlock();
		if(flag==true){
		javascript:spaceDiy.save();
		}
	},
	delBlock : function (bid) {
		spaceDiy.removeCssSelector('#'+bid);
		this.stopSlide(bid);
	},
	delFrame : function (frame) {
		spaceDiy.removeCssSelector('#'+frame.name);
		for (var i in frame['columns']) {
			if (frame['columns'][i] instanceof Column) {
				var children = frame['columns'][i]['children'];
				for (var j in children) {
					if (children[j] instanceof Frame) {
						this.delFrame(children[j]);
					} else if (children[j] instanceof Block) {
						this.delBlock(children[j]['name']);
					}
				}
			}
		}
		this.setClose();
	},
	initChkBlock : function (data) {
		if (typeof name == 'undefined' || data == null ) data = this.data;
		if ( data instanceof Frame) {
			this.initChkBlock(data['columns']);
		} else if (data instanceof Block) {
			var el = $$('chk'+data.name);
			if (el != null) el.checked = true;
		} else if (typeof data == 'object') {
			for (var i in data) {
				this.initChkBlock(data[i]);
			}
		}
	},
	getBlockData : function (blockname) {
		var bid = this.dragObj.id;
		var eleid = bid;
		if (bid.indexOf('portal_block_') != -1) {
			eleid = 0;
		}else {
			bid = 0;
		}
		showWindow('xxx', ROOTPATH+'?template/diyedit/&mod=portalcp&ac=block&op=block&classname='+blockname+'&bid='+bid+'&eleid='+eleid+'&themefile='+document.diyform.themefile.value+'&themename='+document.diyform.themename.value,'get',-1);
		drag.initPosition();
		this.fn = '';
		return true;
	},
	stopSlide : function (id) {
		if (typeof slideshow.entities == 'undefined') return false;
		var slidebox = $C('slidebox',$$(id));
		if(slidebox && slidebox.length > 0) {
			if(slidebox[0].id) {
				var timer = slideshow.entities[slidebox[0].id].timer;
				if(timer) clearTimeout(timer);
				slideshow.entities[slidebox[0].id] = '';
			}
		}
	},

	createObj : function (e,objType,contentType) {
		if (objType == 'block' && !this.checkHasFrame()) {alert("请先添加布局");return false;}
		e = Util.event(e);
		if(e.which != 1 ) {return false;}
		var html = '',offWidth = 0;
		if (objType == 'frame') {
			html =  this.getFrameHtml(contentType);
			offWidth = 300;
		} else if (objType == 'block') {
			html =  this.getBlockHtml(contentType);
			offWidth = 300;
			this.fn = function (e) {drag.getBlockData(contentType);};
		} else if (objType == 'tab') {
			html = this.getTabHtml(contentType);
			offWidth = 300;
		}

		var ele = document.createElement('div');
		ele.innerHTML = html;
		ele = ele.childNodes[0];
		document.body.appendChild(ele);
		this.dragObj = this.overObj = ele;
		if (!this.getTmpBoxElement()) return false;
		var scroll = Util.getScroll();
		this.dragObj.style.position = 'absolute';
		this.dragObj.style.left = e.clientX + scroll.l - 10 + "px";
		this.dragObj.style.top = e.clientY + scroll.t - 10 + "px";
		this.dragObj.style.width = offWidth + 'px';
		this.dragObj.style.cursor = 'move';
		this.dragObj.lastMouseX = e.clientX;
		this.dragObj.lastMouseY = e.clientY;
		Util.insertBefore(this.tmpBoxElement,this.overObj);
		Util.addClass(this.dragObj,this.moving);
		this.dragObj.style.zIndex = 500 ;
		this.scroll = Util.getScroll();
		this.newFlag = true;
		var _method = this;
		document.onscroll = function(){Drag.prototype.resetObj.call(_method, e);};
		window.onscroll = function(){Drag.prototype.resetObj.call(_method, e);};
		document.onmousemove = function (e){Drag.prototype.drag.call(_method, e);};
		document.onmouseup = function (e){Drag.prototype.dragEnd.call(_method, e);};
	},
	getFrameHtml : function (type) {
		
		var id = 'frame'+Util.getRandom(6);
		var className = [this.frameClass,this.moveableObject].join(' ');
		
		
		
		var str = '<div id="'+id+'" class="row-fluid clearfix '+className+'">';		
		
		
		var ge=type.split(":"); 

if(ge[0]!='0')
str +='<div id="'+id+'_left" class="span'+ge[0]+' column"></div>';

if(typeof(ge[1])!='undefined' && ge[1]!='0')
str +='<div id="'+id+'_center" class="span'+ge[1]+' column"></div>';

if(typeof(ge[2])!='undefined' && ge[2]!='0')
str +='<div id="'+id+'_right" class="span'+ge[2]+' column"></div>';
		
		str += '</div>';
		return str;
		
	},
	getTabHtml : function () {
		var id = 'tab'+Util.getRandom(6);
		var className = [this.tabClass,this.moveableObject].join(' ');
		className = className + ' cl';
		var titleClassName = [this.tabTitleClass, this.titleClass, this.moveableColumn, 'cl'].join(' ');
		var str = '<div id="'+id+'" class="'+className+'">';
		str += '<div id="'+id+'_content" class="'+this.tabContentClass+'"></div>';
		str += '</div>';
		return str;
	},
	getBlockHtml : function () {
		
		var id = 'block'+Util.getRandom(6);
		var str = '<div id="'+id+'" class="block move-span"></div>';
		str += '</div>';
		return str;
	},
	setClose : function () {
		this.isChange = true;
		spaceDiy.enablePreviewButton();
	},
	clearClose : function () {
		this.isChange = false;
		this.isClearClose = true;
		window.onbeforeunload = function () {};
	}
});

var spaceDiy = new DIY();
spaceDiy.extend({
	save : function (optype,rejs) {
		
		document.diyform.action = document.diyform.action.replace(/[&|\?]inajax=1/, '');
		document.diyform.layoutdata.value = drag.getPositionStr();
		
		drag.clearClose();
		ajaxp('diyform');
	},
	checkPreview_form : function () {
		if (!$$('preview_form')) {
			var dom = document.createElement('div');
			var search = '';
			var sarr = location.search.replace('?','').split('&');
			for (var i = 0;i<sarr.length;i++){
				var kv = sarr[i].split('=');
				if (kv.length>1 && kv[0] != 'diy') {
					search += '<input type="hidden" value="'+kv[1]+'" name="'+kv[0]+'" />';
				}
			}
			search +=  '<input type="hidden" value="yes" name="preview" />';
			dom.innerHTML = '<form action="'+location.href+'" target="_bloak" method="get" id="preview_form">'+search+'</form>';
			var form = dom.getElementsByTagName('form');
			$$('append_parent').appendChild(form[0]);
		}
	},
	cancelDiyUrl : function () {		
		return location.href.replace(/[\?|\&]diy\=yes/g,'').replace(/[\?|\&]preview=yes/,'');		
	},
	cancel : function () {
		location.href = this.cancelDiyUrl();
		/*
		var flag = false;
		    flag = confirm(this.cancelConfirm ? this.cancelConfirm : '关闭将不保存您刚才的设置,真要退出吗?');
			if (flag) {
			location.href = this.cancelDiyUrl();
			}
			*/
	},
	recover : function() {},
	goonDIY : function () {},
	enablePreviewButton : function () {
		if ($$('preview')){
			$$('preview').className = '';
			if(drag.isChange) {
				$$('diy_preview').onclick = function () {spaceDiy.save('savecache');return false;};
			} else {
				$$('diy_preview').onclick = function () {spaceDiy.save('preview');return false;};
			}
			Util.show($$('savecachemsg'))
		}
	},
	disablePreviewButton : function () {
		if ($$('preview')) {
			$$('preview').className = 'unusable';
			$$('diy_preview').onclick = function () {return false;};
		}
	},
	cancelDIY : function () {},
	switchBlockclass : function(blockclass) {},
	getdiy : function (type) {}
});

spaceDiy.goonDIY();
spaceDiy.init();

