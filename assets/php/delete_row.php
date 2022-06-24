<?php
	
    include('./database_connection.php');

    $sql = "DELETE FROM " . $_GET["table"] . " WHERE id = " . $_GET["id"];
    $result = $conn->query($sql);

	header("Location: ../../backoffice/table/?sub=" . $_GET["table"]);