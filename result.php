<?php require("core/init.php")?>

<?php

$template = new Template("templates/result.php");

$success = isset($_GET['success']) ? $_GET['success'] : null;

$template->success = $success;

//Display template
echo $template;