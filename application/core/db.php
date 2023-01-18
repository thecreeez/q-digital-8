<?php

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_NAME', 'tasklist_mvc');
define('DB_TABLE_VERSIONS', 'versions');

class Database {
    private static $connection = null;

    function __construct() {
        if (self::$connection != null) {
            throw new Exception('Создание второго подключения к базе данных.');
            exit();
        }

        self::$connection = new PDO(sprintf("mysql:host=%s;dbname=%s", DB_HOST, DB_NAME), DB_USER, DB_PASSWORD);
        if (!self::$connection) {
            throw new Exception('Не удалось подключиться к серверу базы данных.');
            exit();
        }
    }   
    
    public function query($sql, $params) {
        $stmt = self::$connection->prepare($sql);

        $stmt->execute($params);
        $result = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($result, $row);
        }

        return $result;
    }
}