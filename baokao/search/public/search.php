<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<?php include "../include/env.php"; ?>
<script src="static/darkmode.js"></script>
<link href="static/search.css" rel="stylesheet" />
<script>
    document.getElementById("nav-search").setAttribute("aria-current", "page")
</script>
<title>Search | baokao</title>

<div class="content">
    <h1>Search</h1>
    <span class="State State--open mr-2">
        <svg class="octicon octicon-copilot" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path d="M6.25 9a.75.75 0 01.75.75v1.5a.75.75 0 01-1.5 0v-1.5A.75.75 0 016.25 9zm4.25.75a.75.75 0 00-1.5 0v1.5a.75.75 0 001.5 0v-1.5z"></path><path fill-rule="evenodd" d="M7.86 1.77c.05.053.097.107.14.164.043-.057.09-.111.14-.164.681-.731 1.737-.9 2.943-.765 1.23.136 2.145.527 2.724 1.26.566.716.693 1.614.693 2.485 0 .572-.053 1.147-.254 1.655l.168.838.066.033A2.75 2.75 0 0116 9.736V11c0 .24-.086.438-.156.567a2.173 2.173 0 01-.259.366c-.18.21-.404.413-.605.58a10.373 10.373 0 01-.792.597l-.015.01-.006.004-.028.018a8.832 8.832 0 01-.456.281c-.307.177-.749.41-1.296.642C11.296 14.528 9.756 15 8 15c-1.756 0-3.296-.472-4.387-.935a12.06 12.06 0 01-1.296-.641 8.815 8.815 0 01-.456-.281l-.028-.02-.006-.003-.015-.01a7.077 7.077 0 01-.235-.166c-.15-.108-.352-.26-.557-.43a5.19 5.19 0 01-.605-.58 2.167 2.167 0 01-.259-.367A1.19 1.19 0 010 11V9.736a2.75 2.75 0 011.52-2.46l.067-.033.167-.838C1.553 5.897 1.5 5.322 1.5 4.75c0-.87.127-1.77.693-2.485.579-.733 1.494-1.124 2.724-1.26 1.206-.134 2.262.034 2.944.765zM3.024 7.709L3 7.824v4.261c.02.013.043.025.065.038.264.152.65.356 1.134.562.972.412 2.307.815 3.801.815 1.494 0 2.83-.403 3.8-.815a10.6 10.6 0 001.2-.6v-4.26l-.023-.116c-.49.21-1.075.291-1.727.291-1.146 0-2.06-.328-2.71-.991A3.223 3.223 0 018 6.266c-.144.269-.321.52-.54.743C6.81 7.672 5.896 8 4.75 8c-.652 0-1.237-.082-1.727-.291zm3.741-4.916c-.193-.207-.637-.414-1.681-.298-1.02.114-1.48.404-1.713.7-.247.313-.37.79-.37 1.555 0 .792.129 1.17.308 1.37.162.181.52.38 1.442.38.854 0 1.339-.236 1.638-.54.315-.323.527-.827.618-1.553.117-.936-.038-1.396-.242-1.614zm2.472 0c.193-.207.637-.414 1.681-.298 1.02.114 1.48.404 1.713.7.247.313.37.79.37 1.555 0 .792-.129 1.17-.308 1.37-.162.181-.52.38-1.442.38-.854 0-1.339-.236-1.638-.54-.315-.323-.527-.827-.618-1.553-.117-.936.038-1.396.242-1.614z"></path></svg>
        <span>Beta!</span>
    </span>
    <br><br>
    <form action="" method="GET">
        <div class="input-group">
            <input class="form-control" id="search-box" name="q" type="text" placeholder="Search across baokao..." aria-label="Search">
            <span class="input-group-button">
                <button class="btn" type="submit" aria-label="Search">
                    <svg class="octicon octicon-search" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path></svg>
                </button>
            </span>
        </div>
    </form>
    <br><br>

    <?php

    if (empty($_GET['q'])) {    // no search performed yet
        global $search_prompt;

        // if not, display helpful hint!

        $subject_array = array("Maths", "English", "Chemistry", "Biology", "Physics", "History", "Economics");
        $study_resource_array = array("papers", "notes", "resources", "practice questions");

        $rand_subject = array_rand($subject_array, 1);
        $rand_study_resource = array_rand($study_resource_array, 1);

        echo <<<HTML
            <span class="search-tip search-hint">Try searching for "$subject_array[$rand_subject] $study_resource_array[$rand_study_resource]"</span>
            <br>
            <span class="search-tip"><strong>Tip:</strong> including more words and using variations of words (e.g maths, math, mathematics) will broaden your search result</span>
        HTML;

    } else {                    // show results
        global $search_prompt;
        global $query;
        $query = htmlspecialchars(str_replace("'", "\'", str_replace("q=", "", htmlspecialchars($_GET['q']))));

        // display value inside search box

        echo <<<HTML
        <script>
            document.getElementById("search-box").setAttribute("value", "$query"); 
        </script>
        HTML;

        // for each repository...

        $dsn = "sqlite:../db/repositories.db";
        $sqlite_db = new PDO($dsn);
        $result = $sqlite_db->prepare("SELECT * FROM repositories");
        $result->execute();

        try {

            echo <<<HTML
                <script type="text/javascript" src="static/env.js"></script>
                <script>repo_arr = [];</script>
            HTML;

            foreach ($result as $row) { // for each repo
                /* strip_tags() just in case ;) */
                $name = strip_tags($row['name']);
                $slug = strip_tags($row['slug']);
                $google_drive_folder_id = htmlspecialchars($row['google_drive_folder_id']);
                $id = $google_drive_folder_id; // in the async requests we want to match up the receipts with the correct repo
                $file_explorer_id = "file_explorer_" . $google_drive_folder_id;

                echo <<<HTML
                    <div class="Box Box--condensed">
                        <div class="Box-header">
                            <h3 class="Box-title">$name</h3>
                        </div>
                    <div class="Box-row" aria-label="File explorer" id="$file_explorer_id"></div>
                        <script>
                            // it's very important we manage variable declarations such that there are no race conditions arising from async fetch requests
                            // to combat race conditions, we take advantage of the Google Drive unique IDs and assign them properly (with some PHP->JS translation ofc lol)
                            google_drive_folder_$id = "$google_drive_folder_id";
                            repo_arr.push(google_drive_folder_$id);
                            file_explorer_$id = document.getElementById("$file_explorer_id");
                            // q= fulltext contains 'query' and trashed = false and 'google_drive_folder_id' in parents
                            ////request_$id = "https://www.googleapis.com/drive/v3/files?q=fullText+contains+" + "'$query'" + "+and+trashed=false+and+'" + google_drive_folder_$id + "'+in+parents&key=" + google_drive_api_key
                        </script>
                    
                    HTML;

                echo <<<HTML
                    </div>
                    <br>
                HTML;

                include "../include/searchget.php";


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
    }

    ?>
</div>

<?php include "../include/footer.php"; ?>