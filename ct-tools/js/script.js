/*
--------------------------------------------------------------------------------------
SCRIPT INDEX
--------------------------------------------------------------------------------------

1. JS IS WORKING
	- Remove .no-js class

2. DEVICE/BROWSER DETECTION

3. SPLASH CTA INTERCEPT

4. CHART FUNCTIONALITY
	- Services

5. CHART FUNCTIONALITY
	- Income

6. BUILD SCREEN
	- Animations etc

7. END SCREEN
	- Add focus for text inputs

8. REDRAW
	- Redraws screen elements to clear artifacts

--------------------------------------------------------------------------------------
*/



// 1. JS IS WORKING - Remove .no-js class
// --------------------------------------------------------------------------------------
$('html').removeClass('no-js');



// 2. DEVICE/BROWSER DETECTION
// --------------------------------------------------------------------------------------

var iebrowser = false; 
if (/MSIE (\d+\.\d+);/.test(navigator.userAgent)){ //test for MSIE x.x;
	var ieversion=new Number(RegExp.$1) // capture x.x portion and store as a number
	iebrowser = true;
}


// 3. SPLASH CTA INTERCEPT
// --------------------------------------------------------------------------------------

var href;

$('a.cta').click(function(e) {

	e.preventDefault();
	href = $(this).attr('href');

	$('.splash').animate({
		opacity: '0'
	}, 500);

	$('.cookie').animate({
		opacity: '0'
	}, 500);

	setTimeout('location.href= href',500);

});



// 4. CHART FUNCTIONALITY
// --------------------------------------------------------------------------------------

// set variables
var fieldset = '';
var prevFieldset = '';
var disableClickServices = false;

// Click
$('#services .chart a').click(function(e) {
	e.preventDefault();

	if(!disableClickServices) {

		disableClickServices = true;

		// get index of clicked element
		var i = $(this).parent().index();

		// update classes on chart elements
		$('#services .chart a').addClass('inactive');
		$(this).removeClass('inactive');
		$('#services .selected').removeClass('selected');
		$(this).addClass('selected');

		// set previous fieldset to last fieldset
		prevFieldset = fieldset;
		
		// set fieldset to current fieldset
		fieldset = $('form').find('fieldset:eq('+i+')')

		// animate
		if(!mobile) {
			$('#services .cta, #services .finish, #services .actions').animate({
				left: -380
			}, 500, function(){

			});
			
			$('#services .intro').animate({
				left: -380
			}, 500, function(){

				$('#services .intro, #services .cta, #services .finish, #services .actions').hide();

				if(prevFieldset != '') {


					prevFieldset.animate({
						left: -380
					}, 500, function(){



						prevFieldset.hide();
						disableClickServices = false;


						fieldset.show().animate({
							left: 0
						}, 500, function() {
						});

					

					});
				} else {
					

					fieldset.show().animate({
						left: 0
					}, 500, function() {
						disableClickServices = false;
					});

				}


			});

		} else if(mobile) {

			$('#services .finish').animate({
				left: -380
			}, 500, function(){

			});

			$('#services .actions').animate({
				left: -380
			}, 500, function(){

				if(prevFieldset != '') {

					prevFieldset.animate({
						left: -380
					}, 500, function(){

						prevFieldset.hide();

						fieldset.show().animate({
							left: 0
						}, 500, function(){
							disableClickServices = false;
						});

					});
				} else {
					
					fieldset.show().animate({
						left: 0
					}, 500,function(){
						disableClickServices = false;
					});

				}
		        if(parent.document.getElementById("budgettool")) {
		        	window.parent.window.scroll(0,findPos(window.parent.document.getElementById('budgettool'), -400));
		    	}

		    	$('#services .finish, #services .actions').hide();

			});

		}
	}

});



// update chart and check if complete
var priority;
var complete = 0;

$('form input[type=radio]').click(function() {

	// get priority classes and update chart
	priority = $(this).attr('class');
	setTimeout('updateChart()',250);

	// 6. Record..
	var id = $(this).closest("fieldset").attr("id");
	recordClick(id);

});

