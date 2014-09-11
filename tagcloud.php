<?
/*
Template Name: Archivio di tag
*/
?>
<?php get_header(); ?>
<?php get_sidebar(); ?>
<div id="centrecontent" class="column">
<h2>Nuvola di tag (argomenti)</h2>
<?php wp_tag_cloud('smallest=8&largest=20&number=0'); ?>
</div>
<?php include(TEMPLATEPATH . '/rightsidebar-mappa.php'); ?>
<?php get_footer(); ?>