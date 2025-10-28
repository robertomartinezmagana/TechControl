<?php
session_start();
session_destroy();
header("Location: ../admin/login_admin.php"); // o el login correspondiente
exit();
?>