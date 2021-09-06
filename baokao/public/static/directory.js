const folder_request = "https://www.googleapis.com/drive/v3/files/" + google_drive_folder_id + "/?key=" + google_drive_api_key;
const folder_name = document.getElementById('folder-name');
const folder_title = document.getElementById('folder-title');
const parent_button = document.getElementById('parent-button');
const errordiv = document.getElementById('errordiv');

fetch(folder_request)
    .then(function (response) {
        if (response.status != 200) {
            error = '<title>That folder doesn\'t exist :( | baokao</title><div class="flash mt-3 flash-error" style="margin: 20px;" id="no-file" style=""><svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill-rule="evenodd" d="M1 12C1 5.925 5.925 1 12 1s11 4.925 11 11-4.925 11-11 11S1 18.075 1 12zm8.036-4.024a.75.75 0 00-1.06 1.06L10.939 12l-2.963 2.963a.75.75 0 101.06 1.06L12 13.06l2.963 2.964a.75.75 0 001.061-1.06L13.061 12l2.963-2.964a.75.75 0 10-1.06-1.06L12 10.939 9.036 7.976z"></path></svg><h1>Something went wrong :(</h1>The URL address may be incorrect, or it might have been moved or deleted. Maybe head back to the <a href="repositories"><strong>Repositories</strong></a> page?<br>'
            errordiv.insertAdjacentHTML("beforeend", error);
        };
        response.json().then(data => {
            let CleanFilename = DOMPurify.sanitize(data.name);
            /* let CleanParent = DOMPurify.sanitize(data.parents[0]); */ /* we can't add a directory "Back to parent folder" button until we gain access to privileged scopes */
            folder_name.innerHTML = CleanFilename;
			folder_title.innerHTML = CleanFilename + ' | baokao';
        }
    )
});
