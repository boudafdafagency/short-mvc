<!DOCTYPE html>
<?php

// Check if the message exists and if it's older than 1 minute
if (isset($_SESSION['message']) && isset($_SESSION['message_time'])) {
    // Calculate how much time has passed since the message was set
    $timePassed = time() - $_SESSION['message_time'];
    // Check if more than 60 seconds (1 minute) have passed
    if ($timePassed > 30) {
        // Unset the message and time if more than 1 minute has passed
        unset($_SESSION['message']);
        unset($_SESSION['status']);
        unset($_SESSION['message_time']);
    }
}
?>
<?php global $router; ?>
<html lang="fr">
<?php require_once('head.php'); ?>

<body>

     <!-- Header -->
    <!-- End Header -->