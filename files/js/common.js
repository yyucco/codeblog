// UTF-8

var _ua = navigator.userAgent;
var _isSp = (_ua.indexOf('iPhone') > -1 && _ua.indexOf('iPad') == -1) || _ua.indexOf('iPod') > -1 || (_ua.indexOf('Android') > -1 && _ua.indexOf('Mobile') > -1);
var _isTablet = (_ua.indexOf('Android') > -1 && _ua.indexOf('Mobile') == -1) || _ua.indexOf('iPad') > -1;
var _url = (location.href.split(location.protocol + '//' + location.host))[1];

if(_isTablet){
	$('meta[name=viewport]').attr('content','');
}

//Chrome印刷対応のため
if(_ua.toLowerCase().indexOf('chrome')>-1){
	$('body').addClass('chrome');
}

/*----------------------------------------------

jquery.cookie.js

----------------------------------------------*/
jQuery.cookie = function(name, value, options) {
		if (typeof value != 'undefined') { // name and value given, set cookie
				options = options || {};
				if (value === null) {
						value = '';
						options.expires = -1;
				}
				var expires = '';
				if (options.expires && (typeof options.expires == 'number' || options.expires.toUTCString)) {
						var date;
						if (typeof options.expires == 'number') {
								date = new Date();
								date.setTime(date.getTime() + (options.expires * 24 * 60 * 60 * 1000));
						} else {
								date = options.expires;
						}
						expires = '; expires=' + date.toUTCString(); // use expires attribute, max-age is not supported by IE
				}
				var path = options.path ? '; path=' + options.path : '';
				var domain = options.domain ? '; domain=' + options.domain : '';
				var secure = options.secure ? '; secure' : '';
				document.cookie = [name, '=', encodeURIComponent(value), expires, path, domain, secure].join('');
		} else { // only name given, get cookie
				var cookieValue = null;
				if (document.cookie && document.cookie != '') {
						var cookies = document.cookie.split(';');
						for (var i = 0; i < cookies.length; i++) {
								var cookie = jQuery.trim(cookies[i]);
								// Does this cookie string begin with the name we want?
								if (cookie.substring(0, name.length + 1) == (name + '=')) {
										cookieValue = decodeURIComponent(cookie.substring(name.length + 1));
										break;
								}
						}
				}
				return cookieValue;
		}
};


/*----------------------------------------------
*
* 	jBRollover 1.1
* 	since:11-02-23
*		MIT license.
* 	© 2011 Bridge Corporation Inc.
*
----------------------------------------------*/
(function($){
		$.fn.jBRollover = function(options) {
				
				// 初期値、オプションの初期値を設定
				var set = $.extend({
						offName : "_off",
						onName : "_on",
						preload : true,
						preloadTime : 3
				},options || {}); // optionsに値があれば上書き
				
				var self = $(this);
				
				//offName. を探すためのRegExp
				var m = new RegExp(set.offName + "\.");
				
				// ロールオーバー処理内容
				var rollover = function() {
						var img = $(this);					
						//src属性にoffName.が含まれる場合に実行
						if(img.attr("src").match(m)) {
								//src属性のoffName.をonName.に置換
								img.attr("src",img.attr("src").replace(set.offName+".", set.onName+"."));
								img.mouseout(function(){
										//マウスアウトでsrc属性のonName.をoffName.に置換
										img.attr("src",img.attr("src").replace(set.onName+".", set.offName+"."));
								})
						}
				};
				
				// セレクタで指定した要素を処理
				self.mouseover(rollover);

				//プリロード処理
				var preloadTimer = function(){
						self.each(function(i) {
								var preimg = $(this);
								if(preimg.attr("src").match(m)) {
										var img = $("<img>").attr("src",preimg.attr("src").replace(set.offName+".", set.onName+"."));
								}
						})
				};

				// preload が true の時オンマウス画像をプリロード
				if(set.preload === true) {
						setTimeout(preloadTimer, set.preloadTime*1000);
				};

				return this;
				
		};
})(jQuery);


