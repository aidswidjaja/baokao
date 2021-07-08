<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<title>Debug | baokao</title>
<div class="content">
    <h1>Debug</h1>
    <br>
    <div class="flash">
        This page is used by the baokao developers to test out this website. If you found this page by accident, click <a href="index">here</a> to go back!
    </div>
    <br>

    <?php

    require '../../vendor/autoload.php';

    $dsn = "sqlite:../db/development.db";
    $sqlite_db = new PDO($dsn);
    $result = $sqlite_db->query("SELECT * FROM repositories");

    foreach ($result as $row) {
        echo "Name = " . $row['name'] . "<br>";
        echo "Info = " . $row['info'] . "<br>";
        echo "Google Drive Link = " . $row['google_drive_folder_link'] . "<br>";
        echo "OAuth2 =  " . $row['oauth2'] . "<br><br>";
    }
    ?>
    <br>
    <p>No PHP fatal errors - Hinata is my senpai</p>

</div>

<?php include "../include/footer.php"; ?>