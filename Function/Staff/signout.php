<?php
function signOut() {
    session_start();
    session_unset();
    session_destroy();
    echo "You have been signed out.";
}
?>
