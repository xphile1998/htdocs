<!DOCTYPE html>
<html lang="en-US">
<!-- /* comment */ -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Page</title>
    <link rel="stylesheet" media="screen" href="/phpmotors/css/normalize.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/main.css">
    <link rel="stylesheet" media="screen" href="/phpmotors/css/medium.css">
</head>

<body>
    <div id="content_box">
        <header>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>
        </header>

        <nav class="navigation">
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?>
        </nav>

        <main>
            <h1>Search Our Inventory</h1>
            <div class="form-container">
                <form action="../search/?action='search'" method="post">
                    <input type="text" name="search" placeholder="Search for..." id="searchbox">
                    <button type="submit" name="submitSearch" value="search" id="searchBtn">Search</button>
                </form>
            </div>

            <div class="results-container hidden">
                <h2 class="results">Your results: </h2>
                <div class="article-container">
                    
                </div>
            </div>
        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>