var updateChart = function () {

	// set classes on chart
	$('#services .chart a.selected').parents('li').attr('class', priority);
	$('#services .chart a').removeClass('inactive');
	$('#services .chart a').removeClass('selected');

	priority = '';

	// check if all priorities have been selected
	$('#services .chart li').each(function(){
		// console.log('each')
		if($(this).attr('class') == undefined) {
			// console.log('undefined')
		} else {
			complete++;
			// console.log(complete)
		}

	});


	//animate
	fieldset.animate({
		left: -380
	}, 500, function(){

		fieldset.hide();
		if(complete >= 14) {
			if(!mobile) {
				$('#services .cta, #services .finish, #services .actions').show().animate({
					left: 0
				}, 500);
			} else if(mobile) {
				$('#services .finish, #services .actions').show().animate({
					left: 0
				}, 500);
			}
		} else {
			$('#services .intro').show().animate({
				left: 0
			}, 500);

			if(!mobile) {
				$('#services .cta').show().animate({
					left: 0
				}, 500);
			} else if(mobile){
				if(parent.document.getElementById("budgettool")) {
			        window.parent.window.scroll(0,findPos(window.parent.document.getElementById('budgettool'), -280));
			    }
			}

			// reset complete for next test
			complete = 0;
		
		}

	});

}





// 5. CHART FUNCTIONALITY - Income
// --------------------------------------------------------------------------------------

// set variables
var incomeText = '';
var prevIncomeText = '';
var disableClickIncome = false;

// Click
$('#income .chart a').click(function(e) {
	e.preventDefault();

	if(!disableClickIncome) {

		disableClickIncome = true;

		// get index of clicked element
		var i = $(this).parent().index();

		// update classes on chart elements
		$('#income .chart a').addClass('inactive');
		$(this).removeClass('inactive');
		$('#income .selected').removeClass('selected');
		$(this).addClass('selected');

		// set previous fieldset to last fieldset
		prevIncomeText = incomeText;
		
		// set fieldset to current fieldset
		incomeText = $('.income_text_container').find('.income_text:eq('+i+')')

		// animate
		if(!mobile) {

			$('#income .intro').animate({
				left: -380
			}, 500, function(){

				$('#income .intro').hide();

				if(prevIncomeText != '') {


					prevIncomeText.animate({
						left: -380
					}, 500, function(){



						prevIncomeText.hide();
						disableClickIncome = false;


						incomeText.show().animate({
							left: 0
						}, 500, function() {
						});

					

					});
				} else {
					

					incomeText.show().animate({
						left: 0
					}, 500, function() {
						disableClickIncome = false;
					});

				}


			});

		} else if(mobile) {

			if(prevIncomeText != '') {

				prevIncomeText.animate({
					left: -380
				}, 500, function(){

					prevIncomeText.hide();

					incomeText.show().animate({
						left: 0
					}, 500, function(){
						disableClickIncome = false;
					});

				});
			} else {
				
				incomeText.show().animate({
					left: 0
				}, 500,function(){
					disableClickIncome = false;
				});

			}
	        if(parent.document.getElementById("budgettool")) {
		        window.parent.window.scroll(0,findPos(window.parent.document.getElementById('budgettool'), -200));
		    }

		}
	}

});









// 6. BUILD SCREEN - Animations etc
// --------------------------------------------------------------------------------------


var services_keyup;
var income_keyup;
var results_keyup;


