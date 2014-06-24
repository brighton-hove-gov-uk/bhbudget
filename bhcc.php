<?

# database connection

	define("DB_HOST", "localhost");
	define("DB_USER", "your_user");
	define("DB_PASS", "your_password");
	define("DB_BASE", "bhbudget");

// response handler class
Class bhcc {

	function get_user(){
		$d = new db;
		$d->db_connect();

		$user = $d->dbget('responses','id',"WHERE user_hash = '".$_COOKIE['bhcc_priorities']."'");
		return $user[0]['id'];	
	}

	// create new respondent
	function response_start(){
		$d = new db;
		$d->db_connect();

		unset($_SESSION);

		// create db record
		$hash = md5(time());
		$q = "INSERT INTO responses (browser,remote_addr,started_at,user_hash,last_seen,visit_count) VALUES ('".$_SERVER['HTTP_USER_AGENT']."','".$_SERVER['REMOTE_ADDR']."','".time()."','".$hash."','".time()."','1')";
		mysql_query($q);

		// set cookie
		setcookie("bhcc_priorities", $hash, time()+ 8035200,'/');	// session expires in 3 months

		// store use details
		$_SESSION['user']['user_hash'] = $hash;
		$_SESSION['user']['id'] = mysql_insert_id();
		$_SESSION['user']['last_seen'] = time();

	}

	// is this device known to be a respondent?
	function response_status(){
		if(@$_COOKIE['bhcc_priorities']  != '' && isset($_COOKIE['bhcc_priorities'])){
			return true;
		}else{
			return false;
		}
	}

	// set session key and recover responses
	function response_restore(){

		$_SESSION['user']['user_hash'] = $_COOKIE['bhcc_priorities'];

		$d = new db;
		$d->db_connect();

		// fetch user
		$user = $d->dbget('responses','*',"WHERE user_hash = '".$_COOKIE['bhcc_priorities']."'");
		$details = array(
			'remote_addr'=>$user[0]['remote_addr'],
			'last_seen'=>$user[0]['last_seen'],
			'user_hash'=>$user[0]['user_hash'],
			'id'=>$user[0]['id']
			);

		// retrieve and clean the responses
		$result = array();
		$responses = $d->dbget('clicks','*',"WHERE user_id = '".$details['id']."'");
		if($responses['count'] >=1){
			unset($responses['count']);
			foreach($responses as $row){
				$result[$row['service']] = $row['priority'];
			}
		}	
		$details['responses'] = $result;
		
		// store in session 
		$_SESSION['user'] = $details;

		// update the last seen and visits stamp
		$q = "UPDATE responses SET visit_count = visit_count+1, last_seen = '".time()."' WHERE id = '".$details['id']."'";
		mysql_query($q);
	}

	function response_clear(){
		// remove cookie
		setcookie("bhcc_priorities", '', 0,'/');	// session expires in 1970	
	}

	function track_click($service,$priority){

		$d = new db;
		$d->db_connect();

		$userID = self::get_user();

		// remove the 'f' from the service
		$service = str_replace('f','',$service);

		// already voted on this one?
		$check = $d->dbget('clicks','*',"WHERE user_id ='".$userID."' and service = '".$service."'");
		if($check['count']>=1){
			$q = "UPDATE clicks SET priority = '".$priority."',time_updated = '".time()."' WHERE user_id = '".$userID."' and service = '".$service."'";
			echo 'updated';
		}else{
			$q = "INSERT INTO clicks (user_id,service,priority,time_updated) VALUES ('".$userID."','".$service."','".$priority."','".time()."')";
			echo 'logged';
		}
		mysql_query($q);
	}

	function show_debug(){
		
		if(isset($_GET['clear'])){
			self::response_clear();
		}
		?>
		<div class="debug">
			<pre>Cookie: <?=print_r(@$_COOKIE);?></pre>
			<pre>Session: <?=print_r(@$_SESSION);?></pre>
		</div>
		<?
	}

	function build_summary(){
		$d = new db;
		$d->db_connect();

		// grab all clicks to date
		$check = $d->dbget('clicks','*',"");

		// loop through and sort into low, med, high
		$results = array();
		unset($check['count']);

		// spark the default array (in order that we cannot return a null..)
		$start = 1;
		while($start <=14){
			$results[$start]['low'] = 0;
			$results[$start]['med'] = 0;
			$results[$start]['high'] = 0;
			$start++;
		}

		// collate results
		foreach($check as $row){
			$results[$row['service']][$row['priority']]++;
		}

		// generate the JSON response
		$final = array();
		foreach($results as $key => $value){
			if($value['high'] > $value['med']){
				$final[$key] = 'high';
			}elseif($value['med'] > $value['low']){
				$final[$key] = 'med';
			}else{
				$final[$key] = 'low';
			}
		}

		// encode and output
		$json = json_encode($final);
		echo $json;
	}


	function store_email($get){
		$s = new Sanity;
		$clean = $s->clean_ui($get);

		$userID = self::get_user();

		$q = "UPDATE responses SET email_address = '".urldecode($clean['email'])."' WHERE id = '".$userID."'";
		mysql_query($q);
	}

	function show_respondents(){

		// list all
		$d = new db;
		$d->db_connect();

		// already voted on this one?
		$check = $d->dbget('responses','*',"ORDER by last_seen DESC");
		$visits = $d->dbget('responses','sum(visit_count)',"");
		$remote_addr = $d->dbget('responses','count(distinct(remote_addr)) ',"");
		?>

<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
	<title>Brighton &amp; Hove City Council / Results</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<body>
		<h1><?=$check['count'];?> respondents (<?=$visits[0]['sum(visit_count)'];?> visits) from <?=$remote_addr[0]['count(distinct(remote_addr))'];?> IP addresses</h1>
		<p>Download respondents <a href="handler.php?do=csv">here</a></p>
		<table class="res_table" cellpadding='0' cellspacing='0'>
			<tr>
				<td>&nbsp;</td>
				<td>IP Address</td>
				<td>Device/Browser</td>
				<td>Last Active</td>
				<td>Visits</td>
				<td>Started At</td>
				<td>Email</td>
			</tr>

			<?
			unset($check['count']);
			$start = 1;
			foreach($check as $row){
				if($row['email_address'] ==''){$row['email_address']='&nbsp';}
				?>
				<tr>
					<td><?=$row['id'];?></td>
					<td><?=$row['remote_addr'];?></td>
					<td><?=$row['browser'];?></td>
					<td><?=date('jS F, H:i',$row['last_seen']);?></td>
					<td><?=$row['visit_count'];?></td>
					<td><?=date('jS F, H:i',$row['started_at']);?></td>
					
					<td><?=$row['email_address'];?></td>
				</tr>
				<?
				$start++;
			}
			?>
		</table>
</body>
</html>


		<?
		/*
		// already voted on this one?
		$check = $d->dbget('clicks','*',"WHERE user_id !='' ORDER by id DESC");
		?>
		<hr/>
		<table class="res_table" cellpadding='0' cellspacing='0'>
			<tr>
				<td>User ID</td>
				<td>Service</td>
				<td>Priority</td>
			</tr>

			<?
			unset($check['count']);
			$start = 1;
			foreach($check as $row){
				?>
				<tr>
					<td><?=$row['user_id'];?></td>
					<td><?=$row['service'];?></td>
					<td><?=$row['priority'];?></td>
				</tr>
				<?
				$start++;
			}
			?>
		</table>
		<?
		*/
		?>



		<style type="text/css">
			.res_table {border-top:1px solid;border-right:1px solid;width:100%;}
			.res_table td {padding:4px 8px;font-size:13px;font-family:arial;border-left:1px solid;border-bottom:1px solid;}
		</style>
		<?
	}




	function csv(){

$csv = "";

		// list all
		$d = new db;
		$d->db_connect();

		// already voted on this one?
		$check = $d->dbget('responses','*',"ORDER by last_seen DESC");
		unset($check['count']);

$csv = "";
$csv .= '"ID",IP Address","Device/Browser","Visit Count","Started","Last Active","Email Address","Education","Housing Benefit","Adult Social Care","Housing","Childrens Social Care","Capital Investment","Highways and Traffic","Central Services","Public Health","Refuse","Libraries, Museums and Tourism","Planning and Economic Development","Leisure, Parks and Open Spaces","Public Safety"
';

		// add each respondent
		foreach($check as $user){

			// get responses
			$clicks = $d->dbget('clicks','*',"WHERE user_id ='".$user['id']."' ORDER by service DESC");


			// sort responses
			unset($clicks['count']);
			$clicked = array();
			foreach($clicks as $row){
				$clicked[$row['service']] = $row['priority'];
			}


$csv .= '"'.$user['id'].'","'.$user['remote_addr'].'","'.$user['browser'].'","'.$user['visit_count'].'","'.date('jS F, H:i',$user['started_at']).'","'.date('jS F, H:i',$user['last_seen']).'","'.$user['email_address'].'","'.@$clicked['1'].'","'.@$clicked['2'].'","'.@$clicked['3'].'","'.@$clicked['4'].'","'.@$clicked['5'].'","'.@$clicked['6'].'","'.@$clicked['7'].'","'.@$clicked['8'].'","'.@$clicked['15'].'","'.@$clicked['10'].'","'.@$clicked['11'].'","'.@$clicked['12'].'","'.@$clicked['13'].'","'.@$clicked['14'].'"
';

		
			unset($clicked);
		}



	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: public");
	header("Content-Description: File Transfer");
	header("Content-Type: application/unknown");
	header("Content-Disposition: filename=filename.csv\r\n");
	header("Content-Transfer-Encoding: binary");

	print $csv;



	}

}




