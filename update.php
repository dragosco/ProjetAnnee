<?php

require("models/Project.php");

$project = Project::getInstance();

if(isset($_POST['json'])) {
    $project->updateTable(json_decode($_POST['json'], true));
}

if(isset($_POST['id'])) {
    $project->updateTask($_POST['id'], $_POST['nvnom']);
}
//$file = fopen('test.txt','w+');
//fwrite($file, $json);
//fclose($file);

header("Location: tasklist.php");
?>
