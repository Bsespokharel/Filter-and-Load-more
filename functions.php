<?php 
add_action('wp_ajax_fortius_filter_news_media', 'fortius_filter_news_media');
add_action('wp_ajax_nopriv_fortius_filter_news_media', 'fortius_filter_news_media');
function fortius_filter_news_media(){
  check_ajax_referer( 'ajax_nonce', 'security' );
    
    if ( isset( $_POST['action'] ) ) {
        $type = $_POST['type'];
        $sort = $_POST['sort'];
        $paged = $_POST['paged'];
        if( ($type != 'news-cat-allval') && ($sort == 'article-date' ) ){
            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'category_name' => $type,
                'orderby' => 'date',
                
            );	 
        }
        if( ($type != 'news-cat-allval') && ($sort == 'article-name' ) ){
            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'category_name' => $type,
                'orderby' => 'name',
                
            );	 
        }
        else if ( ($type == 'news-cat-allval') && ($sort == 'article-date' ) ) {

            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'orderby' => 'date',
            );
        }
        else if ( ($type == 'news-cat-allval') && ($sort == 'article-name' ) )  {

            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'orderby' => 'name',
            );
        }
        $news_filter_query = new WP_Query( $args );
        $query_filter_count = $news_filter_query->found_posts;
        if ( $news_filter_query->have_posts() ) {
            echo '<div class="filter-row clearfix">';
                while ( $news_filter_query->have_posts() ) {
                    $news_filter_query->the_post();
                    get_template_part( 'template-parts/new-media/content', 'news-item' );
                }    
            echo '</div>'; 
        }
        else{
            wp_send_json_error();
        } 
        $count_pag = ceil($query_filter_count/9);?>
        <script>
			jQuery("#total_post").val(<?php echo $query_filter_count; ?>);
			jQuery('#total_post').attr('data-readmore_counter', <?php echo $count_pag;?>);
		</script>
        <?php 
        wp_reset_postdata();
    } 

  wp_die();
}
// Infinite Load more
add_action('wp_ajax_fortius_loadmore_news_media', 'fortius_loadmore_news_media');
add_action('wp_ajax_nopriv_fortius_loadmore_news_media', 'fortius_loadmore_news_media');
function fortius_loadmore_news_media(){
  check_ajax_referer( 'ajax_nonce', 'security' );
    
    if ( isset( $_POST['action'] ) ) {
        $type = $_POST['type'];
        $sort = $_POST['sort'];
        $paged = $_POST['paged'];
        if( ($type != 'news-cat-allval') && ($sort == 'article-date' ) ){
            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'category_name' => $type,
                'orderby' => 'date',
                
            );	 
        }
        if( ($type != 'news-cat-allval') && ($sort == 'article-name' ) ){
            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'category_name' => $type,
                'orderby' => 'name',
                
            );	 
        }
        else if ( ($type == 'news-cat-allval') && ($sort == 'article-date' ) ) {

            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'orderby' => 'date',
            );
        }
        else if ( ($type == 'news-cat-allval') && ($sort == 'article-name' ) )  {

            $args = array(
                'post_type'=> 'post',
                'posts_per_page' => 9,
                'paged'	=> isset($_POST['paged']) ? $_POST['paged'] : 1,
                'orderby' => 'name',
            );
        }
        $news_loadmore_query = new WP_Query( $args );
        $query_filter_count = $news_loadmore_query->found_posts;

        if ( $news_loadmore_query->have_posts() ) {
                while ( $news_loadmore_query->have_posts() ) {
                    $news_loadmore_query->the_post();
                    get_template_part( 'template-parts/new-media/content', 'news-item' );
                }    
        }
        else{
            wp_send_json_error();
        }
        $count_pag = ceil($query_filter_count/9);?>
        <script>
			jQuery("#total_post").val(<?php echo $query_filter_count; ?>);
			jQuery('#total_post').attr('data-readmore_counter', <?php echo $count_pag;?>);
		</script>
        <?php 
        wp_reset_postdata();
    } 
  wp_die();
}