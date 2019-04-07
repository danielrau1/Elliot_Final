<?php
session_start();
require APPROOT.'\views\inc\navbar.php'; ?>
<h3>Hi <?php echo $_SESSION['in']?></h3>