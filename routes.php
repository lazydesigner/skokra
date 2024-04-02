<?php
function isLocalhost()
{
    // Define an array of common localhost hostnames or IP addresses
    $localhosts = array('localhost', '127.0.0.1');

    // Get the server's hostname
    $serverHostname = $_SERVER['SERVER_NAME'];

    // Check if the server's hostname is in the array of localhost values
    return in_array($serverHostname, $localhosts);
}

// Example of how to use the function
if (isLocalhost()) {
    function get_url()
    {

        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';

        $domain = $_SERVER['HTTP_HOST'];

        $subdirectory = dirname($_SERVER['PHP_SELF']);
        if ($subdirectory) {
            $baseUrl = $protocol . $domain . $subdirectory;

            $a = explode('/', $baseUrl);
            $url = $a[0] . '/' . $a[1] . '/' . $a[2] . '/' . $a[3];
            // echo $url;
            // $baseUrl = $protocol . $domain . $subdirectory;
            return $url . '/';
        } else {
            $baseUrl = $protocol . $domain;

            $a = explode('/', $baseUrl);
            $url = $a[0] . '/' . $a[1] . '/' . $a[2] . '/' . $a[3];
            // $baseUrl = $protocol . $domain . $subdirectory;
            return $url . '/';
        }
    }
} else {
    function get_url()
    {
        $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
        $host = $_SERVER['HTTP_HOST'];

        // Remove subdirectories from the base path
        $basePath = '/';
        $requestUri = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : '';
        $basePathPosition = strpos($requestUri, $basePath);
        if ($basePathPosition !== false) {
            $basePath = substr($requestUri, 0, $basePathPosition + strlen($basePath));
        }

        $url = $protocol . $host . $basePath;

        return $url;
    }
}
// Set session variable for last activity
// echo $_SESSION['last_activity'].'<br>';

// Set timeout period in seconds (e.g., 5 minutes)
$timeout = 600; // 5 minutes

// Check if the user is logged in and last activity time is set
if(!isset($login_page)){
    if (isset($_SESSION['last_activity'])) {
        if (isset($_SESSION['url'])) {
            unset($_SESSION['url']);
        }
        // Calculate time difference
        $elapsed_time = time() - $_SESSION['last_activity'];
        // If elapsed time is greater than timeout, log the user out
        if ($elapsed_time > $timeout) {
            session_unset();
            session_destroy();
            // LOGOUT CODE
            $url = $_SERVER['REQUEST_URI'];
            $path = parse_url($url, PHP_URL_PATH);  
    
            if (isLocalhost()) {
                $domainToRemove = "/skokra.com/";
                $newUrl = str_replace($domainToRemove, "", $path);
    
                if (!isset($_SESSION["email"])) {
                    header("Location: " . get_url() . "login?next=" . $newUrl . "");  // If not logged in, redirect
                }
            } else {
                if (!isset($_SESSION["email"])) {
                    header("Location: " . get_url() . "login?next=" . $path . "");  // If not logged in, redirect
                }
            }
            // LOGOUT CODE
        } else {
            $_SESSION['last_activity'] = time();
            $stopthefurtherprocess = true; 
        }
    } else {
        $url = $_SERVER['REQUEST_URI'];
        $path = parse_url($url, PHP_URL_PATH);
    
        if (isLocalhost()) {
            $domainToRemove = "/skokra.com/";
            $newUrl = str_replace($domainToRemove, "", $path);
    
            if (!isset($_SESSION["email"])) {
                header("Location: " . get_url() . "login?next=" . $newUrl . "");
                $stopthefurtherprocess = false;  // If not logged in, redirect
            }
        } else {
            if (!isset($_SESSION["email"])) {
                header("Location: " . get_url() . "login?next=" . $path . "");  // If not logged in, redirect
            }
        }
    }
}
