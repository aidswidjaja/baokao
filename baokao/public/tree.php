<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<div class="content">
    <?php

    require '../../vendor/autoload.php';

    $query = 0;

    if (isset($_SERVER['QUERY_STRING'])) {
        global $query;
        $query = str_replace("=", "", htmlspecialchars($_SERVER['QUERY_STRING']));
    }

    $dsn = "sqlite:../db/repositories.db";
    $sqlite_db = new PDO($dsn);
    $result = $sqlite_db->prepare("SELECT * FROM repositories WHERE slug = '$query'");
    $result->execute(); /* prepared statements to fend off SQL injection attacks xD */
    $repo_loaded = False;


    try {
        foreach ($result as $row) {
            $name = strip_tags($row['name']);
            echo <<<HTML
                    <h1>$name</h1>
                    <script>
                        var query = $query
                    </script>
            HTML;
            $repo_loaded = True;
        }
    } catch (Exception $error) {
        echo <<<HTML
                <div class="flash mt-3 flash-error">
                    <svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M2.343 13.657A8 8 0 1113.657 2.343 8 8 0 012.343 13.657zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z"></path></svg>      
                    <strong>Something went wrong :(</strong> - please report this error to <strong>baokao@adrian.id.au</strong><br><br>
                    <strong>Exception thrown: </strong><br><pre>$error</pre>
                    </div>
            HTML;
    }

    if (!$repo_loaded) {
        echo <<<HTML
            <title>Repository not found | baokao</title>
            <div class="flash mt-3 flash-error" id="no-repository" style="">
                <svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z"></path>
                </svg>
                <h1>That repository doesn't exist</h1>The URL address may be incorrect, or it might have been moved or deleted. Often we remove repositories which don't work anymore or at the owner's request.<br><br>Maybe head back to the <a href="repositories"><strong>Repositories</strong></a> page?<br><br>
            </div>
            </div>
            <br>
        HTML;
        include "../include/footer.php";
        return 0;
    }
    ?>
<br>
<nav class="menu" aria-label="File explorer" id="file-explorer">
</nav>

<script type="text/javascript" src="static/get.js"></script>

</div>

<title>baokao</title>
<?php include "../include/footer.php"; ?>