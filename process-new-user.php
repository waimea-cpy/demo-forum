<?php

    require_once 'common-top.php';

    echo '<h2>Creating New User Account...</h2>';

    // Get submitted data
    $username = $_POST['username'];
    $forename = $_POST['forename'];
    $surname  = $_POST['surname'];
    $password = $_POST['password'];

    // Hash & salt the password using current hashing standard
    $hash = password_hash( $password, PASSWORD_DEFAULT );

    echo '<p>Hashed Password: '.$hash;

    // Check if the user already exists in the DB
    $sql = 'SELECT * 
            FROM users 
            WHERE username=?';

    $users = getRecords( $sql, 's', $username );

    if( count( $users ) > 0 ) showErrorAndDie( 'Username exists. Login instead' );

    // Add new user to the DB
    $sql = 'INSERT INTO users (username, forename, surname, hash) 
            VALUES (?, ?, ?, ?)';

    modifyRecords( $sql, 'ssss', [$username, $forename, $surname, $hash] );

    // Inform the user of success and head back to home page
    showStatus( 'New user account created successfully', 'success' );

    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>
    