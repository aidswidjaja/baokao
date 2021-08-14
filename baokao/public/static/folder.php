<head>
  <meta charset="utf-8">
  <meta name="description" content="a free and open-source study resource viewer by aidswidjaja">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:title" content="baokao">
  <meta property="og:type" content="">
  <meta property="og:url" content="https://baokao.adrian.id.au">
  <meta property="og:image" content="">

  <link rel="apple-touch-icon" href="icon.png">

  <link href="http://fonts.cdnfonts.com/css/cascadia-code" rel="stylesheet">
  <script type="text/javascript" src="ready.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/dompurify@2.3.0/dist/purify.min.js"></script>
  <script type="module" src="https://unpkg.com/dark-mode-toggle"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/inter-ui@3.19.2/inter.min.css">
  <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
  <link type="text/css"href="primer.css" rel="stylesheet" />
  <link type="text/css" href="style.css" rel="stylesheet" />
</head>

<body class="no-js" data-color-mode="" data-light-theme="light" data-dark-theme="dark"  prefers-color-scheme="">
<?php 
if (isset($_SERVER['QUERY_STRING'])) {
    global $query;
    $query = str_replace("=", "", htmlspecialchars($_SERVER['QUERY_STRING']));
}

echo <<<HTML
    <div class="content">
        <div class="blankslate">
            <h1>What are you doing?!?!</h1>
            <p>This is a folder (and not a file), so you'll be redirected to the folder UI in just a moment.</p>
        </div>
    </div>
HTML;
?>

<script type="text/javascript" src="../static/darkmode.js"></script>
</body>