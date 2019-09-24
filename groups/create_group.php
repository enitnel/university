<!DOCTYPE HTML>
<html>
<head>
    <title>Group creation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />     
</head>

<body>

    <div class="container">
        <div class="page-header">
            <h1>New group</h1>
        </div> 
        <?php
        if($_POST){
            include '../config/database.php';
            try{
                $query = "INSERTI пNTO vstu_groups SET group_name=:group_name, number_of_students=:number_of_students";
                $stmt = $con->prepare($query);
                $GroupName=htmlspecialchars(strip_tags($_POST['group_name']));
                $Quantity=htmlspecialchars(strip_tags($_POST['number_of_students']));
                $stmt->bindParam(':group_name', $GroupName);
                $stmt->bindParam(':number_of_students', $Quantity);
                if($stmt->execute())
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                else
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
            }
            catch(PDOException $exception)
            {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <table class='table table-hover w-auto table-bordered'>
                <tr>
                    <td>Group name</td>
                    <td><input type='text' name='group_name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Group quantity</td>
                    <td><textarea name='number_of_students' class='form-control'></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='groups.php' class='btn btn-danger'>Back</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>

</body>
</html>