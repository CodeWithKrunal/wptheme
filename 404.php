<?php

/**

 * The template for displaying 404 pages (not found)

 *

 * @link https://codex.wordpress.org/Creating_an_Error_404_Page

 *

 * @package WordPress

 */



get_header(); ?>

<div class="main">

    <div class="detail_page page-nf error_page_thank_page">

        <div class="wrapper dflex">

            <div class="nf_content">

                <?php the_field( '404_page_content', 'options' ); ?>

            </div>

        </div>

    </div>

</div>

<?php

get_footer();