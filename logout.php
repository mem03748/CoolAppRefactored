<?php
//logout script
session_start();
session_destroy();
// redirect to home page
header('Location: index.php');
