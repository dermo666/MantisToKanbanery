<?php

form_security_validate( 'plugin_Kanbanery_config_update' );

auth_reauthenticate( );
access_ensure_global_level( config_get( 'manage_plugin_threshold' ) );

$f_kanbanery_api_key    = gpc_get_string( 'kanbanery_api_key');
$f_kanbanery_workspace  = gpc_get_string( 'kanbanery_workspace');
$f_kanbanery_project_id = gpc_get_string( 'kanbanery_project_id');
$f_kanbanery_task_type  = gpc_get_string( 'kanbanery_task_type');

if( plugin_config_get( 'kanbanery_api_key' ) != $f_kanbanery_api_key ) {
	plugin_config_set( 'kanbanery_api_key', $f_kanbanery_api_key );
}

if( plugin_config_get( 'kanbanery_workspace' ) != $f_kanbanery_workspace ) {
  plugin_config_set( 'kanbanery_workspace', $f_kanbanery_workspace );
}

if( plugin_config_get( 'kanbanery_project_id' ) != $f_kanbanery_project_id ) {
	plugin_config_set( 'kanbanery_project_id', $f_kanbanery_project_id );
}

if( plugin_config_get( 'kanbanery_task_type' ) != $f_kanbanery_task_type ) {
	plugin_config_set( 'kanbanery_task_type', $f_kanbanery_task_type );
}

form_security_purge( 'plugin_format_config_edit' );

print_successful_redirect( plugin_page( 'config', true ) );
