<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'projectm';

    $conn = mysqli_connect($host, $user, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if (isset($_GET['delete'])) {
        $idToDelete = $_GET['delete'];
    
        // Query to delete the product
        $deleteQuery = "DELETE FROM data_product WHERE id = '$idToDelete'";
    
        // Execute the delete query
        if (mysqli_query($conn, $deleteQuery)) {
            header("Location: product.php?success=delete_success");
            exit();
        } else {
            header("Location: product.php?error=delete_error");
            exit();
        }
    }
?>
