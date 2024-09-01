<?php
session_start();
session_unset(); // Remove all session variables
session_destroy(); // Destroy the session

// Output JavaScript for alert and redirect
echo '<script>
    alert("You have been signed out.");
    window.location.href = "../CG/index.php";
</script>';
exit; // Ensure no further code is executed
?>
