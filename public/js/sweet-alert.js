!function(e,t){function n(t){var n=m(),o=n.querySelector("h2"),i=n.querySelector("p"),a=n.querySelector("button.cancel"),r=n.querySelector("button.confirm");if(o.innerHTML=h(t.title).split("\n").join("<br>"),i.innerHTML=h(t.text||"").split("\n").join("<br>"),t.text&&x(i),B(n.querySelectorAll(".icon")),t.type){for(var l=!1,c=0;c<p.length;c++)if(t.type===p[c]){l=!0;break}if(!l)return e.console.error("Unknown alert type: "+t.type),!1;var s=n.querySelector(".icon."+t.type);switch(x(s),t.type){case"success":g(s,"animate"),g(s.querySelector(".tip"),"animateSuccessTip"),g(s.querySelector(".long"),"animateSuccessLong");break;case"error":g(s,"animateErrorIcon"),g(s.querySelector(".x-mark"),"animateXMark");break;case"warning":g(s,"pulseWarning"),g(s.querySelector(".body"),"pulseWarningIns"),g(s.querySelector(".dot"),"pulseWarningIns")}}if(t.imageUrl){var u=n.querySelector(".icon.custom");u.style.backgroundImage="url("+t.imageUrl+")",x(u);var f=80,d=80;if(t.imageSize){var y=t.imageSize.split("x")[0],v=t.imageSize.split("x")[1];y&&v?(f=y,d=v,u.css({width:y+"px",height:v+"px"})):e.console.error("Parameter imageSize expects value with format WIDTHxHEIGHT, got "+t.imageSize)}u.setAttribute("style",u.getAttribute("style")+"width:"+f+"px; height:"+d+"px")}n.setAttribute("data-has-cancel-button",t.showCancelButton),t.showCancelButton?a.style.display="inline-block":B(a),n.setAttribute("data-has-confirm-button",t.showConfirmButton),t.showConfirmButton?r.style.display="inline-block":B(r),t.cancelButtonText&&(a.innerHTML=h(t.cancelButtonText)),t.confirmButtonText&&(r.innerHTML=h(t.confirmButtonText)),r.className="confirm btn btn-lg",g(n,t.containerClass),g(r,t.confirmButtonClass),g(a,t.cancelButtonClass),g(o,t.titleClass),g(i,t.textClass),n.setAttribute("data-allow-ouside-click",t.allowOutsideClick);var b=!!t.doneFunction;n.setAttribute("data-has-done-function",b),n.setAttribute("data-timer",t.timer)}function o(e,t){for(var n in t)t.hasOwnProperty(n)&&(e[n]=t[n]);return e}function i(){var e=m();E(v(),10),x(e),g(e,"showSweetAlert"),w(e,"hideSweetAlert"),l=t.activeElement;var n=e.querySelector("button.confirm");n.focus(),setTimeout(function(){g(e,"visible")},500);var o=e.getAttribute("data-timer");"null"!==o&&""!==o&&setTimeout(function(){a()},o)}function a(){var n=m();q(v(),5),q(n,5),w(n,"showSweetAlert"),g(n,"hideSweetAlert"),w(n,"visible");var o=n.querySelector(".icon.success");w(o,"animate"),w(o.querySelector(".tip"),"animateSuccessTip"),w(o.querySelector(".long"),"animateSuccessLong");var i=n.querySelector(".icon.error");w(i,"animateErrorIcon"),w(i.querySelector(".x-mark"),"animateXMark");var a=n.querySelector(".icon.warning");w(a,"pulseWarning"),w(a.querySelector(".body"),"pulseWarningIns"),w(a.querySelector(".dot"),"pulseWarningIns"),e.onkeydown=s,t.onclick=c,l&&l.focus(),u=void 0}function r(){var e=m();e.style.marginTop=T(m())}var l,c,s,u,f=".sweet-alert",d=".sweet-overlay",p=["error","warning","info","success"],y={title:"",text:"",type:null,allowOutsideClick:!1,showCancelButton:!1,showConfirmButton:!0,closeOnConfirm:!0,closeOnCancel:!0,confirmButtonText:"OK",confirmButtonClass:"btn-primary",cancelButtonText:"Cancel",cancelButtonClass:"btn-default",containerClass:"",titleClass:"",textClass:"",imageUrl:null,imageSize:null,timer:null},m=function(){return t.querySelector(f)},v=function(){return t.querySelector(d)},b=function(e,t){return new RegExp(" "+t+" ").test(" "+e.className+" ")},g=function(e,t){t&&!b(e,t)&&(e.className+=" "+t)},w=function(e,t){var n=" "+e.className.replace(/[\t\r\n]/g," ")+" ";if(b(e,t)){for(;n.indexOf(" "+t+" ")>=0;)n=n.replace(" "+t+" "," ");e.className=n.replace(/^\s+|\s+$/g,"")}},h=function(e){var n=t.createElement("div");return n.appendChild(t.createTextNode(e)),n.innerHTML},C=function(e){e.style.opacity="",e.style.display="block"},x=function(e){if(e&&!e.length)return C(e);for(var t=0;t<e.length;++t)C(e[t])},S=function(e){e.style.opacity="",e.style.display="none"},B=function(e){if(e&&!e.length)return S(e);for(var t=0;t<e.length;++t)S(e[t])},k=function(e,t){for(var n=t.parentNode;null!==n;){if(n===e)return!0;n=n.parentNode}return!1},T=function(e){e.style.left="-9999px",e.style.display="block";var t=e.clientHeight,n=parseInt(getComputedStyle(e).getPropertyValue("padding"),10);return e.style.left="",e.style.display="none","-"+parseInt(t/2+n)+"px"},E=function(e,t){if(+e.style.opacity<1){t=t||16,e.style.opacity=0,e.style.display="block";var n=+new Date,o=function(){e.style.opacity=+e.style.opacity+(new Date-n)/100,n=+new Date,+e.style.opacity<1&&setTimeout(o,t)};o()}},q=function(e,t){t=t||16,e.style.opacity=1;var n=+new Date,o=function(){e.style.opacity=+e.style.opacity-(new Date-n)/100,n=+new Date,+e.style.opacity>0?setTimeout(o,t):e.style.display="none"};o()},O=function(n){if(MouseEvent){var o=new MouseEvent("click",{view:e,bubbles:!1,cancelable:!0});n.dispatchEvent(o)}else if(t.createEvent){var i=t.createEvent("MouseEvents");i.initEvent("click",!1,!1),n.dispatchEvent(i)}else t.createEventObject?n.fireEvent("onclick"):"function"==typeof n.onclick&&n.onclick()},A=function(t){"function"==typeof t.stopPropagation?(t.stopPropagation(),t.preventDefault()):e.event&&e.event.hasOwnProperty("cancelBubble")&&(e.event.cancelBubble=!0)};e.sweetAlertInitialize=function(){var e='<div class="sweet-overlay" tabIndex="-1"></div><div class="sweet-alert" tabIndex="-1"><div class="icon error"><span class="x-mark"><span class="line left"></span><span class="line right"></span></span></div><div class="icon warning"> <span class="body"></span> <span class="dot"></span> </div> <div class="icon info"></div> <div class="icon success"> <span class="line tip"></span> <span class="line long"></span> <div class="placeholder"></div> <div class="fix"></div> </div> <div class="icon custom"></div> <h2>Title</h2><p class="lead text-muted">Text</p><p><button class="cancel btn btn-lg" tabIndex="2">Cancel</button> <button class="confirm btn btn-lg" tabIndex="1">OK</button></p></div>',n=t.createElement("div");n.innerHTML=e,t.body.appendChild(n)},e.sweetAlert=e.swal=function(){function l(e){var t=e.keyCode||e.which;if(-1!==[9,13,32,27].indexOf(t)){for(var n=e.target||e.srcElement,o=-1,i=0;i<x.length;i++)if(n===x[i]){o=i;break}9===t?(n=-1===o?h:o===x.length-1?x[0]:x[o+1],A(e),n.focus()):(n=13===t||32===t?-1===o?h:void 0:27!==t||C.hidden||"none"===C.style.display?void 0:C,void 0!==n&&O(n,e))}}function f(e){var t=e.target||e.srcElement,n=e.relatedTarget,o=b(p,"visible");if(o){var i=-1;if(null!==n){for(var a=0;a<x.length;a++)if(n===x[a]){i=a;break}-1===i&&t.focus()}else u=t}}if(void 0===arguments[0])return e.console.error("sweetAlert expects at least 1 attribute!"),!1;var d=o({},y);switch(typeof arguments[0]){case"string":d.title=arguments[0],d.text=arguments[1]||"",d.type=arguments[2]||"";break;case"object":if(void 0===arguments[0].title)return e.console.error('Missing "title" argument!'),!1;d.title=arguments[0].title,d.text=arguments[0].text||y.text,d.type=arguments[0].type||y.type,d.allowOutsideClick=arguments[0].allowOutsideClick||y.allowOutsideClick,d.showCancelButton=void 0!==arguments[0].showCancelButton?arguments[0].showCancelButton:y.showCancelButton,d.showConfirmButton=void 0!==arguments[0].showConfirmButton?arguments[0].showConfirmButton:y.showConfirmButton,d.closeOnConfirm=void 0!==arguments[0].closeOnConfirm?arguments[0].closeOnConfirm:y.closeOnConfirm,d.closeOnCancel=void 0!==arguments[0].closeOnCancel?arguments[0].closeOnCancel:y.closeOnCancel,d.timer=arguments[0].timer||y.timer,d.confirmButtonText=y.showCancelButton?"Confirm":y.confirmButtonText,d.confirmButtonText=arguments[0].confirmButtonText||y.confirmButtonText,d.confirmButtonClass=arguments[0].confirmButtonClass||(arguments[0].type?"btn-"+arguments[0].type:null)||y.confirmButtonClass,d.cancelButtonText=arguments[0].cancelButtonText||y.cancelButtonText,d.cancelButtonClass=arguments[0].cancelButtonClass||y.cancelButtonClass,d.containerClass=arguments[0].containerClass||y.containerClass,d.titleClass=arguments[0].titleClass||y.titleClass,d.textClass=arguments[0].textClass||y.textClass,d.imageUrl=arguments[0].imageUrl||y.imageUrl,d.imageSize=arguments[0].imageSize||y.imageSize,d.doneFunction=arguments[1]||null;break;default:return e.console.error('Unexpected type of argument! Expected "string" or "object", got '+typeof arguments[0]),!1}n(d),r(),i();for(var p=m(),v=function(e){var t=e.target||e.srcElement,n=t.className.indexOf("confirm")>-1,o=b(p,"visible"),i=d.doneFunction&&"true"===p.getAttribute("data-has-done-function");switch(e.type){case"click":if(n&&i&&o)d.doneFunction(!0),d.closeOnConfirm&&a();else if(i&&o){var r=String(d.doneFunction).replace(/\s/g,""),l="function("===r.substring(0,9)&&")"!==r.substring(9,10);l&&d.doneFunction(!1),d.closeOnCancel&&a()}else a()}},g=p.querySelectorAll("button"),w=0;w<g.length;w++)g[w].onclick=v;c=t.onclick,t.onclick=function(e){var t=e.target||e.srcElement,n=p===t,o=k(p,e.target),i=b(p,"visible"),r="true"===p.getAttribute("data-allow-ouside-click");!n&&!o&&i&&r&&a()};var h=p.querySelector("button.confirm"),C=p.querySelector("button.cancel"),x=p.querySelectorAll("button:not([type=hidden])");s=e.onkeydown,e.onkeydown=l,h.onblur=f,C.onblur=f,e.onfocus=function(){e.setTimeout(function(){void 0!==u&&(u.focus(),u=void 0)},0)}},e.swal.setDefaults=function(e){if(!e)throw new Error("userParams is required");if("object"!=typeof e)throw new Error("userParams has to be a object");o(y,e)},e.swal.close=function(){a()},function(){"complete"===t.readyState||"interactive"===t.readyState&&t.body?sweetAlertInitialize():t.addEventListener?t.addEventListener("DOMContentLoaded",function e(){t.removeEventListener("DOMContentLoaded",e,!1),sweetAlertInitialize()},!1):t.attachEvent&&t.attachEvent("onreadystatechange",function n(){"complete"===t.readyState&&(t.detachEvent("onreadystatechange",n),sweetAlertInitialize())})}()}(window,document);