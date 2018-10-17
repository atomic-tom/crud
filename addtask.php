<!DOCTYPE html>
<html lang="en">

<head>

  <title>Add Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- why roll your own?  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!--                     -->

  <style type="text/css">
        .wrapper{
         width: 600px;
         margin: 0 auto;
        }
  </style>

</head>

<!------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------>

<body>

<div class="wrapper">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-12">
    <div class="page-header">
	<h2>Enter your task...</h2>
    </div>

	<p><em>...or else</em></p>

	<form method="post" action"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
	 <div class="form-group"> 
	  <label>Task</label>
	  <input type="text" name="task" class="form-control" value="e.g. wax the cat">
	 </div>
	
	 <input type="submit" class="btn btn-primary" value="Submit">
         <a href="index.php" class="btn btn-default">Cancel</a>
	
	</form>

   </div>
  </div>
 </div>
</div>

</body>
</html>


<!---------------------------------------------------------------------------------------->
<!---------------------------------------------------------------------------------------->


<?php

require_once "connect.php";

$task = $err = "";


if($_SERVER["REQUEST_METHOD"] == "POST"){

//get task and verify not empty
	$task = trim($_POST["task"]);
	if( empty($task) ){  
		echo '<script language="javascript">';
		echo 'alert("YOU CAN\'T SUBMIT AN EMPTY TASK! YOU WILL REGRET THIS!")';
		echo '</script>';
	} else{
		$q = "insert into tasks(task) values (?)";

		if( $prepd_q = $db_cnxn->prepare($q) ){

			$prepd_q->bind_param("s", $bp_task);
			$bp_task = $task;

			if( $prepd_q->execute() ){
				header("location: index.php");
				exit();
			} else{
				echo "Shit's fucked";
			}

		}

		$prepd_q->close();

	}

	$db_cnxn->close();
}

?>
