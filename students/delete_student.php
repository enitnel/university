<?php
include '../config/database.php';
try
{
    $id=isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found.');

    $query = "DELETE FROM students WHERE student_id = ?";

    $stmt = $con->prepare($query);
    $stmt->bindParam(1, $id);
     
    if($stmt->execute())
        header('Location: students.php?action=deleted');
    else
        die('Unable to delete record.');
}
catch(PDOException $exception)
{
    die('ERROR: ' . $exception->getMessage());
}
?>