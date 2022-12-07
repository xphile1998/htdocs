<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script type="text/javascript">
        function searchq() {
            var searchTxt = $("input[name='search']").val();

            $.post("search.php", {searchVal: searchTxt}, function(output) {
                $("#output").html(output);
            });
        }
    </script>

</head>

<body>
    <form action="index.php" method="post">
        <input type="text" name="search" placeholder="Search for..." onkeydown="searchq();">
        <input type="submit" value="Search">
    </form>

    <div id="output">

    </div>
</body>

</html>