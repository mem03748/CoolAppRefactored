<?php
require 'config.php';

//Connect to MySQL
$pdo = pdo_connect_mysql();
$msg = "";

//Check if POST data is not empty
if(!empty($_POST)) {
    //check to see if the data from the form is set
    $title = isset($_POST['title']) ? $_POST['title'] : '';
    $desc = isset($_POST['desc']) ? $_POST['desc'] : '';

    //insert the new poll record into the polls table
    $stmt = $pdo->prepare('INSERT INTO polls VALUES (NULL, ?, ?)');
    $stmt->execute([$title, $desc]);

    $poll_id = $pdo->lastInsertId();

    //Get the answers and convert the multiline string to an array, so we can insert each answer
    $answers = isset($_POST['answers']) ? explode(PHP_EOL, $_POST['answers']) : '';
    foreach($answers as $answer) {
        if (empty($answers)) continue;
        // add answers to the answers table
        $stmt = $pdo->prepare('INSERT INTO poll_answers VALUES (NULL, ?, ?, 0)');
        $stmt->execute([$poll_id, $answer]);
    }
    $msg = "Poll created successfully!";
}

?>

<?= template_header('Create Poll') ?>
<?= template_nav() ?>

    <!-- START PAGE CONTENT -->
    <h1 class="title">Create Poll</h1>
    <!-- message sent confirmation goes here -->
    <?php if ($msg) : ?>
    <div class="notification is-success">   
        <h2 class ="title is-2"><?php echo $msg; ?></h2>
    </div>    <!-- END PAGE CONTENT -->
<?php endif; ?>

<form action="" method="post">
        <div class="field">
            <label class="label">Title</label>
                <div class="control">
                    <input class="input" type = "text" name="title" placeholder="Poll Title">
                </div>
        </div>
        <div class="field">
            <label class="label">Description</label>
                <div class="control">
                    <input class="input" type = "text" name="desc" placeholder="Poll Description">
                </div>
        </div>
        <div class="field">
            <label class="label">Answers (per line)</label>
                <div class="control">
                    <textarea class="textarea" name="answers" placeholder="Answers"></textarea>
                </div>
        </div>
        <div class="field">
            <div class="control">
                <button class="button is-link">Submit</button>
            </div>
        </div>
</form>
    
    <!-- END PAGE CONTENT -->

<?= template_footer() ?>