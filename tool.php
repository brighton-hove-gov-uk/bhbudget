<?php
session_start();

// Cannot access app directly without a respondent ID
// Must go via the splash page in order to generate one
// If ID has been removed, expired or just not set, redirect.. 
if(!isset($_COOKIE['bhcc_priorities'])){
	header('location:index.html');
	exit;
}

$useragent=$_SERVER['HTTP_USER_AGENT'];
if(preg_match('/android.+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){ $mob_browser = true; } else { $mob_browser = false; }
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  
	<title>Brighton &amp; Hove City Council</title>

	<meta name="description" content="" />
	<meta name="keywords" content=" " />
	<meta name="author" content="" />
	<meta name="robots" content="index, follow" />
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

	<script>
		var mobile = false;
	</script>

	<?php if($mob_browser) {  ?>

		<meta name="viewport" content="width=device-width, initial-scale=1.0;">
		<script type="text/javascript">

			// mobile variable
			mobile = true;

			// resize iframe
			if(parent.document.getElementById("budgettool")) {
				parent.document.getElementById("budgettool").style.width = "320px";
				parent.document.getElementById("budgettool").style.height = "480px";
			}

		</script>

	<?php } else { ?>
		<meta name="viewport" content="width=960">
	<?php } ?>

	<link type="text/css" rel="stylesheet" href="http://fast.fonts.com/cssapi/f46a06b2-5bc1-4ac0-a318-3223d1cdd112.css"/>
	<link rel="stylesheet" href="ct-tools/css/style.css?c=1" />
	<link rel="stylesheet" href="ct-tools/css/media-queries.css" />
  
</head>
<body>

	<div role="main" class="wrapper">

		<h1><i>Your money,</i> <br/>your services</h1>

		<ul class="tabs-nav">
			<li><a class="tab_services" href="#" title="Council Services">Council Services</a></li>
			<li><a class="tab_income" href="#" title="Council Income">Council Income</a></li>
			<li><a class="tab_results" href="#" title="Overall Results">Overall Results</a></li>
		</ul>

		<div class="tabs-panes">

			<div id="services" class="tabs-pane">

				<div class="guide">

					<div class="intro">
						<h2>Council Services</h2>
						<p>Brighton &amp; Hove City Council is beginning to outline its spending plans for the next financial year.</p>
						<p>Read about each service area, and tell us if it is a high, medium or low priority for you. Your answers will be taken into account when setting next year’s budget.</p>
						<p>After you have voted, click on the headings <span class="help-desktop">on the top right of the screen</span><span class="help-mobile">at the bottom of the page</span> to see where the council’s income comes from, and how other people have rated the services so far.</p>
					</div>

					<div class="cta">

						<h3>Click on a circle</h3>

					</div>
					
					<form id="frm">

						<fieldset id="f1">
							
							<h2>Education – £189.9m</h2>
							<p>Pre-school education, primary, secondary and special schools, and other services such as home to school transport. This service is mostly funded by central government.</p>
							<ul>
								<li>
									<label class="low" for="f1_l">Low priority</label>
									<input type="radio" class="low" id="f1_l" name="f1" value="low"/>
								</li>
								<li>
									<label class="med" for="f1_m">Medium priority</label>
									<input type="radio" class="med" id="f1_m" name="f1" value="medium"/>
								</li>
								<li>
									<label class="high" for="f1_h">High priority</label>
									<input type="radio" class="high" id="f1_h" name="f1" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f2">
							
							<h2>Housing Benefit – £160m</h2>
							<p>This is a means-tested benefit which helps residents meet the cost of rented accommodation. This is a service provided by the council on behalf of the government and is fully funded by central government. </p>
							<ul>
								<li>
									<label class="low" for="f2_l">Low priority</label>
									<input type="radio" class="low" id="f2_l" name="f2" value="low"/>
								</li>
								<li>
									<label class="med" for="f2_m">Medium priority</label>
									<input type="radio" class="med" id="f2_m" name="f2" value="medium"/>
								</li>
								<li>
									<label class="high" for="f2_h">High priority</label>
									<input type="radio" class="high" id="f2_h" name="f2" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f3">
							
							<h2>Adult Social Care – £111.6m</h2>
							<p>Meeting the assessed needs of older people (aged 65+) and of adults (aged 18-65) with either a learning disability, physical disability, mental illness or substance misuse issues.</p>
							<ul>
								<li>
									<label class="low" for="f3_l">Low priority</label>
									<input type="radio" class="low" id="f3_l" name="f3" value="low"/>
								</li>
								<li>
									<label class="med" for="f3_m">Medium priority</label>
									<input type="radio" class="med" id="f3_m" name="f3" value="medium"/>
								</li>
								<li>
									<label class="high" for="f3_h">High priority</label>
									<input type="radio" class="high" id="f3_h" name="f3" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f4">
							
							<h2>Housing – £62.2m</h2>
							<p>Managing the council’s housing stock, developing housing options, providing housing-related support and improving housing quality in the private sector.</p>
							<ul>
								<li>
									<label class="low" for="f4_l">Low priority</label>
									<input type="radio" class="low" id="f4_l" name="f4" value="low"/>
								</li>
								<li>
									<label class="med" for="f4_m">Medium priority</label>
									<input type="radio" class="med" id="f4_m" name="f4" value="medium"/>
								</li>
								<li>
									<label class="high" for="f4_h">High priority</label>
									<input type="radio" class="high" id="f4_h" name="f4" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f5">
							
							<h2>Children’s Social Care – £50.3m</h2>
							<p>Working with the NHS to plan services for children, young people and families. This includes services available to all such as children’s centres and youth services, and specialist services such as child protection, fostering, adoption, the Youth Offending Service and services for children with a disability or special needs.</p>
							<ul>
								<li>
									<label class="low" for="f5_l">Low priority</label>
									<input type="radio" class="low" id="f5_l" name="f5" value="low"/>
								</li>
								<li>
									<label class="med" for="f5_m">Medium priority</label>
									<input type="radio" class="med" id="f5_m" name="f5" value="medium"/>
								</li>
								<li>
									<label class="high" for="f5_h">High priority</label>
									<input type="radio" class="high" id="f5_h" name="f5" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f6">
							
							<h2>Capital Investment Programme – £45.2m</h2>
							<p>This includes funding capital investment in services such as housing, schools, highways, regeneration and council buildings.</p>
							<ul>
								<li>
									<label class="low" for="f6_l">Low priority</label>
									<input type="radio" class="low" id="f6_l" name="f6" value="low"/>
								</li>
								<li>
									<label class="med" for="f6_m">Medium priority</label>
									<input type="radio" class="med" id="f6_m" name="f6" value="medium"/>
								</li>
								<li>
									<label class="high" for="f6_h">High priority</label>
									<input type="radio" class="high" id="f6_h" name="f6" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f7">
							
							<h2>Highways &amp; Traffic Management – £32.9m</h2>
							<p>Managing car parks and off-street parking, coordinating roadworks, managing sea defences, road safety schemes, winter travel and improving public transport. This service area generates income through fees, charges and rents of £26.2m therefore the net cost of these services is £6.7m.</p>
							<ul>
								<li>
									<label class="low" for="f7_l">Low priority</label>
									<input type="radio" class="low" id="f7_l" name="f7" value="low"/>
								</li>
								<li>
									<label class="med" for="f7_m">Medium priority</label>
									<input type="radio" class="med" id="f7_m" name="f7" value="medium"/>
								</li>
								<li>
									<label class="high" for="f7_h">High priority</label>
									<input type="radio" class="high" id="f7_h" name="f7" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f8">
							
							<h2>Central Services – £27.9m</h2>
							<p>Support for the running of all council services, such as finance, information technology and human resources, plus the switchboard, reception, customer service advisors, bereavement services, registration of births, deaths and marriages, electoral services and local land charges.</p>
							<ul>
								<li>
									<label class="low" for="f10_l">Low priority</label>
									<input type="radio" class="low" id="f10_l" name="f10" value="low"/>
								</li>
								<li>
									<label class="med" for="f10_m">Medium priority</label>
									<input type="radio" class="med" id="f10_m" name="f10" value="medium"/>
								</li>
								<li>
									<label class="high" for="f10_h">High priority</label>
									<input type="radio" class="high" id="f10_h" name="f10" value="high"/>
								</li>
							</ul>

						</fieldset>

						<!-- DELETE ME
						<fieldset id="f9">
							
							<h2>Council Tax Benefit – £25m</h2>
							<p>Supports people on low incomes with their Council Tax. Council Tax Benefit is changing to a local Council Tax Support scheme from April 2013.</p>
							<ul>
								<li>
									<label class="low" for="f8_l">Low priority</label>
									<input type="radio" class="low" id="f8_l" name="f8" value="low"/>
								</li>
								<li>
									<label class="med" for="f8_m">Medium priority</label>
									<input type="radio" class="med" id="f8_m" name="f8" value="medium"/>
								</li>
								<li>
									<label class="high" for="f8_h">High priority</label>
									<input type="radio" class="high" id="f8_h" name="f8" value="high"/>
								</li>
							</ul>

						</fieldset>
						END DELETE 	-->

						<fieldset id="f10">
							
							<h2>Refuse Collection, Disposal &amp; Recycling – £24.1m</h2>
							<p>Street cleaning, recycling and refuse services for all residents in the city and managing the disposal of domestic waste.</p>
							<ul>
								<li>
									<label class="low" for="f9_l">Low priority</label>
									<input type="radio" class="low" id="f9_l" name="f9" value="low"/>
								</li>
								<li>
									<label class="med" for="f9_m">Medium priority</label>
									<input type="radio" class="med" id="f9_m" name="f9" value="medium"/>
								</li>
								<li>
									<label class="high" for="f9_h">High priority</label>
									<input type="radio" class="high" id="f9_h" name="f9" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f11">
							
							<h2>Libraries, Museums &amp; Tourism – £23.1m</h2>
							<p>Promoting reading and lifelong learning through free access to books and information in a variety of media. Managing the Royal Pavilion, museums, art galleries, archives, seafront and outdoor events. Also running the Brighton Centre and Hove Centre and marketing the city as a conference, entertainment and exhibition destination. This service generates income through fees, charges and rents of £9.8m so the net cost of these services is £13.3m.</p>
							<ul>
								<li>
									<label class="low" for="f11_l">Low priority</label>
									<input type="radio" class="low" id="f11_l" name="f11" value="low"/>
								</li>
								<li>
									<label class="med" for="f11_m">Medium priority</label>
									<input type="radio" class="med" id="f11_m" name="f11" value="medium"/>
								</li>
								<li>
									<label class="high" for="f11_h">High priority</label>
									<input type="radio" class="high" id="f11_h" name="f11" value="high"/>
								</li>
							</ul>

						</fieldset>

						<!-- ADD ME -->
						<fieldset id="f15">
							
							<h2>Public Health – £18.2m</h2>
							<p>On 1 April 2013 the council gained new public health responsibilities to improve the health of its population. The Department of Health has awarded a ring fenced grant of over £18 million for 2014/15 to cover public health responsibilities. This includes improving the wider determinants of health like poverty, employment, education, mental wellbeing, health improvement to promote healthy lifestyles and reduce health inequalities, health protection from major incidents, including infectious disease and sexually transmitted infections and the prevention of premature mortality and reducing the gap between communities.</p>

							<ul>
								<li>
									<label class="low" for="f15_l">Low priority</label>
									<input type="radio" class="low" id="f15_l" name="f15" value="low"/>
								</li>
								<li>
									<label class="med" for="f15_m">Medium priority</label>
									<input type="radio" class="med" id="f15_m" name="f15" value="medium"/>
								</li>
								<li>
									<label class="high" for="f15_h">High priority</label>
									<input type="radio" class="high" id="f15_h" name="f15" value="high"/>
								</li>
							</ul>

						</fieldset>
						<!-- END ADD 	-->

						<fieldset id="f12">
							
							<h2>Planning &amp; Economic Development – £10.6m</h2>
							<p>Supporting economic development and major projects within the city, development planning and building control, supporting community development, promoting equalities, funding the community grants programme, and providing supported employment for disabled adults.</p>
							<ul>
								<li>
									<label class="low" for="f12_l">Low priority</label>
									<input type="radio" class="low" id="f12_l" name="f12" value="low"/>
								</li>
								<li>
									<label class="med" for="f12_m">Medium priority</label>
									<input type="radio" class="med" id="f12_m" name="f12" value="medium"/>
								</li>
								<li>
									<label class="high" for="f12_h">High priority</label>
									<input type="radio" class="high" id="f12_h" name="f12" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f13">
							
							<h2>Leisure, Parks &amp; Open Spaces – £10.4m</h2>
							<p>Managing parks, open spaces, public trees and allotments. Providing leisure centres, sports development and other physical activities.</p>
							<ul>
								<li>
									<label class="low" for="f13_l">Low priority</label>
									<input type="radio" class="low" id="f13_l" name="f13" value="low"/>
								</li>
								<li>
									<label class="med" for="f13_m">Medium priority</label>
									<input type="radio" class="med" id="f13_m" name="f13" value="medium"/>
								</li>
								<li>
									<label class="high" for="f13_h">High priority</label>
									<input type="radio" class="high" id="f13_h" name="f13" value="high"/>
								</li>
							</ul>

						</fieldset>

						<fieldset id="f14">
							
							<h2>Public Safety – £7.9m</h2>
							<p>Working with police and other partners to tackle drug and alcohol misuse, anti-social behaviour, re-offending and domestic violence. Managing trading standards, environmental health and licensing and providing public toilets.</p>
							<ul>
								<li>
									<label class="low" for="f14_l">Low priority</label>
									<input type="radio" class="low" id="f14_l" name="f14" value="low"/>
								</li>
								<li>
									<label class="med" for="f14_m">Medium priority</label>
									<input type="radio" class="med" id="f14_m" name="f14" value="medium"/>
								</li>
								<li>
									<label class="high" for="f14_h">High priority</label>
									<input type="radio" class="high" id="f14_h" name="f14" value="high"/>
								</li>
							</ul>

						</fieldset>

						<div class="finish">
							<p>Thanks! You have successfully rated all the Council's Services.</p>
							<p>You can continue to make further changes and these will automatically update on our systems.</p>
							<p>You can also leave your email address to receive updates on the outcome of this tool.</p>
						</div>

						<fieldset class="actions">
							<label for="txt_email" class="hidden">Your email address</label>
							<div class="container">
								<input type="text" id="txt_email" value="" placeholder="Your email address" />
								<input type="submit" id="btn_submit" value="Submit" />
							</div>
						</fieldset>

					</form>

				</div>

				<div class="chart">

					<p><span class="text">2013/14 Total:</span> <span class="total">£774.3m</span></p>

					<ul>
						<li id="c1"><a href="#f1" title="Education">1<span></span></a></li>
						<li id="c2"><a href="#f2" title="Housing Benefit">2<span></span></a></li>
						<li id="c3"><a href="#f3" title="Adult Social Care">3<span></span></a></li>
						<li id="c4"><a href="#f4" title="Housing">4<span></span></a></li>
						<li id="c5"><a href="#f5" title="Children’s Social Care">5<span></span></a></li>
						<li id="c6"><a href="#f6" title="Capital Investment Programme">6<span></span></a></li>
						<li id="c7"><a href="#f7" title="Highways &amp; Traffic Management">7<span></span></a></li>
						<li id="c8"><a href="#f8" title="Central Services">8<span></span></a></li>
						<li id="c10"><a href="#f10" title="Refuse Collection, Disposal &amp; Recycling">9<span></span></a></li>
						<li id="c11"><a href="#f11" title="Libraries, Museums &amp; Tourism">10<span></span></a></li>
						<li id="c15"><a href="#f15" title="Public Health">11<span></span></a></li>
						<li id="c12"><a href="#f12" title="Planning &amp; Economic Development">12<span></span></a></li>
						<li id="c13"><a href="#f13" title="Leisure, Parks &amp; Open Spaces">13<span></span></a></li>
						<li id="c14"><a href="#f14" title="Public Safety">14<span></span></a></li>
					</ul>

				</div>

				<div class="key">

					<ul>
						<li class="fund1">High priority</li>
						<li class="fund2">Med priority</li>
						<li class="fund3">Low priority</li>
					</ul>

					<h2>Services Key</h2>

					<div class="container">

						<ol start="1">
							<li><span>Education</span></li>
							<li><span>Housing Benefit</span></li>
							<li><span>Adult Social Care</span></li>
							<li><span>Housing</span></li>
						</ol>

						<ol start="5">
							<li><span>Children’s Social Care</span></li>
							<li><span>Capital Investment Programme</span></li>
							<li><span>Highways &amp; Traffic Management</span></li>
							<li><span>Central Services</span></li>
						</ol>

						<ol start="9">
							<li><span>Refuse Collection, Disposal &amp; Recycling</span></li>
							<li><span>Libraries, Museums &amp; Tourism</span></li>
							<li><span>Public Health</span></li>
							<li><span>Planning &amp; Economic Development</span></li>
						</ol>

						<ol start="13">
							<li><span>Leisure, Parks &amp; Open Spaces</span></li>
							<li><span>Public Safety</span></li>
						</ol>

					</div>

					<ul class="more_links">
						<li><a href="http://www.brighton-hove.gov.uk/bhbudget" title="Have your say" target="_top">Have your say</a></li>
						<li><a href="http://www.brighton-hove.gov.uk/content/council-and-democracy/council-finance/cost-our-services-201314" title="More about council services" target="_top">More about council services</a></li>
					</ul>

				</div>

			</div>

			<div id="income" class="tabs-pane">

				<div class="guide">

					<div class="intro">
						<h2>Where the money comes from.</h2>
						<p>Council Tax is only a fraction of the council’s income. This is where the income came from in 2013/14.</p>


						<div class="cta">

							<h3>Click on a number</h3>

						</div>

					</div>

					<div class="income_text_container">

						<div id="t1" class="income_text">
							<h2>1. Housing Benefit Grant – £160.0m</h2>
							<p>The council provides housing benefits locally and recoups the cost from central government. Housing Benefit will transfer to Universal Credit and Pension Credit over the next four years.</p>
						</div>

						<div id="t2" class="income_text">
							<h2>2. Dedicated Schools Grant – £153.8m</h2>
							<p>This grant can only be spent on schools and support for education. It covers the majority of expenditure on education including teachers and support staff, teaching materials, school buildings and central school services. The level of grant from the government depends on the number of pupils.</p>
						</div>

						<div id="t3" class="income_text">
							<h2>3. Government Grants – £135.6m</h2>
							<p>The government allocates a number of grants to the council, some of which are ring-fenced and must be used for particular projects, while others are treated as a general resource to the council.</p>
						</div>

						<div id="t4" class="income_text">
							<h2>4. Business Rates Retained By Council – £42.2m</h2>
							<p>The government changed the way councils are funded for 2013/14. Previously all business rates were passed to government and distributed to councils through a complex formula. From 2013/14 councils retain a 49% share of business rates collected locally.</p>
						</div>

						<div id="t5" class="income_text">
							<h2>5. Council Tax – £102.7m</h2>
							<p>This is the income from Council Tax payers across the city, which helps to pay for local services such as parks, libraries, planning, social care and household refuse collection. The council is limited on how much it can increase Council Tax. Higher increases would need to be agreed by holding a referendum with residents.</p>
						</div>

						<div id="t6" class="income_text">
							<h2>6. Use of reserves – £9.1m</h2>
							<p>The council holds appropriate levels of reserves to provide a safety net for risks, and for specific purposes. These reserves can be released to support the budget, either to fund particular projects or as part of a review of the level of reserves.</p>
						</div>

						<div id="t7" class="income_text">
							<h2>7. Investment Income – £0.5m</h2>
							<p>This is income generated through the investment of the council’s cash and treasury management.</p>
						</div>

						<div id="t8" class="income_text">
							<h2>8. Housing Rents – £50.5m</h2>
							<p>Rental income from council housing tenants. Used to operate and maintain the housing stock owned by the council.</p>
						</div>

						<div id="t9" class="income_text">
							<h2>9. Fees, Charges and Rents – £119.9m</h2>
							<p>Some council services are chargeable, such as parking, weddings, admission to the Royal Pavilion, allotments and beach hut hire. The council also collects rents from council-owned commercial properties and farms. In some cases the money is ring-fenced and can only be used for certain purposes, such as parking income. </p>
						</div>

					</div>

				</div>

				<div id="income_chart" class="chart">

					<p><span class="text">2013/14 Total:</span> <span class="total">£774.3m</span></p>

					<img src="ct-tools/img/chart.png" alt="" />

					<ul><!-- CHANGED IDs
						<li id="i1"><a href="#t1" title="Housing Benefit Grant">1</a></li>
						<li id="i2"><a href="#t2" title="Dedicated Schools Grant">2</a></li>
						<li id="i3"><a href="#t3" title="Council Tax">3</a></li>
						<li id="i4"><a href="#t4" title="Fees, Charges &amp; Rents">4</a></li>
						<li id="i5"><a href="#t5" title="Formula Grant from Government">5</a></li>
						<li id="i6"><a href="#t6" title="Housing Rents">6</a></li>
						<li id="i7"><a href="#t7" title="Specific Government Grants">7</a></li>
						<li id="i8"><a href="#t8" title="Use of Reserves">8</a></li>
						<li id="i9"><a href="#t9" title="Investment Income">9</a></li> -->

						<li id="i1"><a href="#t1" title="Housing Benefit Grant">1</a></li>
						<li id="i2"><a href="#t2" title="Dedicated Schools Grant">2</a></li>
						<li id="i3"><a href="#t3" title="Government Grants">3</a></li>
						<li id="i4"><a href="#t4" title="Business Rates Retained By Council">4</a></li>
						<li id="i5"><a href="#t5" title="Council Tax">5</a></li>
						<li id="i6"><a href="#t6" title="Use of Reserves">6</a></li>
						<li id="i7"><a href="#t7" title="Investment Income">7</a></li>
						<li id="i8"><a href="#t8" title="Housing Rents">8</a></li>
						<li id="i9"><a href="#t9" title="Fees, Charges &amp; Rents">9</a></li>
					</ul>

				</div>

				<div class="key">

					<h2>Income Key</h2>

					<div class="container">

						<ol start="1">
							<li><span>Housing Benefit &amp; Council Tax Benefit Grant</span></li>
							<li><span>Dedicated Schools Grant</span></li>
							<li><span>Council Tax</span></li>
							<li><span>Fees, Charges &amp; Rents</span></li>
						</ol>

						<ol start="5">
							<li><span>Formula Grant from Government</span></li>
							<li><span>Housing Rents</span></li>
							<li><span>Specific Government Grants</span></li>
							<li><span>Use of Reserves</span></li>
						</ol>

						<ol start="9">
							<li><span>Investment Income</span></li>
						</ol>

					</div>

					<ul class="more_links">
						<li><a href="http://www.brighton-hove.gov.uk/bhbudget" title="Have your say" target="_top">Have your say</a></li>
							<li><a href="http://www.brighton-hove.gov.uk/content/council-and-democracy/council-finance/cost-our-services-201314" title="More about council services" target="_top">More about council services</a></li>
					</ul>

				</div>

			</div>

			<div id="results" class="tabs-pane">

				<div class="guide">

					<div class="intro">
						<h2>Overall Results</h2>
						<p>This chart reflects an average of the results of all the people using the tool so far. It is a real time snapshot of how people are rating the council’s services.</p>
						<p>You can check back any time to review how the ratings have changed.</p>
					</div>

				</div>

				<div class="chart">

					<p><span class="text">2013/14 Total:</span> <span class="total">£774.3m</span></p>

					<ul>
						<li id="r1" class="s_1 low"><a href="#f1" title="Education">1</a></li>
						<li id="r2" class="s_2 low"><a href="#f2" title="Housing Benefit">2</a></li>
						<li id="r3" class="s_3 low"><a href="#f3" title="Adult Social Care">3</a></li>
						<li id="r4" class="s_4 low"><a href="#f4" title="Housing">4</a></li>
						<li id="r5" class="s_5 low"><a href="#f5" title="Children’s Social Care">5</a></li>
						<li id="r6" class="s_6 low"><a href="#f6" title="Capital Investment Programme">6</a></li>
						<li id="r7" class="s_7 low"><a href="#f7" title="Highways &amp; Traffic Management">7</a></li>
						<li id="r8" class="s_8 low"><a href="#f8" title="Central Services">8</a></li>
						<li id="r10" class="s_10 low"><a href="#f10" title="Refuse Collection, Disposal &amp; Recycling">9</a></li>
						<li id="r11" class="s_11 low"><a href="#f11" title="Libraries, Museums &amp; Tourism">10</a></li>
						<li id="r15" class="s_15 low"><a href="#f15" title="Public Health">11</a></li>
						<li id="r12" class="s_12 low"><a href="#f12" title="Planning &amp; Economic Development">12</a></li>
						<li id="r13" class="s_13 low"><a href="#f13" title="Leisure, Parks &amp; Open Spaces">13</a></li>
						<li id="r14" class="s_14 low"><a href="#f14" title="Public Safety">14</a></li>
					</ul>

				</div>

				<div class="key">

					<ul>
						<li class="fund1">High priority</li>
						<li class="fund2">Med priority</li>
						<li class="fund3">Low priority</li>
					</ul>

					<h2>Services Key</h2>

					<div class="container">

						<ol start="1">
							<li><span>Education</span></li>
							<li><span>Housing Benefit</span></li>
							<li><span>Adult Social Care</span></li>
							<li><span>Housing</span></li>
						</ol>

						<ol start="5">
							<li><span>Children’s Social Care</span></li>
							<li><span>Capital Investment Programme</span></li>
							<li><span>Highways &amp; Traffic Management</span></li>
							<li><span>Central Services</span></li>
						</ol>

						<ol start="9">
							<li><span>Refuse Collection, Disposal &amp; Recycling</span></li>
							<li><span>Libraries, Museums &amp; Tourism</span></li>
							<li><span>Public Health</span></li>
							<li><span>Planning &amp; Economic Development</span></li>
						</ol>

						<ol start="13">
							<li><span>Leisure, Parks &amp; Open Spaces</span></li>
							<li><span>Public Safety</span></li>
							<li class="more"><a href="http://www.brighton-hove.gov.uk/content/council-and-democracy/council-finance/cost-our-services-201314" title="Find out more about council services and how they are funded.">More about council services.</a></li>
						</ol>

					</div>

					<ul class="more_links">
						<li><a href="http://www.brighton-hove.gov.uk/bhbudget" title="Have your say" target="_top">Have your say</a></li>
						<li><a href="http://www.brighton-hove.gov.uk/content/council-and-democracy/council-finance/cost-our-services-201314" title="More about council services" target="_top">More about council services</a></li>
					</ul>

				</div>

			</div>

		</div>
	
	</div>
	
	
	<!-- jQuery Library -->
	<script src="ct-tools/js/libs/jquery-1.7.2.min.js"></script>

	<!-- jQuery Tools Library -->
	<script src="ct-tools/js/libs/jquery.tools.min.js"></script>
	
	<!-- Load plugins -->
	<script src="ct-tools/js/plugins.js"></script>
	
	<!-- Custom script -->
	<script src="ct-tools/js/script.js"></script>

	<noscript>
		<link rel="stylesheet" type="text/css" href="ct-tools/css/no-js.css">
	</noscript>

</body>
</html>