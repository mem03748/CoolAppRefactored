function redirect($file, $msg)
{
  if ($msg == 'wrong' || $msg == 'right') {
    //make sure that answer is either right or wrong
    header("Location: " . $file . "?answer=$msg");
  } else {
    echo 'there was an error.';
  }
}

function message()
{


  if (strpos($_SERVER['REQUEST_URI'], "right") == true) {
?>
    <div class="notification is-success">
      <h2 class="title is-2">Success!</h2>
    </div>
  <?php
  }

  if (strpos($_SERVER['REQUEST_URI'], "wrong") == true) {
  ?>
    <div class="notification is-danger">
      <h2 class="title is-2">There was an error.</h2>
    </div>
<?php
  }
}
