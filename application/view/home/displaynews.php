<?php

include_once '../application/authentication/Auth.php';
include_once '../application/libs/Parsedown.php';
$mysqli = new mysqli("localhost", "root", "", "news");

if (Auth::check_login($mysqli) == true) {
    $login = true;
} else {
    $login = false;
}

?>

<?php
    $Parsedown = new Parsedown();
    $article->entry = $Parsedown->text($article->entry);
    $html = '
    <div class="container a-'.$article->id.'">
        <h2>'.$article->title.'</h2>
        <div class="article-meta">
            <time>'.$article->date.'</time>
        </div>
        <div class="box">
            <p>'.$article->entry.'</p>
        </div>
        <div class="read-more">
            <a href="home/viewnews/'.$article->id.'">Read more</a>
        </div>
    ';
    $html .= '
    <div class="delete">
        <button class="a-'.$article->id.'" onClick="callDelete('.$article->id.')">Delete</button>
    </div>
    ';
    $html .= '
    </div>
    ';
    echo $html;
?>