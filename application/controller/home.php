<?php

class Home extends Controller {
    /**
     * index (show all news)
     */
    public function index() {
        $news = $this->model->getAllNews();
        $amount_of_news = $this->model->getAmountOfNews();

        require APP . 'view/_templates/header.php';
        require APP . 'view/home/index.php';
        require APP . 'view/_templates/footer.php';
    }
    
    /**
     * add article
     */
    public function addNews() {
        if (isset($_POST["title"]) && isset($_POST["entry"])) {
            $inserted_id = $this->model->addNews(
                $_POST["title"],
                $_POST["entry"]
            );
        }

        $article = $this->model->viewNews($inserted_id);
        require APP . 'view/home/displaynews.php';
    }
    
    /**
     * delete article
     */
    public function deleteNews($news_id) {
        include_once '../application/authentication/Auth.php';

        Auth::security_session_start();
        if (Auth::check_login($this->myDb) == true) {
            $this->model->deleteNews($news_id);
                header('location: ' . URL . '');
        } else {
            echo "404 error";
        }
    }
    
    /**
     * view article
     */
    public function viewNews($news_id) {

        $article = $this->model->viewNews($news_id);

        require APP . 'view/_templates/header.php';
        require APP . 'view/home/viewnews.php';
        require APP . 'view/_templates/footer.php';
    }

}
