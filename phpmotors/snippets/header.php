<img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo">
<div class="head_para">
    <div id="welcome">
        <a id="admin_link" href="accounts/" title="Go to account admin page">
            <?php
            // Check if the firstname cookie exists, get its value
            // if (isset($_COOKIE['firstname'])) {
            //     $cookieFirstname = filter_input(INPUT_COOKIE, 'firstname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            // }

            // if (isset($cookieFirstname)) {
            //     echo "<span>Welcome, $cookieFirstname!</span>";
            // }

            if (isset($_SESSION['loggedin'])) { ?>
                <span>Welcome, <?php echo $_SESSION['clientData']['clientFirstname']; ?></span>
            <?php } ?>
        </a>
    </div>
    <div id="header_link">
        <?php
        if (isset($_SESSION['loggedin'])) {
        ?>
            <a href="/phpmotors/accounts/?action=logout">Logout</a>
        <?php } else { ?>
            <a href="/phpmotors/accounts/?action=deliverLoginView" title="Login or Register with PHP Motors">My Account</a>
        <?php } ?>
    </div>
    <div id="searchLink">
        <script src="https://kit.fontawesome.com/a5084cfc04.js" crossorigin="anonymous"></script>
        <a href="/phpmotors/search/?action=default" title="Search our inventory"><i class="fa-solid fa-magnifying-glass"></i></a>
    </div>
</div>