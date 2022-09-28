<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Server Error</title>
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/normalize.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/main.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/medium.css">
</head>

<body>
<div id="content_box">
    <!-- PHP call to the HEADER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    <!-- PHP call to the NAV snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>

    <main>
        <h1>Server Error</h1>
        <p>Sorry our server seems to be experiencing some technical difficulties. Please check back later.</p>
    </main>
    
    <!-- PHP call to the FOOTER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</div>
</body>
</html>