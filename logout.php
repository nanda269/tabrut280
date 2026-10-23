<?php
require_once 'includes/functions.php';
logActivity("Logout dari sistem");
session_destroy();
redirect('login.php');
?>
