var BROWSER = {};
var USERAGENT = navigator.userAgent.toLowerCase();
browserVersion({
	'ie' : 'msie',
	'firefox' : '',
	'chrome' : '',
	'opera' : '',
	'safari' : '',
	'mozilla' : '',
	'webkit' : '',
	'maxthon' : '',
	'qq' : 'qqbrowser'
});
if (BROWSER.safari) {
	BROWSER.firefox = true;
}
BROWSER.opera = BROWSER.opera ? opera.version() : 0;

HTMLNODE = document.getElementsByTagName('head')[0].parentNode;
if (BROWSER.ie) {
	HTMLNODE.className = 'ie_all ie' + parseInt(BROWSER.ie);
}

var JSMENU = [];
JSMENU['active'] = [];
JSMENU['timer'] = [];
JSMENU['drag'] = [];
JSMENU['layer'] = 0;
JSMENU['zIndex'] = {
	'win' : 1200,
	'menu' : 1300,
	'dialog' : 1400,
	'prompt' : 1500
};
JSMENU['float'] = '';

var AJAX = [];
AJAX['url'] = [];
AJAX['stack'] = [ 0, 0, 0, 0, 0, 0, 0, 0, 0, 0 ];

if (BROWSER.firefox && window.HTMLElement) {
	HTMLElement.prototype.__defineSetter__('outerHTML', function(sHTML) {
		var r = this.ownerDocument.createRange();
		r.setStartBefore(this);
		var df = r.createContextualFragment(sHTML);
		this.parentNode.replaceChild(df, this);
		return sHTML;
	});

	HTMLElement.prototype.__defineGetter__('outerHTML', function() {
		var attr;
		var attrs = this.attributes;
		var str = '<' + this.tagName.toLowerCase();
		for ( var i = 0; i < attrs.length; i++) {
			attr = attrs[i];
			if (attr.specified)
				str += ' ' + attr.name + '="' + attr.value + '"';
		}
		if (!this.canHaveChildren) {
			return str + '>';
		}
		return str + '>' + this.innerHTML + '</' + this.tagName.toLowerCase()
				+ '>';
	});

	HTMLElement.prototype.__defineGetter__('canHaveChildren', function() {
		switch (this.tagName.toLowerCase()) {
		case 'area':
		case 'base':
		case 'basefont':
		case 'col':
		case 'frame':
		case 'hr':
		case 'img':
		case 'br':
		case 'input':
		case 'isindex':
		case 'link':
		case 'meta':
		case 'param':
			return false;
		}
		return true;
	});
}

function $$(id) {
	return !id ? null : document.getElementById(id);
}

function $C(classname, ele, tag) {
	var returns = [];
	ele = ele || document;
	tag = tag || '*';
	if (ele.getElementsByClassName) {
		var eles = ele.getElementsByClassName(classname);
		if (tag != '*') {
			for ( var i = 0, L = eles.length; i < L; i++) {
				if (eles[i].tagName.toLowerCase() == tag.toLowerCase()) {
					returns.push(eles[i]);
				}
			}
		} else {
			returns = eles;
		}
	} else {
		eles = ele.getElementsByTagName(tag);
		var pattern = new RegExp("(^|\\s)" + classname + "(\\s|$)");
		for (i = 0, L = eles.length; i < L; i++) {
			if (pattern.test(eles[i].className)) {
				returns.push(eles[i]);
			}
		}
	}
	return returns;
}

function _attachEvent(obj, evt, func, eventobj) {
	eventobj = !eventobj ? obj : eventobj;
	if (obj.addEventListener) {
		obj.addEventListener(evt, func, false);
	} else if (eventobj.attachEvent) {
		obj.attachEvent('on' + evt, func);
	}
}

function _detachEvent(obj, evt, func, eventobj) {
	eventobj = !eventobj ? obj : eventobj;
	if (obj.removeEventListener) {
		obj.removeEventListener(evt, func, false);
	} else if (eventobj.detachEvent) {
		obj.detachEvent('on' + evt, func);
	}
}

function browserVersion(types) {
	var other = 1;
	for (i in types) {
		var v = types[i] ? types[i] : i;
		if (USERAGENT.indexOf(v) != -1) {
			var re = new RegExp(v + '(\\/|\\s)([\\d\\.]+)', 'ig');
			var matches = re.exec(USERAGENT);
			var ver = matches != null ? matches[2] : 0;
			other = ver !== 0 && v != 'mozilla' ? 0 : other;
		} else {
			var ver = 0;
		}
		eval('BROWSER.' + i + '= ver');
	}
	BROWSER.other = other;
}

function getEvent() {
	if (document.all)
		return window.event;
	func = getEvent.caller;
	while (func != null) {
		var arg0 = func.arguments[0];
		if (arg0) {
			if ((arg0.constructor == Event || arg0.constructor == MouseEvent)
					|| (typeof (arg0) == "object" && arg0.preventDefault && arg0.stopPropagation)) {
				return arg0;
			}
		}
		func = func.caller;
	}
	return null;
}

function isUndefined(variable) {
	return typeof variable == 'undefined' ? true : false;
}

function in_array(needle, haystack) {
	if (typeof needle == 'string' || typeof needle == 'number') {
		for ( var i in haystack) {
			if (haystack[i] == needle) {
				return true;
			}
		}
	}
	return false;
}

function trim(str) {
	return (str + '').replace(/(\s+)$/g, '').replace(/^\s+/g, '');
}

function strlen(str) {
	return (BROWSER.ie && str.indexOf('\n') != -1) ? str.replace(/\r?\n/g, '_').length
			: str.length;
}

function display(id) {
	$$(id).style.display = $$(id).style.display == '' ? 'none' : '';
}

function checkall(form, prefix, checkall) {
	var checkall = checkall ? checkall : 'chkall';
	count = 0;
	for ( var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name && e.name != checkall
				&& (!prefix || (prefix && e.name.match(prefix)))) {
			e.checked = form.elements[checkall].checked;
			if (e.checked) {
				count++;
			}
		}
	}
	return count;
}

