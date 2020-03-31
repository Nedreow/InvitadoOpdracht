<?php


class DatabaseConfig
{
    private static string $serverName = "server name";
    private static string $userName = "user name";
    private static string $serverPass = "server password";

    public static function getConnection(): PDO
    {
        $serverName = self::$serverName;
        $userName = self::$userName;
        $serverPass = self::$serverPass;

        try {
            $conn = new PDO("mysql:host=$serverName;dbname=myDB", $userName, $serverPass);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        catch(PDOException $e)
        {
            echo "Connection failed: " . $e->getMessage();
        }

        return $conn;
    }
}