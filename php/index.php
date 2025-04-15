<?php
    // get filename of the page + name of page to append to tile tag
    if (isset( $_GET["p"])) 
    {
        $pageFileName = $_GET["p"] . ".html";
        $pageTitle = ucfirst($_GET["p"]);
    }
    else
    {
        $pageFileName = "home.html";
        $pageTitle = 'Home';
    }
    $pagePath = "contents/$pageFileName";
?>
<!DOCTYPE html>
<html lang="en">
<head> 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adrienne Love 🐞 Ambitious Ladybug</title>
    <!-- Link to CSS files -->
    <link href="styles/default.css" rel="stylesheet" type="text/css"> 
	<script src="https://lint.page/kit/880bd5.js" crossorigin="anonymous"></script>
</head>
<body>
	<header>
<h1>Adrienne Love's Ambitious Ladybug 🐞 WEB250 🐞 Static Site</h1>

<nav>
  <ul class="nav-menu">
    <li><a href="index.html">Home</a></li>
    <li><a href="introduction.html">Introduction</a></li>
    <li><a href="contract.html">Contract</a></li>
    <li><a href="http://alove.great-site.net//">PHP Site</a></li>
    <li><a href="intro_form.html">Intro Form</a></li>
    <li class="dropdown">
      
      <a href="#">External Pages</a>
      <ul class="dropdown-menu">
        <li><a href="multipage_sites/superduper_static/index.htm">Superduper Static</a></li>
        <li><a href="http://alove.great-site.net/multipage_sites/superduper_php/">Superduper PHP</a></li>
        <li><a href="joyofphp/src/">Joy of PHP</a></li>
      </ul>
    </li>
  </ul>
</nav>

</header>
<main>
    <!-- Load page content from selected file -->
    <h2><?php echo strtoupper($pageTitle)?></h2> 
    <?php include($pagePath)?>
</main>
	 <footer>
        <nav>
            <a href="https://github.com/Apotts00">GitHub</a>&nbsp;
            <a href="https://apotts00.github.io/">GitHub.io</a>&nbsp;
            <a href="https://apotts00.github.io/web115/">WEB115.io</a>&nbsp;
            <a href="https://apotts00.github.io/web215/">WEB215.io</a>&nbsp;
            <a href="https://apotts00.github.io/web250/">WEB250.io</a>&nbsp;
            <a href="https://www.freecodecamp.org/apotts00">freeCodeCamp</a>&nbsp;
            <a href="https://www.codecademy.com/profiles/adriennepotts">Codecademy</a>&nbsp;
            <a href="https://jsfiddle.net/u/apotts00/fiddles/">JSFiddle</a>&nbsp;    
            <a href="https://www.linkedin.com/in/adrienne-potts/">LinkedIn</a>&nbsp;
        </nav>
    <p>Site built by <a href="https://apotts00.github.io/web250/adriennelove.html"><em>Adrienne Love</em></a>. All rights reserved. ©2025 Certified in 
        <a class="certification" href="https://www.freecodecamp.org/certification/apotts00/responsive-web-design" target="_blank"><em>RWD</em></a> and 
        <a class="certification" href="https://www.freecodecamp.org/certification/apotts00/javascript-algorithms-and-data-structures-v8" target="_blank"><em>JADS</em></a>
    </p>
        <p>Play Safe, Laugh Hard, Grow Together!</p>
    </footer>








