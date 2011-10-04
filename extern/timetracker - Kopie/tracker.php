<?php
session_start();
include('../../libs/autoloader.php');
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
		} 
		?>
	</head>
	<body>
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
				<div class="center-inner-wrap">
					<form name="trackForm" id="trackForm">
						<h1>Kunde</h1>
						<div class="select-wrap" id="customer-selector-wrap">
							<select name="cid" id="cid">
								<option value="0" class="cidChoose">bitte wählen</option>
								<?php
								// Get customer
								$mysqlConfig = new SWB_Config_Mysql();
								$pdoConnect = new SWB_Mysql_PDOConnect($mysqlConfig);
								$pdoQuery = new SWB_Mysql_PDOQuery($pdoConnect);
								$pdoQuery->setQuery('
									SELECT id, title	
									FROM module_projects_customer
									WHERE active=1
									ORDER BY title ASC
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
								<option value="<?php echo $result[$k]['id']; ?>" class="cidOption"><?php echo utf8_encode($result[$k]['title']); ?></option>
								<?php
								}
								?>
							</select>
							<img src="gfx/plus-button.png" alt="Neuer Kunde" title="Kunde hinzufügen" id="buttonAddCustomer" />
						</div>
						<div id="project-wrap">
							<br /><br />
							<h1>Projekt</h1>
							<div class="select-wrap">
								<select name="pid" id="pid">
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
									<option value="<?php echo $result[$k]['id']; ?>"><?php echo utf8_encode($result[$k]['title']); ?></option>
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
								<option value="std">wird berechnet</option>
								<option value="ob">wird nicht berechnet</option>
							</select>
						</div>						
						<input type="hidden" name="unitsNeeded" id="unitsNeeded" value="0" />
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
			<div class="overlay-wrap">
				<div class="overlay-message"></div>
			</div>			
			<!-- Overlay dialogs : Customer -->
			<div id="customer-add-wrap">
				<form id="customerAddForm" method="post" accept-charset="utf-8" action="tracker_actions.php">
					<strong>Kunde anlegen</strong><br /><br />
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
					<input type="hidden" name="projectCustomerId" id="projectCustomerId" />
					<input type="hidden" name="projectUserId" id="projectUserId" value="<?php echo $_SESSION['userId']; ?>" />			
					<div id="projectAddSave"><img src="gfx/disk.png" title="Projekt anlegen" alt="KuPa" /> Speichern</div>
					<div id="projectAddCancel"><img src="gfx/cancel.png" title="abbrechen" alt="KuPa" /> Abbrechen</div>
				</form>
			</div>	
			<!-- Overlay dialogs : Tracker message -->
			<div id="tracker-message"></div>		
		</div>
	</body>
</html>