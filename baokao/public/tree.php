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
    $result = $sqlite_db->prepare("SELECT * FROM repositories WHERE slug = '$query'");
    $result->execute(); /* prepared statements to fend off SQL injection attacks xD */
    $repo_loaded = False;


    try {
        foreach ($result as $row) {
            $name = htmlspecialchars($row['name']);
            $info = htmlspecialchars($row['info']);
            $description = htmlspecialchars($row['description']);
            $google_drive_folder_id = htmlspecialchars($row['google_drive_folder_id']);

            echo <<<HTML
                    <title>$name | baokao</title>
                    <h1>$name</h1>
                    <script>
                        const query = '$query';
                        const google_drive_folder_id = '$google_drive_folder_id';
                    </script>
                    <br>
                    <div class="Box Box--spacious">
                        <div class="Box-body">
                            <h5>$info</h5>
                            <hr>
                            <p>$description</p>
                            <br>
                            <div class="repositories-actions">
                            <details class="tree-action-button details-reset details-overlay details-overlay-dark" id="upload-info-dialog">
                                    <summary class="btn btn-primary repository-temp-upload" aria-haspopup="dialog" id="upload-info-dialog-toggle">                                
                                        <svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M8.53 1.22a.75.75 0 00-1.06 0L3.72 4.97a.75.75 0 001.06 1.06l2.47-2.47v6.69a.75.75 0 001.5 0V3.56l2.47 2.47a.75.75 0 101.06-1.06L8.53 1.22zM3.75 13a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5z"></path></svg><span>Upload</span>
                                    </summary>
                                    <details-dialog class="Box Box--overlay d-flex flex-column anim-fade-in fast">
                                        <div class="Box-header">
                                            <button class="Box-btn-octicon btn-octicon float-right" type="button" aria-label="Close dialog" data-close-dialog id="upload-info-dialog-x">
                                                <svg class="octicon octicon-x" viewBox="0 0 12 16" version="1.1" width="12" height="16" aria-hidden="true"><path fill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"></path></svg>
                                            </button>
                                            <h3 class="Box-title">Upload files in Google Drive</h3>
                                        </div>

                                    <div class="overflow-auto">
                                        <div class="Box-body overflow-auto">
                                            <p>
                                            One-click upload is not yet available in baokao Early Access. If you would like to contribute to this repository, see our <a href="contributions">Contributions</a> page and upload your file directly to Google Drive.
                                            </p>
                                        </div>
                                        <div class="Box-footer">
                                            <a href="https://drive.google.com/drive/folders/$google_drive_folder_id" target="_blank" type="button" class="btn btn-block" data-close-dialog>Go to Google Drive</a>
                                        </div>
                                    </details-dialog>
                                </details>
                                <!-- <button class="btn" type="button" id="repositories-add"><svg class="octicon search-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg><span>Search</span></button> -->
                                <button class="tree-action-button btn btn-outline" type="button" id="copy-current-location" data-clipboard-target=""><svg class="octicon share-icon outline" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.5 3a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 3a3 3 0 01-5.175 2.066l-3.92 2.179a3.005 3.005 0 010 1.51l3.92 2.179a3 3 0 11-.73 1.31l-3.92-2.178a3 3 0 110-4.133l3.92-2.178A3 3 0 1115 3zm-1.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-9-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path></svg><span>Share</span></button>
                            </div>
                        </div>
                    </div>
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
                <h1>That repository doesn't exist :(</h1>The URL address may be incorrect, or it might have been moved or deleted. Maybe head back to the <a href="repositories"><strong>Repositories</strong></a> page?<br><br>
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
    <script type="text/javascript" src="static/copy.js"></script>
    <script type="text/javascript" src="static/repositories-actions.js"></script>
    <script src="static/github-box-overlay.js"></script>

</div>

<?php include "../include/footer.php"; ?>