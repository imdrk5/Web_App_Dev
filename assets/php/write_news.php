<?php  

    session_start();

    include('./database_connection.php');

    $countSubtitle = count($_POST["subtitle"]);
    $countText = count($_POST["text"]);

    $sql = "INSERT INTO news (author, title, image) VALUES(" . $_SESSION['userID'] . ", '" . $_POST["title"] . "', '" . "news1.jpg" . "')";
    $result = $conn->query($sql);
    $news_id = $conn->insert_id;
    
    $sql = "INSERT INTO sections (news_id, subtitle, text) VALUES";
    $i = 0;
    do {
        $sql = $sql . "(" . $news_id . ", '" . $_POST["subtitle"][$i] . "', '" . $_POST["text"][$i] . "')";
        $i++;
        if($i != $countSubtitle) {
            $sql = $sql . ",";
        }
    }while($i < $countSubtitle);
    $result = $conn->query($sql);