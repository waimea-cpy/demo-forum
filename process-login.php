<?php

    require_once 'common-top.php';

    echo '<div class="card">';
    echo '<h2>Logging You In...</h2>';

    // Clear out any previous login details
    session_unset();

    // Check that all data fields exist
    if( !isset( $_POST['username'] ) || empty( $_POST['username'] ) ) showErrorAndDie( 'Missing Username' );
    if( !isset( $_POST['password'] ) || empty( $_POST['password'] ) ) showErrorAndDie( 'Missing Password' );

    // If we get here, we have all the data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Get the user info from the DB
    $sql = 'SELECT * FROM users WHERE username=?';
    $users = getRecords( $sql, 's', [$username] );

    // If no user with that username, they need to make an account
    if( count( $users ) == 0 ) showErrorAndDie( 'No account with that username exists' );

    // User exists, so get their record
    $user = $users[0];

    // Check the hashed password against stored hash
    if( !password_verify( $password, $user['hash'] ) ) showErrorAndDie( 'Incorrect password' );

    // Password is correct, so store user details in the session
    $_SESSION['loggedIn'] = true;
    $_SESSION['userID']   = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['forename'] = $user['forename'];
    $_SESSION['surname']  = $user['surname'];

    // Say hello, and head back to home page
    showStatus( 'Welcome, '.$user['forename'] );
    addRedirect( 2000, 'index.php' );

    require_once 'common-bottom.php';
?>
    