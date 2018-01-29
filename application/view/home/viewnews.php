<?PHP
include_once '../application/authentication/Auth.php';
include_once '../application/libs/Parsedown.php';

$mysqli = new mysqli("localhost", "root", "", "news");

if (Auth::check_login($mysqli) == true) { $login = true; } else { $login = false; }

?>

<?php
    $Parsedown = new Parsedown();
    $article->entry = $Parsedown->text($article->entry);
    $html = '
    <div class="container">
        <h2>'.$article->title.'</h2>
        <div class="article-meta">
            <time>'.$article->date.'</time>
        </div>
        <div class="box">
            <p>'.$article->entry.'</p>
        </div>
    ';
    if ($login) {
        $html .= '
        <div class="delete">
            <a href="'.URL.'home/deletenews/'.$article->id.'">Delete</a>
        </div>
        ';
    }
    $html .= '
    </div>
    ';
    echo $html;
?>