<?php

    require_once 'common-top.php';

    // Get the top-level posts (parent is NULL)

    // The funky query-within-a-query looks up all posts that have 
    // a parent id equal to id of the top-level post (using 'parentID' alias)
    // and then the COUNT(...) function counst the records. This count is
    // given the alias 'replies' and it is used below to show the reply count
    $sql = 'SELECT posts.id AS parentID,
                   posts.title,
                   posts.body,
                   posts.timestamp,
                   users.username,
                   users.forename,
                   users.surname,
                   (
                       SELECT COUNT(*) 
                       FROM posts 
                       WHERE parent = parentID
                   ) AS replies

            FROM posts
            JOIN users ON posts.user = users.id 

            WHERE parent IS NULL

            ORDER BY timestamp DESC';

    $posts = getRecords( $sql );

    echo '<section id="post-list" class="summary">';

    // Loop thru all top-level posts
    foreach( $posts as $post ) {

        $date = new DateTime( $post['timestamp'] );
        $niceDate = $date->format( 'h:ia, j M Y' );

?>

    <a href="show-post.php?id=<?= $post['parentID'] ?>">
      <article class="post card parent">

        <h3><?= $post['title'] ?></h3>

        <div class="info">
            <span class="user">
                <?= $post['forename'] ?> 
                <?= $post['surname'] ?>
                (<?= $post['username'] ?>)
            </span>
            
            <span class="date"><?= $niceDate ?></span>

            <span class="count">Replies: <?= $post['replies'] ?></count>
        </div>

      </article>
    </a>

<?php
    }

    echo '</section>';

    require_once 'common-bottom.php';

?>

