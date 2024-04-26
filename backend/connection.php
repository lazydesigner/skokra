<?php

class DatabaseConnection
{
    private $con;

    public function __construct()
    {
        // session_start();
        $this->establishConnection();
    }

    public static function generateCsrfToken()
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32)); // Generate a random token
        }

        return $_SESSION['csrf_token'];
    }

    private function localConnection()
    {
        // Define an array of common localhost hostnames or IP addresses
        $localhosts = array('localhost', '127.0.0.1');

        // Get the server's hostname
        $serverHostname = $_SERVER['SERVER_NAME'];

        // Check if the server's hostname is in the array of localhost values
        return in_array($serverHostname, $localhosts);
    }

    private function establishConnection()
    {
        if ($this->localConnection()) {
            try {
                $this->con = new PDO("mysql:host=localhost;dbname=skokra", 'root', '');
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        } else {
            try {
                $this->con = new PDO("mysql:host=localhost;dbname=u231955561_in_skokra", 'u231955561_inskokra', 'Skokra@12com');
                $this->con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $this->con->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }

    public function getConnection()
    {
        return $this->con;
    }
}


// Example usage:
// Now $con holds the PDO connection object for further use.
