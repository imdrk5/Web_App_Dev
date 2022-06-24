<?php
	
    include('./database_connection.php');

    $sql = "UPDATE users SET perms=" . $_GET["value"] . " WHERE id=" . $_GET["id"];
    $result = $conn->query($sql);

	header("Location: ../../backoffice/table/?sub=Users");