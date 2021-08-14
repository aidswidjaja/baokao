/* let's fix this later :/ */
/*
const darkModeToggleCusdis = document.getElementById('dark-mode-toggle');
const path = window.location.pathname;
const cusdis = document.getElementById('cusdis');
const cusdisImportStart = '<div id="cusdis_thread" data-host="https://cusdis.com" data-app-id="' + cusdis_app_id + '" data-page-id="' + path + '" data-page-url="https://baokao.adrian.id.au' + path + '" data-page-title="' + path;
const cusdisImportEnd = '<script src="https://cusdis.com/js/cusdis.es.js"></script></div>';

function checkForDarkMode() {
    localStorageDarkMode = localStorage.getItem("darkMode");
    if (localStorageDarkMode == "enabled") {
        cusdis.innerHTML = cusdisImportStart + '" data-theme="dark">' + cusdisImportEnd;
        console.log("Dark Mode 1");
    }
    else {
        cusdis.innerHTML = cusdisImportStart + '" data-theme="light">' + cusdisImportEnd;
        console.log("Light Mode 1")
    };
};

window.onload = checkForDarkMode();

darkModeToggleCusdis.addEventListener('click', () => {
    localStorageDarkMode = localStorage.getItem("darkMode");
    if (document.body.getAttribute("data-color-mode") == "light" || localStorageDarkMode == "disabled" || localStorageDarkMode === null) {
        cusdis.innerHTML = cusdisImportStart + '" data-theme="light">' + cusdisImportEnd;
        console.log("Dark Mode 2")
    } else if (document.body.getAttribute("data-color-mode") == "dark" || localStorageDarkMode == "enabled") {
        cusdis.innerHTML = cusdisImportStart + '" data-theme="dark">' + cusdisImportEnd;
        console.log("Light Mode 2")
  }
});
*/