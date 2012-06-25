<?php
/**
 * Include for move.php in case there is no Board selected (project id).
 */

// Get list of a Kanbanery boards.
$url     = "https://{$workspace}.kanbanery.com/api/v1/user/workspaces.json";
$options = array("headers" => array('X-Kanbanery-ApiToken' => $kanbaneryApiKey));

$request = new httpRequest($url, HTTP_METH_GET, $options);
$result = $request->send();

if (!in_array($request->getResponseCode(), array(200, 201))) {
  echo 'Error<br/>';
  echo 'Response Code: '.$request->getResponseCode().'<br/>'; 
  echo 'Response Body: '; var_dump(json_decode($request->getResponseBody())).'<br/>';
} else {
?>  
<br />
<form action="<?php echo plugin_page( 'move' ) ?>" method="post">
  <?php echo form_security_field( 'move_to_kanbanery' ) ?>
  <input type="hidden" name="bug_id" value="<?php echo $bugId; ?>"/>
  <table class="width60" align="center">
    <tr>
      <td class="form-title" colspan="2"><?php echo plugin_lang_get( 'select_board' ) ?></td>
    </tr>
    <tr <?php echo helper_alternate_class() ?>>
      <td class="category"><?php echo plugin_lang_get( 'board' ) ?></td>
      <td><select name="project_id">
<?php  
  $response = json_decode($request->getResponseBody());
  
  foreach ($response as $workspace) {  
    foreach ($workspace->projects as $project) {
      echo "            <option value={$project->id}>{$project->name}</option>";
    }
  }
?>  
          </select></td>
    </tr>
    <tr>
      <td class="center" rowspan="2"><input type="submit" /></td>
    </tr>    
  </table>
</form>  
  
<?php
}

html_page_bottom();