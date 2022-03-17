<?php

    require_once 'common-top.php';

    echo '<div class="card">';
    echo '<h2>Posting...</h2>';

    // Check that all data fields exist
    if( !isset( $_POST['title'] )  || empty( $_POST['title'] ) )  showErrorAndDie( 'Missing Title' );
    if( !isset( $_POST['parent'] ) || empty( $_POST['parent'] ) ) showErrorAndDie( 'Missing Parent' );
    if( !isset( $_POST['body'] )   || empty( $_POST['body'] ) )   showErrorAndDie( 'Missing Body' );

    // Check for top-level post, and make sure parent is actually null, not a string!
    if( $_POST['parent'] == 'null' ) $_POST['parent'] = null;

    // Check for a reply, and make sure title is actually null, not a string!
    if( $_POST['title'] == 'null' ) $_POST['title'] = null;

    // Setup query
    $sql = 'INSERT INTO posts (title, body, parent, user)
            VALUES (?, ?, ?, ?)';
    $types = 'ssii';
    $data = [
        $_POST['title'], 
        $_POST['body'],
        $_POST['parent'],
        $_SESSION['userID']
    ];

    // Send data to server
    modifyRecords( $sql, $types, $data );

    // If we get here, all went well!
    showStatus( 'Success!' );
    echo '</div>';

    // Head back to the home page
    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>    