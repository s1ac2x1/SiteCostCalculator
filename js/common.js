function addEvent(b,d,c){if(!c.$$guid){c.$$guid=addEvent.guid++}if(!b.events){b.events={}}var a=b.events[d];if(!a){a=b.events[d]={};if(b["on"+d]){a[0]=b["on"+d]}}a[c.$$guid]=c;b["on"+d]=handleEvent}addEvent.guid=1;function removeEvent(a,c,b){if(a.events&&a.events[c]){delete a.events[c][b.$$guid]}}function handleEvent(d){var c=true;d=d||fixEvent(window.event);var a=this.events[d.type];for(var b in a){this.$$handleEvent=a[b];if(this.$$handleEvent(d)===false){c=false}}return c}function fixEvent(a){a.preventDefault=fixEvent.preventDefault;a.stopPropagation=fixEvent.stopPropagation;return a}fixEvent.preventDefault=function(){this.returnValue=false};fixEvent.stopPropagation=function(){this.cancelBubble=true};function createElement(a){if(typeof document.createElementNS!="undefined"){return document.createElementNS("http://www.w3.org/1999/xhtml",a)}if(typeof document.createElement!="undefined"){return document.createElement(a)}return false}function getEventTarget(b){var a;if(!b){b=window.event}if(b.target){a=b.target}else{if(b.srcElement){a=b.srcElement}}if(a.nodeType==3){a=a.parentNode}return a};