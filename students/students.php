<!DOCTYPE HTML>
<html>
<head>
    <title>Group</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
    <style>
        .m-r-1em {margin-right:1em;}
        .m-b-1em {margin-bottom:1em;}
        .m-l-1em {margin-left:1em;}
        .mt0 {margin-top:0;}
    </style>
</head>
<body>
    <div class="container" >
        <div class="page-header">
            <h1>Students</h1>
        </div>

        <?php
        // include database connection
        include '../config/database.php';
        $action = isset($_GET['action']) ? $_GET['action'] : "";

        if($action=='deleted')
        {
            echo "<div class='alert alert-success'>Record was deleted.</div>";
        }
        $query = "SELECT * FROM students";
        $stmt = $con->prepare($query);
        $stmt->execute();
        $num = $stmt->rowCount();
        echo "<a href='create_student.php' class='btn btn-success m-b-1em'>Add student</a>";
        echo "<a href='../groups/groups.php' class='btn btn-danger m-b-1em m-l-1em'>Back</a>";
        if($num>0)
        {
            echo "<table class='table table-hover w-auto table-bordered'>";
            echo "<tr>"; //creating heading
                echo "<th>Student full name</th>";
                echo "<th>Student age</th>";
                echo "<th></th>";
            echo "</tr>";
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
            {
                extract($row);// $row['name'] to $name
                echo "<tr>";
                    echo "<td><a href='update_student.php?id={$student_id}'>{$full_name}</a></td>";
                    echo "<td>{$age}</td>";
                    echo "<td>";
                        echo "<a href='#' onclick='delete_user({$student_id});'  class='btn btn-danger'>Delete</a>";
                    echo "</td>";
                echo "</tr>";
            }
            echo "</table>"; 
        }
        else
            echo "<div class='alert alert-danger'>No records found.</div>";
        ?>
    </div>  
    <script type='text/javascript'>
    function delete_user( id )// confirm record deletion
    {
        var answer = confirm('Are you sure?');
        if (answer)
            window.location = 'delete_student.php?id=' + id;
    }
    </script>
</body>
</html>