function Ajax(recvType, waitId) {

	for ( var stackId = 0; stackId < AJAX['stack'].length
			&& AJAX['stack'][stackId] != 0; stackId++)
		;
	AJAX['stack'][stackId] = 1;

	var aj = new Object();

	aj.loading = '请稍候...';
	aj.recvType = recvType ? recvType : 'XML';
	aj.waitId = waitId ? $$(waitId) : null;

	aj.resultHandle = null;
	aj.sendString = '';
	aj.targetUrl = '';
	aj.stackId = 0;
	aj.stackId = stackId;

	aj.setLoading = function(loading) {
		if (typeof loading !== 'undefined' && loading !== null)
			aj.loading = loading;
	};

	aj.setRecvType = function(recvtype) {
		aj.recvType = recvtype;
	};

	aj.setWaitId = function(waitid) {
		aj.waitId = typeof waitid == 'object' ? waitid : $$(waitid);
	};

	aj.createXMLHttpRequest = function() {
		var request = false;
		if (window.XMLHttpRequest) {
			request = new XMLHttpRequest();
			if (request.overrideMimeType) {
				request.overrideMimeType('text/xml');
			}
		} else if (window.ActiveXObject) {
			var versions = [ 'Microsoft.XMLHTTP', 'MSXML.XMLHTTP',
					'Microsoft.XMLHTTP', 'Msxml2.XMLHTTP.7.0',
					'Msxml2.XMLHTTP.6.0', 'Msxml2.XMLHTTP.5.0',
					'Msxml2.XMLHTTP.4.0', 'MSXML2.XMLHTTP.3.0',
					'MSXML2.XMLHTTP' ];
			for ( var i = 0; i < versions.length; i++) {
				try {
					request = new ActiveXObject(versions[i]);
					if (request) {
						return request;
					}
				} catch (e) {
				}
			}
		}
		return request;
	};

	aj.XMLHttpRequest = aj.createXMLHttpRequest();
	aj.showLoading = function() {
		if (aj.waitId
				&& (aj.XMLHttpRequest.readyState != 4 || aj.XMLHttpRequest.status != 200)) {
		}
	};

	aj.processHandle = function() {
		if (aj.XMLHttpRequest.readyState == 4
				&& aj.XMLHttpRequest.status == 200) {
			for (k in AJAX['url']) {
				if (AJAX['url'][k] == aj.targetUrl) {
					AJAX['url'][k] = null;
				}
			}
			if (aj.waitId) {
				aj.waitId.style.display = 'none';
			}
			if (aj.recvType == 'HTML') {
				aj.resultHandle(aj.XMLHttpRequest.responseText, aj);
			} else if (aj.recvType == 'XML') {
				if (!aj.XMLHttpRequest.responseXML
						|| !aj.XMLHttpRequest.responseXML.lastChild
						|| aj.XMLHttpRequest.responseXML.lastChild.localName == 'parsererror') {
					aj
							.resultHandle(
									'<a href="'
											+ aj.targetUrl
											+ '" target="_blank" style="color:red">内部错误，无法显示此内容</a>',
									aj);
				} else {
					aj
							.resultHandle(
									aj.XMLHttpRequest.responseXML.lastChild.firstChild.nodeValue,
									aj);
				}
			}
			AJAX['stack'][aj.stackId] = 0;
		}
	};

	aj.get = function(targetUrl, resultHandle) {
		targetUrl = hostconvert(targetUrl);
		setTimeout(function() {
			aj.showLoading()
		}, 250);
		if (in_array(targetUrl, AJAX['url'])) {
			return false;
		} else {
			AJAX['url'].push(targetUrl);
		}
		aj.targetUrl = targetUrl;
		aj.XMLHttpRequest.onreadystatechange = aj.processHandle;
		aj.resultHandle = resultHandle;
		var attackevasive = isUndefined(attackevasive) ? 0 : attackevasive;
		var delay = attackevasive & 1 ? (aj.stackId + 1) * 1001 : 100;
		if (window.XMLHttpRequest) {
			setTimeout(function() {
				aj.XMLHttpRequest.open('GET', aj.targetUrl);
				aj.XMLHttpRequest.setRequestHeader('X-Requested-With',
						'XMLHttpRequest');
				aj.XMLHttpRequest.send(null);
			}, delay);
		} else {
			setTimeout(function() {
				aj.XMLHttpRequest.open("GET", targetUrl, true);
				aj.XMLHttpRequest.setRequestHeader('X-Requested-With',
						'XMLHttpRequest');
				aj.XMLHttpRequest.send();
			}, delay);
		}
	};
	aj.post = function(targetUrl, sendString, resultHandle) {
		targetUrl = hostconvert(targetUrl);
		setTimeout(function() {
			aj.showLoading()
		}, 250);
		if (in_array(targetUrl, AJAX['url'])) {
			return false;
		} else {
			AJAX['url'].push(targetUrl);
		}
		aj.targetUrl = targetUrl;
		aj.sendString = sendString;
		aj.XMLHttpRequest.onreadystatechange = aj.processHandle;
		aj.resultHandle = resultHandle;
		aj.XMLHttpRequest.open('POST', targetUrl);
		aj.XMLHttpRequest.setRequestHeader('Content-Type',
				'application/x-www-form-urlencoded');
		aj.XMLHttpRequest
				.setRequestHeader('X-Requested-With', 'XMLHttpRequest');
		aj.XMLHttpRequest.send(aj.sendString);
	};
	return aj;
}

function getHost(url) {
	var host = "null";
	if (typeof url == "undefined" || null == url) {
		url = window.location.href;
	}
	var regex = /.*\:\/\/([^\/]*).*/;
	var match = url.match(regex);
	if (typeof match != "undefined" && null != match) {
		host = match[1];
	}
	return host;
}