/*--------------------------------------------
* 	jBTab 1.2
* 	since:11-04-07  update:12-05-16
*		MIT license.
* 	© 2011 Bridge Corporation Inc.
*
----------------------------------------------*/
(function($){
		$.fn.jBTab = function(options) {
				var self = $(this);
				// 初期値、オプションの初期値を設定
				var set = $.extend({
						contentsBody : $("#tabContent>div"), //内容のセレクタ
						className : "active", //タブに付けるclass名
						defaultShow : 0, //はじめに表示させる内容の番号
						cookie: false,  // cookieを使用するか否か
						expires : 7 //クッキーの保存期間
				},options || {}); // optionsに値があれば上書き

				//クッキーを使用する場合、クッキーに保存されている番号のtabを表示する
				if(set.cookie === true) {
						set.defaultShow = $.cookie('tabNum') ? set.defaultShow = $.cookie('tabNum') : set.defaultShow;
				}
				//ページ内リンクスクリプトとのコンフリクト回避のため
				//タブのhrefから#を除く
				self.find('a').attr('href', function(i, href) {
						return $(this).attr('href').replace('#', '');
				});
				//アクティブなタブにclassを付ける
				self.eq(set.defaultShow).addClass(set.className);
				//設定した番号の内容を表示
				set.contentsBody.hide().eq(set.defaultShow).show();
				// タブ処理内容
				var tab = function() {
						//タブからclassを外す
						self.removeClass(set.className);
						//クリックしたタブにclassを付けて、インデックスを取得
						var tabNum = $(this).addClass(set.className).index();
						//クッキーを使用する場合、はじめに表示させる内容の番号の変更
						if(set.cookie === true) {
								$.cookie("tabNum", null);
								$.cookie("tabNum",tabNum,{expires: set.expires,path:'/'});
								// console.log( "set.defaultShow is " + set.defaultShow );
						}
						//表示・非表示処理
						set.contentsBody.hide().eq(tabNum).show();
						return false;
				};
				// セレクタで指定した要素を処理
				self.click(tab);
				// メソッドチェーン用
				return this;
		};
})(jQuery);


/*--------------------------------------------
* 	Page top
----------------------------------------------*/
(function($){
		$.fn.pageTop = function(){
			var self = $(this),
					docHeight = $(document).height(),
					scrolledHeight,
					scrollEndHeight;
			self.hide();
			$(window).on('load',function(){
				docHeight = $(document).height();
				scrollEndHeight = self.parent("#footer").height();
			});
			var ptBtm = 15;
			if(_isSp) ptBtm = 7;
			$(window).on("scroll load", function() {
				if ( $(this).scrollTop() > 100 ) {
					self.fadeIn("fast");
				} else {
					self.fadeOut("fast");
				}
				docHeight = $(document).height();
				scrolledHeight = $(window).height() + $(window).scrollTop();
				scrollEndHeight = self.parent("#footer").height();
				if ( (docHeight - scrolledHeight) <= scrollEndHeight ) {
					self.css({
						"position":"absolute",
						"bottom": scrollEndHeight + 10
					});
				} else {
					self.css({
						"position":"fixed",
						"bottom": ptBtm
					});
				}
			});
		};
})(jQuery);

