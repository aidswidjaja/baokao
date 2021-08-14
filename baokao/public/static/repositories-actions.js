/* to-do: uhh all of this */

const downloadButton = document.getElementById('repositories-download');

function download() { /* H/t https://orclqa.com/copy-url-clipboard/ */
    var temp_input = document.body.appendChild(document.createElement("input"));
    temp_input.value = "https://docs.google.com/uc?export=download&id=" + google_drive_folder_id;
    temp_input.focus();
    temp_input.select();
    document.execCommand('copy');
    temp_input.parentNode.removeChild(inputc);
}

downloadButton.addEventListener('click', download);