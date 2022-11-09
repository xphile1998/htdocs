<img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo">
<div class="head_para">
    <div id="welcome">
        <a id="admin_link" href="accounts/" title="Go to account admin page">
            <?php
            if (isset($cookieFirstname)) {
                echo "<span>Welcome, $cookieFirstname!</span>";
            }
            ?>
        </a>
    </div>
    <a id="header_link" href="accounts/?action=deliverLoginView" title="Login or Register with PHP Motors">My Account</a>
</div>