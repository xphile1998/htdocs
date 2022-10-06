<!DOCTYPE html>
<html lang="en-US">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP Motors Home Page</title>
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/normalize.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/main.css">
    <link rel = "stylesheet" media="screen" href = "/phpmotors/css/medium.css">
</head>

<body>
<div id="content_box">
    <!-- PHP call to the HEADER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/header.php'; ?>

    <!-- PHP call to the NAV snippet -->
    <!-- <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/nav.php'; ?> -->
    <nav class="navigation">
        <?php echo $navList; ?>
    </nav>


    <main>
        <h1>Welcome to PHP Motors!</h1>

        <div id="call_to_action">
            <section id="own_delo">
                <h2>DMC Delorean</h2>
                <ul id="DMC_features">
                    <li>3 Cup holders</li>
                    <li>Superman doors</li>
                    <li>Fuzzy dice!</li>
                </ul>
                <img id="own_btn" src="/phpmotors/images/site/own_today.png" alt="Own Today Button">
            </section>
            <div id="delo_pic">
                <img src="/phpmotors/images/delorean.jpg" alt="DMC Delorean Coupe">
            </div>
        </div>

        <div id="bottom_row">
            <div id="article1">
                <h2>Delorean Upgrades</h2>
                <div id="delo_upgrades">
                    <div class="upgrade">
                        <div class="ug_img">
                            <img src="/phpmotors/images/upgrades/flux-cap.png" alt="Flux Capacitor Upgrade">
                        </div>
                        <a href="#">Flux Capacitor</a>
                    </div>
                    
                    <div class="upgrade">
                        <div class="ug_img">
                            <img src="/phpmotors/images/upgrades/flame.jpg" alt="Flame Decal Upgrade">
                        </div>
                    <a href="#">Flame Decals</a>
                    </div>
                    
                    <div class="upgrade">
                        <div class="ug_img">    
                            <img src="/phpmotors/images/upgrades/bumper_sticker.jpg" alt="Bumper Sticker Upgrade">
                        </div>
                        <a href="#">Bumper Stickers</a>
                    </div>
                    
                    <div class="upgrade">
                        <div class="ug_img">
                            <img src="/phpmotors/images/upgrades/hub-cap.jpg" alt="Hub Caps Upgrade">
                        </div>
                        <a href="#">Hub Caps</a>
                    </div>
                </div>
            </div>

            <section id="delo_reviews">
                <h2>DMC Delorean Reviews</h2>

                <ul>
                    <li>"So fast its almost like traveling in time." (4/5)</li>
                    <li>"Coolest ride on the road." (4/5)</li>
                    <li>"I'm feeling Marty McFly!" (5/5)</li>
                    <li>"The most futuristic ride of our day." (4/5)</li>
                    <li>"80's livin and I love it!" (5/5)</li>
                </ul>
            </section>
        </div>
    </main>
    
    <!-- PHP call to the FOOTER snippet -->
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/phpmotors/snippets/footer.php'; ?>

</div>
</body>
</html>