function hostconvert(url) {
	if (!url.match(/^https?:\/\//)) {
		if (url[0] == '/') {
		} else {
		}
	}

	var url_host = getHost(url);
	var cur_host = getHost().toLowerCase();
	if (url_host && cur_host != url_host) {
		url = url.replace(url_host, cur_host);
	}
	return url;
}

function newfunction(func) {
	var args = [];
	for ( var i = 1; i < arguments.length; i++)
		args.push(arguments[i]);
	return function(event) {
		doane(event);
		window[func].apply(window, args);
		return false;
	}
}

function evalscript(s) {
	if (s.indexOf('<script') == -1)
		return s;
	var p = /<script[^\>]*?>([^\x00]*?)<\/script>/ig;
	var arr = [];
	while (arr = p.exec(s)) {
		var p1 = /<script[^\>]*?src=\"([^\>]*?)\"[^\>]*?(reload=\"1\")?(?:charset=\"([\w\-]+?)\")?><\/script>/i;
		var arr1 = [];
		arr1 = p1.exec(arr[0]);
		if (arr1) {
			appendscript(arr1[1], '', arr1[2], arr1[3]);
		} else {
			p1 = /<script(.*?)>([^\x00]+?)<\/script>/i;
			arr1 = p1.exec(arr[0]);
			appendscript('', arr1[2], arr1[1].indexOf('reload=') != -1);
		}
	}
	return s;
}

function appendscript(src, text, reload, charset) {
	var id = hash(src + text);
	var evalscripts = [];
	if (!reload && in_array(id, evalscripts))
		return;
	if (reload && $$(id)) {
		$$(id).parentNode.removeChild($$(id));
	}

	evalscripts.push(id);
	var scriptNode = document.createElement("script");
	scriptNode.type = "text/javascript";
	scriptNode.id = id;
	scriptNode.charset = charset ? charset
			: (BROWSER.firefox ? document.characterSet : document.charset);
	try {
		if (src) {
			scriptNode.src = src;
		} else if (text) {
			scriptNode.text = text;
		}
		$$('append_parent').appendChild(scriptNode);
	} catch (e) {
	}
}

function stripscript(s) {
	return s.replace(/<script.*?>.*?<\/script>/ig, '');
}

function ajaxupdateevents(obj, tagName) {
	tagName = tagName ? tagName : 'A';
	var objs = obj.getElementsByTagName(tagName);
	for (k in objs) {
		var o = objs[k];
		ajaxupdateevent(o);
	}
}

function ajaxupdateevent(o) {
	if (typeof o == 'object' && o.getAttribute) {
		if (o.getAttribute('ajaxtarget')) {
			if (!o.id)
				o.id = Math.random();
			var ajaxevent = o.getAttribute('ajaxevent') ? o
					.getAttribute('ajaxevent') : 'click';
			var ajaxurl = o.getAttribute('ajaxurl') ? o.getAttribute('ajaxurl')
					: o.href;
			_attachEvent(o, ajaxevent, newfunction('ajaxget', ajaxurl, o
					.getAttribute('ajaxtarget'), o.getAttribute('ajaxwaitid'),
					o.getAttribute('ajaxloading'), o
							.getAttribute('ajaxdisplay')));
			if (o.getAttribute('ajaxfunc')) {
				o.getAttribute('ajaxfunc').match(/(\w+)\((.+?)\)/);
				_attachEvent(o, ajaxevent, newfunction(RegExp.$1, RegExp.$2));
			}
		}
	}
}

function ajaxget(url, showid, waitid, loading, display, recall, msg) {

	waitid = typeof waitid == 'undefined' || waitid === null ? showid : waitid;
	var x = new Ajax();

	// 5jj
	yun_loading_msg();
	// showloading(typeof msg == 'undefined'?undefined:msg);

	x.setLoading(loading);
	x.setWaitId(waitid);
	x.display = typeof display == 'undefined' || display == null ? '' : display;
	x.showId = $$(showid);
	if (x.showId)
		x.showId.orgdisplay = typeof x.showId.orgdisplay === 'undefined' ? x.showId.style.display
				: x.showId.orgdisplay;

	if (url.substr(strlen(url) - 1) == '#') {
		url = url.substr(0, strlen(url) - 1);
		x.autogoto = 1;
	}
	var url = url + '&inajax=1&ajaxtarget=' + showid;
	x.get(url, function(s, x) {
		var evaled = false;
		if (s.indexOf('ajaxerror') != -1) {
			evalscript(s);
			evaled = true;
		}
		if (!evaled && (typeof ajaxerror == 'undefined' || !ajaxerror)) {
			if (x.showId) {
				x.showId.style.display = x.showId.orgdisplay;
				x.showId.style.display = x.display;
				x.showId.orgdisplay = x.showId.style.display;
				ajaxinnerhtml(x.showId, s);
				ajaxupdateevents(x.showId);
				if (x.autogoto)
					scroll(0, x.showId.offsetTop);
			}
		}

		ajaxerror = null;
		if (typeof recall == 'function') {
			recall();
		} else {
			eval(recall);
		}
		if (!evaled)
			evalscript(s);
	});
}

function ajaxpost(formid, showid, waitid, showidclass, submitbtn, recall) {

	var waitid = typeof waitid == 'undefined' || waitid === null ? showid
			: (waitid !== '' ? waitid : '');
	var showidclass;
	var ajaxframeid = 'ajaxframe';
	var ajaxframe = $$(ajaxframeid);
	var formtarget = $$(formid).target;

	// showloading();
	yun_loading_msg();

	var handleResult = function() {
		var s = '';
		var evaled = false;

		try {
			s = $$(ajaxframeid).contentWindow.document.XMLDocument.text;
		} catch (e) {
			try {
				s = $$(ajaxframeid).contentWindow.document.documentElement.firstChild.wholeText;
			} catch (e) {
				try {
					s = $$(ajaxframeid).contentWindow.document.documentElement.firstChild.nodeValue;
				} catch (e) {
					s = 'JS内部错误';
				}
			}
		}

		if (s != '' && s.indexOf('ajaxerror') != -1) {
			evalscript(s);
			evaled = true;
		}

		if (submitbtn) {
			submitbtn.disabled = false;
		}
		ajaxerror = null;
		if ($$(formid))
			$$(formid).target = formtarget;
		if (typeof recall == 'function') {
			recall();
		} else {
			eval(recall);
		}
		if (!evaled)
			evalscript(s);
		ajaxframe.loading = 0;
		$$('append_parent').removeChild(ajaxframe.parentNode);
	};
	if (!ajaxframe) {
		var div = document.createElement('div');
		div.style.display = 'none';
		div.innerHTML = '<iframe name="' + ajaxframeid + '" id="' + ajaxframeid
				+ '" loading="1"></iframe>';
		$$('append_parent').appendChild(div);
		ajaxframe = $$(ajaxframeid);
	} else if (ajaxframe.loading) {
		return false;
	}

	_attachEvent(ajaxframe, 'load', handleResult);

	$$(formid).target = ajaxframeid;
	var action = $$(formid).getAttribute('action');
	action = hostconvert(action);
	$$(formid).action = action.replace(/\&inajax\=1/g, '') + '&inajax=1';

	$$(formid).submit();
	if (submitbtn) {
		submitbtn.disabled = true;
	}

	doane();
	return false;
}

function ajaxmenu(ctrlObj, timeout, cache, duration, pos, recall, idclass) {
	if (!ctrlObj.getAttribute('mid')) {
		var ctrlid = ctrlObj.id;
		if (!ctrlid) {
			ctrlObj.id = 'ajaxid_' + Math.random();
		}
	} else {
		var ctrlid = ctrlObj.getAttribute('mid');
		if (!ctrlObj.id) {
			ctrlObj.id = 'ajaxid_' + Math.random();
		}
	}
	var menuid = ctrlid + '_menu';
	var menu = $$(menuid);
	if (isUndefined(timeout))
		timeout = 3000;
	if (isUndefined(cache))
		cache = 1;
	if (isUndefined(pos))
		pos = '43';
	if (isUndefined(duration))
		duration = timeout > 0 ? 0 : 3;
	if (isUndefined(idclass))
		idclass = 'p_pop';
	var func = function() {
		showMenu({
			'ctrlid' : ctrlObj.id,
			'menuid' : menuid,
			'duration' : duration,
			'timeout' : timeout,
			'pos' : pos,
			'cache' : cache,
			'layer' : 2
		});
		if (typeof recall == 'function') {
			recall();
		} else {
			eval(recall);
		}
	};

	if (menu) {
		if (menu.style.display == '') {
			hideMenu(menuid);
		} else {
			func();
		}
	} else {
		menu = document.createElement('div');
		menu.id = menuid;
		menu.style.display = 'none';
		menu.className = idclass;
		menu.innerHTML = '<div class="p_opt" id="' + menuid
				+ '_content"></div>';
		$$('append_parent').appendChild(menu);
		var url = (!isUndefined(ctrlObj.href) ? ctrlObj.href
				: ctrlObj.attributes['href'].value);
		url += (url.indexOf('?') != -1 ? '&' : '?') + 'ajaxmenu=1';
		ajaxget(url, menuid + '_content', 'ajaxwaitid', '', '', func);
	}
	doane();
}

function hash(string, length) {
	var length = length ? length : 32;
	var start = 0;
	var i = 0;
	var result = '';
	filllen = length - string.length % length;
	for (i = 0; i < filllen; i++) {
		string += "0";
	}
	while (start < string.length) {
		result = stringxor(result, string.substr(start, length));
		start += length;
	}
	return result;
}

function stringxor(s1, s2) {
	var s = '';
	var hash = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	var max = Math.max(s1.length, s2.length);
	for ( var i = 0; i < max; i++) {
		var k = s1.charCodeAt(i) ^ s2.charCodeAt(i);
		s += hash.charAt(k % 52);
	}
	return s;
}

function ajaxinnerhtml(showid, s) {

	// 5jj
	if (showid == null)
		showid = 'ayaya_temp48568231';

	if (showid.tagName != 'TBODY') {
		showid.innerHTML = s;
	} else {
		while (showid.firstChild) {
			showid.firstChild.parentNode.removeChild(showid.firstChild);
		}
		var div1 = document.createElement('DIV');
		div1.id = showid.id + '_div';
		div1.innerHTML = '<table><tbody id="' + showid.id + '_tbody">' + s
				+ '</tbody></table>';
		$$('append_parent').appendChild(div1);
		var trs = div1.getElementsByTagName('TR');
		var l = trs.length;
		for ( var i = 0; i < l; i++) {
			showid.appendChild(trs[0]);
		}
		var inputs = div1.getElementsByTagName('INPUT');
		var l = inputs.length;
		for ( var i = 0; i < l; i++) {
			showid.appendChild(inputs[0]);
		}
		div1.parentNode.removeChild(div1);
	}
}

function doane(event) {
	e = event ? event : window.event;
	if (!e) {
		e = getEvent();
	}
	if (!e) {
		return null;
	}
	if (e.preventDefault) {
		e.preventDefault();
	} else {
		e.returnValue = false;
	}
	if (e.stopPropagation) {
		e.stopPropagation();
	} else {
		e.cancelBubble = true;
	}
	return e;
}

function showMenu(v) {
	var ctrlid = isUndefined(v['ctrlid']) ? v : v['ctrlid'];
	var showid = isUndefined(v['showid']) ? ctrlid : v['showid'];
	var menuid = isUndefined(v['menuid']) ? showid + '_menu' : v['menuid'];
	var ctrlObj = $$(ctrlid);
	var menuObj = $$(menuid);
	if (!menuObj)
		return;
	var mtype = isUndefined(v['mtype']) ? 'menu' : v['mtype'];
	var evt = isUndefined(v['evt']) ? 'mouseover' : v['evt'];
	var pos = isUndefined(v['pos']) ? '43' : v['pos'];
	var layer = isUndefined(v['layer']) ? 1 : v['layer'];
	var duration = isUndefined(v['duration']) ? 2 : v['duration'];
	var timeout = isUndefined(v['timeout']) ? 250 : v['timeout'];
	// 5jj
	var maxh = isUndefined(v['maxh']) ? 600 : v['maxh'];
	var cache = isUndefined(v['cache']) ? 1 : v['cache'];
	var drag = isUndefined(v['drag']) ? '' : v['drag'];
	var dragobj = drag && $$(drag) ? $$(drag) : menuObj;
	var fade = isUndefined(v['fade']) ? 0 : v['fade'];
	var cover = isUndefined(v['cover']) ? 0 : v['cover'];
	var zindex = isUndefined(v['zindex']) ? JSMENU['zIndex']['menu']
			: v['zindex'];
	var winhandlekey = isUndefined(v['win']) ? '' : v['win'];
	zindex = cover ? zindex + 200 : zindex;
	if (typeof JSMENU['active'][layer] == 'undefined') {
		JSMENU['active'][layer] = [];
	}

	if (evt == 'click' && in_array(menuid, JSMENU['active'][layer])
			&& mtype != 'win') {
		hideMenu(menuid, mtype);
		return;
	}
	if (mtype == 'menu') {
		hideMenu(layer, mtype);
	}

	if (ctrlObj) {
		if (!ctrlObj.initialized) {
			ctrlObj.initialized = true;
			ctrlObj.unselectable = true;

			ctrlObj.outfunc = typeof ctrlObj.onmouseout == 'function' ? ctrlObj.onmouseout
					: null;
			ctrlObj.onmouseout = function() {
				if (this.outfunc)
					this.outfunc();
				if (duration < 3 && !JSMENU['timer'][menuid])
					JSMENU['timer'][menuid] = setTimeout('hideMenu(\'' + menuid
							+ '\', \'' + mtype + '\')', timeout);
			};

			ctrlObj.overfunc = typeof ctrlObj.onmouseover == 'function' ? ctrlObj.onmouseover
					: null;
			ctrlObj.onmouseover = function(e) {
				doane(e);
				if (this.overfunc)
					this.overfunc();
				if (evt == 'click') {
					clearTimeout(JSMENU['timer'][menuid]);
					JSMENU['timer'][menuid] = null;
				} else {
					for ( var i in JSMENU['timer']) {
						if (JSMENU['timer'][i]) {
							clearTimeout(JSMENU['timer'][i]);
							JSMENU['timer'][i] = null;
						}
					}
				}
			};
		}
	}

	var dragMenu = function(menuObj, e, op) {
		e = e ? e : window.event;
		if (op == 1) {
			if (in_array(BROWSER.ie ? e.srcElement.tagName : e.target.tagName,
					[ 'TEXTAREA', 'INPUT', 'BUTTON', 'SELECT' ])) {
				return;
			}
			JSMENU['drag'] = [ e.clientX, e.clientY ];
			JSMENU['drag'][2] = parseInt(menuObj.style.left);
			JSMENU['drag'][3] = parseInt(menuObj.style.top);
			document.onmousemove = function(e) {
				try {
					dragMenu(menuObj, e, 2);
				} catch (err) {
				}
			};
			document.onmouseup = function(e) {
				try {
					dragMenu(menuObj, e, 3);
				} catch (err) {
				}
			};
			doane(e);
		} else if (op == 2 && JSMENU['drag'][0]) {
			var menudragnow = [ e.clientX, e.clientY ];
			menuObj.style.left = (JSMENU['drag'][2] + menudragnow[0] - JSMENU['drag'][0])
					+ 'px';
			menuObj.style.top = (JSMENU['drag'][3] + menudragnow[1] - JSMENU['drag'][1])
					+ 'px';
			doane(e);
		} else if (op == 3) {
			JSMENU['drag'] = [];
			document.onmousemove = null;
			document.onmouseup = null;
		}
	};

	if (!menuObj.initialized) {
		menuObj.initialized = true;
		menuObj.ctrlkey = ctrlid;
		menuObj.mtype = mtype;
		menuObj.layer = layer;
		menuObj.cover = cover;
		if (ctrlObj && ctrlObj.getAttribute('fwin')) {
			menuObj.scrolly = true;
		}
		menuObj.style.position = 'absolute';
		menuObj.style.zIndex = zindex + layer;
		menuObj.onclick = function(e) {
			if (!e || BROWSER.ie) {
				window.event.cancelBubble = true;
				return window.event;
			} else {
				e.stopPropagation();
				return e;
			}
		};
		if (duration < 3) {
			if (duration > 1) {
				menuObj.onmouseover = function() {
					clearTimeout(JSMENU['timer'][menuid]);
					JSMENU['timer'][menuid] = null;
				};
			}
			if (duration != 1) {
				menuObj.onmouseout = function() {
					JSMENU['timer'][menuid] = setTimeout('hideMenu(\'' + menuid
							+ '\', \'' + mtype + '\')', timeout);
				};
			}
		}
		if (cover) {
			var coverObj = document.createElement('div');
			coverObj.id = menuid + '_cover';
			coverObj.style.position = 'absolute';
			coverObj.style.zIndex = menuObj.style.zIndex - 1;
			coverObj.style.left = coverObj.style.top = '0px';
			coverObj.style.width = '100%';
			coverObj.style.height = document.body.offsetHeight + 'px';
			coverObj.style.backgroundColor = '#000';
			coverObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity=50)';
			coverObj.style.opacity = 0.5;
			$$('append_parent').appendChild(coverObj);
			_attachEvent(window, 'load', function() {
				coverObj.style.height = document.body.offsetHeight + 'px';
			}, document);
		}
	}
	if (drag) {
		dragobj.style.cursor = 'move';
		dragobj.onmousedown = function(event) {
			try {
				dragMenu(menuObj, event, 1);
			} catch (e) {
			}
		};
	}
	menuObj.style.display = '';
	if (cover)
		$$(menuid + '_cover').style.display = '';
	if (fade) {
		var O = 0;
		var fadeIn = function(O) {
			if (O == 100) {
				clearTimeout(fadeInTimer);
				return;
			}
			menuObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity='
					+ O + ')';
			menuObj.style.opacity = O / 100;
			O += 10;
			var fadeInTimer = setTimeout(function() {
				fadeIn(O);
			}, 50);
		};
		fadeIn(O);
		menuObj.fade = true;
	} else {
		menuObj.fade = false;
	}
	if (pos != '*') {
		setMenuPosition(showid, menuid, pos);
	}
	if (BROWSER.ie && BROWSER.ie < 7 && winhandlekey
			&& $$('fwin_' + winhandlekey)) {
		$$(menuid).style.left = (parseInt($$(menuid).style.left) - parseInt($$('fwin_'
				+ winhandlekey).style.left))
				+ 'px';
		$$(menuid).style.top = (parseInt($$(menuid).style.top) - parseInt($$('fwin_'
				+ winhandlekey).style.top))
				+ 'px';
	}
	if (maxh && menuObj.scrollHeight > maxh) {
		menuObj.style.height = maxh + 'px';
		if (BROWSER.opera) {
			menuObj.style.overflow = 'auto';
		} else {
			menuObj.style.overflowY = 'auto';
		}
	}

	if (!duration) {
		setTimeout('hideMenu(\'' + menuid + '\', \'' + mtype + '\')', timeout);
	}

	if (!in_array(menuid, JSMENU['active'][layer]))
		JSMENU['active'][layer].push(menuid);
	menuObj.cache = cache;
	if (layer > JSMENU['layer']) {
		JSMENU['layer'] = layer;
	}
}

