!function(e){var t={};function n(l){if(t[l])return t[l].exports;var a=t[l]={i:l,l:!1,exports:{}};return e[l].call(a.exports,a,a.exports,n),a.l=!0,a.exports}n.m=e,n.c=t,n.d=function(e,t,l){n.o(e,t)||Object.defineProperty(e,t,{enumerable:!0,get:l})},n.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},n.t=function(e,t){if(1&t&&(e=n(e)),8&t)return e;if(4&t&&"object"==typeof e&&e&&e.__esModule)return e;var l=Object.create(null);if(n.r(l),Object.defineProperty(l,"default",{enumerable:!0,value:e}),2&t&&"string"!=typeof e)for(var a in e)n.d(l,a,function(t){return e[t]}.bind(null,a));return l},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,"a",t),t},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},n.p="",n(n.s=2)}([function(e,t,n){var l;
/*!
  Copyright (c) 2017 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
/*!
  Copyright (c) 2017 Jed Watson.
  Licensed under the MIT License (MIT), see
  http://jedwatson.github.io/classnames
*/
!function(){"use strict";var n={}.hasOwnProperty;function a(){for(var e=[],t=0;t<arguments.length;t++){var l=arguments[t];if(l){var o=typeof l;if("string"===o||"number"===o)e.push(l);else if(Array.isArray(l)&&l.length){var r=a.apply(null,l);r&&e.push(r)}else if("object"===o)for(var c in l)n.call(l,c)&&l[c]&&e.push(c)}}return e.join(" ")}e.exports?(a.default=a,e.exports=a):void 0===(l=function(){return a}.apply(t,[]))||(e.exports=l)}()},,function(e,t,n){"use strict";n.r(t);var l=n(0),a=n.n(l),o=void 0===wp.blockEditor?wp.editor:wp.blockEditor,r=wp.i18n.__,c=o.RichText,i=o.InspectorControls,s=wp.blocks,u=s.registerBlockType,p=s.createBlock,m=wp.element.Fragment,f=wp.components,d=f.PanelBody,y=f.RadioControl,g=wp.element.createElement("svg",{x:"0px",y:"0px",viewBox:"0 0 512 512"},wp.element.createElement("path",{class:"st0",d:"M48,346.8h34.6v51h31.2v-51h34.6v135.8h-34.6V428H82.6v54.5H48V346.8z"}),wp.element.createElement("path",{class:"st0",d:"M268.1,344.3c17.5,0,31.6,8.3,41,17.3l-19,21.6c-6.2-5.6-12.8-9.2-22-9.2c-17.3,0-30.5,15.2-30.5,40.4 c0,26.1,13.2,40.6,32,40.6c9,0,16.4-4.5,22.4-11.1l19,21.1c-11.5,13.4-26.7,19.9-43.4,19.9c-35.3,0-65.4-23.1-65.4-69.4 C202.1,370.3,231.5,344.3,268.1,344.3z"}),wp.element.createElement("path",{class:"st0",d:"M363,346.8h44.4c28.2,0,50.6,7.1,50.6,33.7c0,11.8-7.1,25.4-22.9,29.5v0.8c19.2,3.6,29,13.7,29,31.8 c0,28-23.1,40-52.6,40H363V346.8z M406.3,400.6c12.6,0,17.7-6,17.7-14.9c0-8.6-5.3-12.2-17.7-12.2h-8.5v27.1H406.3z M408.9,455.8 c14.7,0,21.1-5.5,21.1-16.2c0-10.5-6.4-14.9-21.1-14.9h-11.1v31H408.9z"}),wp.element.createElement("polygon",{class:"st0",points:"209.8,56.9 184,31 39.3,175.7 39.3,175.7 39.3,175.7 184,320.4 209.8,294.6 91,175.7"}),wp.element.createElement("polygon",{class:"st0",points:"302.2,56.9 328,31 472.7,175.7 472.7,175.7 472.7,175.7 328,320.4 302.2,294.6 421,175.7"}));function b(e){var t,n=e.value.match(/\r\n|\n/g);t=null!=n?n.length+1:1,e.style.height=1.8*t+1.6+2+"em"}var h=function(e){var t=e.attributes,n=e.setAttributes,l=t.isLineShow;return wp.element.createElement(d,{title:r("HCB settings","loos-hcb"),initialOpen:!0},wp.element.createElement(y,{label:r("Display number of lines in this block","loos-hcb"),selected:l,options:[{label:r("Do not set individually","loos-hcb"),value:"undefined"},{label:r("Display row count","loos-hcb"),value:"on"},{label:r("Do not display row count","loos-hcb"),value:"off"}],onChange:function(e){n({isLineShow:e})}}))};function v(e){return(v="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}var w=hcbLangArray;"object"!=v(w)&&(w={},alert("エラー：「Highlighting Code Block」プラグインの「使用する言語設定」を見直してください。")),u("loos-hcb/code-block",{title:"Highlighing Code Block",icon:g,category:"formatting",keywords:["hcb","code"],attributes:{code:{type:"string",source:"text",selector:"code"},className:{type:"string",default:""},langType:{type:"string",default:"plane"},langName:{type:"string",default:""},fileName:{type:"string",default:""},dataLineNum:{type:"text"},isLineShow:{type:"string",default:"undefined"},preClass:{type:"string"}},supports:{className:!1},transforms:{from:[{type:"block",blocks:["core/code"],transform:function(e){return p("loos-hcb/code-block",{code:e.content})}}],to:[{type:"block",blocks:["core/code"],transform:function(e){return p("core/code",{content:e.code})}}]},edit:function(e){var t=e.attributes,n=e.setAttributes,l=e.clientId,o=e.className,c=a()("hcb_wrap",o);setTimeout(function(){b(document.getElementById("block-"+l).querySelector(".hcb_textarea"))},10);var s=[wp.element.createElement("option",{value:""},"- Lang Select -")];Object.keys(w).forEach(function(e){s.push(wp.element.createElement("option",{value:e},w[e]))});var u="prism "+t.isLineShow+"-numbers lang-"+t.langType;return n({preClass:u}),wp.element.createElement(m,null,wp.element.createElement(i,null,wp.element.createElement(h,e)),wp.element.createElement("div",{className:c},wp.element.createElement("textarea",{className:"hcb_textarea",placeholder:"Your Code...",value:t.code,onChange:function(e){n({code:e.target.value}),b(e.target)}}),wp.element.createElement("div",{className:"select_wrap"},wp.element.createElement("select",{value:t.langType,onChange:function(e){var t=e.target.querySelector("option:checked"),l=t.text;"- Lang Select -"===l&&(l=""),n({langType:t.value}),n({langName:l})}},s),wp.element.createElement("input",{type:"text",className:"num_input",value:t.dataLineNum,placeholder:r('"data-line" value',"loos-hcb"),onChange:function(e){n({dataLineNum:e.target.value})}}),wp.element.createElement("input",{type:"text",className:"filename_input",value:t.fileName,placeholder:r("file name","loos-hcb"),onChange:function(e){n({fileName:e.target.value})}}))))},save:function(e){var t,n=e.attributes,l={className:n.preClass};return""!==n.fileName&&(l["data-file"]=n.fileName),""!==n.langName&&(l["data-lang"]=n.langName),""!==n.dataLineNum&&(l["data-line"]=n.dataLineNum),wp.element.createElement("div",{className:"hcb_wrap"},wp.element.createElement("pre",l,wp.element.createElement(c.Content,{tagName:"code",value:(t=n.code,t?t.replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/"/g,"&quot;").replace(/'/g,"&#39;"):t)})))}})}]);