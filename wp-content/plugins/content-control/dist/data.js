!function(){"use strict";var e={d:function(t,o){for(var r in o)e.o(o,r)&&!e.o(t,r)&&Object.defineProperty(t,r,{enumerable:!0,get:o[r]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r:function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};e.r(t),e.d(t,{registry:function(){return c}});var o=window.wp.coreData,r=window.wp.data,n=window.wp.hooks,i=window.contentControl.coreData;const c=(0,r.createRegistry)({});c.register(o.store),c.register(i.licenseStore),c.register(i.settingsStore),c.register(i.restrictionsStore),c.register(i.urlSearchStore),document.addEventListener("DOMContentLoaded",(()=>{(0,n.doAction)("content-control.data.registry",c)})),(window.contentControl=window.contentControl||{}).data=t}();