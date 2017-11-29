<?php
//======================================================================
// DATABASE CONFIGURATIONS
//======================================================================
// Local Database Connection Details (in this example, the developer is using a
// jawsDB mysql database that is different than the deployment DB.  You can
// simply use your own MySql DB on your computer.
//It's set up this way so we don't have to change anything
$local_host = "localhost";
$local_username = "root";
$local_password = "root";
$local_databaseName = "statusReportSystem";
// Production Database Connection Details:
$databaseConnectURL = "mysql://be47041b8f6eac:d6cb8661@us-cdbr-iron-east-05.cleardb.net/heroku_17d28927bcb96ef?reconnect=true";
// CLEARDB_DATABASE_URL needs to be set in Heroku.
$databaseConnectURL = getenv("CLEARDB_DATABASE_URL");
//======================================================================
// DATABASE CONNECTION
//======================================================================
$possibleLocalhosts = array('127.0.0.1', "::1");
if(in_array($_SERVER['REMOTE_ADDR'], $possibleLocalhosts)) // If our REMOTE_ADDR is a localhost, do this:
{
	// Open a connection with our local database
	$todoAppMySQLConnection = mysqli_connect($local_host, $local_username, $local_password, $local_databaseName);
}
else // If our REMOTE_ADDR wasn't a localhost, we must be working remotely.
{
	// Parse our $databaseConnectURL so that we can pull out the key's we neeed
	$parsedDatabaseConnectUrl = parse_url($databaseConnectURL);
	$remote_host = $parsedDatabaseConnectUrl["host"];
	$remote_username = $parsedDatabaseConnectUrl["user"];
	$remote_password = $parsedDatabaseConnectUrl["pass"];
	$remote_databaseName = substr($parsedDatabaseConnectUrl["path"], 1);
	// Open a connection with our remote database
	$todoAppMySQLConnection = mysqli_connect($remote_host, $remote_username, $remote_password, $remote_databaseName);
}
//======================================================================
// FRESH DEPLOY DATABASE SETUP WIZARD
//======================================================================
if (isset($_GET['setup-db'])) // Only enter this if our URL contains a "setup-db" parameter
{
	echo '<h1>Database Configurations</h1>';
	echo '<form method="GET" action="?setup-db">';
	echo '<p>Are you sure you want to erase your current remote database and reconfigure it with a fresh schema?</br></p>';
	echo '<input name="execute-db-setup" type="submit" value="Yes">' . '</form>';
}
if (isset($_GET['execute-db-setup'])) // Only enter this if our URL contains a "setup-db" parameter
{
	echo '<h1>Database Configurations</h1>';
	// STEP A - CREATE TASKS TABLE IN DATABASE
	$sqlCreateTableStatement = "
		CREATE TABLE `Users` (
			`UserID` int() NOT NULL AUTO_INCREMENT,
			`UserName` varchar(50) NOT NULL DEFAULT '',
			`FirstName` varchar(100) NOT NULL DEFAULT '',
			`LastName` varchar(100) NOT NULL DEFAULT '',
			`Email` varchar(100) DEFAULT '',
			`Password` varchar(100) DEFAULT 'statusReport',
			`IDNum` int() NOT NULL,
			PRIMARY KEY (`id`)
		)";
	if (mysqli_query($todoAppMySQLConnection, $sqlCreateTableStatement))
	{
		echo '</br>StepA: Successfully configured database.</br>';
	}
	else
	{
		echo '</br>StepA: Looks like there was an error :(</br>';
		echo '</br>' . mysqli_error($todoAppMySQLConnection);
	}
	// STEP B - ADD SAMPLE TASKS TO TABLE (that was created by step a)
	$sqlPopulateTableStatement = "
		INSERT INTO `tasks` (`id`, `taskName`, `completed`, `lastUpdated`) VALUES
		(1, 'Give yourself a high five, your PRODUCTION table is working!', 0, '2016-09-20 11:35:05'),
		(2, 'Complete the next part of the lab, since PRODUCTION is working.', 0, '2016-09-20 11:35:05');
		";
	if (mysqli_query($todoAppMySQLConnection, $sqlPopulateTableStatement))
	{
		echo '</br>Step B: Successfully added sample tasks to task table in database.</br>';
	}
	else
	{
		echo '</br>Step B: Looks like there was an error :(</br>';
		echo '</br>' . mysqli_error($todoAppMySQLConnection);
	}
}
?>
