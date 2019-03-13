<?php 
global $post;
$image_url = aq_resize( get_the_post_thumbnail_url($post->ID, 'full' ), 567, 463, true, true, true );
$thumbnail_id = get_post_thumbnail_id( $post->ID );
$alt = get_post_meta($thumbnail_id, '_wp_attachment_image_alt', true);?>
<div class="filter-item">
    <div class="filter__thumbnail">
        <?php if ( has_post_thumbnail() ) { ?>
            <div class="filter-thumb">
                <img src="<?php echo $image_url;?>" alt="<?php echo $alt; ?>" class="img-fluid">
            </div>
            <div class="filter-caption filter--caption--overlay">
        <?php }
        else{
            echo '<div class="filter-caption">';
        } ?>
            <?php the_title( '<h3>', '</h3>' );  ?>
            <div class="date"><?php echo get_the_date('d F Y'); ?></div>
            <?php if ( has_post_thumbnail() ) { ?>
                <a href="<?php the_permalink(); ?>" class="read-more"><img src="<?php echo FIP; ?>filter-white.png"></a>
            <?php } 
            else {
                echo ' <a href="<?php the_permalink(); ?>" class="read-more"><img src="'. FIP .'filter-gray.png"></a>';
            } ?>
        </div>
    </div>
</div>