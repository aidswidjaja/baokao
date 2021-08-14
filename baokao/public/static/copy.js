clipboardButton = document.getElementById('copy-current-location');
clipboardButton.setAttribute("data-clipboard-text", window.location.href);

new ClipboardJS('#copy-current-location');

clipboardToastMessage = '<div class="p-1 clipboard-control position-fixed top-0 right-0 mb-3 ml-3"" id="copy-current-location"><div class="Toast Toast--success Toast--animateIn clipboard-animation-controller"><span class="Toast-icon"><svg width="12" height="16" viewBox="0 0 12 16" class="octicon octicon-check" aria-hidden="true"><path fill-rule="evenodd" d="M12 5l-8 8-4-4 1.5-1.5L4 10l6.5-6.5L12 5z" /></svg></span><span class="Toast-content">Copied link to clipboard</span><button class="Toast-dismissButton"><svg width="12" height="16" viewBox="0 0 12 16" class="octicon octicon-x" aria-hidden="true"><pathfill-rule="evenodd" d="M7.48 8l3.75 3.75-1.48 1.48L6 9.48l-3.75 3.75-1.48-1.48L4.52 8 .77 4.25l1.48-1.48L6 6.52l3.75-3.75 1.48 1.48L7.48 8z"/></svg></button></div></div>';

clipboardButton.addEventListener('click', () => {
    document.body.insertAdjacentHTML("beforeend", clipboardToastMessage);
    var clipboardAnimController = document.getElementsByClassName('clipboard-animation-controller');
    var clipboardControl = document.getElementsByClassName('clipboard-control');
    setTimeout(
        function() {
            for (var i = 0; i < clipboardAnimController.length; ++i) {
                clipboardAnimController[i].classList.add("Toast--animateOut")
            }
        }, 3000)
});