if($('.splash').length == 0 && !mobile) {


	// move finish
	$('#services .finish').detach().insertAfter('#services .intro');


	// 1st elements

	$('h1').delay(500).animate({
		top: 0
	}, 500);

	$('.tabs-nav li').delay(600).fadeIn(500);

	var services_keyup;

	$('#services .key').delay(500).animate({
		top: 0
	}, 500, function() {
		$(this).find('h2').addClass('down');
		services_keyup = true;
	});



	// 2nd elements

	// MB - set the priorities this person chose last time for each service
	getPrevious();

	$('#services .chart li').delay(1000).each(function(i) {
		$(this).delay(50*i).fadeIn();
	});

	$('#services .chart p span').delay(1000).fadeIn();

	var counter = 0;
	var target = 774.3;
	var increment = 5.7;

	var updateTotal = function () {
		if(counter >= target) {
			$('#services .chart p span.total').html('£'+(target)+'m');
			return false;
		} else {
			counter = Math.round(counter + increment);
			$('#services .chart p span.total').html('£'+(counter)+'m');
			setTimeout('updateTotal()',1)
		}
	}
	setTimeout('updateTotal()',1000);




	// 3rd elements

	$('#services .intro').delay(1700).animate({
		left: 0
	}, 500);

	$('#services .cta').delay(1800).animate({
		left: 0
	}, 400);



	
	if(services_keyup == undefined) {
		$('#services .key').delay(1200).animate({
			top: 102
		}, 400, function(){
			$(this).find('h2').removeClass('down');
			services_keyup = false;
		
		});
	}


	// key open/close
	$('#services .key h2').click(function(){

		if(!services_keyup) {
			
			$(this).parents('.key').animate({
				top: 0
			}, 400, function(){
				$(this).find('h2').addClass('down');
				services_keyup = true;
			});

		} else {

			

			$(this).parents('.key').animate({
				top: 102
			}, 400, function(){
				$(this).find('h2').removeClass('down');
				services_keyup = false;
			});

		}

	});


} else if($('.splash').length == 0 && mobile) {
     
	// MB - set the priorities this person chose last time for each service
	getPrevious();

    // move window to top of iframe
    if(parent.document.getElementById("budgettool")) {
	    window.parent.window.scroll(0,findPos(window.parent.document.getElementById('budgettool'), 10));
	}

	// move tabs 
	$('.tabs-nav').detach().insertAfter('.tabs-panes');

	// move form
	$('form').detach().insertAfter('#services .chart');

	// move income text
	$('.income_text_container').detach().insertAfter('#income .chart');

	// change form labels
	$('fieldset label').each(function() {
		$(this).text($(this).text().replace(' priority',''));
	});

} else if($('.splash').length > 0 && !mobile) {
	var h = $('.splash').outerHeight() + $('.cookie').outerHeight();
	var i_height = 768;
	$('.splash').css('margin-top',(i_height - h)/2+'px')

}

$('.tab_services').click(function(){
	
	if(services_keyup == undefined) {
		$('#services .key').animate({
			top: 0
		}, 500, function() {
			services_keyup = true;
		});
	}

	var ol_start = 1;
	$('#services .key ol').each(function() {
		$(this).delay(100).attr('start',ol_start);
		ol_start = ol_start + 4;
	});

});



$('.tab_income').click(function(){

	if(income_keyup == undefined) {
		$('#income .key').animate({
			top: 0
		}, 500, function() {
			$(this).find('h2').addClass('down');
			income_keyup = true;
		});
	}

	$('#income .chart img').delay(500).fadeIn();

	$('#income .chart li').delay(1000).each(function(i) {
		$(this).delay(50*i).fadeIn();
	});

	$('#income .chart p span').delay(1500).fadeIn();

	$('#income .intro').delay(2000).animate({
		left: 0
	}, 500);


	$('#income .cta').delay(2100).animate({
		left: 0
	}, 500);

	if(income_keyup == undefined) {
		$('#income .key').delay(2100).animate({
			top: 102
		}, 400, function(){
			$(this).find('h2').removeClass('down');
			income_keyup = false;
		
		});
	}

	var ol_start = 1;
	$('#income .key ol').each(function() {
		$(this).attr('start',ol_start);
		ol_start = ol_start + 4;
	});
});



$('.tab_results').click(function(){

	if(results_keyup == undefined) {
		$('#results .key').animate({
			top: 0
		}, 500, function() {
			$(this).find('h2').addClass('down');
			results_keyup = true;
		});
	}

	$('#results .chart li').delay(500).each(function(i) {
		$(this).delay(50*i).fadeIn();
	});

	$('#results .chart p span').delay(750).fadeIn();

	$('#results .intro').delay(1000).animate({
		left: 0
	}, 500);

	$('#results .chart a').click(function(e){
		e.preventDefault();
	});

	if(results_keyup == undefined) {
		$('#results .key').delay(1200).animate({
			top: 102
		}, 400, function(){
			$(this).find('h2').removeClass('down');
			results_keyup = false;

		});
	}

	var ol_start = 1;
	$('#results .key ol').each(function() {
		$(this).attr('start',ol_start);
		ol_start = ol_start + 4;
	});

	// grab summary classes from the database and display
	load_summary();

});


