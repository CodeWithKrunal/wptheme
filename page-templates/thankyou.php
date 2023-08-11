<?php
/**
 * Template Name: Thnak you page
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */


get_header(); ?>

<div class="main">

    <div class="detail_page page-nf error_page_thank_page">

        <div class="wrapper dflex">

            <div class="nf_content">

                <?php the_field( '404_page_content_2', 'options' ); ?>

            </div>

        </div>

    </div>

</div>

<?php

get_footer();