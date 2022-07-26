const request = "https://www.googleapis.com/drive/v3/files/" + google_drive_file_id + "/?key=" + google_drive_api_key + '&fields=kind,id,name,mimeType,description,parents';
const filename = document.getElementById('filename');
const errordiv = document.getElementById('errordiv');
const mainviewer = document.getElementById('mainviewer');
const docviewer = document.getElementById('docviewer-iframe');
const download = document.getElementById('download');
const downloadbutton = document.getElementById('download-button');
const pdfdownload = document.getElementById('download-as-pdf');
const docdownload = document.getElementById('download-as-doc');
const externallink = document.getElementById('open-externally');
const filedescription = document.getElementById('file-description');
const divdiscription = document.getElementById('description-div');
const title = document.getElementById('title');

try {
    fetch(request)
        .then(function (response) {
            if (response.status != 200) {
                error = '<title>That file doesn\'t exist :( | baokao</title><div class="flash mt-3 flash-error" style="margin: 20px;" id="no-file" style=""><svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z"></path></svg><h1>Something went wrong :(</h1>The URL address may be incorrect, or it might have been moved or deleted. Maybe head back to the <a href="repositories"><strong>Repositories</strong></a> page?<br>'
                errordiv.insertAdjacentHTML("beforeend", error);
                mainviewer.setAttribute("style", "display: none;");
            };
            response.json().then(data => {
                let CleanDescription = DOMPurify.sanitize(data.description).replaceAll('\n', '<br>');

                if (data.description) { 
                    DescriptionData = '<p>' + CleanDescription + '</p>';
                    filedescription.insertAdjacentHTML("beforeend", DescriptionData);
                }
                else {
                    divdiscription.setAttribute("style", "display: none;");
                }

                let CleanFilename = DOMPurify.sanitize(data.name);
                InjectData = '<span> ' + CleanFilename + '</span>';
                
                switch (data.mimeType) { /* mmmm I love DRY */
                    case "application/epub+zip":
                        mimeIcon = '<svg class="octicon octicon-book" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M0 3.75A.75.75 0 01.75 3h7.497c1.566 0 2.945.8 3.751 2.014A4.496 4.496 0 0115.75 3h7.5a.75.75 0 01.75.75v15.063a.75.75 0 01-.755.75l-7.682-.052a3 3 0 00-2.142.878l-.89.891a.75.75 0 01-1.061 0l-.902-.901a3 3 0 00-2.121-.879H.75a.75.75 0 01-.75-.75v-15zm11.247 3.747a3 3 0 00-3-2.997H1.5V18h6.947a4.5 4.5 0 012.803.98l-.003-11.483zm1.503 11.485V7.5a3 3 0 013-3h6.75v13.558l-6.927-.047a4.5 4.5 0 00-2.823.971z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.document":
                    case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                    case "application/pdf":
                        mimeIcon = '<svg class="octicon octicon-file" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M5 2.5a.5.5 0 00-.5.5v18a.5.5 0 00.5.5h14a.5.5 0 00.5-.5V8.5h-4a2 2 0 01-2-2v-4H5zm10 0v4a.5.5 0 00.5.5h4a.5.5 0 00-.146-.336l-4.018-4.018A.5.5 0 0015 2.5zM3 3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2H5a2 2 0 01-2-2V3z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.folder":
                        mimeIcon = '<svg class="octicon octicon-file-directory" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M3.75 4.5a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25V7.687a.25.25 0 00-.25-.25h-8.471a1.75 1.75 0 01-1.447-.765L8.928 4.61a.25.25 0 00-.208-.11H3.75zM2 4.75C2 3.784 2.784 3 3.75 3h4.971c.58 0 1.12.286 1.447.765l1.404 2.063a.25.25 0 00.207.11h8.471c.966 0 1.75.783 1.75 1.75V19.25A1.75 1.75 0 0120.25 21H3.75A1.75 1.75 0 012 19.25V4.75z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.drive-sdk":
                    case "application/vnd.google-apps.shortcut":
                        mimeIcon = '<svg class="octicon octicon-link" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M14.78 3.653a3.936 3.936 0 115.567 5.567l-3.627 3.627a3.936 3.936 0 01-5.88-.353.75.75 0 00-1.18.928 5.436 5.436 0 008.12.486l3.628-3.628a5.436 5.436 0 10-7.688-7.688l-3 3a.75.75 0 001.06 1.061l3-3z"></path><path d="M7.28 11.153a3.936 3.936 0 015.88.353.75.75 0 001.18-.928 5.436 5.436 0 00-8.12-.486L2.592 13.72a5.436 5.436 0 107.688 7.688l3-3a.75.75 0 10-1.06-1.06l-3 3a3.936 3.936 0 01-5.567-5.568l3.627-3.627z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.audio":
                    case "audio/mpeg":
                        mimeIcon = '<svg class="octicon octicon-unmute" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M11.553 3.064A.75.75 0 0112 3.75v16.5a.75.75 0 01-1.255.555L5.46 16H2.75A1.75 1.75 0 011 14.25v-4.5C1 8.784 1.784 8 2.75 8h2.71l5.285-4.805a.75.75 0 01.808-.13zM10.5 5.445l-4.245 3.86a.75.75 0 01-.505.195h-3a.25.25 0 00-.25.25v4.5c0 .138.112.25.25.25h3a.75.75 0 01.505.195l4.245 3.86V5.445z"></path><path d="M18.718 4.222a.75.75 0 011.06 0c4.296 4.296 4.296 11.26 0 15.556a.75.75 0 01-1.06-1.06 9.5 9.5 0 000-13.436.75.75 0 010-1.06z"></path><path d="M16.243 7.757a.75.75 0 10-1.061 1.061 4.5 4.5 0 010 6.364.75.75 0 001.06 1.06 6 6 0 000-8.485z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.photo":
                    case "image/jpeg":
                    case "image/png":
                        mimeIcon = '<svg class="octicon octicon-file-media" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M2.25 4a.25.25 0 00-.25.25v15.5c0 .138.112.25.25.25h3.178L14 10.977a1.75 1.75 0 012.506-.032L22 16.44V4.25a.25.25 0 00-.25-.25H2.25zm3.496 17.5H21.75a1.75 1.75 0 001.75-1.75V4.25a1.75 1.75 0 00-1.75-1.75H2.25A1.75 1.75 0 00.5 4.25v15.5c0 .966.784 1.75 1.75 1.75h3.496zM22 19.75v-1.19l-6.555-6.554a.25.25 0 00-.358.004L7.497 20H21.75a.25.25 0 00.25-.25zM9 9.25a1.75 1.75 0 11-3.5 0 1.75 1.75 0 013.5 0zm1.5 0a3.25 3.25 0 11-6.5 0 3.25 3.25 0 016.5 0z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.video":
                        mimeIcon = '<svg class="octicon octicon-device-camera-video" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M24 5.25a.75.75 0 00-1.136-.643L16.5 8.425V6.25a1.75 1.75 0 00-1.75-1.75h-13A1.75 1.75 0 000 6.25v11C0 18.216.784 19 1.75 19h13a1.75 1.75 0 001.75-1.75v-2.175l6.364 3.818A.75.75 0 0024 18.25v-13zm-7.5 8.075l6 3.6V6.575l-6 3.6v3.15zM15 9.75v-3.5a.25.25 0 00-.25-.25h-13a.25.25 0 00-.25.25v11c0 .138.112.25.25.25h13a.25.25 0 00.25-.25v-7.5z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.presentation":
                    case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
                        mimeIcon = '<svg class="octicon octicon-video" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M1.75 4.5a.25.25 0 00-.25.25v14.5c0 .138.112.25.25.25h20.5a.25.25 0 00.25-.25V4.75a.25.25 0 00-.25-.25H1.75zM0 4.75C0 3.784.784 3 1.75 3h20.5c.966 0 1.75.784 1.75 1.75v14.5A1.75 1.75 0 0122.25 21H1.75A1.75 1.75 0 010 19.25V4.75z"></path><path d="M9 15.584V8.416a.5.5 0 01.77-.42l5.576 3.583a.5.5 0 010 .842L9.77 16.005a.5.5 0 01-.77-.42z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.spreadsheet":
                    case "application/x-vnd.oasis.opendocument.spreadsheet":
                    case "text/csv":
                    case "text/tab-separated-values":
                    case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                        mimeIcon = '<svg class="octicon octicon-table" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M2 3.75C2 2.784 2.784 2 3.75 2h16.5c.966 0 1.75.784 1.75 1.75v16.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25V3.75zM3.5 9v11.25c0 .138.112.25.25.25H7.5V9h-4zm4-1.5h-4V3.75a.25.25 0 01.25-.25H7.5v4zM9 9v11.5h11.25a.25.25 0 00.25-.25V9H9zm11.5-1.5H9v-4h11.25a.25.25 0 01.25.25V7.5z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.script":
                    case "application/vnd.google-apps.script+json":
                        mimeIcon = '<svg class="octicon octicon-code-square" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M10.3 8.24a.75.75 0 01-.04 1.06L7.352 12l2.908 2.7a.75.75 0 11-1.02 1.1l-3.5-3.25a.75.75 0 010-1.1l3.5-3.25a.75.75 0 011.06.04zm3.44 1.06a.75.75 0 111.02-1.1l3.5 3.25a.75.75 0 010 1.1l-3.5 3.25a.75.75 0 11-1.02-1.1l2.908-2.7-2.908-2.7z"></path><path fill-rule="evenodd" d="M2 3.75C2 2.784 2.784 2 3.75 2h16.5c.966 0 1.75.784 1.75 1.75v16.5A1.75 1.75 0 0120.25 22H3.75A1.75 1.75 0 012 20.25V3.75zm1.75-.25a.25.25 0 00-.25.25v16.5c0 .138.112.25.25.25h16.5a.25.25 0 00.25-.25V3.75a.25.25 0 00-.25-.25H3.75z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.fusiontable":
                        mimeIcon = '<svg class="octicon octicon-database" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M12 1.25c-2.487 0-4.774.402-6.466 1.079-.844.337-1.577.758-2.112 1.264C2.886 4.1 2.5 4.744 2.5 5.5v12.987l.026.013H2.5c0 .756.386 1.4.922 1.907.535.506 1.268.927 2.112 1.264 1.692.677 3.979 1.079 6.466 1.079s4.773-.402 6.466-1.079c.844-.337 1.577-.758 2.112-1.264.536-.507.922-1.151.922-1.907h-.026l.026-.013V5.5c0-.756-.386-1.4-.922-1.907-.535-.506-1.268-.927-2.112-1.264C16.773 1.652 14.487 1.25 12 1.25zM4 5.5c0-.21.104-.487.453-.817.35-.332.899-.666 1.638-.962C7.566 3.131 9.655 2.75 12 2.75c2.345 0 4.434.382 5.909.971.74.296 1.287.63 1.638.962.35.33.453.606.453.817 0 .21-.104.487-.453.817-.35.332-.899.666-1.638.962-1.475.59-3.564.971-5.909.971-2.345 0-4.434-.382-5.909-.971-.74-.296-1.287-.63-1.638-.962C4.103 5.987 4 5.711 4 5.5zM20 12V7.871a7.842 7.842 0 01-1.534.8C16.773 9.348 14.487 9.75 12 9.75s-4.774-.402-6.466-1.079A7.843 7.843 0 014 7.871V12c0 .21.104.487.453.817.35.332.899.666 1.638.961 1.475.59 3.564.972 5.909.972 2.345 0 4.434-.382 5.909-.972.74-.295 1.287-.629 1.638-.96.35-.33.453-.607.453-.818zM4 14.371c.443.305.963.572 1.534.8 1.692.677 3.979 1.079 6.466 1.079s4.773-.402 6.466-1.079a7.842 7.842 0 001.534-.8v4.116l.013.013H20c0 .21-.104.487-.453.817-.35.332-.899.666-1.638.962-1.475.59-3.564.971-5.909.971-2.345 0-4.434-.382-5.909-.971-.74-.296-1.287-.63-1.638-.962-.35-.33-.453-.606-.453-.817h-.013L4 18.487V14.37z"></path></svg>'
                        break;
                    case "application/vnd.google-apps.form":
                        mimeIcon = '<svg class="octicon octicon-list-unordered" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M4 7a1 1 0 100-2 1 1 0 000 2zm4.75-1.5a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zm0 6a.75.75 0 000 1.5h11.5a.75.75 0 000-1.5H8.75zM5 12a1 1 0 11-2 0 1 1 0 012 0zm-1 7a1 1 0 100-2 1 1 0 000 2z"></path></svg>'
                        break;
                    case "application/zip":
                        mimeIcon = '<svg class="octicon octicon-file-zip" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M5 2.5a.5.5 0 00-.5.5v18a.5.5 0 00.5.5h1.75a.75.75 0 010 1.5H5a2 2 0 01-2-2V3a2 2 0 012-2h9.982a2 2 0 011.414.586l4.018 4.018A2 2 0 0121 7.018V21a2 2 0 01-2 2h-2.75a.75.75 0 010-1.5H19a.5.5 0 00.5-.5V7.018a.5.5 0 00-.146-.354l-4.018-4.018a.5.5 0 00-.354-.146H5z"></path><path d="M11.5 15.75a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm.75-3.75a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zm-.75-2.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zM12.25 6a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zm-.75-2.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zM9.75 13.5a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zM9 11.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1a.75.75 0 01-.75-.75zm.75-3.75a.75.75 0 000 1.5h1a.75.75 0 000-1.5h-1zM9 5.25a.75.75 0 01.75-.75h1a.75.75 0 010 1.5h-1A.75.75 0 019 5.25z"></path><path fill-rule="evenodd" d="M11 17a2 2 0 00-2 2v4.25c0 .414.336.75.75.75h3.5a.75.75 0 00.75-.75V19a2 2 0 00-2-2h-1zm-.5 2a.5.5 0 01.5-.5h1a.5.5 0 01.5.5v3.5h-2V19z"></path></svg>'
                        break;
                    default:
                        mimeIcon = '<svg class="octicon octicon-package" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M12.876.64a1.75 1.75 0 00-1.75 0l-8.25 4.762a1.75 1.75 0 00-.875 1.515v9.525c0 .625.334 1.203.875 1.515l8.25 4.763a1.75 1.75 0 001.75 0l8.25-4.762a1.75 1.75 0 00.875-1.516V6.917a1.75 1.75 0 00-.875-1.515L12.876.639zm-1 1.298a.25.25 0 01.25 0l7.625 4.402-7.75 4.474-7.75-4.474 7.625-4.402zM3.501 7.64v8.803c0 .09.048.172.125.216l7.625 4.402v-8.947L3.501 7.64zm9.25 13.421l7.625-4.402a.25.25 0 00.125-.216V7.639l-7.75 4.474v8.947z"></path></svg>'
                }
                filename.insertAdjacentHTML("beforeend", mimeIcon);
                filename.insertAdjacentHTML("beforeend", InjectData);
                title.innerHTML = CleanFilename + ' | baokao';

                var url_mimetype = undefined;
                var iframe_link = undefined;
                var external_link = undefined;

                /* this code should only work in the editor */
                switch (data.mimeType) {
                    /* Google Drive URL mimetypes */
                    case "application/vnd.google-apps.document":
                    case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
                        var url_mimetype = "document";
                        break;
                    case "application/vnd.google-apps.presentation":
                    case "application/vnd.openxmlformats-officedocument.presentationml.presentation":
                        var url_mimetype = "presentation";
                        break;
                    case "application/vnd.google-apps.spreadsheet":
                    case "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet":
                        var url_mimetype = "spreadsheets";
                        break;
                    case "application/vnd.google-apps.form":
                        var url_mimetype = "forms";
                        break;
                    case "application/vnd.google-apps.folder":
                        var url_mimetype = "folder";
                        break;
                    default:
                        var url_mimetype = "file";
                        file_mimetype = true;
                }


                if (url_mimetype != "file") {
                    const docedit_link_starter = "https://docs.google.com/" + url_mimetype + "/d/" + google_drive_file_id + "/edit";
                    const download_link_starter = "https://docs.google.com/" + url_mimetype + "/d/" + google_drive_file_id + "/export?format=";
                    const pdfdownload = download_link_starter + 'pdf';
                    const docdownload = download_link_starter + 'doc';
                    const dropdown_html = '<details class="dropdown details-reset details-overlay d-block"> <summary id="download-button" class="btn btn-primary btn-block mb-2" aria-haspopup="true"> <svg class="octicon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16"><path fill-rule="evenodd" d="M7.47 10.78a.75.75 0 001.06 0l3.75-3.75a.75.75 0 00-1.06-1.06L8.75 8.44V1.75a.75.75 0 00-1.5 0v6.69L4.78 5.97a.75.75 0 00-1.06 1.06l3.75 3.75zM3.75 13a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5z"></path></svg>Download <div class="dropdown-caret"></div> </summary> <ul class="dropdown-menu dropdown-menu-se"> <li><a class="dropdown-item" id="download-as-pdf" href="' + pdfdownload +'">Download as PDF</a></li> <li><a class="dropdown-item" id="download-as-doc" href="' + docdownload +'">Download as DOCX</a></li> </ul> </details>';
                    download.innerHTML = dropdown_html;
                    
                    if (editing_enabled == true) {      /* editing enabled */    
                        external_link = docedit_link_starter;
                        if (typeof data.resourceKey !== 'undefined') {
                            iframe_link = docedit_link_starter + "?rm=embedded&chrome=false&resourcekey=" + data.resourceKey;
                            console.log("Google Doc + Editing + resourceKey");
                        } else {
                            iframe_link = docedit_link_starter + "?rm=embedded&chrome=false";
                            console.log("Google Doc + Editing");
                        }
                    } else {
                        const docview_link_starter = "https://docs.google.com/" + url_mimetype + "/d/" + google_drive_file_id + "/preview";
                        external_link = docedit_link_starter;
                        if (typeof data.resourceKey !== 'undefined') {
                            iframe_link = docview_link_starter + "?resourcekey=" + data.resourceKey;
                            console.log("Google Doc + Viewing + resourceKey");
                        } else {
                            iframe_link = docview_link_starter;
                            console.log("Google Doc + Viewing");
                        }
                    }

                } else {
                    const drive_link_starter = "https://drive.google.com/file/d/" + google_drive_file_id + "/preview";
					if (editing_enabled == true) { 
                    	const status = document.getElementById('editing-status');
                    	status.innerHTML = "<div class='flash flash-warn'>This file type can't be edited in baokao.</div>";
					};
                    if (typeof data.resourceKey !== 'undefined') {
                        iframe_link = drive_link_starter + "?resourcekey=" + data.resourceKey;
                        console.log("Drive + Viewing + resourceKey");
                    } else {
                        iframe_link = drive_link_starter;
                        console.log("Drive + Viewing");
                    }
                    external_link = iframe_link;
                };

                if (url_mimetype == "forms") {
                    docviewer.src = "static/forms.php";
                } else if (url_mimetype == "folder") {
                    docviewer.src = "static/folder.php";
                    var redirect_link = '/directory?' + google_drive_file_id;
                    window.location.replace(redirect_link);

                } else {
                    docviewer.src = iframe_link;
                }

                externallink.href = external_link;

            });
        });
} catch {
    error = '<title>Something went wrong | baokao</title><div class="flash mt-3 flash-error" id="error" style=""><svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z"></path></svg><h1>Something went wrong :(</h1>Something went wrong :( - please report this error to <strong>baokao@adrian.id.au</strong><br><br></div></div><br>'
    errordiv.insertAdjacentHTML("beforeend", error);
};