/*
* jquery-match-height 0.7.0 by @liabru
* http://brm.io/jquery-match-height/
* License MIT
*/
(function(){
!function(t){"use strict";"function"==typeof define&&define.amd?define(["jquery"],t):"undefined"!=typeof module&&module.exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){var e=-1,o=-1,i=function(t){return parseFloat(t)||0},a=function(e){var o=1,a=t(e),n=null,r=[];return a.each(function(){var e=t(this),a=e.offset().top-i(e.css("margin-top")),s=r.length>0?r[r.length-1]:null;null===s?r.push(e):Math.floor(Math.abs(n-a))<=o?r[r.length-1]=s.add(e):r.push(e),n=a}),r},n=function(e){var o={
byRow:!0,property:"height",target:null,remove:!1};return"object"==typeof e?t.extend(o,e):("boolean"==typeof e?o.byRow=e:"remove"===e&&(o.remove=!0),o)},r=t.fn.matchHeight=function(e){var o=n(e);if(o.remove){var i=this;return this.css(o.property,""),t.each(r._groups,function(t,e){e.elements=e.elements.not(i)}),this}return this.length<=1&&!o.target?this:(r._groups.push({elements:this,options:o}),r._apply(this,o),this)};r.version="0.7.0",r._groups=[],r._throttle=80,r._maintainScroll=!1,r._beforeUpdate=null,
r._afterUpdate=null,r._rows=a,r._parse=i,r._parseOptions=n,r._apply=function(e,o){var s=n(o),h=t(e),l=[h],c=t(window).scrollTop(),p=t("html").outerHeight(!0),d=h.parents().filter(":hidden");return d.each(function(){var e=t(this);e.data("style-cache",e.attr("style"))}),d.css("display","block"),s.byRow&&!s.target&&(h.each(function(){var e=t(this),o=e.css("display");"inline-block"!==o&&"flex"!==o&&"inline-flex"!==o&&(o="block"),e.data("style-cache",e.attr("style")),e.css({display:o,"padding-top":"0",
"padding-bottom":"0","margin-top":"0","margin-bottom":"0","border-top-width":"0","border-bottom-width":"0",height:"100px",overflow:"hidden"})}),l=a(h),h.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||"")})),t.each(l,function(e,o){var a=t(o),n=0;if(s.target)n=s.target.outerHeight(!1);else{if(s.byRow&&a.length<=1)return void a.css(s.property,"");a.each(function(){var e=t(this),o=e.attr("style"),i=e.css("display");"inline-block"!==i&&"flex"!==i&&"inline-flex"!==i&&(i="block");var a={
display:i};a[s.property]="",e.css(a),e.outerHeight(!1)>n&&(n=e.outerHeight(!1)),o?e.attr("style",o):e.css("display","")})}a.each(function(){var e=t(this),o=0;s.target&&e.is(s.target)||("border-box"!==e.css("box-sizing")&&(o+=i(e.css("border-top-width"))+i(e.css("border-bottom-width")),o+=i(e.css("padding-top"))+i(e.css("padding-bottom"))),e.css(s.property,n-o+"px"))})}),d.each(function(){var e=t(this);e.attr("style",e.data("style-cache")||null)}),r._maintainScroll&&t(window).scrollTop(c/p*t("html").outerHeight(!0)),
this},r._applyDataApi=function(){var e={};t("[data-match-height], [data-mh]").each(function(){var o=t(this),i=o.attr("data-mh")||o.attr("data-match-height");i in e?e[i]=e[i].add(o):e[i]=o}),t.each(e,function(){this.matchHeight(!0)})};var s=function(e){r._beforeUpdate&&r._beforeUpdate(e,r._groups),t.each(r._groups,function(){r._apply(this.elements,this.options)}),r._afterUpdate&&r._afterUpdate(e,r._groups)};r._update=function(i,a){if(a&&"resize"===a.type){var n=t(window).width();if(n===e)return;e=n;
}i?-1===o&&(o=setTimeout(function(){s(a),o=-1},r._throttle)):s(a)},t(r._applyDataApi),t(window).bind("load",function(t){r._update(!1,t)}),t(window).bind("resize orientationchange",function(t){r._update(!0,t)})});
}());
$.fn.matchHeight._afterUpdate = function(event, groups) {
	//アンカーリンクがあれば、高さ調整後にウィンドウ位置を調整
	if(location.hash){
		if($(location.hash.split('?')[0]).offset()){
			var position = $(location.hash.split('?')[0]).offset().top;
			window.scrollTo(0,position);
		}
	}
};

/*----------------------------------------------
*
* 	jQuery ready
*
----------------------------------------------*/

