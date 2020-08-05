<?php
    //DB接続
    function connectDB() {
        $db = new PDO("mysql:host=localhost;dbname=dbname", "username", "password");
        return $db;
    }

    //チャット登録
    function insert() {
        $db = connectDB();
        $sql = "insert into chat (name, message, time) values (:name, :message, now())";
        $stmt = $db->prepare($sql);
        $params = array(":name" => $_POST["name"], ":message" => $_POST["message"]);
        $stmt->execute($params);
        return $stmt;
    }

    //チャット取得
    function select() {
        $db = connectDB();
        $sql = "select * from chat order by time";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt;
    } 

    //チャット削除
    function delete() {
        $db = connectDB();
        $sql = "delete from chat where id = :id";
        $stmt = $db->prepare($sql);
        $params = array(":id" => $_POST["id"]);
        $stmt->execute($params);
        return $stmt;
    }
?>