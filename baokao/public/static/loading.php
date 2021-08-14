<link href="http://fonts.cdnfonts.com/css/cascadia-code" rel="stylesheet">
<script type="text/javascript" src="ready.js"></script>
<script src="https://cdn.jsdelivr.net/npm/dompurify@2.3.0/dist/purify.min.js"></script>
<script type="module" src="https://unpkg.com/dark-mode-toggle"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/inter-ui@3.19.2/inter.min.css">
<script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
<link type="text/css" href="primer.css" rel="stylesheet" />
<link type="text/css" href="style.css" rel="stylesheet" />
<div class="content">
    <div class="blankslate">
        <svg class="octicon octicon-octoface blankslate-icon" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24">
            <path d="M7.75 11c-.69 0-1.25.56-1.25 1.25v1.5a1.25 1.25 0 102.5 0v-1.5C9 11.56 8.44 11 7.75 11zm1.27 4.5a.469.469 0 01.48-.5h5a.47.47 0 01.48.5c-.116 1.316-.759 2.5-2.98 2.5s-2.864-1.184-2.98-2.5zm7.23-4.5c-.69 0-1.25.56-1.25 1.25v1.5a1.25 1.25 0 102.5 0v-1.5c0-.69-.56-1.25-1.25-1.25z"></path>
            <path fill-rule="evenodd" d="M21.255 3.82a1.725 1.725 0 00-2.141-1.195c-.557.16-1.406.44-2.264.866-.78.386-1.647.93-2.293 1.677A18.442 18.442 0 0012 5c-.93 0-1.784.059-2.569.17-.645-.74-1.505-1.28-2.28-1.664a13.876 13.876 0 00-2.265-.866 1.725 1.725 0 00-2.141 1.196 23.645 23.645 0 00-.69 3.292c-.125.97-.191 2.07-.066 3.112C1.254 11.882 1 13.734 1 15.527 1 19.915 3.13 23 12 23c8.87 0 11-3.053 11-7.473 0-1.794-.255-3.647-.99-5.29.127-1.046.06-2.15-.066-3.125a23.652 23.652 0 00-.689-3.292zM20.5 14c.5 3.5-1.5 6.5-8.5 6.5s-9-3-8.5-6.5c.583-4 3-6 8.5-6s7.928 2 8.5 6z"></path>
        </svg>
        <h3 class="mb-1">Loading contents<span class="AnimatedEllipsis"></span></h3>
        <p>Just a second :D</p>
    </div>
</div>

<script>
    function checkForDarkMode() {
        localStorageDarkMode = localStorage.getItem("darkMode");
        if (localStorageDarkMode == "enabled") {
            document.body.setAttribute("data-color-mode", "dark");
            document.body.setAttribute("prefers-color-scheme", "dark");
        } else {
            document.body.setAttribute("data-color-mode", "light");
            document.body.setAttribute("prefers-color-scheme", "light");
        };
    };

    window.onload = checkForDarkMode();

    darkModeToggle.addEventListener('click', () => {
        localStorageDarkMode = localStorage.getItem("darkMode");
        if (document.body.getAttribute("data-color-mode") == "light" || localStorageDarkMode == "disabled" || localStorageDarkMode === null) {
            document.body.setAttribute("data-color-mode", "dark");
            document.body.setAttribute("prefers-color-scheme", "dark");
            localStorage.setItem("darkMode", "enabled");
        } else if (document.body.getAttribute("data-color-mode") == "dark" || localStorageDarkMode == "enabled") {
            document.body.setAttribute("data-color-mode", "light");
            document.body.setAttribute("prefers-color-scheme", "light");
            localStorage.setItem("darkMode", "disabled");
        }
    });
</script>