function setMenuPosition(showid, menuid, pos) {
	var showObj = $$(showid);
	var menuObj = menuid ? $$(menuid) : $$(showid + '_menu');
	if (isUndefined(pos))
		pos = '43';
	var basePoint = parseInt(pos.substr(0, 1));
	var direction = parseInt(pos.substr(1, 1));
	var sxy = 0, sx = 0, sy = 0, sw = 0, sh = 0, ml = 0, mt = 0, mw = 0, mcw = 0, mh = 0, mch = 0, bpl = 0, bpt = 0;

	if (!menuObj || (basePoint > 0 && !showObj))
		return;
	if (showObj) {
		sxy = fetchOffset(showObj);
		sx = sxy['left'];
		sy = sxy['top'];
		sw = showObj.offsetWidth;
		sh = showObj.offsetHeight;
	}
	mw = menuObj.offsetWidth;
	mcw = menuObj.clientWidth;
	mh = menuObj.offsetHeight;
	mch = menuObj.clientHeight;

	switch (basePoint) {
	case 1:
		bpl = sx;
		bpt = sy;
		break;
	case 2:
		bpl = sx + sw;
		bpt = sy;
		break;
	case 3:
		bpl = sx + sw;
		bpt = sy + sh;
		break;
	case 4:
		bpl = sx;
		bpt = sy + sh;
		break;
	}
	switch (direction) {
	case 0:
		menuObj.style.left = (document.body.clientWidth - menuObj.clientWidth)
				/ 2 + 'px';
		mt = (document.documentElement.clientHeight - menuObj.clientHeight) / 2;
		break;
	case 1:
		ml = bpl - mw;
		mt = bpt - mh;
		break;
	case 2:
		ml = bpl;
		mt = bpt - mh;
		break;
	case 3:
		ml = bpl;
		mt = bpt;
		break;
	case 4:
		ml = bpl - mw;
		mt = bpt;
		break;
	}
	var scrollTop = Math.max(document.documentElement.scrollTop,
			document.body.scrollTop);
	var scrollLeft = Math.max(document.documentElement.scrollLeft,
			document.body.scrollLeft);
	if (in_array(direction, [ 1, 4 ]) && ml < 0) {
		ml = bpl;
		if (in_array(basePoint, [ 1, 4 ]))
			ml += sw;
	} else if (ml + mw > scrollLeft + document.body.clientWidth && sx >= mw) {
		ml = bpl - mw;
		if (in_array(basePoint, [ 2, 3 ]))
			ml -= sw;
	}
	if (in_array(direction, [ 1, 2 ]) && mt < 0) {
		mt = bpt;
		if (in_array(basePoint, [ 1, 2 ]))
			mt += sh;
	} else if (mt + mh > scrollTop + document.documentElement.clientHeight
			&& sy >= mh) {
		mt = bpt - mh;
		if (in_array(basePoint, [ 3, 4 ]))
			mt -= sh;
	}
	if (pos == '210') {
		ml += 69 - sw / 2;
		mt -= 5;
		if (showObj.tagName == 'TEXTAREA') {
			ml -= sw / 2;
			mt += sh / 2;
		}
	}
	if (direction == 0 || menuObj.scrolly) {
		if (BROWSER.ie && BROWSER.ie < 7) {
			if (direction == 0)
				mt += scrollTop;
		} else {
			if (menuObj.scrolly)
				mt -= scrollTop;
			menuObj.style.position = 'fixed';
		}
	}
	if (ml)
		menuObj.style.left = ml + 'px';
	if (mt)
		menuObj.style.top = mt + 'px';
	if (direction == 0 && BROWSER.ie && !document.documentElement.clientHeight) {
		menuObj.style.position = 'absolute';
		menuObj.style.top = (document.body.clientHeight - menuObj.clientHeight)
				/ 2 + 'px';
	}
	if (menuObj.style.clip && !BROWSER.opera) {
		menuObj.style.clip = 'rect(auto, auto, auto, auto)';
	}
}

