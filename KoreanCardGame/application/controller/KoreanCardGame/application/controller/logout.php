<?php
    session_start();
    session_destroy();
//    header("Location: /KoreanLearn/application/view/index.html");
    ?>

<script>
    location.replace('../view/index.html');
</script>
