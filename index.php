<!-- Boilerplate -->
<!DOCTYPE html>
<html lang="en">

<head>

  <title>C.R.U.D.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

<!-- why roll your own?  -->	
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!--			 -->

  <style type="text/css">
  	.wrapper{
  	 width: 500px;
  	 margin: 0 auto;
        }
        .page-header h2{
 	 margin-top: 0;
        }
        table tr td:last-child a{
  	 margin-right: 15px;
        }
  </style>


  <script type="text/javascript">
        $(document).ready(function(){
            $('[data-toggle="tooltip"]').tooltip();   
        });
  </script>

</head>

<!-------------------------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------------------------->

<body>

<div class="wrapper">
 <div class="container-fluid">
  <div class="row">
   <div class="col-md-20">
    
    <div class="page-header clearfix">
	<h2 class="pull-left">C.R.U.D.</h2>
	<a href="addtask.php" class="btn btn-primary pull-right">
		Add a task</a>
    </div>

<?php
require_once "connect.php";

$q = "select * from tasks order by create_time asc";

if ( $q_res = $db_cnxn->query($q) ){

	if ( $q_res->num_rows > 0 ){

		echo "<table class='table table-bordered table-hover table-responsive'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>TASK</th>";
		echo "<th>LAST UPDATED</th>";
		echo "<th></th>";
		echo "</tr>";
		echo "</thead>";
		echo "<tbody>";
        
		while($row = $q_res->fetch_array()){
		 echo "<tr>";
		 echo "<td>" . $row['task'] . "</td>";
		 echo "<td>" . $row['create_time'] . "</td>";
		 echo "<td>";
		 echo "<a href='viewtask.php?id=". $row['id'] 
			."' title='View Task' data-toggle='tooltip'><span class='btn btn-primary'/></a>";
		 echo "<a href='edittask.php?id=". $row['id'] 
			."' title='Edit Task' data-toggle='tooltip'><span class='btn btn-success'/></a>";
		 echo "<a href='deletetask.php?id=". $row['id'] 
			."' title='Delete Task' data-toggle='tooltip'>"
			."<span class='btn btn-danger'/></a>";
		 echo "</td>";
		 echo "</tr>";
		}
		echo "</tbody>";                            
		echo "</table>";	
	
		$q_res->free();
	
	} else {
		echo "<p class='lead'><em>You are lazy and have no tasks</em></p>";
	}	 
} else{
	echo "<p class='lead'><em>Whoops! Couldn't query your tasks.	" . $db_cnxn->error . "</em></p>";
}

$db_cnxn->close();

?>

   </div>
  </div>
 </div>
</div>

</body>
</html>
