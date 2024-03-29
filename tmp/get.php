<?php
// Include the configuration.
require_once('config.php');

// Getting users for project.
//$url = "https://" . WORKSPACE . ".kanbanery.com/api/v1/projects/" . PROJECT_ID . "/users.json";

// Listing workspaces with projects.
$url = "https://" . WORKSPACE . ".kanbanery.com/api/v1/user/workspaces.json";

// Getting Task Types for project.
//$url = "https://" . WORKSPACE . ".kanbanery.com/api/v1/projects/" . PROJECT_ID . "/task_types.json";

// Listing columns of a project
//$url = "https://" . WORKSPACE . ".kanbanery.com/api/v1/projects/" . PROJECT_ID . "/columns.json";

// Listing of all tasks.
//$url = "https://" . WORKSPACE . ".kanbanery.com/api/v1/projects/" . PROJECT_ID . "/tasks.json";

// $data = "task[task_type_name]=bug&task[title]=" . $_POST["title"] . "&task[description]=" . $_POST["body"];

$options = array("headers" => array('X-Kanbanery-ApiToken' => KEY));

echo '<pre>';
var_dump($url);
echo "<br/>";
var_dump($data);

$request = new httpRequest($url, HTTP_METH_GET, $options);
//$request->setRawPostData ($data);
$result = $request->send();

var_dump($request->getResponseCode());

echo "<br/>";

print_r(json_decode($request->getResponseBody()));