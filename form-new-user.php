<?php

    require_once 'common-top.php';

?>

<section>
    <form method="POST" action="process-new-user.php">

        <header>
            <h2>Create a New Account</h2>
        </header>

        <label>Forename</label>
        <input name="forename" type="text" required>

        <label>Surname</label>
        <input name="surname" type="text" required>

        <label>Username</label>
        <input name="username" type="text" required>

        <label>Password</label>
        <input name="password" type="password" required>

        <input type="submit" value="Create Account">

        <footer>
            Already have an account? <a href="form-login.php">Login here</a>
        </footer>
    </form>
</section>

<?php

    require_once 'common-bottom.php';

?>