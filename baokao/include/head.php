<!doctype html>
<html class="no-js" lang="">

<!--
    baokao is available at https://github.com/aidswidjaja/baokao
    and is distributed under the Apache 2.0 license, available
    at https://www.apache.org/licenses/LICENSE-2.0
-->

<head>
  <meta charset="utf-8">
  <meta name="description" content="A free and open-source study resource viewer by aidswidjaja.">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <meta property="og:site_name" content="baokao">
  <meta property="og:title" content="baokao ~ study resources">
  <meta property="og:type" content="website">
  <meta property="og:description" content="A free and open-source study resource viewer by aidswidjaja.">
  <meta property="og:image" content="https://baokao.adrian.id.au/baokao.png">
  <meta property="og:keywords" content="baokao,past papers,study notes,study material,HSC,NSW HSC,aidswidjaja">
  <meta property="og:url" content="https://baokao.adrian.id.au">
  <meta name="theme-color" content="#2188ff">
  <link type="application/json+oembed" href="../public/static/oembed.json" />

  <link rel="apple-touch-icon" href="baokao.png">
  <link rel="icon" type="image/png" href="baokao.png">

  <style>
    .frame-example {
      min-height: 500px;
    }
  </style>
  <!-- primer box overlay - not supposed to use in prod, but I'm going to because it's the only one that works -->
  <link href="https://unpkg.com/@github/details-dialog-element/dist/index.css" rel="stylesheet" />
  <script type="text/javascript" src="static/ready.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/dompurify@2.3.0/dist/purify.min.js"></script>
  <script type="module" src="https://unpkg.com/dark-mode-toggle"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/inter-ui@3.19.2/inter.min.css">
  <script src="https://cdn.jsdelivr.net/npm/clipboard@2.0.8/dist/clipboard.min.js"></script>
  <link type="text/css" href="static/primer.css" rel="stylesheet" />
  <link type="text/css" href="static/style.css" rel="stylesheet" />

  <!-- Panelbear Analytics - We respect your privacy -->
  <script async src="https://cdn.panelbear.com/analytics.js?site=5g6zJ4xSF7H"></script>
  <script>
    window.panelbear = window.panelbear || function() {
      (window.panelbear.q = window.panelbear.q || []).push(arguments);
    };
    panelbear('config', {
      site: '5g6zJ4xSF7H'
    });
  </script>

</head>

<body class="no-js" data-color-mode="" data-light-theme="light" data-dark-theme="dark" prefers-color-scheme="" style="visibility: hidden;">
  <script>
    document.querySelector('body').classList.remove('no-js');
  </script>
  <noscript>
    <div class="flash mt-3 flash-error">
      <svg class="octicon octicon-container" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16 16" width="16" height="16">
        <path fill-rule="evenodd" d="M2.343 13.657A8 8 0 1113.657 2.343 8 8 0 012.343 13.657zM6.03 4.97a.75.75 0 00-1.06 1.06L6.94 8 4.97 9.97a.75.75 0 101.06 1.06L8 9.06l1.97 1.97a.75.75 0 101.06-1.06L9.06 8l1.97-1.97a.75.75 0 10-1.06-1.06L8 6.94 6.03 4.97z"></path>
      </svg>
      <strong> You don't have JavaScript enabled!</strong> You'll probably experience errors trying to access baokao. Make sure your network connection is stable. If you're in a school network, ask your network administrator to whitelist <strong>baokao.adrian.id.au</strong> so you can use the site properly :)
    </div>
  </noscript>

  <?php require '../../vendor/autoload.php'; ?>