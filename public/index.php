<?php

/*DR: index.php requires bootstrap.php, which in turn requires the classes from the libraries*/

require_once '../app/bootstrap.php'; //(A)

// Init Core Library
$init = new Core; //(A1.1) DR: initialize the Core class like this can use its constructor, and it is available here since above we required it through "2 levels"