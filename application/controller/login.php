<?php

include_once APP.'authentication/Auth.php';

class Login extends Controller {
    /**
     * Index
     */
    public function index() {

        Auth::security_session_start();

        if (Auth::check_login($this->myDb) == true) {
            $logged = 'in';
        } else {
            $logged = 'out';
        }

        require APP . 'view/login/index.php';
    }

    /**
     * login
     */
    public function loginProcess() {
         
        Auth::security_session_start();
         
        if (isset($_POST['email'], $_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
         
            if (Auth::login($email, $password, $this->myDb) == true) {
                header('location: ' . URL . '');
            } else {
                echo "Login failed <br>";
            }
        } else {
            echo 'Invalid Request';
        }
    }

    /**
     * logout
     */
    public function logout() {
        Auth::security_session_start();
        
        $_SESSION = array();
        
        $params = session_get_cookie_params();
         
        setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
         
        session_destroy();

        header('location: ' . URL . '');
    }
}

?>