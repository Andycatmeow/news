<?PHP
include_once '../application/authentication/Auth.php';
include_once '../application/libs/Parsedown.php';

?>

<?PHP if (Auth::check_login($this->myDb) == true) { $login = true; ?>
<div class="write">
    <div class="box">
        <h3>Write news</h3>
        <form id="submit-article-form" action="javascript:void(null);" onsubmit="callAdd()" method="POST">
            <label>Title *</label>
            <input type="text" name="title" value="" required />
            <label>Entry *</label>
            <textarea name="entry" value="" placeholder="What do you have to say?" required></textarea>

            <input type="submit" name="submit_add_news" value="Submit" />
        </form>
    </div>
</div>
<?PHP } else { $login = false; } ?>

<div id="result"></div>

<?php
    $Parsedown = new Parsedown();
    foreach ($news as $article) {
        //<h2>'.$article->title.'</h2>
        $article->entry = $Parsedown->text($article->entry);
        $html = '
        <div class="container a-'.$article->id.'">
            <div class="article-title">
                <a href="home/viewnews/'.$article->id.'"><h2>'.$article->title.'</h2></a>
            </div>
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
        if ($login) {
            $html .= '
            <div class="delete">
                <button class="a-'.$article->id.'" onClick="callDelete('.$article->id.')">Delete</button>
            </div>
            ';
        }
        $html .= '
        </div>
        ';
        echo $html;
    }

?>