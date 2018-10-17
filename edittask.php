<?php

require_once "connect.php";

$label = $task = "";


// Grab task so you know what you're editing

if( isset($_GET["id"]) && !empty(trim($_GET["id"])) ){

        $label_q = "select task from tasks where id = ? ";

        if( $prepd_label_q = $db_cnxn->prepare($label_q) ){
                $prepd_label_q->bind_param("i", $bp_id);
                $bp_id = trim($_GET["id"]);

                if( $prepd_label_q->execute() ){
                        $label_q_res = $prepd_label_q->get_result();
                        $row = $label_q_res->fetch_array(MYSQLI_ASSOC);
                        $label = $row["task"];
		}
	}
}



if($_SERVER["REQUEST_METHOD"] == "POST"){

//get task and verify not empty, get ID
        $task = trim($_POST["task"]);
        $id = trim($_GET["id"]);

        if( empty($task) ){ 
		echo '<script language="javascript">';
                echo 'alert("YOU CAN\'T SUBMIT AN EMPTY TASK! YOU WILL REGRET THIS!")';
                echo '</script>';

	} else{

                $q = "update tasks set task=? where id=?";

                if( $prepd_q = $db_cnxn->prepare($q) ){

                        $prepd_q->bind_param("si", $bp_task, $bp_id);
                        $bp_task = $task;
                        $bp_id = $id;

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


<head>

  <title>Edit Task</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- why roll your own?  -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--                     -->

  <style type="text/css">
        .wrapper{
         width: 600px;
         margin: 0 auto;
        }
  </style>


  <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();
        });
  </script>

</head>

<!------------------------------------------------------------------------------------>
<!------------------------------------------------------------------------------------>

<body>

<div class="wrapper">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-12">
    <div class="page-header">
	<h2>Task: <?php echo $row['task'] ?></h2>
    </div>

	<p><em>Re-enter your task</em></p>

	<form method="post" action"<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
	 <div class="form-group <?php echo (!empty($err)) ? 'has-error' : ''; ?>">
	  <label>Task</label>
	  <input type="text" name="task" class="form-control" value="<?php echo $task; ?>">
	  <span class="help-block"><?php echo $err;?></span>
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

