<?php
require 'config.php';

// Connect to MySQL
$pdo = pdo_connect_mysql();

//var_dump($_POST);

//If the GET request "id" exists (poll id)...
if (isset($_GET['id'])) {
    //MySQL query that selects the poll records by the GET request "id"
    $stmt = $pdo->prepare('SELECT * FROM polls WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    //fetch the record
    $poll = $stmt->fetch(PDO::FETCH_ASSOC);

    //Check if the poll record exists with the id specified
    if($poll){
        //MySQL query that selects the poll answers
        $stmt = $pdo->prepare('SELECT * FROM poll_answers WHERE poll_id = ? ORDER BY votes DESC');
        $stmt->execute([$_GET['id']]);
        //Fetch all the answers
        $poll_answers = $stmt->fetchAll(PDO::FETCH_ASSOC);

        //Total number of votes, will be used to calculate the percentage
        $total_votes = 0;

        foreach ($poll_answers as $poll_answer) {
            //Every poll answers votes will be added to total votes
            $total_votes += $poll_answer['votes'];
        }
    }else {
        die ('The poll with that id does not exist.');
    }
} else {
    die('No poll id specified.');
}

?>

<?= template_header('Poll Results') ?>
<?= template_nav() ?>

    <!-- START PAGE CONTENT -->
    <h1 class="title">Poll Results</h1>
    <h2 class="subtitle"><?=$poll['title']?> (Total Votes: <?=$total_votes?>)</h2>
<div class="container">
    <?php foreach ($poll_answers as $poll_answer):?>
    <p><?=$poll_answer['title']?>(<?= $poll_answer['votes'] ?> votes)</p>
    <progress class="is-primary is-large"
                value="<?= @round(($poll_answer['votes'] / $total_votes) * 100) ?>"
                max="<?= $total_votes * 3?>"></progress>
    <?php endforeach?>
</div> 
<p>Total Votes: <?=$total_votes?></p>
   <!-- END PAGE CONTENT -->

<?= template_footer() ?>