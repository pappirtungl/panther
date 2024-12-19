
<?php
get_header();
?>
<article class="content px-3 py-5 p-md-5 hm">
<div class="container">
    <?php

        if( have_posts() ) {
            while( have_posts() ) {
                the_post();
                the_content();
            }
        }

    ?>
    </div>
</article>
<?php
get_footer();
?>