function hideMenu(attr, mtype) {
	attr = isUndefined(attr) ? '' : attr;
	mtype = isUndefined(mtype) ? 'menu' : mtype;
	if (attr == '') {
		for ( var i = 1; i <= JSMENU['layer']; i++) {
			hideMenu(i, mtype);
		}
		return;
	} else if (typeof attr == 'number') {
		for ( var j in JSMENU['active'][attr]) {
			hideMenu(JSMENU['active'][attr][j], mtype);
		}
		return;
	} else if (typeof attr == 'string') {
		var menuObj = $$(attr);
		if (!menuObj || (mtype && menuObj.mtype != mtype))
			return;
		clearTimeout(JSMENU['timer'][attr]);
		var hide = function() {
			if (menuObj.cache) {
				menuObj.style.display = 'none';
				if (menuObj.cover)
					$$(attr + '_cover').style.display = 'none';
			} else {
				menuObj.parentNode.removeChild(menuObj);
				if (menuObj.cover)
					$$(attr + '_cover').parentNode.removeChild($$(attr
							+ '_cover'));
			}
			var tmp = [];
			for ( var k in JSMENU['active'][menuObj.layer]) {
				if (attr != JSMENU['active'][menuObj.layer][k])
					tmp.push(JSMENU['active'][menuObj.layer][k]);
			}
			JSMENU['active'][menuObj.layer] = tmp;
		};
		if (menuObj.fade) {
			var O = 100;
			var fadeOut = function(O) {
				if (O == 0) {
					clearTimeout(fadeOutTimer);
					hide();
					return;
				}
				menuObj.style.filter = 'progid:DXImageTransform.Microsoft.Alpha(opacity='
						+ O + ')';
				menuObj.style.opacity = O / 100;
				O -= 10;
				var fadeOutTimer = setTimeout(function() {
					fadeOut(O);
				}, 50);
			};
			fadeOut(O);
		} else {
			hide();
		}
	}
}

function getCurrentStyle(obj, cssproperty, csspropertyNS) {
	if (obj.style[cssproperty]) {
		return obj.style[cssproperty];
	}
	if (obj.currentStyle) {
		return obj.currentStyle[cssproperty];
	} else if (document.defaultView.getComputedStyle(obj, null)) {
		var currentStyle = document.defaultView.getComputedStyle(obj, null);
		var value = currentStyle.getPropertyValue(csspropertyNS);
		if (!value) {
			value = currentStyle[cssproperty];
		}
		return value;
	} else if (window.getComputedStyle) {
		var currentStyle = window.getComputedStyle(obj, "");
		return currentStyle.getPropertyValue(csspropertyNS);
	}
}

function fetchOffset(obj, mode) {

	var left_offset = 0, top_offset = 0, mode = !mode ? 0 : mode;

	if (obj.getBoundingClientRect && !mode) {
		var rect = obj.getBoundingClientRect();
		var scrollTop = Math.max(document.documentElement.scrollTop,
				document.body.scrollTop);
		var scrollLeft = Math.max(document.documentElement.scrollLeft,
				document.body.scrollLeft);
		if (document.documentElement.dir == 'rtl') {
			scrollLeft = scrollLeft + document.documentElement.clientWidth
					- document.documentElement.scrollWidth;
		}
		left_offset = rect.left + scrollLeft
				- document.documentElement.clientLeft;
		top_offset = rect.top + scrollTop - document.documentElement.clientTop;
	}

	if (left_offset <= 0 || top_offset <= 0) {
		left_offset = obj.offsetLeft;
		top_offset = obj.offsetTop;
		while ((obj = obj.offsetParent) != null) {
			position = getCurrentStyle(obj, 'position', 'position');
			if (position == 'relative') {
				continue;
			}
			left_offset += obj.offsetLeft;
			top_offset += obj.offsetTop;
		}
	}
	return {
		'left' : left_offset,
		'top' : top_offset
	};
}

function showPrompt(ctrlid, evt, msg, timeout, type) {
	var menuid = ctrlid ? ctrlid + '_pmenu' : 'ntcwin';
	var duration = timeout ? 0 : 3;
	if ($$(menuid)) {
		$$(menuid).parentNode.removeChild($$(menuid));
	}
	var div = document.createElement('div');
	div.id = menuid;
	div.className = ctrlid ? 'prmm up' : 'ntcwin';
	div.style.display = 'none';
	$$('append_parent').appendChild(div);
	if (ctrlid) {
		msg = '<div id="' + ctrlid + '_prompt" class="prmc"><ul><li>' + msg
				+ '</li></ul></div>';
	}
	div.innerHTML = msg;
	if (ctrlid) {
		if (!timeout) {
			evt = 'click';
		}
		if ($$(ctrlid).evt !== false) {
			var prompting = function() {
				showMenu({
					'mtype' : 'prompt',
					'ctrlid' : ctrlid,
					'evt' : evt,
					'menuid' : menuid,
					'pos' : '210'
				});
			};
			if (evt == 'click') {
				$$(ctrlid).onclick = prompting;
			} else {
				$$(ctrlid).onmouseover = prompting;
			}
		}
		showMenu({
			'mtype' : 'prompt',
			'ctrlid' : ctrlid,
			'evt' : evt,
			'menuid' : menuid,
			'pos' : '210',
			'duration' : duration,
			'timeout' : timeout,
			'zindex' : JSMENU['zIndex']['prompt']
		});
		$$(ctrlid).unselectable = false;

	} else {
		showMenu({
			'mtype' : 'prompt',
			'pos' : '00',
			'menuid' : menuid,
			'duration' : duration,
			'timeout' : timeout,
			'zindex' : JSMENU['zIndex']['prompt']
		});

		if (type != 'loading') {
			$$(menuid).style.top = '25%';
		}
	}
}
function showDialog(msg, mode, t, func, cover, funccancel, leftmsg, confirmtxt,
		canceltxt) {
	cover = isUndefined(cover) ? (mode == 'info' ? 0 : 1) : cover;
	leftmsg = isUndefined(leftmsg) ? '' : leftmsg;
	mode = in_array(mode, [ 'confirm', 'notice', 'info' ]) ? mode : 'alert';
	var menuid = 'fwin_dialog';
	var menuObj = $$(menuid);
	confirmtxt = confirmtxt ? confirmtxt : '确定';
	canceltxt = canceltxt ? canceltxt : '取消';

	if (menuObj)
		hideMenu('fwin_dialog', 'dialog');
	menuObj = document.createElement('div');
	menuObj.style.display = 'none';
	menuObj.className = 'fwinmask';
	menuObj.id = menuid;
	$$('append_parent').appendChild(menuObj);
	var s = '<table cellpadding="0" cellspacing="0" class="fwin"><tr><td class="t_l"></td><td class="t_c"></td><td class="t_r"></td></tr><tr><td class="m_l">&nbsp;&nbsp;</td><td class="m_c"><h3 class="flb"><em>';
	s += t ? t : '提示信息';
	s += '</em><span><a href="javascript:;" id="fwin_dialog_close" class="flbc" onclick="hideMenu(\''
			+ menuid + '\', \'dialog\')" title="关闭">关闭</a></span></h3>';
	if (mode == 'info') {
		s += msg ? msg : '';
	} else {
		s += '<div class="c altw"><div class="'
				+ (mode == 'alert' ? 'alert_error' : 'alert_info') + '"><p>'
				+ msg + '</p></div></div>';
		s += '<p class="o pns">'
				+ (leftmsg ? '<span class="z xg1">' + leftmsg + '</span>' : '')
				+ '<button id="fwin_dialog_submit" value="true" class="pn pnc"><strong>'
				+ confirmtxt + '</strong></button>';
		s += mode == 'confirm' ? '<button id="fwin_dialog_cancel" value="true" class="pn" onclick="hideMenu(\''
				+ menuid
				+ '\', \'dialog\')"><strong>'
				+ canceltxt
				+ '</strong></button>'
				: '';
		s += '</p>';
	}
	s += '</td><td class="m_r"></td></tr><tr><td class="b_l"></td><td class="b_c"></td><td class="b_r"></td></tr></table>';
	menuObj.innerHTML = s;
	if ($$('fwin_dialog_submit'))
		$$('fwin_dialog_submit').onclick = function() {
			if (typeof func == 'function')
				func();
			else
				eval(func);
			hideMenu(menuid, 'dialog');
		};
	if ($$('fwin_dialog_cancel')) {
		$$('fwin_dialog_cancel').onclick = function() {
			if (typeof funccancel == 'function')
				funccancel();
			else
				eval(funccancel);
			hideMenu(menuid, 'dialog');
		};
		$$('fwin_dialog_close').onclick = $$('fwin_dialog_cancel').onclick;
	}

	showMenu({
		'mtype' : 'dialog',
		'menuid' : menuid,
		'duration' : 3,
		'pos' : '00',
		'zindex' : JSMENU['zIndex']['dialog'],
		'cache' : 0,
		'cover' : cover
	});
}

