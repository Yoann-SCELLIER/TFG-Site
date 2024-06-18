<?php

session_start();
session_unset();
session_destroy();
header('Location: /TFG/index.php');
exit();