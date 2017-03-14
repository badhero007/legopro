<?php
use backend\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<link href="adminex/html/css/style.css" rel="stylesheet">
<link href="adminex/html/css/style-responsive.css" rel="stylesheet">
<body class="sticky-header">
<!--common-->


<section>
        <!-- left side start-->
        <div class="left-side sticky-left-side" style="overflow: hidden;" tabindex="5000">
            <div class="left-side-inner">
                ...
            </div>
        </div>
        <!-- left side end-->

        <!-- main content start-->
        <div class="main-content" >
            <?= $content ?>

        </div>

        <!-- main content end-->
</section>

<!-- Placed js at the end of the document so the pages load faster -->
<!--<script src="adminex/html/js/jquery-1.10.2.min.js"></script>-->
<script src="adminex/html/js/jquery-ui-1.9.2.custom.min.js"></script>
<script src="adminex/html/js/jquery-migrate-1.2.1.min.js"></script>
<script src="adminex/html/js/bootstrap.min.js"></script>
<script src="adminex/html/js/modernizr.min.js"></script>
<script src="adminex/html/js/jquery.nicescroll.js"></script>


<!--common scripts for all pages-->
<script src="adminex/html/js/scripts.js"></script>

</body>