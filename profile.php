<?php
require 'config.php';

//We need to use sessions, so you should always start sessions using the code below
session_start();

//if not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

//query the database for the profile details
//We don't have the password or email info stored on sessions so instead 
//we can get the results from the database.
$stmt = $con->prepare('SELECT password, email FROM accounts WHERE id = ?');
//In this case we can use the account ID to get the account info.

$stmt->bind_param('i', $_SESSION['id']);
$stmt->execute();
$stmt->bind_result($password, $email);
$stmt->fetch();
$stmt->close();
?>

<?= template_header('Profile') ?>
<?= template_nav() ?>

<div class="columns">
    <!-- START LEFT NAV COLUMN-->
    <div class="column is-one-quarter">
        <aside class="menu">
            <p class="menu-label"> Admin menu </p>
            <ul class="menu-list">
                <li><a href="admin.php" > Admin </a></li>
                <li><a href="profile.php" class="is-active"> Profile </a></li>
                <li><a href="polls.php"> Polls </a></li>
                <li><a href="contacts.php"> Contacts </a></li>
            </ul>
        </aside>
    </div>
    <!-- END LEFT NAV COLUMN-->

    <!-- START RIGHT CONTENT COLUMN-->
    <div class="column">


        <!-- START PAGE CONTENT -->
        <h1 class="title">Profile</h1>
        <p class="subtitle">Your account details are below:</p>
        <table class="table">
            <tr>
                <td>Username:</td>
                <td><?= $_SESSION['name'] ?></td>
            </tr>
            <tr>
                <td>Password:</td>
                <td><?= $password ?></td>
            </tr>
            <tr>
                <td>Email:</td>
                <td><?= $email ?></td>
            </tr>
        </table>
        <!-- END PAGE CONTENT -->
        <!-- END RIGHT CONTENT COLUMN-->
    </div>
</div>

<?= template_footer() ?>
