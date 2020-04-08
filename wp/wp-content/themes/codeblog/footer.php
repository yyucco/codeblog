<section class="ranking">
<div class="inner sec01">
<h2 class="rankingTtl"><i class="fas fa-crown"></i>
	<span class="txt">人気の記事</span></span></h2>	
<div class="col04 spcol02">
<?php get_the_ID();//記事のPV情報を取得する
  $args = array('meta_key'=> 'post_views_count',//投稿数をカウントするカスタムフィールド名
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
                'posts_per_page' => $number
  );
  $my_query = new WP_Query( $args );?>
  <?php while ( $my_query->have_posts() ) : $my_query->the_post(); $loopcounter++; ?>

  <?php get_template_part('loop');?>
       <?php endwhile; ?>
    <?php wp_reset_postdata(); ?> 
</div>
</section>
</div><!-- ranking -->
<footer>


	<div class="inner">
			<div class="navbarfooter">
				<ul class="inner">
<?php wp_list_categories( ); ?>
				</ul>
			</div><!-- navbarfooter -->
		
	</div><!-- inner -->
	

</footer>
<?php wp_footer(); ?>