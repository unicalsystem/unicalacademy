!function(){"use strict";var e={n:function(t){var n=t&&t.__esModule?function(){return t.default}:function(){return t};return e.d(n,{a:n}),n},d:function(t,n){for(var o in n)e.o(n,o)&&!e.o(t,o)&&Object.defineProperty(t,o,{enumerable:!0,get:n[o]})},o:function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},r:function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})}},t={};e.r(t);var n=window.jQuery,o=e.n(n);function i(){const e=o()(this),t=e.parents(".widget").eq(0).find(".widget_options-roles");"logged_in"===e.val()?t.show():t.hide()}function r(){o()(".widget_options-which_users select").each((function(){i.call(this)}))}o()((()=>{r(),o()(document).on("change",".widget_options-which_users select",(function(){i.call(this)})).on("widget-updated",r)})),(window.contentControl=window.contentControl||{}).widgetEditor=t}();