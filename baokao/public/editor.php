<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<?php include "../include/env.php"; ?>

<link type="text/css" href="static/viewer.css" rel="stylesheet" />

<div id="errordiv"></div>

<?php

if (isset($_SERVER['QUERY_STRING'])) {
    global $query;
    $query = str_replace("=", "", htmlspecialchars($_SERVER['QUERY_STRING']));
}

$file_loaded = False;

echo <<<HTML
    <script>
        const google_drive_file_id = '$query';
        const editing_enabled = new Boolean(true);
    </script>
HTML;

try {
    echo <<<HTML
    <title id="title"></title>
    <div class="viewer" id="mainviewer" style="">

    <div class="view">
    <iframe class="docviewer" id="docviewer-iframe" src="static/loading.php"></iframe>
    <div id="error-message"></div>
    </div>
    <div class="sidebar">
    <p class="h3" id="filename"></p>
    <div id="description-div">
        <p id="file-description"></p>
    </div>
    <hr>
    <div id="editing-status">
    <span class="State State--merged mr-2">
        <svg class="octicon octicon-pencil" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M11.013 1.427a1.75 1.75 0 012.474 0l1.086 1.086a1.75 1.75 0 010 2.474l-8.61 8.61c-.21.21-.47.364-.756.445l-3.251.93a.75.75 0 01-.927-.928l.929-3.25a1.75 1.75 0 01.445-.758l8.61-8.61zm1.414 1.06a.25.25 0 00-.354 0L10.811 3.75l1.439 1.44 1.263-1.263a.25.25 0 000-.354l-1.086-1.086zM11.189 6.25L9.75 4.81l-6.286 6.287a.25.25 0 00-.064.108l-.558 1.953 1.953-.558a.249.249 0 00.108-.064l6.286-6.286z"></path></svg>
        <span id="editing-label">Currently editing</span>
    </span>
    <br><br>
        <div class="flash">
        Editing files requires the owner to grant permission to edit. We also recommend using Google Chrome to edit files – <a href="contributions#edit-files">see why</a>.</p>
        </div>
    </div>
    <hr>
    <span id="download"><a href="https://drive.google.com/uc?export=download&id=$query" class="btn btn-primary btn-block mb-2" type="button"><svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M7.47 10.78a.75.75 0 001.06 0l3.75-3.75a.75.75 0 00-1.06-1.06L8.75 8.44V1.75a.75.75 0 00-1.5 0v6.69L4.78 5.97a.75.75 0 00-1.06 1.06l3.75 3.75zM3.75 13a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5z"></path></svg><span>Download</span></a></span>
    <a href="viewer?$query" class="btn btn-block mb-2" type="button"><svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M1.679 7.932c.412-.621 1.242-1.75 2.366-2.717C5.175 4.242 6.527 3.5 8 3.5c1.473 0 2.824.742 3.955 1.715 1.124.967 1.954 2.096 2.366 2.717a.119.119 0 010 .136c-.412.621-1.242 1.75-2.366 2.717C10.825 11.758 9.473 12.5 8 12.5c-1.473 0-2.824-.742-3.955-1.715C2.92 9.818 2.09 8.69 1.679 8.068a.119.119 0 010-.136zM8 2c-1.981 0-3.67.992-4.933 2.078C1.797 5.169.88 6.423.43 7.1a1.619 1.619 0 000 1.798c.45.678 1.367 1.932 2.637 3.024C4.329 13.008 6.019 14 8 14c1.981 0 3.67-.992 4.933-2.078 1.27-1.091 2.187-2.345 2.637-3.023a1.619 1.619 0 000-1.798c-.45-.678-1.367-1.932-2.637-3.023C11.671 2.992 9.981 2 8 2zm0 8a2 2 0 100-4 2 2 0 000 4z"></path></svg><span>View</span></a>
    <span><a id="open-externally" href="" target="_blank" class="btn btn-block mb-2" type="button"><svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M10.604 1h4.146a.25.25 0 01.25.25v4.146a.25.25 0 01-.427.177L13.03 4.03 9.28 7.78a.75.75 0 01-1.06-1.06l3.75-3.75-1.543-1.543A.25.25 0 0110.604 1zM3.75 2A1.75 1.75 0 002 3.75v8.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 12.25v-3.5a.75.75 0 00-1.5 0v3.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-8.5a.25.25 0 01.25-.25h3.5a.75.75 0 000-1.5h-3.5z"></path></svg><span>Open in Google Drive</span></a></span> 
    <button class="btn btn-block btn-outline mb-2" type="button" id="copy-current-location" data-clipboard-target=""><svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M13.5 3a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 3a3 3 0 01-5.175 2.066l-3.92 2.179a3.005 3.005 0 010 1.51l3.92 2.179a3 3 0 11-.73 1.31l-3.92-2.178a3 3 0 110-4.133l3.92-2.178A3 3 0 1115 3zm-1.5 10a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zm-9-5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z"></path></svg><span>Share</span></button>
    <hr>
    <p class="h4">Comment</p>
    <div id="cusdis-parent" class="cusdis-parent-viewer">
    	<div id="cusdis-wrapper">
        	<div id="cusdis_thread" data-host="https://cusdis.com" data-css="static/cusdis.css" data-app-id="$cusdis_app_id" data-page-id="$query" data-page-url="https://baokao.adrian.id.au/editor/$query" data-page-title="Editing $query"></div>
    	</div>
    <script async src="https://cusdis.com/js/cusdis.es.js"></script>
    </div>
    </div>
HTML;

} catch (Exception $error) {
    echo <<<HTML
    <div class="flash mt-3 flash-error">
        <svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M2.343 13.657A8 8 0 1113.657 2.343 8 8 0 012.343 13.657zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z"></path></svg>      
        <strong>Something went wrong :(</strong> - please report this error to <strong>baokao@adrian.id.au</strong><br><br>
        <strong>Exception thrown: </strong><br><pre>$error</pre>
        </div>
HTML;
}

?>

<script type="text/javascript" src="static/env.js"></script>
<script type="text/javascript" src="static/viewer.js"></script>
<script type="text/javascript" src="static/copy.js"></script>

<title>baokao</title>
<script type="text/javascript" src="../static/darkmode.js"></script>
<script type="text/javascript" src="static/cusdis.js"></script>