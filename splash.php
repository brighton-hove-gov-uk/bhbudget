<?php

session_start();
include('bhcc.php');
$bhcc = new bhcc;

// check for cookie
if($bhcc->response_status()){
	// we have a cookie, recover priorities
	$bhcc->response_restore();
}else{
	// no cookie, set one (nothing in it yet, just a unique respondent ID)
	$bhcc->response_start();
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
	<link rel="stylesheet" href="ct-tools/css/style.css" />
	<link rel="stylesheet" href="ct-tools/css/media-queries.css" />

  
</head>
<body>

	<div id="main" role="main" class="wrapper">

		<div class="splash">

			<h1><i>Your money,</i> your services</h1>

			<p>Brighton &amp; Hove City Council is beginning to outline its spending plans for the next financial year.</p>

			<p>Before making their decisions, councillors would like to know what you think about spending on services.</p>

			<a href="tool.php" title="Launch tool" class="cta">

				<h3>Launch tool</h3>

			</a>

			<img src="ct-tools/img/question.jpg" alt="" />
		
		</div>

		<p class="cookie">This tool sets cookies on your computer to track your progress so you can come back and finish the tool if you run out of time, as well as providing us with information during your visit. By using this tool, you accept the terms of our <a href="http://www.brighton-hove.gov.uk/index.cfm?request=b1000213" title="Read our cookie policy">cookie policy</a>.</p>

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