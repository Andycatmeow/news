<?php
/**
 * Class Error
 */
class Problem extends Controller {
    /**
     * index
     */
    public function index() {
        require APP . 'view/_templates/header.php';
        require APP . 'view/problem/index.php';
        require APP . 'view/_templates/footer.php';
    }
}
