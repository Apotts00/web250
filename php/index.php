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
	<?php include 'components/footer.html' ?>
</body>
</html>









