<!DOCTYPE HTML>
<html>
<head>
    <title>Student editing</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />    
</head>

<body>

    <div class="container">
        <div class="page-header">
            <h1>Edit the student</h1>
        </div>

        <?php

        $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');
        $group_id=$_GET['group_id'];

        include '../config/database.php';

        try 
        {
            $query = "SELECT * FROM students WHERE student_id = ?";
            $stmt = $con->prepare( $query );
            $stmt->bindParam(1, $id);

            $stmt->execute();

            $row = $stmt->fetch(PDO::FETCH_ASSOC);

            $fullName = $row['full_name'];
            $age = $row['age'];
        }   

        catch(PDOException $exception)
        {
            die('ERROR: ' . $exception->getMessage());
        }
        
        if($_POST)
        {
            try
            {
                $query = "UPDATE students SET full_name=:full_name, age=:age WHERE student_id = :student_id";

                $stmt = $con->prepare($query);

                $fullName=htmlspecialchars(strip_tags($_POST['full_name']));
                $age=htmlspecialchars(strip_tags($_POST['age']));

                $stmt->bindParam(':full_name', $fullName);
                $stmt->bindParam(':age', $age);
                $stmt->bindParam(':student_id', $id);

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
                    <td>Student full name</td>
                    <td><input type='text' name='full_name' value="<?php echo htmlspecialchars($fullName, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td>Student age</td>
                    <td><input type='number' name='age' value="<?php echo htmlspecialchars($age, ENT_QUOTES);  ?>" class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='students.php?id=<?php echo $group_id; ?>' class='btn btn-danger'>Back</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>

</body>
</html>
