window.log = function f(){ log.history = log.history || []; log.history.push(arguments); if(this.console) { var args = arguments, newarr; args.callee = args.callee.caller; newarr = [].slice.call(args); if (typeof console.log === 'object') log.apply.call(console.log, console, newarr); else console.log.apply(console, newarr);}};
(function(a){function b(){}for(var c="assert,count,debug,dir,dirxml,error,exception,group,groupCollapsed,groupEnd,info,log,markTimeline,profile,profileEnd,time,timeEnd,trace,warn".split(","),d;!!(d=c.pop());){a[d]=a[d]||b;}})
(function(){try{console.log();return window.console;}catch(a){return (window.console={});}}());


/*
--------------------------------------------------------------------------------------
PLUGINS INDEX
--------------------------------------------------------------------------------------

1. JQUERY TOOLS
	- Init tabs

2. JQUERY TOOLS
	- Init tooltips

3. JQUERY UNIFORM
	- Custom radio buttons

4. JQUERY PLACEHOLDER
	- Fallback for HTML5 placeholder attribute

--------------------------------------------------------------------------------------
*/

var isiPad = navigator.userAgent.match(/iPad/i) != null;


// 1. JQUERY TOOLS - Init tabs
// --------------------------------------------------------------------------------------
$('ul.tabs-nav').tabs('div.tabs-panes > div',{
	initialIndex: 0
});

if(mobile) {

//Finds y value of given object
function findPos(obj, offset) {

    var curtop = 0;

    if (obj.offsetParent) {
    do {
        curtop += obj.offsetTop;
    } while (obj = obj.offsetParent);
        return [curtop-offset];
    }
}

    $('.tabs-nav a').click(function(){
    	if(parent.document.getElementById("budgettool")) {
        	window.parent.window.scroll(0,findPos(window.parent.document.getElementById('budgettool'), 10));
        }
    });
}



// 2. JQUERY TOOLS - Init tooltips
// --------------------------------------------------------------------------------------
if($('.chart').length > 0) {

	if(!mobile && !isiPad) {
		$('.chart a[title]').tooltip({
			position: 'bottom center',
			offset: [10, 0],
			opacity: 0.95,
			events: {
		        def:     "mouseover,mouseout",
		        input:   "focus,blur",
		        widget:  "focus mouseover,blur mouseout",
		        tooltip: "focus,blur"
		    },
            onHide: function() {
                if(!iebrowser) {
                    $('.chart').redraw();
                }
            }
		});
	}

}



// 3. JQUERY UNIFORM - Custom radio buttons
// --------------------------------------------------------------------------------------
$.getScript('ct-tools/js/plugins/jquery.uniform.min.js', function() {
	
	$('input:radio').uniform();

	$('.radio').each(function() {
		$(this).addClass($(this).find('input').attr('class'));
	});

	$('label').hover(
		function () {
			$(this).parent().find('.radio').addClass('hover');
		},
		function () {
			$(this).parent().find('.radio').removeClass('hover');
		}
	);

});



// 4. JQUERY PLACEHOLDER - Fallback for HTML5 placeholder attribute
// --------------------------------------------------------------------------------------

$.getScript('ct-tools/js/plugins/jquery.placeholder.min.js', function() {
	$('input[placeholder], textarea[placeholder]').placeholder();
});


