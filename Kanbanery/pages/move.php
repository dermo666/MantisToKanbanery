<?php

form_security_validate( 'move_to_kanbanery' );

auth_reauthenticate( );

  

header('Location: view.php?id='.$bug_id);