// key open/close
$('#income .key h2').click(function(){

	if(!income_keyup) {
		
		$(this).parents('.key').animate({
			top: 0
		}, 400, function(){
			$(this).find('h2').addClass('down');
			income_keyup = true;
		});

	} else {

		

		$(this).parents('.key').animate({
			top: 102
		}, 400, function(){
			$(this).find('h2').removeClass('down');
			income_keyup = false;
		});

	}

});



// key open/close
$('#results .key h2').click(function(){

	if(!results_keyup) {
		
		$(this).parents('.key').animate({
			top: 0
		}, 400, function(){
			$(this).find('h2').addClass('down');
			results_keyup = true;
		});

	} else {

		

		$(this).parents('.key').animate({
			top: 102
		}, 400, function(){
			$(this).find('h2').removeClass('down');
			results_keyup = false;
		});

	}

});



// 7. END SCREEN - Add focus for text inputs
// --------------------------------------------------------------------------------------

if(!mobile){
	// Focus handler
	$('.actions .container input').focus(function(){
		$(this).parent().addClass('focus');
	})
	$('.actions .container input').blur(function(){
		$(this).parent().removeClass('focus');
	})

}




// MB - x. RESPONSE HANDLER  - log click against database and cookie 
// --------------------------------------------------------------------------------------

// Track this response
function recordClick(id){
	$.ajax({
	  url: 'handler.php?do=track&id='+id+'&priority='+priority
	});
}

// get the selected state of the services this device chose last time
function getPrevious(){
	$.ajax({
		url: 'handler.php?do=plot',
		success: function (data){
			setPrevious(data);
		}
	});
}

// apply correct class to the selected services
function setPrevious(data){
	if(data !=='null'){
		var obj = $.parseJSON(data);
		$.each(obj, function(key , value) {
			// set low, med, high
			$('#c'+key).addClass(value);

			// mark as radio button as checked
			$('#f'+key+' div.radio.'+value+' span').addClass('checked');
		});
	}
}

// grab the data for the overall results chart and call for it to be displayed
function load_summary(){
	// collate the summary priorities
	$.ajax({
		url: 'handler.php?do=summary',
		success: function (data){
			// retrieved, apply the correct class to each circle
			var obj = $.parseJSON(data);
			$.each(obj, function(key , value) {
				// remove defaults
				$('.s_'+key).removeClass('low');
				$('.s_'+key).removeClass('med');
				$('.s_'+key).removeClass('high');

				// set the resultant class 
				$('.s_'+key).addClass(value);
			});

			// display..
			setTimeout('display_summary()',500);
		}
	});	
}

// display the overall results summary..
function display_summary(){
	/*$('#results .key').animate({
		top: 0
	}, 500);*/

	$('#results .chart li').delay(500).each(function(i) {
		$(this).delay(50*i).fadeIn();
	});

	$('#results .chart p span').delay(750).fadeIn();

	$('#results .intro').delay(1000).animate({
		left: 0
	}, 500);

	$('#results .chart a').click(function(e){
		e.preventDefault();
	})

	var ol_start = 1;
	$('#results .key ol').each(function() {
		$(this).attr('start',ol_start);
		ol_start = ol_start + 4;
	});	
}

// email form handler..
$('#btn_submit').click(function(e){
	e.preventDefault();

	// email form has been submitted, validate the UI and process if able
	var email = $('#txt_email').val();
	if(validateEmail(email)){
		// looks good, store
		$.ajax({
			url: 'handler.php?do=store_email&email='+encodeURIComponent(email),
			success: function (){
				$('.actions div').addClass('form_sent');
				$('#txt_email').val('Thank you');
				
				// hide form
				$('.actions').delay(1500).animate({
					opacity: 0
				}, 500);
			}
		});

	}else{
		// not an email..
		$('.actions div').addClass('form_fail');
	}
});

function validateEmail(email) {
	var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
	if( !emailReg.test( email ) ) {
		return false;
	} else {
		return true;
	}
}



// 8.REDRAW - Redraws screen elements to clear artifacts
// --------------------------------------------------------------------------------------

$.fn.redraw = function() {
  return this.hide(0, function(){$(this).show()});
};

if(!iebrowser) {
	$('.splash .cta').redraw();
}

