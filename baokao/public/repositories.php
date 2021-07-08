<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<link href="../static/repositories.css" rel="stylesheet" />
<script>
    document.getElementById("nav-repositories").setAttribute("aria-current", "page")
</script>
<title>Repositories | baokao</title>
<div class="content">
    <h1>Repositories</h1>
    <br>
    <div class="repositories-flexbox">
        <?php

        require '../../vendor/autoload.php';

        $dsn = "sqlite:../db/repositories.db";
        $sqlite_db = new PDO($dsn);
        $result = $sqlite_db->query("SELECT * FROM repositories");

        foreach ($result as $row) {
            /* strip_tags() just in case ;) */
            $name = strip_tags($row['name']);
            $info = strip_tags($row['info']);
            $colour = strip_tags($row['colour']);
            $image = strip_tags($row['image']);
            echo <<<HTML
            <div class="repositories-flexbox">
                <div class="Box Box--spacious f4 repositories-unit-container hover-grow">
                    <div class="Box-header image-header">
                        <style>
                            .image-header {
                                background-color: $colour;
                                background-image: url($image);
                            }
                        </style>
                    </div>
                    <div class="Box-row">
                        <h3 class="Box-title Truncate-text">
                        $name
                        </h3>
                        <p class="Truncate-text--primary repositories-info">
                        $info
                        </p>
                    </div>
                </div>
            </div>
            HTML;
        }

        ?>
    </div>
</div>
<?php include "../include/footer.php"; ?>