function showWindow(k, url, mode, cache, menuv) {

	mode = isUndefined(mode) ? 'get' : mode;
	cache = isUndefined(cache) ? 1 : cache;
	var menuid = 'fwin_' + k;
	var menuObj = $$(menuid);
	var drag = null;
	var loadingst = null;

	var fetchContent = function() {
		if (mode == 'get') {
			menuObj.url = url;
			url += (url.search(/\?/) > 0 ? '&' : '?')
					+ 'infloat=yes&handlekey=' + k;
			url += cache == -1 ? '&t=' + (+new Date()) : '';
			ajaxget(url, 'fwin_content_' + k, null, '', '', function() {
				initMenu();
				show();
			});
		} else if (mode == 'post') {
			menuObj.act = $$(url).action;
			ajaxpost(url, 'fwin_content_' + k, '', '', '', function() {
				initMenu();
				show();
			});
		}

	};
	var initMenu = function() {
		clearTimeout(loadingst);
		var objs = menuObj.getElementsByTagName('*');
		var fctrlidinit = false;
		for ( var i = 0; i < objs.length; i++) {
			if (objs[i].id) {
				objs[i].setAttribute('fwin', k);
			}
			if (objs[i].className == 'flb' && !fctrlidinit) {
				if (!objs[i].id)
					objs[i].id = 'fctrl_' + k;
				drag = objs[i].id;
				fctrlidinit = true;
			}
		}
	};
	var show = function() {

		hideMenu('fwin_dialog', 'dialog');
		v = {
			'mtype' : 'win',
			'menuid' : menuid,
			'duration' : 3,
			'pos' : '00',
			'zindex' : JSMENU['zIndex']['win'],
			'drag' : typeof drag == null ? '' : drag,
			'cache' : cache
		};
		for (k in menuv) {
			v[k] = menuv[k];
		}
		showMenu(v);
	};

	if (!menuObj) {
		menuObj = document.createElement('div');
		menuObj.id = menuid;
		menuObj.style.display = 'none';
		menuObj.className = 'fwinmask';
		$$('append_parent').appendChild(menuObj);

		$open = '<h3 class="flb" id="layer_title" fwin="register" style="cursor: move;"><span><a title="关闭" onclick="hidewin()" class="flbc" href="javascript:;">关闭</a></span></h3>';

		menuObj.innerHTML = '<table cellpadding="0" cellspacing="0" class="fwin"><tr><td class="t_l"></td><td class="t_c" ondblclick="hideWindow(\''
				+ k
				+ '\')"></td><td class="t_r"></td></tr><tr><td class="m_l" ondblclick="hideWindow(\''
				+ k
				+ '\')"><span></span></td><td class="m_c">'
				+ $open
				+ '<div class="row-fluid" id="fwin_content_'
				+ k
				+ '"></div></td><td class="m_r" ondblclick="hideWindow(\''
				+ k
				+ '\')"></td></tr><tr><td class="b_l"></td><td class="b_c" ondblclick="hideWindow(\''
				+ k + '\')"></td><td class="b_r"></td></tr></table>';

		if (mode == 'html') {
			$$('fwin_content_' + k).innerHTML = url;
			initMenu();
			show();
		} else {
			fetchContent();
		}
	} else if ((mode == 'get' && (url != menuObj.url || cache != 1))
			|| (mode == 'post' && $$(url).action != menuObj.act)) {

		fetchContent();

	} else {
		show();
	}
	doane();
	setTimeout(function() {
		$("#jLoading").fadeOut(300)
	}, 100);
}
function hideWindow(k, all, clear) {
	all = isUndefined(all) ? 1 : all;
	clear = isUndefined(clear) ? 1 : clear;
	hideMenu('fwin_' + k, 'win');
	if (clear && $$('fwin_' + k)) {
		$$('append_parent').removeChild($$('fwin_' + k));
	}
	if (all) {
		hideMenu();
	}
}

function openDiy() {
	window.location.href = ((window.location.href + '').replace(
			/[\?\&]diy=yes/g, '').split('#')[0] + (window.location.search
			&& window.location.search.indexOf('?diy=yes') < 0 ? '&diy=yes'
			: '?diy=yes'));
}

function hasClass(elem, className) {
	return elem.className
			&& (" " + elem.className + " ").indexOf(" " + className + " ") != -1;
}

