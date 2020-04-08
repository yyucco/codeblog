
<?php 
//カウントしてカスタムフィールドに表示
	if( !is_user_logged_in() && !is_bot() ) { 
		set_post_views( get_the_ID() ); 
	} 
?>



<!DOCTYPE html>
<html lang="ja" class="noJS">

<head>
<?php wp_head(); ?>
<meta charset="utf-8">
<meta name="Description" content="">

<title>新着情報｜サイト名を入れて下さい</title>

<?php include( TEMPLATEPATH . '/head.php' ); ?>

<!-- ここからページのみ -->
<link rel="stylesheet" type="text/css" href="/files/css/blogStyle.css" media="all">
<!-- ここまでページのみ -->


</head>

<body >
<div id="container">
<?php get_header(); ?>

<div id="mv" class="sec01">
	<div class="inner">
		<div class="txt">
			<ul id="tagArea">
				<li class="category"><?php the_category(); ?></li>
				<?php
				  $posttags = get_tags();
				  if ($posttags) {
				    foreach($posttags as $tag) {
				      echo '<li><a href="'. get_tag_link($tag->term_id) .'">' . $tag->name . '</a></li>';
				    }
				  }
				?>
			</ul>
			<div id="update">
				<p><?php the_modified_date('Y.m.d'); ?></p>
				<p><?php the_time('Y.m.d'); ?></p>				
			</div>
			<h1 class="title01"><?php the_title(); ?></h1>
			<p class="lead">
				<?php 
				echo get_post_meta($post->ID, 'description_txt', true );
				echo get_post_meta($post->ID, 'item_lead', true );
				?>
			</p>
		</div>
		<div class="img">
			<img src="/files/img/dummy/img03.png" alt="">
		</div><!-- img -->
	</div>
</div><!-- mv -->


<div id="content">
	<div class="inner"> 
	<!-- main -->
	<div id="main">
		<div id="mokuji" class="sec01">
			<p class="ttl">もくじ</p>
			<div class="mokujiList">
				<ul>
					<li><a href="#">h2タイトルが入ります</a></li>
					<li><a href="#">h2タイトルが入ります</a></li>
					<li><a href="#">h2タイトルが入ります</a></li>
					<li><a href="#">h2タイトルが入ります</a></li>
				</ul>
			
			</div>
		</div><!-- mokuji -->
		
		<div class="pr01 sec01">
			<img src="/files/img/dummy/img04.png" alt="">
		</div>

	  <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
      <section class="content">
	    <?php the_content(); ?>
      </section>
	  <?php endwhile; endif; ?>


		<section class="sec01style02" id="anc01">

			<h2 class="title02"><span>title02がはいります</span></h2>

			<div class="sec02">
				<div class="txt">
					<p>テキストテキストテキスト<span class="strong">強調テキスト</span>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<p>テキストテキストテキストテキストテキストテキストテキストテキスト<code title="線の右">border-right: none;</code>テキストテキストテキストテキストテキストテキストテキスト<kbd>⌘</kbd>+<kbd>N</kbd></p>
				</div>
				<div class="txt">
					<p>テキストテキストテキスト<span class="strong">強調テキスト</span>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
				</div>
			</div><!-- sec02 -->
			<div class="sec02">
				<div class="sec03">
					<h3 class="title03">title03がはいります</h3>
					<div class="imgSec01">
						<div class="img imgL spFlClear w20per">
							<img src="/files/img/dummy/img03.png" alt="ダミー画像">
						</div>
						<div class="txt">
							<p>テキストテキストテキストテテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
							<p>テキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						</div>
					</div><!-- imgSec01 -->
				</div><!-- sec03 -->

				<div class="sec03">
					<h4 class="title04">title04がはいります</h4>
					<div class="txt">
						<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
						<p>テキストテキストテキスト</p>
					</div>
				</div><!-- sec03 -->

				<div class="sec03">
					<h3 class="title05Wrap"><span class="title05">title05がはいります</span></h3>
					<div class="img">
						<img src="/files/img/dummy/img03.png" alt="ダミー画像">
					</div>
				</div><!-- sec03 -->

				<div class="sec03">
					<ul class="col04 spcol02">
						<li>
							<div class="img">
								<img src="/files/img/dummy/img03.png" alt="ダミー画像">
							</div>
							<div class="txt">
								<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
								<p>テキストテキストテキスト</p>
							</div>
						</li>
						<li>
							<div class="img">
								<img src="/files/img/dummy/img03.png" alt="ダミー画像">
							</div>
							<div class="txt">
								<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
								<p>テキストテキストテキスト</p>
							</div>
						</li>
						<li>
							<div class="img">
								<img src="/files/img/dummy/img03.png" alt="ダミー画像">
							</div>
							<div class="txt">
								<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
								<p>テキストテキストテキスト</p>
							</div>
						</li>
						<li>
							<div class="img">
								<img src="/files/img/dummy/img03.png" alt="ダミー画像">
							</div>
							<div class="txt">
								<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
								<p>テキストテキストテキスト</p>
							</div>
						</li>
					</ul>
				</div><!-- sec03 -->

				<div class="point sec03">
					<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<p>テキストテキストテキスト</p>
				</div>
				<div class="reference sec03">
					<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
					<p>テキストテキストテキスト</p>
				</div>
					<div class="sec03 col02">
					<div class="col">
						<p class="ttl html">html</p>			
						<div class="codearea">
<pre class="prettyprint lang-html linenums">

<div class="sec03">
	<h4 class="title04">title04がはいります</h4>
	<div class="txt">
		<p>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト</p>
		<p>テキストテキストテキスト</p>
	</div>
</div>
</pre>
						</div><!-- codearea -->
					</div><!-- col -->

					<div class="col">
						<p class="ttl css">css</p>			
						<div class="codearea">
<pre class="prettyprint lang-css linenums">
.img {
  width: 47%;
  margin-right: 60px;  margin-right: 60px;
  margin-top: 60px;
  float: left;
}
.img {
  text-align: center;
}
.img {
  text-align: center;
}</pre>
						</div><!-- codearea -->
					</div><!-- col -->
					</div><!-- sec03 -->

			</div><!-- sec02 -->

		</section><!-- sec01 -->
		<section class="relationpost col02 spcolClear sec01">
			<article>
			<div class="cp_card02">	
				<a href="/">
				<div class="photo">
					<div class="photo1" style="background-image: url(/files/img/dummy/img03.png);"></div>
				</div><!-- photo -->
				<div class="description">
					<h2 class="ttl">記事タイトル</h2>
				</div><!-- description -->
				</a>
			</div>		
			</article>
			<article>
			<div class="cp_card02">	
				<a href="/">
				<div class="photo">
					<div class="photo1" style="background-image: url(/files/img/dummy/img03.png);"></div>
				</div><!-- photo -->
				<div class="description">
					<h2 class="ttl">記事タイトル</h2>
				</div><!-- description -->
				</a>
			</div>		
			</article>
		</section><!-- relationpost -->	
		<div class="btnWrap01">
			<a href="#" class="btn01">カテゴリー一覧に戻る</a>
		</div>

	</div>
	<!-- /main -->


</div><!-- inner -->






</div>
<!-- /content -->
</div><!-- /container -->

<?php get_footer(); ?>
</body>
</html>