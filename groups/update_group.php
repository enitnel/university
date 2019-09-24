<!DOCTYPE HTML>
<html>
<head>
    <title>Group editing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
</head>

<body>

    <div class="container">
        <div class="page-header">
            <h1>Edit the group</h1>
        </div>

        <?php

        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

        include '../config/database.php';

        try 
        {
            $query = "SELECT * FROM vstu_groups WHERE group_id = ?";

            $stmt = $con->prepare( $query );
            $stmt->bindParam(1, $id);
            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);
             
            // values to fill up our form
            $GroupName = $row['group_name'];
            $Quantity = $row['number_of_students'];
        }
        catch(PDOException $exception)
        {
            die('ERROR: ' . $exception->getMessage());
        }

        if($_POST)
        { 
            try
            {
                $query = "UPDATE vstu_groups SET group_name=:group_name, number_of_students=:number_of_students WHERE group_id = :group_id";
                $stmt = $con->prepare($query);

                $GroupName=htmlspecialchars(strip_tags($_POST['group_name']));
                $Quantity=htmlspecialchars(strip_tags($_POST['number_of_students']));

                $stmt->bindParam(':group_name', $GroupName);
                $stmt->bindParam(':number_of_students', $Quantity);
                $stmt->bindParam(':group_id', $id);

                if($stmt->execute())
                    echo "<div class='alert alert-success'>Record was updated.</div>";
                else
                    echo "<div class='alert alert-danger'>Unable to update record. Please try again.</div>"; 
            }
            catch(PDOException $exception)
            {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . "?id={$id}");?>" method="post">
            <table class='table table-hover w-auto table-bordered'>
                <tr>
                    <td>Group name</td>
                    <td><input type='text' name='group_name' value="<?php echo htmlspecialchars($GroupName, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Group quantity</td>
                    <td><textarea name='number_of_students' class='form-control'><?php echo htmlspecialchars($Quantity, ENT_QUOTES);?></textarea></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save Changes' class='btn btn-primary' />
                        <a href='groups.php' class='btn btn-danger'>Back</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>

</body>
</html>
