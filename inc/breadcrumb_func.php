<?php

if ( ! defined( 'ABSPATH' ) ) {

	exit; // Exit if accessed directly

}



function the_breadcrumb() {

    echo '<section class="breadcrumb">
    <div class="wrapper">
        <div class="breadcrumb-box d_flex align_items_c">
            <ul class="unlisted d_flex align_items_c">';
                 echo '<li class="breadcrumb-item"><a href="'.get_option('home').'" class="back"><img src="'.get_template_directory_uri().'/assets/images/site/breakcrumb_home.svg" alt="breadcrumb" class="home-icon">עמוד ראשי</a></li>';



        if( is_home() ){

            echo "<span>".get_the_title( get_option( 'page_for_posts' ) )."</span>"; 

        }

        elseif( is_404() ){

            echo "<span>404</span>";

        }

        elseif( is_product() ) {

            $terms  = get_the_terms( get_the_ID(), 'product_cat' );

            $i = 1;

            if ( $terms && ! is_wp_error( $terms ) ) : 

                foreach ( $terms as $term ) :

                    if($i == 1 ) :

                        $link = get_term_link($term);

                        echo "<li class='breadcrumb-item'><a href='{$link}' title='{$term->name}'>{$term->name}</a></li>";

                    endif;

                $i++; endforeach;

            endif;

            echo '<li class="breadcrumb-item active">';

            the_title();

            echo '</li>';

        }
        elseif ( is_singular( 'courses' ) ) {
            echo "<li class='breadcrumb-item'><a href='".get_permalink(708)."'>".get_the_title(708)."</a></li>";
            echo '<li class="breadcrumb-item active">';
            the_title();
            echo '</li>';
        }
        elseif ( is_single() ) {

            echo '<li class="breadcrumb-item active">';

            the_title();

            echo '</li>';

        }

        elseif( is_product_category() ){

            $trail     = '';

            $query_obj = get_queried_object();

            $term_id   = $query_obj->term_id;

            $taxonomy  = get_taxonomy( $query_obj->taxonomy );

         

            if ( $term_id && $taxonomy && get_term_parents_list( $term_id, $taxonomy->name, array( 'inclusive' => false, 'separator'=> '') ) ) {

                $trail .= '<li class="breadcrumb-item">'.get_term_parents_list( $term_id, $taxonomy->name, array( 'inclusive' => false, 'separator'=> '') ).'</li>';

            }



            echo $trail;



            echo '<li class="breadcrumb-item active">';

            woocommerce_page_title();

            echo '</li>';

            

        }

        elseif( is_woocommerce() ){

            echo '<li class="breadcrumb-item active">';

            woocommerce_page_title();

            echo '</li>';

        } 

        

        elseif (is_search()) {

            echo"<li class='breadcrumb-item active'>Search Results"; echo'</li>';

        }



        else{

            echo '<li class="breadcrumb-item active"><a href="javascript:void(0);">';

            echo the_title();

            echo '</a></li>';

        }

   

    echo '</ul></div></div></section>';

}