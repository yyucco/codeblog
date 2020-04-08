<?php
if(get_the_category()){
  $cat_meta = get_option("cat_meta_data");
  $cat = get_the_category();
  $cat_id   = $cat[0]->cat_ID;
	$cat_name = $cat[0]->name;
	$cat_slug = $cat[0]->category_nicename;
}	  
?>
	  		<article>
			<div class="cp_card01">	
					<div class="photo">
					<a href="<?php the_permalink(); ?>">
						<div class="photo1" style="background-image: url(
						<?php 
							if (has_post_thumbnail()){
							the_post_thumbnail_url();
							} else { echo "/files/img/dummy/img03.png"; } 
						?>
						">
						</div>
					</a>
					</div><!-- photo -->
					<div class="category"><a href="<?php echo $cat_slug; ?>"><?php echo $cat_name; ?></a></div>	
					<div class="description">
					<a href="<?php the_permalink(); ?>">
						<p class="date"><?php the_modified_date('Y.m.d'); ?></p>
						<h2 class="ttl"><?php the_title(); ?></h2>
						<div class="text"><?php echo mb_substr(strip_tags($post-> post_content),0,200).'…<span class="more">記事を読む</span>'; ?></div>

					</a>
					</div><!-- description -->
			</div>		
			</article>

		