<?PHP

class Auth {

    public static function security_session_start() {
        $session_name = 'security_session_id';
        $secure = false;
        $httponly = true;
        
        $cookieParams = session_get_cookie_params();
        session_set_cookie_params($cookieParams["lifetime"], $cookieParams["path"], $cookieParams["domain"], $secure, $httponly);
        session_name($session_name);
        session_start();
        session_regenerate_id();
    }

    public static function login($email, $password, $mysqli) {
        $now = time();
        $query = "SELECT id, username, password FROM members WHERE email = ? LIMIT 1";
        if ($stmt = $mysqli->prepare($query)) {
            $stmt->bind_param('s', $email);
            $stmt->execute();
            $stmt->store_result();

            $stmt->bind_result($user_id, $username, $data_password);
            $stmt->fetch();
    
            if ($stmt->num_rows == 1) {
                if (password_verify($password, $data_password)) {

                    $user_browser = $_SERVER['HTTP_USER_AGENT'];
                    $user_id = preg_replace("/[^0-9]+/", "", $user_id);
                    $_SESSION['user_id'] = $user_id;
                    $username = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $username);
                    $_SESSION['username'] = $username;
                    $_SESSION['login_string'] = hash('sha512', $data_password . $user_browser);
                    
                    return true;

                } else {
                    return false;
                }
            } else {
                return false;
            }
        }
    }

    public static function check_login($mysqli) {
        if (isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'])) {
    
            $user_id = $_SESSION['user_id'];
            $login_string = $_SESSION['login_string'];
            $username = $_SESSION['username'];
            $user_browser = $_SERVER['HTTP_USER_AGENT'];
    
            $query = "SELECT password FROM members WHERE id = ? LIMIT 1";
            
            if ($stmt = $mysqli->prepare($query)) {
                $stmt->bind_param('i', $user_id);
                $stmt->execute();
                $stmt->store_result();
    
                if ($stmt->num_rows == 1) {
                    $stmt->bind_result($password);
                    $stmt->fetch();
                    $check_login = hash('sha512', $password . $user_browser);
    
                    if (hash_equals($check_login, $login_string) ){
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
}

?>