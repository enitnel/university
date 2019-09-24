<!DOCTYPE HTML>
<html>
<head>
    <title>Student creation</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />       
</head>
<body>

    <div class="container">
        <div class="page-header">
            <h1>New student</h1>
        </div> 

        <?php
        if($_POST){
            include '../config/database.php';// include database connection
            try
            {
                $query = "INSERT INTO students SET full_name=:full_name, age=:age";
                $stmt = $con->prepare($query);// prepare query for execution
                
                $fullName=htmlspecialchars(strip_tags($_POST['full_name']));
                $age=htmlspecialchars(strip_tags($_POST['age']));
                
                $stmt->bindParam(':full_name', $fullName);
                $stmt->bindParam(':age', $age);
                
                if($stmt->execute())// Execute the query
                    echo "<div class='alert alert-success'>Record was saved.</div>";
                else
                    echo "<div class='alert alert-danger'>Unable to save record.</div>";
            }
            catch(PDOException $exception)// show error
            {
                die('ERROR: ' . $exception->getMessage());
            }
        }
        ?>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
            <table class='table table-hover table-responsived w-auto table-bordered'>
                <tr>
                    <td>Student full name</td>
                    <td><input type='text' name='full_name' class='form-control' /></td>
                </tr>
                <tr>
                    <td>Student age</td>
                    <td><input type='number' name='age' class='form-control' /></td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type='submit' value='Save' class='btn btn-primary' />
                        <a href='students.php' class='btn btn-danger'>Back</a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    
</body>
</html>