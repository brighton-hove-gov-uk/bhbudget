<?
// handler.php
session_start();
include('bhcc.php');

$bhcc = new bhcc;
$sanity = new Sanity;

$clean = $sanity->clean_ui($_GET);

switch($clean['do']){
	case "track":
		// add to session array
		$_SESSION['user']['results'][$clean['id']] = $clean['priority'];

		// store click in database
		$bhcc->track_click($clean['id'],$clean['priority']);
	break;

	case "plot":
		$d = new db;
		$d->db_connect();

		$userID = $bhcc->get_user();

		// already voted on this one?
		$check = $d->dbget('clicks','*',"WHERE user_id ='".$userID."'");
		if($check['count']>=1){
			unset($check['count']);
			foreach($check as $row){
				$result[str_replace('f','',$row['service'])] = $row['priority'];
			}
			$plot = json_encode($result);

			if(@$userID !=''){
				echo $plot;
			}else{
				echo 'no user';
			}
			
		}else{
			echo 'null';
		}
	break;

	case "summary":
		// calc the most popular response for each of the priorities
		// result will be a JSON string
		echo $bhcc->build_summary();
	break;

	case "respondents":
		// output raw data
		$bhcc->show_respondents();
	break;
	case "csv":
		// output raw data
		$bhcc->csv();
	break;

	case "store_email":
		// save email against the respondent
		$bhcc->store_email($_GET);
	break;
}



?>