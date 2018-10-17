<?php
require_once "connect.php";

if( isset($_GET["id"]) && !empty(trim($_GET["id"])) ){

        $q = "select * from tasks where id = ? ";

        if( $prepd_q = $db_cnxn->prepare($q) ){
                $prepd_q->bind_param("i", $bp_id);
                $bp_id = trim($_GET["id"]);

                if( $prepd_q->execute() ){
                        $q_res = $prepd_q->get_result();

                        if( $q_res->num_rows == 1){

                                $this_row = $q_res->fetch_array(MYSQLI_ASSOC);

                                $task = $this_row["task"];
                                $create_time = $this_row["create_time"];
                        }
                }

                $prepd_q->close();

                $db_cnxn->close();
        }
}

?>

<!-------------------------------------------------------------------------------------------------------------->
<!-------------------------------------------------------------------------------------------------------------->

<!-- Boilerplate -->

<!DOCTYPE html>
<html lang="en">

<head>

  <title>View Task</title>
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
        <h2>View Task</h2>
    </div>

<table class='table table-bordered table-striped'>

<thead>
 <tr>
  <th>TASK</th>
  <th>LAST UPDATED</th>
 </tr>
</thead>

<tbody>
 <tr>
  <td><?php echo $this_row['task']; ?></td>
  <td><?php echo $this_row['create_time']; ?></td>
 </tr>
</tbody>

</table>
   
<?php echo "<a href='edittask.php?id=". ($_GET['id']) ."' class='btn btn-primary'>Edit Task</a>" ?>
<a href="index.php" class="btn btn-outline-primary">Back</a>
<?php echo "<a href='deletetask.php?id=". ($_GET['id']) ."' class='btn btn-danger'>Delete Task</a>" ?>

   </div>
  </div>
 </div>
</div>

</body>
</html>