$(function(){

	//javascriptがonの時はclassを取る
	$("html").removeClass("noJS");
	
	//rollover
	$("img,input:image").jBRollover({preloadTime : 5});

	//labelにclickイベントをバインド
	$("#main label").each(function(i, l){
		l = $(l);
		l.bind('click', function(){
			var t = $('input[id=' + l.attr('for') + ']');
			t.checked = t.checked ? false : true;
		});
	});

	//スムーススクロール
	$('a[href^=#]').not('.noScroll').click(function() {
		var speed = 500;
		var target = $(this.hash);
		if (!target.length) return ;
		var position = target.offset().top;
		$('html,body').animate({scrollTop: position}, speed, 'swing');
		if($(this).parent().attr('id')==='pagetop') return false;
		window.history.pushState(null, null, this.hash);
		return false;
	});
	//ヘッダー固定の場合　不要なら削除
	// var smoothscroll = {
	// 	speed:500,
	// 	func:function(_target){
	// 		if (!_target.length) return ;
	// 		var header = $('#header').height()+15;
	// 		if($(window).width()<767){header=$('#header').height()+10}
	// 		var position = _target.offset().top - header;
	// 		$('html,body').animate({scrollTop: position}, this.speed, 'swing');
	// 	},
	// 	init:function(){
	// 		$('a[href^=#]').not('.noScroll').click(function() {
	// 			smoothscroll.func($(this.hash));
	// 			return false;
	// 		});
	// 		$('a[href^="'+ _url +'#"]').not('.noScroll').click(function() {
	// 			smoothscroll.func($(this.hash));
	// 			return false;
	// 		});
	// 		if(location.hash){
	// 			smoothscroll.func($(location.hash.split('?')[0]));
	// 			$('a[href*="'+ location.pathname +'#"]').not('.noScroll').click(function() {
	// 				smoothscroll.func($(this.hash));
	// 				return false;
	// 			});
	// 		}
	// 	}
	// };
	// smoothscroll.init();

	$(window).on('load',function(){
		//ページトップへ
		$('#pagetop').pageTop();
	});

	//新着情報
	$('.js_news_sort').on('change',function(){
		var val = $(this).val();
		location.href = val
	});

/*----------------------------------------------
*
* 	nav
*
----------------------------------------------*/

/* nav_1nd
------------------------------- */

	$('.nav_1nd > li a').on('click',function(){
		var $li = $(this).parent();

		if($($li).hasClass("activeNav01")){
		$('.nav_1nd > li').removeClass("activeNav01");
			$($li).removeClass("activeNav01");
		} else {
		$('.nav_1nd > li').removeClass("activeNav01");
			$($li).addClass("activeNav01");
		}
	});

/* nav_2nd
------------------------------- */
    // $(".nav_3nd",this).show();
 // $("nav .nav_2nd > ul > li").hover(function(){
 //    $(".nav_3nd",this).stop().fadeIn();
	//    $('.nav_3nd ul').slick({
	// 		  infinite: true,
	// 		  slidesToShow: 4,
	// 		  slidesToScroll: 1
	//   });
 //  }, function(){
 //    $(".nav_3nd",this).stop().fadeOut();
 //  });

/* nav_3nd
------------------------------- */
   $('.nav_3nd ul').slick({
		  infinite: true,
		  slidesToShow: 4,
		  slidesToScroll: 1
  });

/* ハンバーガーメニュー
------------------------------- */
$(function(){
    var body = document.body;
    var blackBg = document.getElementById('js-black-bg');
    var headerHeight =   $('header').height();
    $(window).scroll(function () {
    if ($(this).scrollTop() > headerHeight) {
	         $(body).addClass('navFixed');
	    } else {
	         $(body).removeClass('navFixed'); 
	    }
    });

    $('.navBtn,.ovarray').on('click', function() {
       $(body).toggleClass('nav-open');
    });

 });


/*
function escape_html (string) {
  if(typeof string !== 'string') {
    return string;
  }
  return string.replace(/[&'`"<>]/g, function(match) {
    return {
      '&': '&amp;',
      "'": '&#x27;',
      '`': '&#x60;',
      '"': '&quot;',
      '<': '&lt;',
      '>': '&gt;',
    }[match]
  });
}








function escapechange (string) {
  // if(typeof string !== 'string') {
  //   return string;
  // }
  var	stringhtml = $(string).html();
  	console.log(stringhtml);
  var escapehtml = stringhtml.replace(/[&'`"<>]/g, function(match) {
    return {
      '&': '&amp;',
      "'": '&#x27;',
      '`': '&#x60;',
      '"': '&quot;',
      '<': '&lt;',
      '>': '&gt;',
    }[match]
  });
    	console.log(escapehtml);
	return  $(string).html(escapehtml);
};

	code = $("pre");
	code2 = escapechange(code);
	// console.log(code2);
*/














});
