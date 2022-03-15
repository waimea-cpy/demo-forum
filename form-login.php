<?php

    require_once 'common-top.php';

?>

<form class="card" method="POST" action="process-login.php">

    <h2>Login</h2>

    <label>Username</label>
    <input name="username" type="text" required>

    <label>Password</label>
    <input name="password" type="password" required>

    <div class="controls">
        <input type="submit" value="Login">
    </div>

</form>

<p>Don't have an account? Create one <a href="form-new-user.php">here</a></p>

<?php

    require_once 'common-bottom.php';

?>