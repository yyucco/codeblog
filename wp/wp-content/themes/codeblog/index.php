<!DOCTYPE html>
<html lang="ja" class="noJS">
<head>
<?php include( TEMPLATEPATH . '/head.php' ); ?>

<!-- ここからページのみ -->
<link rel="stylesheet" type="text/css" href="/files/css/postlist.css" media="all">
<!-- ここまでページのみ -->

</head>

<body >
<div id="container">
<?php get_header(); ?>


<div id="content">
	<div class="inner">
	<!-- main -->
	<div id="main">
		<h1 class="title01 alnC">title01：記事タイトルがここに入ります</h1>

		<div class="postlist col04 spcol02">

<?php if (have_posts()) :  ?>
<?php while (have_posts()) : the_post(); ?>
  <?php get_template_part('loop');?>
<?php endwhile; ?>
<?php else : ?>
	<p>記事がありません</p>
<?php endif; ?>
	
		</div><!-- postlist -->

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