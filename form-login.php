<?php

    require_once 'common-top.php';

?>

<section>
    <form class="card" method="POST" action="process-login.php">

        <header>
            <h2>Login</h2>
        </header>

        <label>Username</label>
        <input name="username" type="text" required>

        <label>Password</label>
        <input name="password" type="password" required>

        <div class="controls">
            <input type="submit" value="Login">
        </div>

        <footer>
            <p>Don't have an account? <a href="form-new-user.php">Create one here</a></p>
        </footer>
    </form>
</section>

<?php

    require_once 'common-bottom.php';

?>