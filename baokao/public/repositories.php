<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<link href="static/repositories.css" rel="stylesheet" />
<script>
    document.getElementById("nav-repositories").setAttribute("aria-current", "page")
</script>
<title>Repositories | baokao</title>
<div class="content">
    <h1>Repositories</h1>
    <br>
    <div class="repositories-flexbox">
        <?php

        $dsn = "sqlite:../db/repositories.db";
        $sqlite_db = new PDO($dsn);
        $result = $sqlite_db->query("SELECT * FROM repositories");

        try {
            foreach ($result as $row) {
                /* strip_tags() just in case ;) */
                $name = strip_tags($row['name']);
                $info = strip_tags($row['info']);
                $slug = strip_tags($row['slug']);
                $colour = strip_tags($row['colour']);
                $image = strip_tags($row['image']);
                echo <<<HTML
                <div class="repositories-flexbox">
                    <div onclick="location.href = 'tree?$slug'" class="Box--spacious border-none rounded-1 f4 repositories-unit-container color-shadow-medium hover-grow">
                        <div class="rounded-1 image-header image-header-$slug">
                            <style>
                                .image-header-$slug {
                                    background-color: $colour;
                                    background-image: url($image);
                                }
                            </style>
                        </div>
                        <div class="Box-row">
                            <span class="Truncate">
                            <h3 class="Box-title Truncate-text--primary">
                            $name
                            </h3>
                            </span>
                            <span class="repositories-info">
                            <p class="repositories-info-text">$info</p>
                            </span>
                        </div>
                    </div>
                </div>
HTML;
            }
        } 
        catch (Exception $error) {
            echo <<<HTML
                <div class="flash mt-3 flash-error">
                    <svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M2.343 13.657A8 8 0 1113.657 2.343 8 8 0 012.343 13.657zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z"></path></svg>      
                    <strong>Something went wrong :(</strong> - please report this error to <strong>baokao@adrian.id.au</strong><br><br>
                    <strong>Exception thrown: </strong><br><pre>$error</pre>
                    </div>
HTML;
        }

        ?>
    </div>
</div>
<?php include "../include/footer.php"; ?>