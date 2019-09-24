<!DOCTYPE HTML>
<html>
<head>
    <title>University</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
    .m-r-1em{ margin-right:1em; }
    .m-b-1em{ margin-bottom:1em; }
    .m-l-1em{ margin-left:1em; }
    .mt0{ margin-top:0; }
    </style>
</head>

<body>

    <div class="container">
        <div class="page-header">
            <h1>Groups</h1>
        </div>
     
        <?php
        include '../config/database.php';
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if($action=='deleted')
            echo "<div class='alert alert-success'>Record was deleted.</div>";

        $query = "SELECT * FROM vstu_groups";
        $stmt = $con->prepare($query);
        $stmt->execute();
         
        $num = $stmt->rowCount();

        echo "<a href='create_group.php' class='btn btn-success m-b-1em'>Add group</a>";

        if($num>0)
        {
            echo "<table class='table table-hover w-auto table-bordered'>";//start table
            echo "<tr>";
                echo "<th>Group name</th>";
                echo "<th>Group quantity</th>";
                echo "<th></th>";
            echo "</tr>";

            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);
                echo "<tr>";
                    echo "<td><a href='../students/students.php?id={$group_id}'>{$group_name}</a></td>";
                    echo "<td>{$number_of_students}</td>";
                    echo "<td>";
                        // we will use this links on next part of this post
                        echo "<a href='update_group.php?id={$group_id}' class='btn btn-primary m-r-1em'>Edit</a>";
             
                        // we will use this links on next part of this post
                        echo "<a href='#' onclick='delete_user({$group_id});'  class='btn btn-danger'>Delete</a>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</table>"; 
        }
        else
            echo "<div class='alert alert-danger'>No records found.</div>";
        ?>

    </div> <!-- end .container -->

 <script type='text/javascript'>

function delete_user( id ){
     
    var answer = confirm('Are you sure?');
    if (answer){
        // if user clicked ok, 
        // pass the id to delete.php and execute the delete query
        window.location = 'delete_group.php?id=' + id;
    } 
}
</script>
 
</body>
</html>