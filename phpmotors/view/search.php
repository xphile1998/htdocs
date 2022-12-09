<!-- ====================== >>
||                          ||
||  Search View             ||
||                          ||
<< ======================= -->

<!DOCTYPE html>
<html lang="en-US">
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

            <?php
                if (isset($_SESSION['message'])) {
                    echo $_SESSION['message'];
                }
                $_SESSION['message'] = null;
            ?>
            
            <div class="form-container">
                <form  method="post" action="/phpmotors/search/?action=search">
                    <input type="text" name="search" placeholder="Search for..." id="search">
                    <input type="submit" name="searchTxt" value="Search" id="searchBtn">
                </form>
            </div>

            <div class="results-container">
                <h2 class="results">Your results: </h2>
                <div id="article-container">
                    <?php 
                    if (isset($searchDisplay)) {
                        echo $searchDisplay; 
                    }
                    ?>
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