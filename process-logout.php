<?php

    require_once 'common-top.php';

    session_destroy();

    header( 'Location: index.php' );
    
?>