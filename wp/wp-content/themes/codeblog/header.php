
<header>
	<div class="headerinner">
		<div id="headerLogo"><a href="/"><img src="/files/img/common/logo2.png" alt=""></a></div>
		<nav>

			<div class="navbar">
				<div class="navBtn">
					<span class="cp_bar"></span>
				</div><!-- navBtn -->
				<ul class="inner">
					<li class="navLogo pcNone"><a href="/"><img src="/files/img/common/logo2.png" alt=""></a></li>
			      <?php if ( has_nav_menu( 'category_menu' ) ) : ?>
			        <?php wp_nav_menu(array(
				          'theme_location' => 'category_menu',
						  'depth' => 1,
					      'items_wrap' => '%3$s',
					      'container' => false,
			          )
			        ); ?>
			       <?php endif  ?>
				</ul>
			</div><!-- navbar -->

			<div class="ovarray"></div>
		</nav>
	</div><!-- headerinner -->
</header>