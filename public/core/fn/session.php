<?php
session_start();

if (!$_SESSION['key']) {
    $_SESSION['key'] = $_SERVER['PHP_AUTH_PW'];
}

session_write_close();
