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
    <!-- <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        function searchq() {
            var searchTxt = $("input[name='search']").val();

            $.post("search.php", {searchVal: searchTxt}, function(output) {
                $("#article-container").html(output);
            });
        }
    </script> -->
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
                <!-- <form action="../view/search.php" method="post"> -->
                    <input type="text" name="search" placeholder="Search for..." id="searchbox" onkeydown="searchq();">
                    <button type="submit" name="submitSearch" value="search" id="searchBtn">Search</button>
                </form>
            </div>

            <div class="results-container hidden">
                <h2 class="results">Your results: </h2>
                <div id="article-container"></div>
            </div>
        </main>

        <hr>
        <footer>
            <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>
        </footer>

    </div>
</body>

</html>