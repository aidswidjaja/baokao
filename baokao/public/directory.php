<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<div class="content">
    <?php

    $query = 0;

    if (isset($_SERVER['QUERY_STRING'])) {
        global $query;
        $query = htmlspecialchars(str_replace("=", "", htmlspecialchars($_SERVER['QUERY_STRING'])));
    }

    $dsn = "sqlite:../db/repositories.db";
    $sqlite_db = new PDO($dsn);
    $result = $sqlite_db->prepare("SELECT * FROM repositories WHERE google_drive_folder_id = '$query'");
    $result->execute(); /* prepared statements to fend off SQL injection attacks xD */
    $repo_loaded = False;

    if (isset($result)) { /* if the ID matches a Repository folder, redirect to the Repository UI */
        try {
            foreach ($result as $row) {
                $slug = htmlspecialchars($row['slug']);
                echo <<<HTML
                    <script>
                        const folder_redirect_link = '/tree/' + '$slug';
                        window.location.replace(folder_redirect_link); 
                        console.log(window.location.hostname);
                    </script>
HTML;
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
    }

    /* when the ID is just a standard folder, display standard tree logic executed */
    echo <<<HTML
			<title id="folder-title">Loading... | baokao</title>
            <h1 id="folder-name"></h1>
            <script>
                const google_drive_folder_id = '$query';
            </script>
HTML;
    $repo_loaded = True;

    if (!$repo_loaded) {
        echo <<<HTML
            <title>Folder not found | baokao</title>
            <div class="flash mt-3 flash-error" id="no-repository" style="">
                <svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
                    <path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z"></path>
                </svg>
                <h1>That folder doesn't exist :(</h1>The URL address may be incorrect, or it might have been moved or deleted. Maybe head back to the <a href="repositories"><strong>Repositories</strong></a> page?<br><br>
            </div>
            </div>
            <br>
HTML;
        include "../include/footer.php";
        return 0;
    }

    ?>
    <br>

    <div id="errordiv"></div>

    <!-- Ideally the #parent-button would actually do what it claims to do and go to parent, but because getting the parents[0] requires privileged scopes, we'll have to deal with this for now - it's terrible UX but that's all we can do rn -->

    <a onclick="window.history.back()" class="btn-octicon" id="parent-button"><svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
            <path fill-rule="evenodd" d="M6.78 1.97a.75.75 0 010 1.06L3.81 6h6.44A4.75 4.75 0 0115 10.75v2.5a.75.75 0 01-1.5 0v-2.5a3.25 3.25 0 00-3.25-3.25H3.81l2.97 2.97a.75.75 0 11-1.06 1.06L1.47 7.28a.75.75 0 010-1.06l4.25-4.25a.75.75 0 011.06 0z"></path>
        </svg></a>

    <button class="btn-octicon" type="button" aria-label="Copy share link" id="copy-current-location" data-clipboard-target="">
        <svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.5 3a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 3a3 3 0 01-5.175 2.066l-3.92 2.179a3.005 3.005 0 010 1.51l3.92 2.179a3 3 0 11-.73 1.31l-3.92-2.178a3 3 0 110-4.133l3.92-2.178A3 3 0 1115 3zm-1.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-9-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path></svg>
    </button>
    <br><br>
    <nav class="menu" aria-label="File explorer" id="file-explorer">
    </nav>

    <div class="blankslate" id="repositories-loading">
        <svg class="octicon octicon-octoface blankslate-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path d="M7.75 11c-.69 0-1.25.56-1.25 1.25v1.5a1.25 1.25 0 102.5 0v-1.5C9 11.56 8.44 11 7.75 11zm1.27 4.5a.469.469 0 01.48-.5h5a.47.47 0 01.48.5c-.116 1.316-.759 2.5-2.98 2.5s-2.864-1.184-2.98-2.5zm7.23-4.5c-.69 0-1.25.56-1.25 1.25v1.5a1.25 1.25 0 102.5 0v-1.5c0-.69-.56-1.25-1.25-1.25z"></path>
            <path fill-rule="evenodd" d="M21.255 3.82a1.725 1.725 0 00-2.141-1.195c-.557.16-1.406.44-2.264.866-.78.386-1.647.93-2.293 1.677A18.442 18.442 0 0012 5c-.93 0-1.784.059-2.569.17-.645-.74-1.505-1.28-2.28-1.664a13.876 13.876 0 00-2.265-.866 1.725 1.725 0 00-2.141 1.196 23.645 23.645 0 00-.69 3.292c-.125.97-.191 2.07-.066 3.112C1.254 11.882 1 13.734 1 15.527 1 19.915 3.13 23 12 23c8.87 0 11-3.053 11-7.473 0-1.794-.255-3.647-.99-5.29.127-1.046.06-2.15-.066-3.125a23.652 23.652 0 00-.689-3.292zM20.5 14c.5 3.5-1.5 6.5-8.5 6.5s-9-3-8.5-6.5c.583-4 3-6 8.5-6s7.928 2 8.5 6z"></path>
        </svg>
        <h3 class="mb-1">Loading contents<span class="AnimatedEllipsis"></span></h3>
        <p>Just a second :D</p>
    </div>

    <script type="text/javascript" src="static/env.js"></script>
    <script type="text/javascript" src="static/get.js"></script>
    <script type="text/javascript" src="static/directory.js"></script>
    <script type="text/javascript" src="static/copy.js"></script>

</div>

<?php include "../include/footer.php"; ?>