function slideshow(el) {
	var obj = this;
	if (!el.id)
		el.id = Math.random();
	if (typeof slideshow.entities == 'undefined') {
		slideshow.entities = {};
	}
	this.id = el.id;
	if (slideshow.entities[this.id])
		return false;
	slideshow.entities[this.id] = this;

	this.slideshows = [];
	this.slidebar = [];
	this.slideother = [];
	this.slidebarup = '';
	this.slidebardown = '';
	this.slidenum = 0;
	this.slidestep = 0;

	this.container = el;
	this.imgs = [];
	this.imgLoad = [];
	this.imgLoaded = 0;
	this.imgWidth = 0;
	this.imgHeight = 0;

	this.getMEvent = function(ele, value) {
		value = !value ? 'mouseover' : value;
		var mevent = !ele ? '' : ele.getAttribute('mevent');
		mevent = (mevent == 'click' || mevent == 'mouseover') ? mevent : value;
		return mevent;
	};
	this.slideshows = $C('slideshow', el);
	this.slideshows = this.slideshows.length > 0 ? this.slideshows[0].childNodes
			: null;
	this.slidebar = $C('slidebar', el);
	this.slidebar = this.slidebar.length > 0 ? this.slidebar[0] : null;
	this.barmevent = this.getMEvent(this.slidebar);
	this.slideother = $C('slideother', el);
	this.slidebarup = $C('slidebarup', el);
	this.slidebarup = this.slidebarup.length > 0 ? this.slidebarup[0] : null;
	this.barupmevent = this.getMEvent(this.slidebarup, 'click');
	this.slidebardown = $C('slidebardown', el);
	this.slidebardown = this.slidebardown.length > 0 ? this.slidebardown[0]
			: null;
	this.bardownmevent = this.getMEvent(this.slidebardown, 'click');
	this.slidenum = parseInt(this.container.getAttribute('slidenum'));
	this.slidestep = parseInt(this.container.getAttribute('slidestep'));
	this.timestep = parseInt(this.container.getAttribute('timestep'));
	this.timestep = !this.timestep ? 2500 : this.timestep;

	this.index = this.length = 0;
	if (!this.slideshows) {
		var nodes = el.childNodes;
		for ( var i = 0, L = nodes.length; i < L; i++) {
			if (nodes[i].nodeType == 1) {
				this.slideshows[this.length] = nodes[i];
			}
		}
	}
	for (i = 0, L = this.slideshows.length; i < L; i++) {
		if (this.slideshows[i].nodeType == 1) {
			this.slideshows[i].style.display = "none";
			this.length += 1;
		}
	}
	for (i = 0, L = this.slideother.length; i < L; i++) {
		for ( var j = 0; j < this.slideother[i].childNodes.length; j++) {
			if (this.slideother[i].childNodes[j].nodeType == 1) {
				this.slideother[i].childNodes[j].style.display = "none";
			}
		}
	}

	if (!this.slidebar) {
		if (!this.slidenum && !this.slidestep) {
			this.container.parentNode.style.position = 'relative';
			this.slidebar = document.createElement('div');
			this.slidebar.className = 'slidebar';
			this.slidebar.style.position = 'absolute';
			this.slidebar.style.top = '5px';
			this.slidebar.style.left = '4px';
			this.slidebar.style.display = 'none';
			var html = '<ul>';
			for ( var i = 0; i < this.length; i++) {
				html += '<li on' + this.barmevent + '="slideshow.entities['
						+ this.id + '].xactive(' + i + '); return false;">'
						+ (i + 1).toString() + '</li>';
			}
			html += '</ul>';
			this.slidebar.innerHTML = html;
			this.container.parentNode.appendChild(this.slidebar);
			this.controls = this.slidebar.getElementsByTagName('li');
		}
	} else {
		this.controls = this.slidebar.childNodes;
		for (i = 0; i < this.controls.length; i++) {
			if (this.slidebarup == this.controls[i]
					|| this.slidebardown == this.controls[i])
				continue;
			_attachEvent(this.controls[i], this.barmevent, function() {
				slidexactive()
			});
		}
	}
	if (this.slidebarup) {
		_attachEvent(this.slidebarup, this.barupmevent, function() {
			slidexactive('up')
		});
	}
	if (this.slidebardown) {
		_attachEvent(this.slidebardown, this.bardownmevent, function() {
			slidexactive('down')
		});
	}
	this.activeByStep = function(index) {
		var showindex = 0, i = 0;
		if (index == 'down') {
			showindex = this.index + 1;
			if (showindex >= this.length) {
				this.runRoll();
			} else {
				for (i = 0; i < this.slidestep; i++) {
					if (showindex >= this.length)
						showindex = 0;
					this.index = this.index - this.slidenum + 1;
					if (this.index < 0)
						this.index = this.length - Math.abs(this.index);
					this.active(showindex);
					showindex++;
				}
			}
		} else if (index == 'up') {
			var tempindex = this.index;
			showindex = this.index - this.slidenum;
			if (showindex < 0)
				return false;
			for (i = 0; i < this.slidestep; i++) {
				if (showindex < 0)
					showindex = this.length - Math.abs(showindex);
				this.active(showindex);
				this.index = tempindex = tempindex - 1;
				if (this.index < 0)
					this.index = this.length - 1;
				showindex--;
			}
		}
		return false;
	};
	this.active = function(index) {
		this.slideshows[this.index].style.display = "none";
		this.slideshows[index].style.display = "block";
		if (this.controls && this.controls.length > 0) {
			this.controls[this.index].className = '';
			this.controls[index].className = 'on';
		}
		for ( var i = 0, L = this.slideother.length; i < L; i++) {
			this.slideother[i].childNodes[this.index].style.display = "none";
			this.slideother[i].childNodes[index].style.display = "block";
		}
		this.index = index;
	};
	this.xactive = function(index) {
		if (!this.slidenum && !this.slidestep) {
			clearTimeout(this.timer);
			if (index == 'down')
				index = this.index == this.length - 1 ? 0 : this.index + 1;
			if (index == 'up')
				index = this.index == 0 ? this.length - 1 : this.index - 1;
			this.active(index);
			var ss = this;
			this.timer = setTimeout(function() {
				ss.run();
			}, 8000);
		} else {
			this.activeByStep(index);
		}
	};
	this.run = function() {
		var index = this.index + 1 < this.length ? this.index + 1 : 0;
		this.active(index);
		var ss = this;
		this.timer = setTimeout(function() {
			ss.run();
		}, this.timestep);
	};

	this.runRoll = function() {
		for ( var i = 0; i < this.slidenum; i++) {
			if (this.slideshows[i]
					&& typeof this.slideshows[i].style != 'undefined')
				this.slideshows[i].style.display = "block";
			for ( var j = 0, L = this.slideother.length; j < L; j++) {
				this.slideother[j].childNodes[i].style.display = "block";
			}
		}
		this.index = this.slidenum - 1;
	};
	var imgs = this.slideshows.length ? this.slideshows[0].parentNode
			.getElementsByTagName('img') : [];
	for (i = 0, L = imgs.length; i < L; i++) {
		this.imgs.push(imgs[i]);
		this.imgLoad.push(new Image());
		this.imgLoad[i].src = this.imgs[i].src;
		this.imgLoad[i].onerror = function() {
			obj.imgLoaded++;
		};
	}

	this.getSize = function() {
		if (this.imgs.length == 0)
			return false;
		var img = this.imgs[0];
		this.imgWidth = img.width ? parseInt(img.width) : 0;
		this.imgHeight = img.height ? parseInt(img.height) : 0;
		var ele = img.parentNode;
		while ((!this.imgWidth || !this.imgHeight)
				&& !hasClass(ele, 'slideshow') && ele != document.body) {
			this.imgWidth = ele.style.width ? parseInt(ele.style.width) : 0;
			this.imgHeight = ele.style.height ? parseInt(ele.style.height) : 0;
			ele = ele.parentNode;
		}
		return true;
	};

	this.getSize();

	this.checkLoad = function() {
		var obj = this;
		for (i = 0; i < this.imgs.length; i++) {
			if (this.imgLoad[i].complete && !this.imgLoad[i].status) {
				this.imgLoaded++;
				this.imgLoad[i].status = 1;
			}
		}
		var percentEle = $$(this.id + '_percent');
		if (this.imgLoaded < this.imgs.length) {
			if (!percentEle) {
				var dom = document.createElement('div');
				dom.id = this.id + "_percent";
				dom.style.width = this.imgWidth ? this.imgWidth + 'px'
						: '150px';
				dom.style.height = this.imgHeight ? this.imgHeight + 'px'
						: '150px';
				dom.style.lineHeight = this.imgHeight ? this.imgHeight + 'px'
						: '150px';
				dom.style.backgroundColor = '#ccc';
				dom.style.textAlign = 'center';
				dom.style.top = '0';
				dom.style.left = '0';
				dom.style.marginLeft = 'auto';
				dom.style.marginRight = 'auto';
				this.slideshows[0].parentNode.appendChild(dom);
				percentEle = dom;
			}
			el.parentNode.style.position = 'relative';
			percentEle.innerHTML = (parseInt(this.imgLoaded / this.imgs.length
					* 100))
					+ '%';
			setTimeout(function() {
				obj.checkLoad();
			}, 100)
		} else {
			if (percentEle)
				percentEle.parentNode.removeChild(percentEle);
			this.container.style.display = 'block';
			if (this.slidebar)
				this.slidebar.style.display = '';
			this.index = this.length - 1 < 0 ? 0 : this.length - 1;
			if (this.slideshows.length > 0) {
				if (!this.slidenum || !this.slidestep) {
					this.run();
				} else {
					this.runRoll();
				}
			}
		}
	};
	this.checkLoad();
}

