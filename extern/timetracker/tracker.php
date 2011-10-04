<?php
session_start();
// Fallback bei fehlender UserID in Session
if (!isset($_SESSION['userId'])) {
	header('location: index.php');
}

include('../../libs/autoloader.php');
error_reporting(0);

// DB connect
$mysqlConfig = new SWB_Config_Mysql();
$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
	<head>
	   <title>autoactiva GmbH Timetracker</title>
	   <meta http-equiv="content-type" content="text/html;charset=utf-8" />
	   <meta http-equiv="Content-Style-Type" content="text/css" />
		<meta name="description" content="none" />
		<meta name="keywords" content="none" />
		<meta name="robots" content="index, follow" />
		<meta name="language" content="de" />	
		<meta name="distribution" content="global" />
		<meta name="revisit-after" content="7" />
		<script src="js/jquery-1.6.1.min.js" type="text/javascript"></script>
		<script src="js/tracker.js" type="text/javascript"></script>
		<link href="css/tracker.css" rel="stylesheet" type="text/css" />   
		<?php
		// Show message if set
		if (!empty($_SESSION['messageText'])) {
		?>
			<script type="text/javascript">
			messageText = '<?php echo $_SESSION['messageText']; ?>';
			messageType = '<?php echo $_SESSION['messageType']; ?>';
			</script>
		<?php
			unset($_SESSION['messageText']);
			unset($_SESSION['messageType']);
		} 
		?>
	</head>
	<body onbeforeunload="quit()">
		<div class="content-wrap">
			<div class="head-wrap outer-wrap">
				<div class="head-inner">
					<div class="head-text">
						Bitte Kunde und Projekt wählen
					</div>
					<div class="counter-wrap">
						<div id="counterHours" class="counter-numbers">00</div>
						<div class="counter-seperator">:</div>
						<div id="counterMinutes" class="counter-numbers">00</div>
						<div class="counter-seperator">:</div>
						<div id="counterSeconds" class="counter-numbers">00</div>
					</div>
					<div id="record-pulse"><img src="gfx/record-pulse.gif" alt="pulse" /></div>
				</div>
			</div>
			<div class="center-wrap outer-wrap">
			<!-- PROCENT -->
			<?php
			// projectId submiited: Show percentage and get default charging
			if (isset($_REQUEST['pid'])) {
				
				// Get default charging
				$pdoQuery->setQuery('
					SELECT charging_default
					FROM module_projects_projects
					WHERE id=:projectid
				');
				$pdoQuery->bindInteger('projectid', $_REQUEST['pid']);
				$pdoResult = $pdoQuery->fetchAll();
				$defaultCharging	= $pdoResult[0]['charging_default'];		
			
				// Get overall hours
				$pdoQuery->setQuery('
					SELECT SUM(hoursUsed+hoursOB+hoursKV) AS hoursOverall	
					FROM module_projects_projects_tracking
					WHERE projectId = :projectid
				');			 
				$pdoQuery->bindInteger('projectid', $_REQUEST['pid']);
				$resultSum = $pdoQuery->fetchAll();
				
				// Get budget
				$pdoQuery->setQuery('
					SELECT budget
					FROM module_projects_projects
					WHERE id=:projectid
				');
				$pdoQuery->bindInteger('projectid', $_REQUEST['pid']);
				$pdoResult = $pdoQuery->fetchAll();			
				
				if ($pdoResult[0]['budget'] > 0) {
					
					// Calculate percentage
					$percentage = ($resultSum[0]['hoursOverall'] * 100)/$pdoResult[0]['budget'];
					$percentageWidth = intval($percentage * 3.2);
					$percentage = round($percentage,2);
					
			?>
			<div class="center-procent-wrap">
				<div class="center-procent-red" style="width:<?php echo $percentageWidth; ?>px">
					<div class="center-procent-text">
						<?php echo $percentage.' % verbraucht ( '.$resultSum[0]['hoursOverall'].' von '.$pdoResult[0]['budget'].' Stunden)'; ?>
					</div>
				</div>
			</div>
			<?php 
				}
			}
			?>
				<div class="center-inner-wrap">
					<form name="trackForm" id="trackForm" method="post" accept-charset="utf-8" action="tracker_actions.php">
						<h1>Kunde</h1>
						<div class="select-wrap" id="customer-selector-wrap">
							<select name="cid" id="cid">
								<option value="0" class="cidChoose">bitte wählen</option>
								<?php
								// Get customer
								$pdoQuery->setQuery('
									SELECT id, acronym, title	
									FROM module_projects_customer
									WHERE active=1
									ORDER BY acronym ASC
								');
								/*$pdoQuery->setQuery("
									SELECT id, title,
										(
										SELECT COUNT(*)
										FROM module_projects_projects
										WHERE module_projects_customer.id = module_projects_projects.customerId AND active=1
										) as ppc
									FROM module_projects_customer
									ORDER BY title ASC
								");*/				
								$result = $pdoQuery->fetchAll();
								foreach($result as $k => $v) {
								?>
								<option value="<?php echo $result[$k]['id']; ?>" class="cidOption"<?php if ($_REQUEST['cid'] == $result[$k]['id']) { echo ' selected="seleted"'; } ?>><?php echo $result[$k]['acronym'].' - '.$result[$k]['title']; ?></option>
								<?php
								}
								?>
							</select>
							<img src="gfx/plus-button.png" alt="Neuer Kunde" title="Kunde hinzufügen" id="buttonAddCustomer" />
						</div>
						<div id="project-wrap"<?php if (isset($_REQUEST['cid']) && $_REQUEST['cid'] > 0) { echo ' style="display:inline"'; } ?>>
							<br /><br />
							<h1>Projekt</h1>
							<div class="select-wrap">
								<select name="pid" id="pid">
									<?php
									// Get projects according to customer
									if (isset($_REQUEST['cid'])) {
										$pdoQuery->setQuery('
											SELECT id, jobnumber, title
											FROM module_projects_projects
											WHERE customerId = :cid AND active = 1
											ORDER BY jobnumber ASC
										');
										$pdoQuery->bindInteger('cid', $_REQUEST['cid']);
										$pdoResult = $pdoQuery->fetchAll();
										if ($pdoResult) {

											foreach ($pdoResult as $k => $v) {
											?>
												
												<option class="pidOption" value="<?php echo $pdoResult[$k]['id']; ?>"<?php if ($_REQUEST['pid'] == $pdoResult[$k]['id']) { echo ' selected="seleted"'; } ?>><?php echo $pdoResult[$k]['jobnumber'].' - '.$pdoResult[$k]['title']; ?></option>

											<?php
											}

										}
									}
									?>
								</select>
								<img src="gfx/plus-button.png" alt="Neues Projekt" title="Projekt hinzufügen" id="buttonAddProject" />
							</div>
						</div>
						<div id="category-wrap">
							<br /><br />
							<h1>Kategorie</h1>
							<div class="select-wrap">
								<select name="catid" id="catid">
								<?php
								// Get customer
								$pdoQuery->setQuery("
									SELECT id, title
									FROM module_projects_tasks_categories
									ORDER BY title ASC
								");
								$result = $pdoQuery->fetchAll();
								foreach($result as $k => $v) {
								?>
								<option value="<?php echo $result[$k]['id']; ?>"><?php echo $result[$k]['title']; ?></option>
								<?php
								}
								?>							
								</select>
							</div>
						</div>
						<div id="comment-wrap">
							<br /><br />
							<h1>Kommentar</h1>
							<textarea name="trackText" id="trackText" rows="3"></textarea>
						</div>
						<div id="type-wrap">
							<br /><br />
							<h1>Abrechnungstyp</h1>
							<select name="trackRate" id="trackRate">
								<option value="std"<?php if ($defaultCharging == 'std') { echo ' selected="selected"'; } ?>>wird berechnet</option>
								<option value="ob"<?php if ($defaultCharging == 'ob') { echo ' selected="selected"'; } ?>>wird nicht berechnet</option>
							</select>
						</div>
						<input type="hidden" name="unitsNeeded" id="unitsNeeded" value="0" />
						<input type="hidden" name="nettoSeconds" id="nettoSeconds" value="0" />
					</form>
				</div>
				<div class="button-play-pause">
					<img src="gfx/button-play.png" title="Tracking starten" alt="Tracking Control" id="control-play-pause" />
				</div>
				<div class="button-stop">
					<img src="gfx/button-stop.png" title="Tracking beenden" alt="Tracking Control" id="control-stop" />
				</div>		
				<div class="button-save">
					<img src="gfx/button-save.png" alt="save" title="Jetzt speichern" />
				</div>				
			</div>
			<div class="logout">
				<a href="logout.php"><img src="gfx/logout.png" alt="Logout" title="Logout" /></a>
			</div>			
			<div class="username">
				<?php 
				// Get user
				$userObj = SWB_User_User::getUserById($_SESSION['userId']);
				echo $userObj->getName().' '.$userObj->getSurname();	
				?>
			</div>
			<div class="overlay-wrap">
				<div class="overlay-message"></div>
			</div>			
			<!-- Overlay dialogs : Customer -->
			<div id="customer-add-wrap">
				<form id="customerAddForm" method="post" accept-charset="utf-8" action="tracker_actions.php">
					<strong>Kunde anlegen</strong><br /><br />
					Kundenkürzel<br />
					<input type="text" name="customerShort" id="customerShort" maxlength="10" /><br /><br />
					Name des Kunden<br />
					<input type="text" name="customerTitle" id="customerTitle" /><br /><br />
					<input type="submit" id="customerAddSave" name="submitCustomerAdd" value="Speichern" />
					<div id="customerAddCancel"><img src="gfx/cancel.png" title="abbrechen" alt="KuPa" /> Abbrechen</div>
				</form>
			</div>
			<!-- Overlay dialogs : Project -->
			<div id="project-add-wrap">
				<form id="projectAddForm" method="post" accept-charset="utf-8" action="tracker_actions.php">
					<strong>Projekt anlegen</strong><br /><br />
					Jobnummer<br />
					<input type="text" name="projectJobnumber" id="projectJobnumber" /><br /><br />
					Titel<br />
					<input type="text" name="projectTitle" id="projectTitle" /><br /><br />		
					Budget in Stunden<br />
					<input type="text" name="projectBudget" id="projectBudget" value="0,00" /><br /><br />				
					Standard-Berechnung<br />
					<select name="projectCalcType" id="projectCalcType">
						<option value="std">wird berechnet</option>
						<option value="ob">wird nicht berechnet</option>
					</select>
					<br /><br />		
					<input type="hidden" name="projectCustomerId" id="projectCustomerId" value="<?php echo intval($_REQUEST['cid']); ?>" />
					<input type="hidden" name="projectUserId" id="projectUserId" value="<?php echo $_SESSION['userId']; ?>" />	
					<input type="submit" id="projectAddSave" name="submitProjectAdd" value="Speichern" />
					<div id="projectAddCancel"><img src="gfx/cancel.png" title="abbrechen" alt="KuPa" /> Abbrechen</div>
				</form>
			</div>	
			<!-- Overlay dialogs : Tracker message -->
			<div id="tracker-message"></div>		
		</div>
	</body>
</html>