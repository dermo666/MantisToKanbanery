<?php

form_security_validate( 'move_to_kanbanery' );
auth_reauthenticate( );

// Get Mantis Bug Details.
$bug_id = gpc_get_int( 'bug_id' );

$bug = bug_get( $bug_id, true );

// echo '<pre>';
// print_r($bug); 
// echo $bug->summary.' '.$bug->description;

$kanbaneryApiKey = plugin_config_get( 'kanbanery_api_key' );
$workspace       = plugin_config_get( 'kanbanery_workspace' );
$projectId       = plugin_config_get( 'kanbanery_project_id' );
$taskType        = plugin_config_get( 'kanbanery_task_type' );

// Add task to a Kanbanery project.
$url     = "https://{$workspace}.kanbanery.com/api/v1/projects/{$projectId}/tasks.json";
$data    = "task[task_type_name]={$taskType}&task[title]={$bug->summary}&task[description]={$bug->description}";
$options = array("headers" => array('X-Kanbanery-ApiToken' => $kanbaneryApiKey));

// var_dump($url);
// echo "<br/>";
// var_dump($data);

$request = new httpRequest($url, HTTP_METH_POST, $options);
$request->setRawPostData ($data);
$result = $request->send();

// TODO: Mantis bug can be related to Kanban Task so it will be added only once and updated after that
// Must use some custom field to hold the value of Kanban Task ID.

if (in_array($request->getResponseCode(), array(200, 201))) {
  $response = json_decode($request->getResponseBody());  
  echo "Bug added to Kanbanery under ID: ".$response->id;
} else {
  echo 'Error<br/>';
  echo 'Response Code: '.$request->getResponseCode().'<br/>'; 
  echo 'Response Body: '; var_dump($request->getResponseBody()).'<br/>';
}

echo "<br/>";
echo "<a href='view.php?id=$bug_id'>Back to bug</a>";