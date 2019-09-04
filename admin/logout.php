<?php
session_start();
unset($_SESSION['admin']);
session_destroy();
echo '<script language="javascript">document.location="login.php";</script>';
?>
