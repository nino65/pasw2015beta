<?
/*
Template Name: Mappa
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="centrecontent" class="column">
<h2>Mappa del sito</h2>
 <h3>Pagine</h3>
            
                                <ul>
                                    <?php wp_list_pages('depth=1&sort_column=menu_order&title_li=' ); ?>		
                                </ul>		
    
                                <br /><br />
        
                                <h3>Categorie</h3>
            
                                <ul>
                                    <?php wp_list_categories('title_li=&hierarchical=0&show_count=1') ?>	
                                </ul>								
                                
                                <?php
                        
                                $cats = get_categories();
                                foreach ($cats as $cat) {
                        
                                query_posts('cat='.$cat->cat_ID);
                    
                                ?>
                            
                                <br /><br />
                                <h3><?php echo $cat->cat_name; ?></h3>
                    
                                <ul>	
                                        <?php while (have_posts()) : the_post(); ?>
                                        <li style="font-weight:normal !important;"><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> - Commenti (<?php echo $post->comment_count ?>)</li>
                                        <?php endwhile;  ?>
                                </ul>
                        
                                <?php } ?>	
</div>
<?php include(TEMPLATEPATH . '/rightsidebar-mappa.php'); ?>
<?php get_footer(); ?>