<?php
// Get the carousel
$news_query = new WP_Query( [
    'post_type' => 'post',
    'posts_per_page' => 9,
    'post_status' => 'publish',
    // 'order' => 'asc',
] );
$categories = get_the_category();

$categories = get_categories( array(
    'orderby' => 'name',
    'parent'  => 0
) );
$total_post_count = wp_count_posts( 'post' );
$total_post = $total_post_count->publish;
?>
<div class="filters">
    <div class="container">
        <ul>
            <li>
                <label>Type</label>
                <select class="form-control" id="news-cat">
                    <option name="news-cat"  value="news-cat-allval" >All</option>    
                    <?php foreach ( $categories as $category ) {
                        echo  '<option name="news-cat"  value="' . $category->slug . '" > ' .  $category->name . '</option>';
                    }
                    ?>
                </select>
            </li>
            <!-- end list item -->
            <li>
                <label>Sort By</label>
                <select class="form-control" id="news-sort">
                    <option name="news-sort" value="article-date">By Date</option>
                    <option name="news-sort" value="article-name">Name</option>
                </select>
            </li>
            <!-- end list item -->
        </ul>
    </div>
</div>

<?php if ( $news_query->have_posts() ) { ?>
    <div class="filter-results">
        <div class="container">
            <div class="filter-row clearfix">
                <?php while ( $news_query->have_posts() ) { 
                    $news_query->the_post(); 
                    get_template_part( 'template-parts/content', 'item' );
                } ?>          
            </div>
        </div>
        <div id='loadingDiv' style="display: none;">
            <img src='<?php echo FIP; ?>Spinner-1s-200px.gif' />
            <input type="hidden" id="total_post" value="<?php echo $total_post;?>" data-readmore_counter="<?php echo ceil($total_post/9);?>">
        </div>  
    </div>
<?php }
wp_reset_postdata();
