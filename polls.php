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



$stmt = $pdo->query('SELECT p.*, GROUP_CONCAT(pa.title ORDER BY pa.id) AS answers
                     FROM polls p LEFT JOIN poll_answers pa ON pa.poll_id = p.id
                     GROUP BY p.id');

$polls = $stmt->fetchAll(PDO::FETCH_ASSOC);



?>

<?= template_header('Polls') ?>
<?= template_nav() ?>

<!-- START PAGE CONTENT -->

<?php
//if the URL has success or fail in it show message
message();
?>



<div class="columns">
    <!-- START LEFT NAV COLUMN-->
    <div class="column is-one-quarter">
        <aside class="menu">
            <p class="menu-label"> Admin menu </p>
            <ul class="menu-list">
                <li><a href="admin.php" > Admin </a></li>
                <li><a href="profile.php"> Profile </a></li>
                <li><a href="polls.php" class="is-active"> Polls </a></li>
                <li><a href="contacts.php"> Contacts </a></li>
            </ul>
        </aside>
    </div>
    <!-- END LEFT NAV COLUMN-->
    <!-- START RIGHT CONTENT COLUMN-->
    <div class="column">

        <h1 class="title">Polls</h1>
        <p>Welcome, view our list of polls below</p>

        <a href="poll-create.php" class="buton is-primary is-small">
            <span class="icon"><i class="fas fa-plus-square"></i> </span>
            <span>Create Poll</span>
        </a>
        <p>&nbsp;</p>
        <div class="container">
            <table class="table is-bordered is-hoverable">
                <thead>
                    <tr>
                        <td>#</td>
                        <td>Title</td>
                        <td>Answers</td>
                        <td>Action</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($polls as $poll) : ?>
                        <tr>
                            <td>
                                <?= $poll['id'] ?>
                            </td>
                            <td>
                                <?= $poll['title'] ?>
                            </td>
                            <td>
                                <?= $poll['answers'] ?>
                            </td>
                            <td>
                                <a href="poll-vote.php?id=<?= $poll['id'] ?>" class="button is-link is-small" title="View Poll">
                                    <span class="icon"> <i class="fas fa-eye"></i> </span>
                                </a>
                                <a href="poll-delete.php?id=<?= $poll['id'] ?>" class="button is-link is-small">
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
