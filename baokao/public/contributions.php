<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<title>Contributions | baokao</title>
<script>
    document.getElementById("nav-contributions").setAttribute("aria-current", "page")
</script>
<div class="content">

    <h1>Contributions</h1>
    <br>
    <h4>I want to contribute student resources</h4>
    <div class="content">
        <div class="TimelineItem">
            <div class="TimelineItem-badge">
                <svg class="octicon octicon-flame" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd" d="M11.5 7a4.499 4.499 0 11-8.998 0A4.499 4.499 0 0111.5 7zm-.82 4.74a6 6 0 111.06-1.06l3.04 3.04a.75.75 0 11-1.06 1.06l-3.04-3.04z"></path>
                </svg>
            </div>

            <div class="TimelineItem-body">
                Find the right Repository that's most appropriate for the materials you're trying to contribute
            </div>
        </div>
        <div class="TimelineItem">
            <div class="TimelineItem-badge">
                <svg class="octicon octicon-milestone" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd" d="M7.75 0a.75.75 0 01.75.75V3h3.634c.414 0 .814.147 1.13.414l2.07 1.75a1.75 1.75 0 010 2.672l-2.07 1.75a1.75 1.75 0 01-1.13.414H8.5v5.25a.75.75 0 11-1.5 0V10H2.75A1.75 1.75 0 011 8.25v-3.5C1 3.784 1.784 3 2.75 3H7V.75A.75.75 0 017.75 0zm0 8.5h4.384a.25.25 0 00.161-.06l2.07-1.75a.25.25 0 000-.38l-2.07-1.75a.25.25 0 00-.161-.06H2.75a.25.25 0 00-.25.25v3.5c0 .138.112.25.25.25h5z"></path>
                </svg>
            </div>

            <div class="TimelineItem-body">
                On the Repository's home page, click the <span class="text-bold">Upload</span> button where you'll be redirected to Google Drive
            </div>
        </div>
        <div class="TimelineItem">
            <div class="TimelineItem-badge">
                <svg class="octicon octicon-lock" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd" d="M4 4v2h-.25A1.75 1.75 0 002 7.75v5.5c0 .966.784 1.75 1.75 1.75h8.5A1.75 1.75 0 0014 13.25v-5.5A1.75 1.75 0 0012.25 6H12V4a4 4 0 10-8 0zm6.5 2V4a2.5 2.5 0 00-5 0v2h5zM12 7.5h.25a.25.25 0 01.25.25v5.5a.25.25 0 01-.25.25h-8.5a.25.25 0 01-.25-.25v-5.5a.25.25 0 01.25-.25H12z"></path>
                </svg>
            </div>

            <div class="TimelineItem-body">
                If you need to request access first, click the Repository's name, then go to <span class="text-bold">Share</span>, then click <span class="text-bold">Ask to share</span> where you can contact the Repository's owner directly
            </div>
        </div>
        <div class="TimelineItem">
            <div class="TimelineItem-badge">
                <svg class="octicon octicon-upload" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd" d="M8.53 1.22a.75.75 0 00-1.06 0L3.72 4.97a.75.75 0 001.06 1.06l2.47-2.47v6.69a.75.75 0 001.5 0V3.56l2.47 2.47a.75.75 0 101.06-1.06L8.53 1.22zM3.75 13a.75.75 0 000 1.5h8.5a.75.75 0 000-1.5h-8.5z"></path>
                </svg>
            </div>

            <div class="TimelineItem-body">
                Once you have gained access, you can upload resources through Google Drive
            </div>
        </div>
        <div class="TimelineItem">
            <div class="TimelineItem-badge">
                <svg class="octicon octicon-mail" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
                    <path fill-rule="evenodd" d="M1.75 2A1.75 1.75 0 000 3.75v.736a.75.75 0 000 .027v7.737C0 13.216.784 14 1.75 14h12.5A1.75 1.75 0 0016 12.25v-8.5A1.75 1.75 0 0014.25 2H1.75zM14.5 4.07v-.32a.25.25 0 00-.25-.25H1.75a.25.25 0 00-.25.25v.32L8 7.88l6.5-3.81zm-13 1.74v6.441c0 .138.112.25.25.25h12.5a.25.25 0 00.25-.25V5.809L8.38 9.397a.75.75 0 01-.76 0L1.5 5.809z"></path>
                </svg>
            </div>

            <div class="TimelineItem-body">
                Some Repositories might have a README document with contact details, or another system in place to contribute files easily
            </div>
        </div>
    </div>
    <div class="flash flash-success">
        We hope to introduce one-click upload in baokao once we're out of Early Access.
    </div>
    <br>
    <h4>I want to help improve the baokao web application</h4>
    <p>Pull requests are very much welcome via our <a href="https://github.com/aidswidjaja/baokao" target="_blank">GitHub repository.</a>
    <br>
    <h4>Other questions?</h4>
    <p>If you have any questions, feel free to email <a href="mailto:baokao@adrian.id.au">baokao@adrian.id.au</a>. Thanks for improving baokao - it's greatly appreciated!</p>

</div>

<script src="static/darkmode.js"></script>

<?php include "../include/footer.php"; ?>