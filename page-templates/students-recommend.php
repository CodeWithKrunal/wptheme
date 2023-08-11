<?php
/**
 * Template Name: Students Recommend
 *
 * @package WordPress
 * @subpackage morekoren
 * @since morekoren 1.0
 */
get_header(); ?>
<?php if(get_field('banner_image') || get_field('banner_title') || get_field('banner_sub_title')): ?>
<!-- inner banner section -->
<section class="banner inner-banner-section" style="background-image: url('<?php echo get_field('banner_image')['url'];?>');">
    <div class="wrapper">
        <?php if(get_field('banner_title')): ?>
        <h1><?php echo get_field('banner_title');?></h1>
        <?php endif; ?>
        <?php if(get_field('banner_sub_title')): ?>
        <h2><?php echo get_field('banner_sub_title');?> </h2>
        <?php endif; ?>
    </div>
</section>
<!-- inner banner section end -->
<?php endif; ?>

<?php the_breadcrumb();?>

<?php 
    $page_content   = get_field('page_content');
    $add_teacher    = get_field('add_teacher');
    $buttonmain     = get_field('button');
    $buttontext     = get_field( 'option_button_text' );
?>

<!-- students recommend start -->
<section class="students-recommend-section after-breadcrumb-section">
    <div class="wrapper">
        <div class="our-course-box text-right w-100">
            <div class="course-heading-area">
                <h2 class="h2 h2_right"><?php the_title(); ?></h2>
                <?php if ( $page_content ) : ?>
                    <div class="course-detail mr-0">
                        <?php echo $page_content; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>


<?php 

 if( get_query_var('paged') ) {
  $page = get_query_var( 'paged' );
} else {
  $page = 1;
}  
                    $row= 0;
                    $students_per_page  = 5;
                    $students = get_field( 'add_students_comments' );
                    $total_students = count( $students );
                    $pages = ceil( $total_students / $students_per_page );
                    $min = ( ( $page * $students_per_page ) - $students_per_page ) + 1;
                    $max = ( $min + $students_per_page ) - 1;
?>
        <?php if( have_rows('add_students_comments') ): ?>
            <div class="students-comment-box-list">
        <?php 
            while ( have_rows('add_students_comments') ) : the_row();
                $title = get_sub_field('title');
                $content = get_sub_field('content');
                $button = get_sub_field('button');
            ?>                   
<?php
$row++;
                        // Ignore this students if $row is lower than $min
                        if($row < $min) { continue; }
                        if($row > $max) { break; }  ?>
	
                <div class="students-comment-box">
                    <div class="comment-icon">
                        <img src="<?php echo get_template_directory_uri() ?>/assets/images/site/comment_icon.svg" alt="comment-icon">
                    </div>
                    <div class="comment-info">
                        <a href="javascript:;" class="close-para-icon"><img src="<?php echo get_template_directory_uri() ?>/assets/images/site/close_para_icon.svg" alt="close-icon"></a>
                        <h3 class="student_name"><?php echo $title; ?></h3>
                        <div class="comment-lines">
                            <?php echo $content; ?>
                        </div>
                        <div class="read-more-link text-left"><a class="read_con" href="javascript:;">קרא עוד</a></div>
                        
                    </div>
                </div>
            <?php endwhile; ?>
			<?php
			// Pagination
   echo paginate_links( array(
							'base' => get_permalink() . 'page/%#%' . '/',
							'format' => '?paged=%#%',
							'current' => $page,
							'total' => $pages
                            ) );
  ?>
            
            </div>
        <?php endif; ?>
        <?php 
            if ($buttonmain) {
                $buttonmain_tar          = ($buttonmain["target"])? $buttonmain["target"]:"_self";
                echo '<div class="opinion-link text-center"><span class="btmn_text">'.$buttontext.'</span><a class="modal-toggle" href="'.$buttonmain["url"].'" target="'.$buttonmain_tar.'">'.$buttonmain["title"].'</a></div>';
            }
        ?>
    </div>
</section>
<!-- students recommend stop -->



<?php if(get_field('good_to_know_title') || get_field('good_to_know_content')):?>
<section class="radiates_blog inner-radiates-blog radiates_blog_new">
    <div class="wrapper">
        <div class="radistes-blog-content">
            <?php if(get_field('good_to_know_title')):?>
            <h3 class="bg-small white_bg"><?php echo get_field('good_to_know_title');?></h3>
            <?php endif;?>
            <?php if(get_field('good_to_know_content')):?>
            <?php echo get_field('good_to_know_content');?>
            <?php endif;?>
        </div>
    </div>
</section>
<?php endif;?>

<?php
$our_courses_title  = get_field('our_courses_title', false, false);
$show_courses       = get_field('show_courses');

if ($show_courses) {
if ($our_courses_title || have_rows('our_courses', )) { ?>
    <section class="our_courses suggestion-section">
        <div class="wrapper">
            <?php if ( $our_courses_title ) : ?>
            <h2 class="h2"><?php echo $our_courses_title; ?></h2>
            <?php endif; ?>
            <?php if( have_rows('our_courses', ) ): ?>
                <div class="row suggestion-box-area">
            <?php 
                while ( have_rows('our_courses', ) ) : the_row();
                    $courses_image = get_sub_field('courses_image');
                    $courses_title = get_sub_field('courses_title');
                ?>                            
                    <div class="col-4 suggestion-box">
                        <div class="content-box">
                            <?php if ( $courses_image ) : ?>
                                <div class="box-img"><img src="<?php echo $courses_image['url']; ?>" alt="suggestion-box"></div>
                            <?php endif; 
                            if ($courses_title) {

                                $courses_title_tar          = ($courses_title["target"])? $courses_title["target"]:"_self";
                                echo '<a class="bg-small" href="'.$courses_title["url"].'" target="'.$courses_title_tar.'">'.$courses_title["title"].'<img src="'.get_template_directory_uri().'/assets/images/site/white_arrow.svg" alt="white_arrow"></a>';                                
                            }
                            ?>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
            <?php endif; ?>
        </div>
    </section>
<?php } } ?>

<?php if(get_field('want_study')): ?>
<?php get_template_part('template-parts/page/want-study');  ?>
<?php endif; ?>

   <div class="student-recommdation-form">
      <div class="modal-overlay modal-toggle"></div>
        <div class="modal-wrapper modal-transition">
            <div class="modal-header">
                <button class="modal-close modal-toggle">
                    <img src="<?php echo get_template_directory_uri();?>/assets/images/site/close_icon.svg" alt="">
                </button>
                <?php if(get_field('form_title')): ?>
                <h2 class="modal-heading"><?php echo get_field('form_title');?></h2>
                <?php endif;?>
            </div>
            <div class="modal-body">
                <div class="modal-content">
                    <?php 
                                 $posts = get_field('form');
                                 if( $posts ): 
                                     foreach( $posts as $p ): // variable must NOT be called $post (IMPORTANT) 
                                           $cf7_id= $p->ID;
                                            echo do_shortcode( '[contact-form-7 id="'.$cf7_id.'" ]' ); 
                                      endforeach;     
                                endif;                   
                            ?>
                </div>
            </div>
        </div>
   </div>

<?php get_footer(); ?>

<script>

    jQuery(document).ready(function(){
        jQuery('.students-comment-box .read_con').on('click', function(){
            $(this).parent('.comment-info').find('.comment-lines').addClass('show')
        });
    });
</script>