<?php
include('includes/config.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $delete_id = $_GET['id'] ?? null;

    // Delete related members first
    $deleteMembersQuery = "DELETE FROM members WHERE membership_type = $delete_id";
    $conn->query($deleteMembersQuery);

    // Now delete from membership_types
    $deleteQuery = "DELETE FROM membership_types WHERE id = $delete_id";

    if ($conn->query($deleteQuery) === TRUE) {
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
        exit();
    }
}

?>
