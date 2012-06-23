<?php
// Include the configuration.
require_once('config.php');

// Tasks of a project.
$url = "https://" . WORKSPACE . ".kanbanery.com/api/v1/projects/" . PROJECT_ID . "/tasks.json";

$data = "task[task_type_name]=Office Work&task[title]=Some funny title&task[description]=Somy funny description";

$options = array("headers" => array('X-Kanbanery-ApiToken' => KEY));

var_dump($url);
echo "<br/>";
var_dump($data);

$request = new httpRequest($url, HTTP_METH_POST, $options);
$request->setRawPostData ($data);
$result = $request->send();
header("HTTP/1.0 " . $request->getResponseCode());

echo "<br/>";

var_dump($request->getResponseBody());