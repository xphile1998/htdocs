<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

<h1 class="account-heading">Sign in</h1>

<form method="post">
    <label for="email">Email Address</label>
    <input type="text" id="email" name="clientEmail">

    <label for="password">Password</label>
    <input type="password" id="password" name="clientPassword">

    <input type="submit" value="Sign-in">
    <input type="hidden" name="action" value="Login">
</form>

<a href="/phpmotors/accounts/?action=deliveringRegisterView" id="toreg">Not a member yet?</a>

<?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>