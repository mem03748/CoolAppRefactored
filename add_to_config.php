function redirect($msg, $file, $answer)
{
  if (!empty($msg)) {
    //make sure that answer is either success or error
    header("Location: " . $file . "?message=$msg" . "?answer=$answer");
  } else {
    echo 'there was an error.';
  }
}

function message()
{


  if (strpos($_SERVER['REQUEST_URI'], "success") == true) {
?>
    <div class="notification is-success">
      <h2 class="title is-2">Success!</h2>
    </div>
  <?php
  }

  if (strpos($_SERVER['REQUEST_URI'], "error") == true) {
  ?>
    <div class="notification is-danger">
      <h2 class="title is-2">There was an error.</h2>
    </div>
<?php
  }
}