//
// var hidetimer;
function showmessage(s, type, c) {/*
									 * clearTimeout(hidetimer);
									 * if(isUndefined(c)) c=0; showmask(c);
									 * if(type=='succeed'){
									 * 
									 * showPrompt(null, null, '<div
									 * class="msgbox msgbox_succeed"><div
									 * class="msgbox_layer"><span
									 * class="msgbox_layer_l"></span><span
									 * class="msgbox_layer_img"></span>' + s + '<span
									 * class="msgbox_layer_r"></span></div></div>',
									 * 0,'succeed'); }else if(type=='loading'){
									 * 
									 * showPrompt(null, null, '<div
									 * class="msgbox msgbox_loading"><div
									 * class="msgbox_layer"><span
									 * class="msgbox_layer_l"></span><span
									 * class="msgbox_layer_img"></span>' + s + '<span
									 * class="msgbox_layer_r"></span></div></div>',
									 * 0,'loading'); }else{
									 * 
									 * showPrompt(null, null, '<div
									 * class="msgbox msgbox_error"><div
									 * class="msgbox_layer"><span
									 * class="msgbox_layer_l"></span><span
									 * class="msgbox_layer_img"></span>' + s + '<span
									 * class="msgbox_layer_r"></span></div></div>',
									 * 0,'error'); }
									 * 
									 * if(type!='loading'){
									 * 
									 * setTimeout(function () {hidemask();},
									 * 1800); setTimeout(function ()
									 * {$('#ntcwin').fadeOut(1000)}, 1800);
									 * hidetimer=setTimeout(function ()
									 * {hideMenu(1,
									 * 'prompt');$$('append_parent').removeChild($$('ntcwin'));},
									 * 3600); }
									 */

}

function user_message(s, type) {/*
								 * if(type=='succeed'){
								 * 
								 * showPrompt(null, null, '<div class="msgbox
								 * msgbox_succeed"><div class="msgbox_layer"><span
								 * class="msgbox_layer_l"></span><span
								 * class="msgbox_layer_img"></span>' + s + '<span
								 * class="msgbox_layer_r"></span></div></div>',
								 * 0,type); }else{
								 * 
								 * showPrompt(null, null, '<div class="msgbox
								 * msgbox_error"><div class="msgbox_layer"><span
								 * class="msgbox_layer_l"></span><span
								 * class="msgbox_layer_img"></span>' + s + '<span
								 * class="msgbox_layer_r"></span></div></div>',
								 * 0,type); } setTimeout(function ()
								 * {$('#ntcwin').fadeOut(1000)}, 1800);
								 * hidetimer=setTimeout(function () {hideMenu(1,
								 * 'prompt');$$('append_parent').removeChild($$('ntcwin'));},
								 * 3600);
								 */
}
function hidemessage() {
	// setTimeout(function () {hidemask();}, 0);
	// setTimeout(function () {hideMenu(1,
	// 'prompt');$$('append_parent').removeChild($$('ntcwin'));}, 0);
}
/*
 * function showloading(msg) { msg = isUndefined(msg) ? '请稍候' : msg;
 * showmessage(msg+'...','loading'); }
 */
function hideloading() {
	// hidemessage();
}

function yun_msg(t, s) {
	eval('yun_' + t + '_msg(s)');

}

function yun_info_msg(s) {
	jInfo(s, {
		HorizontalPosition : 'center',
		VerticalPosition : 'center',
		autoHide : false
	});
	if (!$("#fwin_xxx").length)
		setTimeout(function() {
			$("#jOverlay").fadeOut(400)
		}, 600);
}

function yun_warning_msg(s) {
	jWarning(s, {
		HorizontalPosition : 'center',
		VerticalPosition : 'top',
		autoHide : true
	});
	if (!$("#fwin_xxx").length)
		setTimeout(function() {
			$("#jOverlay").fadeOut(400)
		}, 600);
}
function yun_danger_msg(s) {
	jDanger(s, {
		HorizontalPosition : 'center',
		VerticalPosition : 'top',
		autoHide : true
	});
	if (!$("#fwin_xxx").length)
		setTimeout(function() {
			$("#jOverlay").fadeOut(400)
		}, 600);
}
function yun_success_msg(s) {
	jSuccess(s, {
		HorizontalPosition : 'center',
		VerticalPosition : 'top',
		autoHide : true
	});
	if (!$("#fwin_xxx").length)
		setTimeout(function() {
			$("#jOverlay").fadeOut(400)
		}, 600);
}
function yun_loading_msg(s) {
	s = typeof s == 'undefined' ? '<div class="alert alert-info">正在加载...</div>'
			: s;
	jLoading(s, {
		HorizontalPosition : 'center',
		VerticalPosition : 'center',
		autoHide : false
	});
}

function yun_onfocus(e) {
	setTimeout("$$('" + e + "').focus()", 200);
}
function showwin(url) {

	showWindow('xxx', url);
}
function hidewin() {
	$("#jOverlay").remove();
	$.jNotify._close();
	setTimeout(function() {
		$$('append_parent').removeChild($$('fwin_xxx'));
	}, 0);
}
function ajaxp(id) {

	ajaxpost(id, '', '', '');
	return false;
}

function recaptcha(id) {
	if (!id)
		id = 'captcha';
	var _z = Math.floor(Math.random() * 10) + Math.floor(Math.random() * 10)
			+ Math.floor(Math.random() * 10);
	document.getElementById(id + 'img').src = ROOTPATH + 'static/captcha.php?'
			+ _z;
	document.getElementById(id).value = '';
	document.getElementById(id).focus();
}

function setcookie(cookieName, cookieValue, seconds, path, domain, secure) {
	var expires = new Date();
	if (cookieValue == '' || seconds < 0) {
		cookieValue = '';
		seconds = -2592000;
	}
	expires.setTime(expires.getTime() + seconds * 1000);
	document.cookie = escape(cookieName) + '=' + escape(cookieValue)
			+ (expires ? '; expires=' + expires.toGMTString() : '')
			+ (path ? '; path=' + path : '/')
			+ (domain ? '; domain=' + domain : '') + (secure ? '; secure' : '');
}

function getcookie(name, nounescape) {

	var cookie_start = document.cookie.indexOf(name);
	var cookie_end = document.cookie.indexOf(";", cookie_start);
	if (cookie_start == -1) {
		return '';
	} else {
		var v = document.cookie.substring(cookie_start + name.length + 1,
				(cookie_end > cookie_start ? cookie_end
						: document.cookie.length));
		return !nounescape ? unescape(v) : v;
	}
}

function CheckAll(form) {
	for ( var i = 0; i < form.elements.length; i++) {
		var e = form.elements[i];
		if (e.name != 'chkall')
			e.checked = form.chkall.checked;
	}
}
function showhide(id) {
	try {
		var sbtitle = document.getElementById(id);
		if (sbtitle) {
			if (sbtitle.style.display == 'block' || sbtitle.style.display == '') {
				sbtitle.style.display = 'none';
			} else {
				sbtitle.style.display = 'block';
			}
		}
	} catch (e) {
	}
}

function boxshow(id) {
	try {
		var sbtitle = document.getElementById(id);
		if (sbtitle) {
			sbtitle.style.display = 'block';
		}
	} catch (e) {
	}
}

function boxhide(id) {
	try {
		var sbtitle = document.getElementById(id);
		if (sbtitle) {
			sbtitle.style.display = 'none';
		}
	} catch (e) {
	}
}

function imgFit(id, width, height) {
	var imageArr = document.getElementById(id);
	if (imageArr.offsetWidth > width || imageArr.offsetHeight > height) {
		imageRate1 = parseInt(imageArr.offsetWidth) / width;
		imageRate2 = parseInt(imageArr.offsetHeight) / height;
		if (imageRate2 > imageRate1)
			imageArr.style.height = imageArr.offsetHeight / imageRate2 + "px";
		else
			imageArr.style.width = imageArr.offsetWidth / imageRate1 + "px";
	}
}

var KEID = new Array();
function ke_set(id) {
	var o = KEID[id];

	if (Object.prototype.toString.apply(o) === '[object Array]') {

		for ( var i = 0; i < o.length; i++) {
			eval(o[i] + '.sync()');
		}
	}

	return false;
}

function countDown(id, secs, surl) {
	if (!surl) {
		var surl = window.location.href;
		pos = surl.indexOf("#");
		if (pos > -1)
			surl = surl.substring(0, pos);
	}
	var jumpTo = document.getElementById(id);

	if (--secs > -1 && jumpTo) {
		jumpTo.innerHTML = secs + 1;
		setTimeout("countDown('" + id + "'," + secs + ",'" + surl + "')", 1000);
	} else {
		location.href = surl;
	}
}