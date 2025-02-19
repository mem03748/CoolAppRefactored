<?php
require 'config.php';

//Connect to MySQL
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id']))
{
    //select the record that is going to be deleted
    $stmt = $pdo->prepare('SELECT * FROM contacts WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $contact = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$contact)
    {
        die ('Contact does not exist with that ID.');
    }
    if (isset($_GET['confirm']))
    {
        if ($_GET['confirm'] == 'yes') {
            //USer clicked the yes button, delete record
            $stmt = $pdo->prepare('DELETE FROM contacts WHERE id = ?');
            $stmt -> execute([$_GET['id']]);
            //output message
            $msg = 'You have deleted the contact!';
        }
        else
        {
            //User clicked the no button, redirect them back to the home page
            header('Location: contacts.php');
            exit;
        }
    }

}
else
{
    die ('No ID specified.');
}




?>

<?= template_header('Delete Contact') ?>
<?= template_nav() ?>

    <!-- START PAGE CONTENT -->
    <h1 class="title">Delete Contact</h1>
    <?php if ($msg) : ?>
    <div class="notification is-success">
        <h2 class="title is-2"><?php echo $msg; ?></h2>
    </div>
<?php endif; ?>
<h2 class="subtitle"> Are you sure you want to delete contact number: <?=$contact['id']?> </h2>
<a href="contact-delete.php?id=<?=$contact['id']?>&confirm=yes" class="button is-success">Yes</a>
<a href="contact-delete.php?id=<?=$contact['id']?>&confirm=no" class="button is-danger">No</a>
    <!-- END PAGE CONTENT -->

<?= template_footer() ?>