<?php

// Get Mantis Bug Details.
$bugId = gpc_get_int( 'bug_id' );
$projectId = gpc_get_int( 'project_id', 0 );

access_ensure_bug_level( config_get( 'update_bug_threshold' ), $bugId );
form_security_validate( 'move_to_kanbanery' );

html_page_top( plugin_lang_get( 'configuration') );
print_manage_menu( );

$bug = bug_get( $bugId, true );

$kanbaneryApiKey = plugin_config_get( 'kanbanery_api_key' );
$workspace       = plugin_config_get( 'kanbanery_workspace' );
$taskType        = plugin_config_get( 'kanbanery_task_type' );

if ($projectId == 0) {
  // If there is not submitted project id use the default config.
  $projectId = plugin_config_get( 'kanbanery_project_id' );
}

if ($projectId == 0) {
  // In case there is no default Board selected show page with Board options from Kanbanery.
  require_once 'board_selection.php';
  exit;
}

// Add task to a Kanbanery project.
$url     = "https://{$workspace}.kanbanery.com/api/v1/projects/{$projectId}/tasks.json";
$data    = "task[task_type_name]={$taskType}&task[title]={$bug->id} - {$bug->summary}&task[description]={$bug->description}";
$options = array("headers" => array('X-Kanbanery-ApiToken' => $kanbaneryApiKey));

$request = new httpRequest($url, HTTP_METH_POST, $options);
$request->setRawPostData ($data);
$result = $request->send();

if (in_array($request->getResponseCode(), array(200, 201))) {
  $response = json_decode($request->getResponseBody());  
  echo "<div align='center'><p><span class='bracket-link'>[ Bug added to Kanbanery under ID: {$response->id}  ]</span></p></div>";
} else {
  echo 'Error<br/>';
  echo 'Response Code: '.$request->getResponseCode().'<br/>'; 
  echo 'Response Body: '; var_dump($request->getResponseBody()).'<br/>';
}

echo "<br/>";
echo "<div align='center'><p><span class='bracket-link'>[ <a href='view.php?id=$bug_id'>Back to bug</a> ]</span></p></div>";

html_page_bottom();