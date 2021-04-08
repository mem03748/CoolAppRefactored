<?php
require 'config.php';

//We need to use sessions, so you should always start sessions using the code below
session_start();

//if not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}


?>

<?= template_header('Profile') ?>
<?= template_nav() ?>

<div class = "columns" >
<!-- START LEFT NAV COLUMN-->
<div class = "column is-one-quarter" >
<aside class = "menu" >
<p class = "menu-label" > Admin menu </p >
<ul class = "menu-list" >
<li ><a href = "admin.php" class = "is-active" > Admin </a ></li >
<li ><a href = "profile.php" > Profile </a ></li >
<li ><a href = "polls.php" > Polls </a ></li >
<li ><a href = "contacts.php" > Contacts </a ></li >
</ul >
</aside >
</div >
<!-- END LEFT NAV COLUMN-->
<!-- START RIGHT CONTENT COLUMN-->
<div class = "column" >
<h1 class = "title" > Page Title Goes Here </h1 >
<p > This is where page content goes. </p >
</div >
<!-- END RIGHT CONTENT COLUMN-->
</div >

<?= template_footer() ?>
