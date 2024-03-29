(function(window, document) {
	'use strict';

	var lazyRocketsConfig;

	var docElem = document.documentElement;

	var addEventListener = window.addEventListener;

	var setTimeout = window.setTimeout;

	var rAF = window.requestAnimationFrame || setTimeout;

	var regPicture = /^picture$/i;

	var loadEvents = ['load', 'error', 'lazyincluded', '_lazyloaded'];

	var hasClass = function(ele, cls) {
		/*var reg = new RegExp('(\\s|^)'+cls+'(\\s|$)');
		return ele.className.match(reg) && reg;*/

		var reg = new RegExp('(^|\s)' + cls + '\d(\s|$)');
		return ele.className.match(cls);
	};

	var addClass = function(ele, cls) {
		if (!hasClass(ele, cls)){
			ele.className += ' '+cls;
		}
	};

	var removeClass = function(ele, cls) {
		var reg;
		if ((reg = hasClass(ele,cls))) {
			ele.className = ele.className.replace(reg, ' ');
		}
	};

	var addRemoveLoadEvents = function(dom, fn, add){
		var action = add ? 'addEventListener' : 'removeEventListener';
		if(add){
			addRemoveLoadEvents(dom, fn);
		}
		loadEvents.forEach(function(evt){
			dom[action](evt, fn);
		});
	};

	var triggerEvent = function(elem, name, detail, noBubbles, noCancelable){
		var event = document.createEvent('CustomEvent');

		event.initCustomEvent(name, !noBubbles, !noCancelable, detail);

		event.details =  event.detail;

		elem.dispatchEvent(event);
		return event;
	};

	var updatePolyfill = function (el, full){
		var polyfill;
		if(!window.HTMLPictureElement){
			if( ( polyfill = (window.picturefill || window.respimage || lazyRocketsConfig.pf) ) ){
				polyfill({reevaluate: true, reparse: true, elements: [el]});
			} else if(full && full.src){
				el.src = full.src;
			}
		}
	};

	var getCSS = function (elem, style){
		return getComputedStyle(elem, null)[style];
	};

	var prepareThrottledCheckElements = function(fn){
		var noPreparedElems = document.querySelectorAll('[data-lazy-src]:not(.lazyload),[data-lazy-original]:not(.lazyload)');
		
		for (var i = 0; i < noPreparedElems.length; i++) {
			addClass(noPreparedElems[i], lazyRocketsConfig.lazyClass);
		}
	}

	var throttle = function(fn){
		var running;
		var lastTime = 0;
		var Date = window.Date;
		var run = function(){
			running = false;
			lastTime = Date.now();
			fn();
		};
		var afterAF = function(){
			setTimeout(run);
		};
		var getAF = function(){
			rAF(afterAF);
		};

		return function(force){
			if(running){
				return;
			}
			var delay = lazyRocketsConfig.throttle - (Date.now() - lastTime);

			running =  true;

			if(delay < 4){
				delay = 4;
			}

			if(force === true){
				getAF();
			} else {
				setTimeout(getAF, delay);
			}
		};
	};

	var loader = (function(){
		var lazyloadElems, preloadElems, isCompleted, resetPreloadingTimer, loadMode;

		var eLvW, elvH, eLtop, eLleft, eLright, eLbottom;

		var defaultExpand, preloadExpand;

		var regImg = /^img$/i;
		var regIframe = /^iframe$/i;

		var supportScroll = ('onscroll' in window) && !(/glebot/.test(navigator.userAgent));

		var shrinkExpand = 0;
		var currentExpand = 0;
		var lowRuns = 0;

		var isLoading = 0;

		var resetPreloading = function(e){
			isLoading--;
			if(e && e.target){
				addRemoveLoadEvents(e.target, resetPreloading);
			}

			if(!e || isLoading < 0 || !e.target){
				isLoading = 0;
			}
		};

		var isNestedVisible = function(elem, elemExpand){
			var outerRect;
			var parent = elem;
			var visible = getCSS(elem, 'visibility') != 'hidden';

			eLtop -= elemExpand;
			eLbottom += elemExpand;
			eLleft -= elemExpand;
			eLright += elemExpand;

			while(visible && (parent = parent.offsetParent)){
				visible = ((getCSS(parent, 'opacity') || 1) > 0);

				if(visible && getCSS(parent, 'overflow') != 'visible'){
					outerRect = parent.getBoundingClientRect();
					visible = eLright > outerRect.left &&
					eLleft < outerRect.right &&
					eLbottom > outerRect.top - 1 &&
					eLtop < outerRect.bottom + 1
					;
				}
			}

			return visible;
		};

		var checkElements = function() {
			var eLlen, i, rect, autoLoadElem, loadedSomething, elemExpand, elemNegativeExpand, elemExpandVal, beforeExpandVal;

			if((loadMode = lazyRocketsConfig.loadMode) && isLoading < 8 && (eLlen = lazyloadElems.length)){

				i = 0;

				lowRuns++;

				if(currentExpand < preloadExpand && isLoading < 1 && lowRuns > 4 && loadMode > 2){
					currentExpand = preloadExpand;
					lowRuns = 0;
				} else if(currentExpand != defaultExpand && loadMode > 1 && lowRuns > 3){
					currentExpand = defaultExpand;
				} else {
					currentExpand = shrinkExpand;
				}

				for(; i < eLlen; i++){

					if(!lazyloadElems[i] || lazyloadElems[i]._lazyRace){continue;}

					if(!supportScroll){unveilElement(lazyloadElems[i]);continue;}

					if(!(elemExpandVal = lazyloadElems[i].getAttribute('data-expand')) || !(elemExpand = elemExpandVal * 1)){
						elemExpand = currentExpand;
					}

					if(beforeExpandVal !== elemExpand){
						eLvW = innerWidth + elemExpand;
						elvH = innerHeight + elemExpand;
						elemNegativeExpand = elemExpand * -1;
						beforeExpandVal = elemExpand;
					}

					rect = lazyloadElems[i].getBoundingClientRect();

					if ((eLbottom = rect.bottom) >= elemNegativeExpand &&
						(eLtop = rect.top) <= elvH &&
						(eLright = rect.right) >= elemNegativeExpand &&
						(eLleft = rect.left) <= eLvW &&
						(eLbottom || eLright || eLleft || eLtop) &&
						((isCompleted && isLoading < 3 && lowRuns < 4 && !elemExpandVal && loadMode > 2) || isNestedVisible(lazyloadElems[i], elemExpand))){
						unveilElement(lazyloadElems[i], false, rect.width);
						loadedSomething = true;
					} else if(!loadedSomething && isCompleted && !autoLoadElem &&
						isLoading < 3 && lowRuns < 4 && loadMode > 2 &&
						(preloadElems[0] || lazyRocketsConfig.preloadAfterLoad) &&
						(preloadElems[0] || (!elemExpandVal && ((eLbottom || eLright || eLleft || eLtop) /*|| lazyloadElems[i].getAttribute(lazyRocketsConfig.sizesAttr) != 'auto'*/)))){
						autoLoadElem = preloadElems[0] || lazyloadElems[i];
					}
				}

				if(autoLoadElem && !loadedSomething){
					unveilElement(autoLoadElem);
				}
			}
		};

		var throttledCheckElements = throttle(checkElements);

		var switchLoadingClass = function(e){
			addClass(e.target, lazyRocketsConfig.loadedClass);
			removeClass(e.target, lazyRocketsConfig.loadingClass);
			addRemoveLoadEvents(e.target, switchLoadingClass);
		};

		var changeIframeSrc = function(elem, src){
			if(elem.getAttribute('src') != src){
				/*try {
					elem.contentWindow.location.replace(src);
				} catch(e){*/
					elem.setAttribute('src', src);
				//}
			}
		};

		var rafBatch = (function(){
			var isRunning;
			var batch = [];
			var runBatch = function(){
				while(batch.length){
					(batch.shift())();
				}
				isRunning = false;
			};
			return function(fn){
				batch.push(fn);
				if(!isRunning){
					isRunning = true;
					rAF(runBatch);
				}
			};
		})();

		var unveilElement = function (elem, force, width){
			var sources, i, len, sourceSrcset, src, srcset, sizes, parent, isPicture, event, firesLoad, customMedia;

			var curSrc = elem.currentSrc || elem.src;
			var isImg = regImg.test(elem.nodeName);

			var sizes = null;
			var isAuto = sizes == 'auto';

			if( (isAuto || !isCompleted) && isImg && curSrc && !elem.complete && !hasClass(elem, lazyRocketsConfig.errorClass)){return;}

			elem._lazyRace = true;
			isLoading++;

			rafBatch(function lazyUnveil(){

				if(elem._lazyRace){
					delete elem._lazyRace;
				}

				removeClass(elem, lazyRocketsConfig.lazyClass);

				if(!(event = triggerEvent(elem, 'lazybeforeunveil', {force: !!force})).defaultPrevented){

					/*if(sizes){
						if(isAuto){*/
							//addClass(elem, lazyRocketsConfig.autosizesClass);
						//} else {
							//elem.setAttribute('sizes', sizes);
						//}
					//}

					srcset = elem.getAttribute('data-lazy-srcset');
					//srcset = null;
					sizes = elem.getAttribute('data-lazy-sizes');
					
					src = elem.getAttribute('data-lazy-src') || elem.getAttribute('data-lazy-original');

					if(isImg) {
						parent = elem.parentNode;
						isPicture = parent && regPicture.test(parent.nodeName || '');
					}

					firesLoad = event.detail.firesLoad || (('src' in elem) && (srcset || sizes || src || isPicture));

					event = {target: elem};

					if(firesLoad){
						addRemoveLoadEvents(elem, resetPreloading, true);
						clearTimeout(resetPreloadingTimer);
						resetPreloadingTimer = setTimeout(resetPreloading, 2500);

						addClass(elem, lazyRocketsConfig.loadingClass);
						addRemoveLoadEvents(elem, switchLoadingClass, true);
					}

					/*if(isPicture){
						sources = parent.getElementsByTagName('source');
						for(i = 0, len = sources.length; i < len; i++){
							if( (customMedia = lazyRocketsConfig.customMedia[sources[i].getAttribute('data-media') || sources[i].getAttribute('media')]) ){
								sources[i].setAttribute('media', customMedia);
							}
							sourceSrcset = sources[i].getAttribute(lazyRocketsConfig.srcsetAttr);
							if(sourceSrcset){
								sources[i].setAttribute('srcset', sourceSrcset);
							}
						}
					}*/
					if(srcset){
						elem.setAttribute('srcset', srcset);
					}
					if(sizes){
						elem.setAttribute('sizes', sizes);
					}
					if(src){
						if(regIframe.test(elem.nodeName)){
							changeIframeSrc(elem, src);
						} else {
							elem.setAttribute('src', src);
						}
					}

					if(isPicture){
						updatePolyfill(elem, {src: src});
					}
				}

				if( !firesLoad || (elem.complete && curSrc == (elem.currentSrc || elem.src)) ){
					if(firesLoad){
						resetPreloading(event);
					} else {
						isLoading--;
					}
					switchLoadingClass(event);
				}
			});
		};

		var onload = function(){
			var scrollTimer;
			var afterScroll = function(){
				lazyRocketsConfig.loadMode = 3;
				throttledCheckElements();
			};

			isCompleted = true;
			lowRuns += 8;

			lazyRocketsConfig.loadMode = 3;

			addEventListener('scroll', function(){
				if(lazyRocketsConfig.loadMode == 3){
					lazyRocketsConfig.loadMode = 2;
				}
				clearTimeout(scrollTimer);
				scrollTimer = setTimeout(afterScroll, 99);
			}, true);
		};

		return {
			_: function(){

				lazyloadElems = document.getElementsByClassName(lazyRocketsConfig.lazyClass);
				preloadElems = document.getElementsByClassName(lazyRocketsConfig.lazyClass + ' ' + lazyRocketsConfig.preloadClass);
				
				/*lazyloadElems = document.querySelectorAll('[data-lazy-src],[data-lazy-original]');
				preloadElems = document.querySelectorAll('[data-lazy-src].' + lazyRocketsConfig.preloadClass + ', [data-lazy-original].' + lazyRocketsConfig.preloadClass);*/

				defaultExpand = lazyRocketsConfig.expand;
				preloadExpand = Math.round(defaultExpand * lazyRocketsConfig.expFactor);

				addEventListener('scroll', throttledCheckElements, true);
				addEventListener('resize', throttledCheckElements, true);

				if(window.MutationObserver){
					new MutationObserver( prepareThrottledCheckElements ).observe( docElem, {childList: true, subtree: true, attributes: true} );
					
					new MutationObserver( throttledCheckElements ).observe( docElem, {childList: true, subtree: true, attributes: true} );
				} else {
					docElem.addEventListener('DOMNodeInserted', prepareThrottledCheckElements, true);
					docElem.addEventListener('DOMAttrModified', prepareThrottledCheckElements, true);
					setInterval(prepareThrottledCheckElements, 999);

					docElem.addEventListener('DOMNodeInserted', throttledCheckElements, true);
					docElem.addEventListener('DOMAttrModified', throttledCheckElements, true);
					setInterval(throttledCheckElements, 999);
				}

				addEventListener('hashchange', prepareThrottledCheckElements, true);

				/*if(window.MutationObserver){
					new MutationObserver( throttledCheckElements ).observe( docElem, {childList: true, subtree: true, attributes: true} );
				} else {
					docElem.addEventListener('DOMNodeInserted', throttledCheckElements, true);
					docElem.addEventListener('DOMAttrModified', throttledCheckElements, true);
					setInterval(throttledCheckElements, 999);
				}

				addEventListener('hashchange', throttledCheckElements, true);*/

				['focus', 'mouseover', 'click', 'load', 'transitionend', 'animationend', 'webkitAnimationEnd'].forEach(function(name){
					document.addEventListener(name, throttledCheckElements, true);
				});

				if(!(isCompleted = /d$|^c/.test(document.readyState))){
					addEventListener('load', onload);
					document.addEventListener('DOMContentLoaded', throttledCheckElements);
				} else {
					onload();
				}

				throttledCheckElements(lazyloadElems.length > 0);
			},
			checkElems: throttledCheckElements,
			unveil: unveilElement
		};
	})();

	var init = function(){
		if(!init.i){
			init.i = true;
			loader._();
		}
	};

	(function(){
		var prop;
		var lazyRocketsDefaults = {
			lazyClass: 'lazyload',
			loadedClass: 'lazyloaded',
			loadingClass: 'lazyloading',
			preloadClass: 'lazypreload',
			errorClass: 'lazyerror',
			autosizesClass: 'lazyautosizes',
			//srcAttr: 'data-src',
			//srcsetAttr: 'data-srcset',
			//sizesAttr: 'data-sizes',
			//minSize: 40,
			//customMedia: {},
			init: true,
			expFactor: 2,
			expand: 359,
			loadMode: 2,
			throttle: 99
		};

		lazyRocketsConfig = window.lazyRocketsConfig || window.lazyRocketsConfig || {};

		for(prop in lazyRocketsDefaults){
			if(!(prop in lazyRocketsConfig)){
				lazyRocketsConfig[prop] = lazyRocketsDefaults[prop];
			}
		}

		window.lazyRocketsConfig = lazyRocketsConfig;

		setTimeout(function(){
			if(lazyRocketsConfig.init){

				var tmpElems = document.querySelectorAll('[data-lazy-src],[data-lazy-original]');
				for (var i = 0; i < tmpElems.length; i++) {
					addClass(tmpElems[i], lazyRocketsConfig.lazyClass);
				};

				init();
			}
		});
	})();

	return {
		cfg: lazyRocketsConfig,
		loader: loader,
		init: init,
		uP: updatePolyfill,
		aC: addClass,
		rC: removeClass,
		hC: hasClass,
		fire: triggerEvent
	};
})(window, document);
;
