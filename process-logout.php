<?php

    require_once 'common-session.php';

    session_destroy();

    header( 'Location: index.php' );
    
?>