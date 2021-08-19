<?php include "../include/head.php"; ?>
<?php include "../include/navbar.php"; ?>
<?php include "../include/env.php"; ?>
<script src="static/darkmode.js"></script>
<script>
    document.getElementById("nav-community").setAttribute("aria-current", "page")
</script>
<title>Community | baokao</title>

<div class="content">
    <h1>Community</h1>
    <ul class="content">
        <li>Due to technical limitations with our comment box provider <a href="https://cusdis.com/">Cusdis</a>, all comments across the site need to be manually approved.</li>
        <li>We are waiting for <a href="https://github.com/djyde/cusdis/issues/105#issuecomment-845931733">Cusdis to improve support for custom theming</a>, but until then, comment boxes may not work properly in Dark Mode.</li>
        <li>The Community tab allows for general commenting so please be nice!</li>
    </ul>
    <?php
    echo <<<HTML
        <div id="cusdis-parent">
           <div id="cusdis-wrapper">
                <div id="cusdis_thread" data-host="https://cusdis.com" data-app-id="$cusdis_app_id" data-page-id="community" data-page-url="https://baokao.adrian.id.au/community" data-page-title="Community">
                    <script async src="https://cusdis.com/js/cusdis.es.js"></script>
                </div>
            </div>
        </div>
HTML;
    ?>
</div>

<?php include "../include/footer.php"; ?>