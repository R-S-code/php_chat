<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>chat</title>
    <link rel="stylesheet" href="./main.css">
</head>

<?php
    //db_function読み込み
    include("./db_function.php");
    //接続
    try {
        connectDB();
        $msg = "db access succeeded";
    } catch (PDOException $e) {
        $msg = "db access failed";
    }
?>

<body>
    <p> <?php echo $msg; ?> </p>
    <hr>

    <form method="post" action="./chat.php">
        <p classs="name"> name </p> <input type="text" name="name" maxlength="10" placeholder="10char"> 
        <p> message </p> <input type="text" name="message" maxlength="40" placeholder="40char"> <br>
        <button name="send" type="submit" class="send">send</button>
    </form>

    <?php
    //チャット表示
    if(isset($_POST["send"])) {  
        insert();
        $stmt = select();

        foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $message) {
            echo 
                "<p> ["
                . $message["name"] 
                . "]" 
                . $message["message"]
                . " @ " 
                . $message["time"] 
                . "<form action='./chat.php' method='post'> <input type='hidden' name='id' value="
                . $message["id"] 
                . "> 
                    <input type='submit' name='delete' value='delete'>
                    </form> </p> <hr>";
        }
    }
        
    //削除時
    else if(isset($_POST["delete"])) {
        delete();
        $stmt = select();
        foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $message) {
            echo 
                "<p> ["
                . $message["name"] 
                . "] <br>" 
                . $message["message"]
                . "@" 
                . $message["time"] 
                . "<form action='./chat.php' method='post'> <input type='hidden' name='id' value="
                . $message["id"] 
                . "> 
                    <input type='submit' name='delete' value='delete'>
                    </form> </p> <hr>";
        }
    }

    else {
        //データベースからチャットの一覧表時
        $stmt = select(); 
        foreach ($stmt->fetchall(PDO::FETCH_ASSOC) as $message) {
            echo 
                "<p> ["
                . $message["name"] 
                . "] <br>" 
                . $message["message"]
                . "@" 
                . $message["time"] 
                . "<form action='chat.php' method='post'> <input type='hidden' name='id' value="
                . $message["id"] 
                . "> 
                    <input type='submit' name='delete' value='delete'>
                    </form> </p> <hr>";
        }
    }
    ?>
<body>
