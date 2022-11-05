<img src="/phpmotors/images/site/logo.png" alt="PHP Motors Logo">
<div class="head_para">
    <?php
    if (isset($cookieFirstname)) {
        echo "<span>Welcome $cookieFirstname</span>";
    }
    ?>
    <a href="accounts/?action=deliverLoginView" title="Login or Register with PHP Motors">My Account</a>
</div>