<?php

    require_once 'common-top.php';

    echo '<div class="card">';
    echo '<h2>Creating New User Account...</h2>';

    // Check that all data fields exist
    if( !isset( $_POST['username'] ) || empty( $_POST['username'] ) ) showErrorAndDie( 'Missing Username' );
    if( !isset( $_POST['forename'] ) || empty( $_POST['forename'] ) ) showErrorAndDie( 'Missing Forename' );
    if( !isset( $_POST['surname'] )  || empty( $_POST['surname'] ) )  showErrorAndDie( 'Missing Surname' );
    if( !isset( $_POST['password'] ) || empty( $_POST['password'] ) ) showErrorAndDie( 'Missing Password' );

    // If we get here, we have all the data
    $username = $_POST['username'];
    $forename = $_POST['forename'];
    $surname  = $_POST['surname'];
    $password = $_POST['password'];

    // Hash & salt the password using current hashing standard
    $hash = password_hash( $password, PASSWORD_DEFAULT );

    // Check if the user already exists in the DB
    $sql = 'SELECT * FROM users WHERE username=?';
    $users = getRecords( $sql, 's', [$username] );
    if( count( $users ) > 0 ) showErrorAndDie( 'Username already exists. Please login instead' );

    // Add new user to the DB
    $sql = 'INSERT INTO users (username, forename, surname, hash) VALUES (?, ?, ?, ?)';
    modifyRecords( $sql, 'ssss', [$username, $forename, $surname, $hash] );

    // Inform the user of success and head back to home page
    showStatus( 'New user account created successfully' );
    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>
    