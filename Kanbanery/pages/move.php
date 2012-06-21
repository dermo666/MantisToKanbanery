<?php

form_security_validate( 'move_to_kanbanery' );

auth_reauthenticate( );

// TODO: move to kanbanery or display error.

header('Location: view.php?id='.$bug_id);