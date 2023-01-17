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

    public function getUserByLogin($login) {
        $sql = "SELECT * FROM `users` WHERE `users`.`login` = ?";

        return $this->query($sql, array($login));
    }

    public function insertUser($login, $password) {
        $sql = "INSERT INTO `users` (`login`, `password`) VALUES (?, ?)";

        return $this->query($sql, array($login, $password));
    }

    public function getTasks($login) {
        $sql = "SELECT `tasks`.`id`, `tasks`.`description`, `tasks`.`status` FROM `tasks` WHERE `tasks`.`users_id` = (SELECT `users`.`id` FROM `users` WHERE `users`.`login` = ?)";

        return $this->query($sql, array($login));
    }

    public function addTask($usersId, $description) {
        $sql = "INSERT INTO `tasks` (`users_id`, `description`) VALUES (?, ?)";

        return $this->query($sql, array($usersId, $description));
    }

    public function changeTaskStatus($usersId, $taskId) {
        $sql = "UPDATE `tasks` SET `tasks`.`status` = `tasks`.`status` ^ 1 WHERE `tasks`.`users_id` = ? AND `tasks`.`id` = ?";

        return $this->query($sql, array($usersId, $taskId));
    }

    public function removeTask($usersId, $taskId) {
        $sql = "DELETE FROM `tasks` WHERE `tasks`.`users_id` = ? AND `tasks`.`id` = ?";

        return $this->query($sql, array($usersId, $taskId));
    }

    public function removeAllTasks($usersId) {
        $sql = "DELETE FROM `tasks` WHERE `tasks`.`users_id` = ?";

        return $this->query($sql, array($usersId));
    }

    public function readyAllTasks($usersId) {
        $sql = "UPDATE `tasks` SET `tasks`.`status` = 1 WHERE `tasks`.`users_id` = ? AND `tasks`.`status` = 0";

        return $this->query($sql, array($usersId));
    }

    private function query($sql, $params) {
        $stmt = self::$connection->prepare($sql);

        $stmt->execute($params);
        $result = array();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            array_push($result, $row);
        }

        return $result;
    }
}