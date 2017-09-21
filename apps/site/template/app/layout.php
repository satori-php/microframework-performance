<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?= $title ?></title>
    </head>
    <body>
        <div class="wrapper">
            <header>
                <div class="container">
                    <div class="logo">
                        <a href="/"><?= $site_name ?></a>
                    </div>
                    <nav>
                        <ul>
                            <li>
                                <a href="/unknown">Unknown</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </header>
            <main>
                <div class="container">
                    <?= $this->inset('content') ?>
                </div>
            </main>
            <footer>
                <div class="container">
                    <div class="footer-section">
                        <div class="copyright">Copyright (C) <?= $copyright ?></div>
                    </div>
                </div>
            </footer>
        </div>
    </body>
</html>
