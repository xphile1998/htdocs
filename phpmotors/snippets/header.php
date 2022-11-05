<img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo">
<div class="head_para">
    <div id="welcome">
        <?php
        if (isset($cookieFirstname)) {
            echo "<span>Welcome, $cookieFirstname!</span>";
        }
        ?>
    </div>
    <a id="header_link" href="accounts/?action=deliverLoginView" title="Login or Register with PHP Motors">My Account</a>
</div>