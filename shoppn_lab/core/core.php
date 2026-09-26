<?php 

if(session_status() === PHP_SESSION_NONE)
    {
        session_start(); // will Start session if session not started already
    }

    date_default_timezone_set('UTC');

    require_once __DIR__ . '/db_class.php'; //Include the database class file

    function get_ip()
    {
        if(!empty($_SERVER['HTTP_CLIENT_IP']))
            {
                return $_SERVER['HTTP_CLIENT_IP'];
            } else if(!empty($_SERVER['HTTP_X_FORWARDED_FOR']))
            {
                $ip_list = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
                return trim($ip_list[0]);
            } elseif (!empty($_SERVER['REMOTE_ADDR'])){
                return $_SERVER['REMOTE_ADDR'];
            }
            return 'UNKNOWN';
    }
    
    function redirect($url)
    {
        header("Location:" . $url);
        exit(); 
    }

    function is_logged_in()
    {
        return isset($_SESSION['user_id']);
    }

    function is_admin()
    {
        return isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true;
    }   

    function require_login()
    {
        if (!is_logged_in()) {
            redirect('login.php');
        }
    }

    function require_admin()
    {
        if (!is_admin()) {
            $_SESSION['error'] = 'You do not have permission to access this page.';
            redirect('index.php');
        }
    }
    