// CORE Utils
class db {
	/**
	 * dB::db_connect()
	 * 
	 * @return
	 */
	function db_connect() {
		$result = mysql_pconnect(DB_HOST, DB_USER, DB_PASS); 
		if (!$result){
			return false;
		} else {}
		
		if(!mysql_select_db(DB_BASE)){
			return false;	
		} else {}
		return $result;
	}
	
	/**
	 * dB::dbget()
	 * 
	 * @param mixed $table
	 * @param mixed $what
	 * @param mixed $where
	 * @return
	 */
	function dbget($table, $what, $where) {
		$sql = "SELECT ".$what." FROM $table $where";
		$recordSet = mysql_query($sql);
		$results = array();
		$results['count'] = mysql_num_rows($recordSet);
		while($row = mysql_fetch_array($recordSet)) {
			$results[] = $row;
		}
		return $results;
	}	
	
}




class Sanity {
	
	function clean_ui($ui="",$store=""){
		$clean = array();
		foreach($ui as $key => $value){
			$clean[$key] = self::clean($value,"");
			if($store !=''){ $_SESSION[$store][$key] = $clean[$key]; }
		}
		return $clean;
	}
	
	/**
	 * Sanity::clean()
	 * 
	 * @param mixed $input
	 * @param mixed $type
	 * @return
	 */
	function clean($input, $type){
		
		$db = new db;
		$db->db_connect();
		switch($type){
			# minimal clean up if no method defined
			default:
				$clean_input = mysql_real_escape_string($input);
				return $clean_input;  
			break;
			
			case "post":
				$input = filter_var($input, FILTER_SANITIZE_STRING);
				$clean_input = mysql_real_escape_string($input);
				return $clean_input;
			break;
	
			case "email":
				# checks an email and returns false if its not valid 
				$clean_input = mysql_real_escape_string($input);
				if(filter_var($clean_input, FILTER_VALIDATE_EMAIL)){
					return filter_var($clean_input, FILTER_VALIDATE_EMAIL);
				} else {
					return false;
				}
			break;
			
			case "url":
				# checks an email and returns false if its not valid 
				$clean_input = mysql_real_escape_string($input);
				if(filter_var($clean_input, FILTER_VALIDATE_URL,FILTER_FLAG_SCHEME_REQUIRED)){
					return filter_var($clean_input, FILTER_VALIDATE_URL,FILTER_FLAG_SCHEME_REQUIRED);
				} else {
					return false;
				}
			break;
		}
	}


}
?>