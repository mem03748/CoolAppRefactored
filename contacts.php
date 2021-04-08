<?php
require 'config.php';

//We need to use sessions, so you should always start sessions using the code below
session_start();

//if not logged in, redirect to login page
if (!isset($_SESSION['loggedin'])) {
    header('Location: login.php');
    exit;
}

//Connect to MySQL
$pdo = pdo_connect_mysql();


$stmt = $pdo->query('SELECT * FROM contacts');

$contacts = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<?= template_header('Contacts') ?>
<?= template_nav() ?>

<div class="columns">
    <!-- START LEFT NAV COLUMN-->
    <div class="column is-one-quarter">
        <aside class="menu">
            <p class="menu-label"> Admin menu </p>
            <ul class="menu-list">
                <li><a href="admin.php"> Admin </a></li>
                <li><a href="profile.php"> Profile </a></li>
                <li><a href="polls.php"> Polls </a></li>
                <li><a href="contacts.php" class="is-active"> Contacts </a></li>
            </ul>
        </aside>
    </div>
    <!-- END LEFT NAV COLUMN-->

    <!-- START RIGHT CONTENT COLUMN-->
    <div class="column">
        <!-- START PAGE CONTENT -->
        <h1 class="title">Contacts</h1>
        <p>Welcome, view our list of contacts below</p>

        <a href="contact-create.php" class="buton is-primary is-small">
            <span class="icon"><i class="fas fa-plus-square"></i> </span>
            <span>Create Contact</span>
        </a>
        <p>&nbsp;</p>
        <div class="container">
            <table class="table is-bordered is-hoverable">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Name</td>
                        <td>Email</td>
                        <td>Phone</td>
                        <td>Title</td>
                        <td>Created</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contacts as $contact) : ?>
                        <tr>
                            <td>
                                <?= $contact['id'] ?>
                            </td>
                            <td>
                                <?= $contact['name'] ?>
                            </td>
                            <td>
                                <?= $contact['email'] ?>
                            </td>
                            <td>
                                <?= $contact['phone'] ?>
                            </td>
                            <td>
                                <?= $contact['title'] ?>
                            </td>
                            <td>
                                <?= $contact['created'] ?>
                            </td>
                            <td>
                                <a href="contact-update.php?id=<?= $contact['id'] ?>" class="button is-link is-small" title="View Contact">
                                    <span class="icon"> <i class="fas fa-eye"></i> </span>
                                </a>
                                <a href="contact-delete.php?id=<?= $contact['id'] ?>" class="button is-link is-small">
                                    <span class="icon"> <i class="fas fa-trash-alt"></i> </span>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END RIGHT CONTENT COLUMN-->
</div>

<?= template_footer() ?>
