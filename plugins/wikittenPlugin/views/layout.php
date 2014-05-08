<?php
// Sanitize html content:
function e($dirty) {
    return htmlspecialchars($dirty, ENT_QUOTES, 'UTF-8');
}
?>

<body>
    <div id="main">
        <a href="http://wikitten.vizuina.com" id="logo" target="_blank" class="hidden-phone">
            <img src="static/img/logo.png" alt="">
            <div class="bubble">Remember to check for updates!</div>
        </a>
        <div class="inner">
            <div class="container-fluid">
                <div class="row-fluid">
                    <div class="span3">
                        <div id="sidebar">
                            <div class="inner">
                                <h2><span><?php echo e(APP_NAME) ?></span></h2>
                                <?php include('tree.php') ?>
                            </div>
                        </div>
                    </div>
                    <div class="span9">
                        <div id="content">
                            <div class="inner">
                                <?php echo $content; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function () {
            $('#logo').delay(2000).animate({
                left: '20px'
            }, 600);
        });
    </script>
</body>
</html>
