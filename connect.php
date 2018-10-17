<?php

DEFINE('db', 'localhost');
DEFINE('db_usr', 'crud');
DEFINE('db_pwd', 'crud');
DEFINE('db_name', 'crud');

$db_cnxn = new mysqli(db, db_usr, db_pwd, db_name);

if ( $db_cnxn->connect_error ){
	die('Oh no! DB connection Error! ('. $db_cnxn->connect_errno . ') '
		. $db_cnxn->connect_error);
}

?>
