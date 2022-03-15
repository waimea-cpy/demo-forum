<?php

    require_once 'common-top.php';

?>

<form class="card" method="POST" action="process-new-user.php">

    <h2>Create a New Account</h2>

    <label>Forename</label>
    <input name="forename" type="text" required>

    <label>Surname</label>
    <input name="surname" type="text" required>

    <label>Username</label>
    <input name="username" type="text" required>

    <label>Password</label>
    <input name="password" type="password" required>

    <div class="controls">
        <input type="submit" value="Create Account">
    </div>

</form>

<p>Already have an account? Login <a href="form-login.php">here</a></p>


<?php

    require_once 'common-bottom.php';

?>