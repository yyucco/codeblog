








		<article>
		<div class="cp_card01">
				<!-- photo -->	
				<div class="photo">
				<a href="/">
					<div class="photo1" style="background-image: url(
					<?php if( has_post_thumbnail() ): ?>	
			        <?php the_post_thumbnail('thumbnail'); ?>
			        <?php else: echo '/files/img/common/noimage.jpg'; ?>
					);">
          			<?php endif; ?>	
					</div>
				</a>
				</div>
				<!-- /photo -->
				<!-- カテゴリー -->
				 <?php if( has_category() ): ?>
				<div class="category"><a href="">           
                <?php $postcat=get_the_category(); echo $postcat[0]->name; ?></a></div>	
            	<?php endif; ?>
            	<!-- /カテゴリー -->	
				<div class="description">
				<a href="/">
					<p class="date">2018.06.21</p>
					<h2 class="ttl">記事タイトル</h2>
					<p class="text">テキストテキストテキストテキストテキストテキストテキスト...</p>
				</a>
				</div><!-- description -->
		</div>		
		</article>


      <li>
        <a href="<?php the_permalink(); ?>">
          <!--順位-->
          <span class="rank-count r-count<?php echo $loopcounter; ?>">
           <?php echo $loopcounter; ?>
          </span>
          <!--サムネイル画像の追加-->

          <div class="sidekiji-text">
            <?php the_title(); ?>
            <br>
            <!--カテゴリ-->
              <span class="cat-data">
               <?php if( has_category() ): ?>
                <?php $postcat=get_the_category(); echo $postcat[0]->name; ?>
            <?php endif; ?></span>
          </div>
        </a>
      </li>
      <?php endwhile; ?>
    <?php wp_reset_postdata(); ?>

