<?php
auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

html_page_top( plugin_lang_get( 'configuration') );

print_manage_menu( );

$t_kanbanery_api_key = plugin_config_get( 'kanbanery_api_key' );
$t_kanbanery_project_id = plugin_config_get( 'kanbanery_project_id' );
$t_kanbanery_task_type = plugin_config_get( 'kanbanery_task_type' );
?>

<br />
<form action="<?php echo plugin_page( 'config_update' ) ?>" method="post">
  <?php echo form_security_field( 'plugin_Kanbanery_config_update' ) ?>
  <table class="width60" align="center">
    <tr>
      <td class="form-title" colspan="2"><?php echo plugin_lang_get( 'configuration' ) ?></td>
    </tr>
    <tr <?php echo helper_alternate_class() ?>>
      <td class="category"><?php echo plugin_lang_get( 'kanbanery_api_key' ) ?></td>
      <td><input name="kanbanery_api_key" value="<?php echo string_attribute( $t_kanbanery_api_key ) ?>" /></td>
    </tr>
    <tr <?php echo helper_alternate_class() ?>>
      <td class="category"><?php echo plugin_lang_get( 'kanbanery_project_id' ) ?></td>
      <td><input name="kanbanery_project_id" value="<?php echo string_attribute( $t_kanbanery_project_id ) ?>" /></td>
    </tr>
    <tr <?php echo helper_alternate_class() ?>>
      <td class="category"><?php echo plugin_lang_get( 'kanbanery_task_type' ) ?></td>
      <td><input name="kanbanery_task_type" value="<?php echo string_attribute( $t_kanbanery_task_type ) ?>" /></td>
    </tr>
    <tr>
      <td class="center" rowspan="2"><input type="submit" /></td>
    </tr>
  </table>
</form>

<?php html_page_bottom();