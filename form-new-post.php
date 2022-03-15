<?php

    require_once 'common-top.php';

?>

<form class="card" method="POST" action="process-new-post.php">
    <h2>Create a New Post</h2>

    <input name="parent" type="hidden" value="null">
    
    <label>Title</label>
    <input name="title" type="text" required>

    <label>Body</label>
    <textarea name="body"></textarea>

    <div class="controls">
        <input type="submit" value="Post">
    </div>
</form>


<?php

    require_once 'common-bottom.php';

?>

