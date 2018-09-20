<?php
require_once 'config/config.php';
unset($_SESSION['user_admin']);
header('Location: login.php');