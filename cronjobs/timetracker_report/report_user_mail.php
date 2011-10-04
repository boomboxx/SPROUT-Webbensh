<?php
error_reporting(E_ALL ^E_NOTICE);
include('../../libs/autoloader.php');

// DB connect
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoConnect->setUtf8();
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

// Message init
$message = '
	<html>
		<head>
			<style type="text/css">
				* { font-family:Arial,Helvatica,sans-serif; border:none; font-size:12px } 
				h1 { font-size:15px; font-weight:bold }
			</style>
		</head>
		<body>
			<h1>Time-Tracker Report für den '.date('d.m.Y').'<h1>
';
	
// Get active user
$users = SWB_User_User::getActiveUsers('surname');
foreach ($users as $user) {	
	
	$message .= '
				<table width="100%" border="0" cellspacing="0" cellpadding="0" style="border:1px solid #000000">
	              <tr>
	                <td><table width="100%" style="border-bottom:1px solid #000000; background-color:#CCCCCC">
	                  <tr>
	                    <td><strong>'.$user->getSurname().', '.$user->getName().'</strong></td>
	                    <td><table width="160" border="0" align="right" cellpadding="0" cellspacing="0">
	                          <tr>
	                            <td width="40" align="right">Std.</td>
	                            <td width="40" align="right">OB</td>
	                            <td width="40" align="right">KV</td>
	                            <td width="40" align="right">Netto</td>
	                          </tr>
	                      </table></td>
	                  </tr>
	                </table>
	';
	
	// Trackings
	$pdoQuery->setQuery("
		SELECT projectId, categoryId, userId, moment, hoursUsed, hoursKV, hoursOB, nettoSeconds, notice 
		FROM module_projects_projects_tracking 
		WHERE userId=:userid AND moment LIKE :lookupdate
		ORDER BY moment ASC
	");
	$pdoQuery->bindInteger('userid', $user->getId());
	$pdoQuery->bindString('lookupdate', date('Y-m-d').'%');
	$trackings = $pdoQuery->fetchAll();
	
	foreach($trackings as $tracking) {
		
		// Get project
		$pdoQuery->setQuery("SELECT * FROM module_projects_projects WHERE id=:pid");
		$pdoQuery->bindInteger('pid', $tracking['projectId']);
		$project = $pdoQuery->fetchAll();
		
		// Get customer
		$pdoQuery->setQuery("SELECT * FROM module_projects_customer WHERE id=:cid");
		$pdoQuery->bindInteger('cid', $project[0]['customerId']);
		$customer = $pdoQuery->fetchAll();
		
		// Get category
		$pdoQuery->setQuery("SELECT * FROM module_projects_tasks_categories WHERE id=:cid");
		$pdoQuery->bindInteger('cid', $tracking['categoryId']);
		$category = $pdoQuery->fetchAll();		
		
		// Set output for hours
		if ($tracking['hoursUsed'] > 0) { $opHours['hoursUsed'] = $tracking['hoursUsed']; } else { $opHours['hoursUsed'] = '-'; }
		if ($tracking['hoursOB'] > 0) { $opHours['hoursOB'] = $tracking['hoursOB']; } else { $opHours['hoursOB'] = '-'; }
		if ($tracking['hoursKV'] > 0) { $opHours['hoursKV'] = $tracking['hoursKV']; } else { $opHours['hoursKV'] = '-'; }
		
		$message .= '
		                  <table width="100%">
		                    <tr>
		                      <td width="25%"><strong>'.$customer[0]['title'].'</strong></td>
		                      <td width="25%"><strong>'.$project[0]['jobnumber'].' - '.$project[0]['title'].'</strong></td>
		                      <td width="25%">'.$category[0]['title'].'</td>
		                      <td width="25%"><table width="160" border="0" align="right" cellpadding="0" cellspacing="0">
		                          <tr>
		                            <td width="40" align="right">'.$opHours['hoursUsed'].'</td>
		                            <td width="40" align="right">'.$opHours['hoursOB'].'</td>
		                            <td width="40" align="right">'.$opHours['hoursKV'].'</td>
		                            <td width="40" align="right">'.round(($tracking['nettoSeconds']/3600),2).'</td>
		                          </tr>
		                      </table></td>
		                    </tr>
		                  </table>
		                  <table width="100%" style="border-bottom:1px solid #000000">
		                    <tr>
		                      <td width="25%">'.nl2br($tracking['notice']).'
		                    </tr>
		                  </table>
		';
	
	}
	
	// Get sums for hours
	$pdoQuery->setQuery("SELECT SUM(hoursUsed) AS sumHoursUsed, SUM(hoursOB) AS sumHoursOB, SUM(hoursKV) AS sumHoursKV  FROM module_projects_projects_tracking WHERE userId=:userid AND moment LIKE :lookupdate");
	$pdoQuery->bindInteger('userid', $user->getId());
	$pdoQuery->bindString('lookupdate', date('Y-m-d').'%');
	$hours = $pdoQuery->fetchAll();
	$trackingSum['hoursUsed'] = $hours[0]['sumHoursUsed'];
	$trackingSum['hoursOB'] = $hours[0]['sumHoursOB'];		
	$trackingSum['hoursKV'] = $hours[0]['sumHoursKV'];
	
	// Get sum for netto seconds
	$pdoQuery->setQuery("SELECT SUM(nettoSeconds) AS sumHoursUsed  FROM module_projects_projects_tracking WHERE userId=:userid AND moment LIKE :lookupdate");
	$pdoQuery->bindInteger('userid', $user->getId());
	$pdoQuery->bindString('lookupdate', date('Y-m-d').'%');
	$hours = $pdoQuery->fetchAll();
	$trackingSum['nettoSeconds'] = round(($hours[0]['sumHoursUsed']/3600),2);	
	
	$message .= '
	                  <table width="100%">
	                    <tr>
	                      <td width="25%"><table width="160" border="0" align="right" cellpadding="0" cellspacing="0" style="border-top:1px solid #000000">
	                          <tr>
	                            <td width="40" align="right">'.$trackingSum['hoursUsed'].'</td>
	                            <td width="40" align="right">'.$trackingSum['hoursOB'].'</td>
	                            <td width="40" align="right">'.$trackingSum['hoursKV'].'</td>
	                            <td width="40" align="right">'.$trackingSum['nettoSeconds'].'</td>
	                          </tr>
	                      </table></td>
	                    </tr>
	                  </table></td>
	              </tr>
	            </table>	
			</body>
		</html>
		<br />
	';

}

// ===== DEBUG =====
//echo $message; die();

// Send only ad weekdays (Mo. - Fr.)
if (date('D') != 'Sat' && date('D') != 'Sun') {

	$iTo = 0;
	
	$pdoQuery->setQuery("SELECT email  FROM swb_user WHERE active = 1");
	$user = $pdoQuery->fetchAll();
	
	$toArray = array();
	foreach ($user as $k => $v) {
		
		$toArray[] = $user[$k]['email'];
		
	}
	
	$toArray[] = 'c.paul@autoactiva.de';
	
	$to = implode(',', $toArray);
	
	//$to = 'office@boomboxx.de,j.califice@exchange.autoactiva.de';
	$subject = "Tracker Report ".date('d.m.Y');
	$xtra    = "From: system@sprout (Tracking Report)\r\n";
	$xtra   .= "Content-Type: text/html;  charset=UTF-8\r\nContent-Transfer-Encoding: 8bit\r\n";
	$xtra   .= "X-Mailer: PHP ". phpversion();
	 
	if(mail($to,
	     $subject,
	     $message,
	     $xtra)) {
	     	echo "ja";
	     }
     
}     