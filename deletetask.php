<?php
require_once "connect.php";

if( isset($_GET["id"]) && !empty(trim($_GET["id"])) ){

        $q = "delete from tasks where id = ? ";

        if( $prepd_q = $db_cnxn->prepare($q) ){

		$prepd_q->bind_param("i", $bp_id);
                $bp_id = trim($_GET["id"]);

                if( $prepd_q->execute() ){

			header("location: index.php");
			exit();
		}

	$prepd_q->close();

	$db_cnxn->close();
	}
}

?>
