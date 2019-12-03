<?php

setcookie('userId','',-1,'/');
setcookie('password','',-1,'/');
unset($_SESSION['users']);
session_destroy();
session_write_close();
header('Location: ../index.php');
die;