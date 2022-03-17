<?php

    require_once 'common-top.php';

    // Get the top-level posts (parent is NULL)
    $sql = 'SELECT posts.id,
                   posts.title,
                   posts.body,
                   posts.timestamp,
                   users.username,
                   users.forename,
                   users.surname 

            FROM posts
            JOIN users ON posts.user = users.id 

            WHERE parent IS NULL

            ORDER BY timestamp DESC';

    $posts = getRecords( $sql );

    echo '<section id="post-list">';

    // Loop thriugh the top-level posts
    foreach( $posts as $post ) {

        $date = new DateTime( $post['timestamp'] );
        $niceDate = $date->format( 'h:ia, j M Y' );

?>

    <article class="post card parent">

        <div class="info">
            <span class="user">
                <?= $post['forename'] ?> 
                <?= $post['surname'] ?>
                (<?= $post['username'] ?>)
            </span>
            
            <span class="date"><?= $niceDate ?></span>
        </div>

        <h3><?= $post['title'] ?></h3>

        <div class="body">
            <?= nl2br( $post['body'] ) ?>
        </div>

<?php

        // Get the replies (parent is same as the parent post)
        $sql = 'SELECT posts.id,
                       posts.title,
                       posts.body,
                       posts.timestamp,
                       users.username,
                       users.forename,
                       users.surname 

                FROM posts
                JOIN users ON posts.user = users.id 

                WHERE parent=?

                ORDER BY timestamp ASC';

        $replies = getRecords( $sql, 'i', [$post['id']] );

        echo '<ol class="replies">';

        // Loop through the replies
        foreach( $replies as $reply ) {

            $date = new DateTime( $reply['timestamp'] );
            $niceDate = $date->format( 'h:ia, j M Y' );

?>
            <li class="reply">
                <div class="info">
                    <span class="user">
                        <?= $reply['forename'] ?> 
                        <?= $reply['surname'] ?>
                        (<?= $reply['username'] ?>)
                    </span>
                    
                    <span class="date"><?= $niceDate ?></span>
                </div>
                <div class="body">
                    <?= nl2br( $reply['body'] ) ?>
                </div>
            </li>
<?php
        }

        echo '</ol>';

        // Show a reply form if user is logged in
        if( $loggedIn ) {
?>
            <form method="POST" action="process-new-post.php" class="inline">
                <img src="images/new.svg" alt="speech bubble">

                <input name="parent" type="hidden" value="<?= $post['id'] ?>">
                <input name="title" type="hidden" value="null" >
                
                <textarea name="body" placeholder="Your reply..."></textarea>
                
                <input type="submit" value="Reply">
            </form>
<?php
        }

        echo '</article>';

    }

    echo '</section>';

    require_once 'common-bottom.php';

?>

