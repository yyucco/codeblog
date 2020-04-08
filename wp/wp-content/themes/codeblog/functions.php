<?php

/* ----------------------------------------
-head
-メニュー
-ウジェット
-記事のアクセス数
-エディター

---------------------------------------- */

/* ----------------------------------------

head

---------------------------------------- */
//////////////////////////////////////////////////
//wp_head　不要タグの削除
//////////////////////////////////////////////////


// wpバージョン記述を削除
remove_action('wp_head', 'wp_generator');

// デフォルトのjQueryの記述を削除
function my_delete_local_jquery() {wp_deregister_script('jquery');}
add_action( 'wp_enqueue_scripts', 'my_delete_local_jquery' );

// 絵文字用のスタイル定義の記述を削除
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// 独自css読み込み
function register_stylesheet() { //読み込むCSSを登録する
	wp_register_style('post', get_template_directory_uri().'/css/post.css');
}
function add_stylesheet() { 
	if(is_single()){
	register_stylesheet();
	wp_enqueue_style('post', '', array(), '1.0', false);
	}
}
add_action('wp_enqueue_scripts', 'add_stylesheet');

/* ----------------------------------------

メニュー

---------------------------------------- */
register_nav_menus( array(
    'category_menu' => 'カテゴリーメニューリスト'
));

/* ----------------------------------------

ウジェット

---------------------------------------- */
function arphabet_widgets_init() {

	register_sidebar( array(
		'name' => 'Home right sidebar',
		'id' => 'home_right_1',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
	register_sidebar( array(
		'name' => 'Home right sidebar2',
		'id' => 'home_right_2',
		'before_widget' => '<div>',
		'after_widget' => '</div>',
		'before_title' => '<h2 class="rounded">',
		'after_title' => '</h2>',
	) );
}
add_action( 'widgets_init', 'arphabet_widgets_init' );



//////////////////////////////////////////////////
//広告ウィジェットアイテム
//////////////////////////////////////////////////
class AdWidgetItemClass extends WP_Widget {
	function __construct() {
		$widget_option = array('description' => '様々な広告に利用できるテキストエリア');
		parent::__construct( false, $name = '[LION]広告', $widget_option );
	}
 
	// 設定を表示するメソッド
	function widget( $args, $instance ) {
		extract( $args );
 
		echo $before_widget;
		echo '<div class="adWidget">';
		
		// 本文を取得
		$body = $instance[ 'body' ];
		if( $body != '' ) {
			echo $body; 
		}
 
		echo '<h2 class="adWidget__title">Advertisement</h2></div>';
		echo $after_widget;
 
	}
	
	// 設定を保存するメソッド
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}
	
	// 設定フォームを出力するメソッド
	function form( $instance ) {
		?>
        <p>
          <label for="<?php echo $this->get_field_id('body'); ?>">広告タグ:</label>
          <textarea class="widefat" rows="8" id="<?php echo $this->get_field_id('body'); ?>" name="<?php echo $this->get_field_name('body'); ?>"><?php echo @$instance['body']; ?></textarea>
		</p>
		<?php
	}
 
}
add_action( 'widgets_init', create_function( '', 'return register_widget( "AdWidgetItemClass" );' ) );


//////////////////////////////////////////////////
//投稿サムネイル画像
//////////////////////////////////////////////////

add_theme_support( 'post-thumbnails' ); 

//////////////////////////////////////////////////
//記事のアクセス数
//////////////////////////////////////////////////

//カウントしてカスタムフィールドに表示
function set_post_views($postID) {
  $count_key = 'post_views_count';
  $count = get_post_meta($postID, $count_key, true);
  if($count==''){
      $count = 0;
      delete_post_meta($postID, $count_key);
      add_post_meta($postID, $count_key, '0');
  }else{
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
}

//クローラーのアクセス判別
function is_bot() {
  $ua = $_SERVER['HTTP_USER_AGENT'];
  $bot = array(
        "googlebot",
        "msnbot",
        "yahoo"
  );
  foreach( $bot as $bot ) {
    if (stripos( $ua, $bot ) !== false){
      return true;
    }
  }
  return false;
}

//投稿一覧に表示
function manage_posts_columns($columns) {
	$columns['post_views_count'] = 'view数';
	$columns['thumbnail'] = 'サムネイル';
	$columns = array(
	'cb'         => '<input type="checkbox" />',
	'thumbnail'   => 'サムネイル',
	'title'      => 'タイトル',
	'date'       => '日時',
	'categories' => 'カテゴリー',
	'post_views_count' => 'view数'
	);
	return $columns;
}
function add_column($column_name, $post_id) {
  /*View数呼び出し*/
  if ( $column_name == 'post_views_count' ) {
      $stitle = get_post_meta($post_id, 'post_views_count', true);
    }
    /*サムネイル呼び出し*/
  if ( $column_name == 'thumbnail') {
    $thumb = get_the_post_thumbnail($post_id, array(100,100), 'thumbnail');
  }
   /*ない場合は「なし」を表示する*/
  if ( isset($stitle) && $stitle ) {
    echo attribute_escape($stitle);
  }
  else if ( isset($thumb) && $thumb ) {
    echo $thumb;
  }
  else {
    echo __('None');
  }
}

function make_modified_column_sortable( $sortable_columns ) {
//	$sortable_columns['modified'] = 'modified';
	$sortable_columns['post_views_count'] = array( 'post_views_count', true );
	return $sortable_columns;
}
add_filter( 'manage_posts_columns', 'manage_posts_columns' );
add_action( 'manage_posts_custom_column', 'add_column', 10, 2 );
add_filter( 'manage_edit-post_sortable_columns', 'make_modified_column_sortable', 10, 1 );

//投稿一覧に表示

/* 人気記事一覧ウィジェット */
class Popular_Posts extends WP_Widget {
 /*コンストラクタ*/
  function __construct() {
    parent::__construct(
      'popular_posts',
      '人気記事',
      array( 'description' => 'PV数の多い順で記事を表示' )
    );
   }
  /*ウィジェット追加画面でのカスタマイズ欄の追加*/
  function form($instance) {
    if(empty($instance['title'])) {
      $instance['title'] = '';
    }
    if(empty($instance['number'])) {
      $instance['number'] = 5;
    }
?>
  <p>
    <label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('タイトル:'); ?></label>
    <input type="text" class="widefat" id="<?php echo $this->get_field_id('title'); ?>"
    name="<?php echo $this->get_field_name('title'); ?>"
    value="<?php echo esc_attr( $instance['title'] ); ?>">
  </p>
  <p>
    <label for="<?php echo $this->get_field_id('number'); ?>"><?php _e('記事表示件数:'); ?></label>
    <input type="text" id="<?php echo $this->get_field_id('limit'); ?>"
    name="<?php echo $this->get_field_name('number'); ?>"
    value="<?php echo esc_attr( $instance['number'] ); ?>" size="3">
  </p>
<?php
  }
  /*カスタマイズ欄の入力内容が変更された場合の処理*/
  function update($new_instance, $old_instance) {
    $instance = $old_instance;
    $instance['title'] = strip_tags($new_instance['title']);
    $instance['number'] = is_numeric($new_instance['number']) ? $new_instance['number'] : 5;
      return $instance;
  }
  /*ウィジェットのに出力される要素の設定*/
  function widget($args, $instance) {
    extract($args);
    echo $before_widget;
      if(!empty($instance['title'])) {
        $title = apply_filters('widget_title', $instance['title'] );
      }
      if (!empty($title)) {
        echo $before_title . $title . $after_title;
      } else {
        echo '<h4>人気記事</h4>';
      }
    $number = !empty($instance['number']) ? $instance['number'] : get_option('number');
?>
 
  <!--ここにウィジェットとして呼び出したい要素を記述-->
 
<?php echo $after_widget;
  }
}
register_widget('Popular_Posts');


/* ----------------------------------------

-エディター

---------------------------------------- */

//////////////////////////////////////////////////
//エディター用js・css追加
//////////////////////////////////////////////////

// register_block_style(
//     'core/heading',
//     array(
//         'name'         => 'designh2',
//         'label'        => 'h2',
//         'inline_style' => '
// 					 .is-style-designh2  {
// 						font-size: 3rem;
// 						color: #587ee5;
// 						line-height: 1.2;
// 						width: calc(100% + 100px);
// 					  height: 100%;
// 						margin-left: -50px;
// 					  padding-right: 20px;
// 						border-left: 10px solid #587ee5;
// 					  margin-bottom: 40px;
// 					  display: inline-block;
// 					  padding: 5px 5px 5px 20px;
// 					  background-image: linear-gradient(
// 					    -45deg,
// 					    #fff 25%,
// 					    #ced9f7 25%, #ced9f7 50%,
// 					    #fff 50%, #fff 75%,
// 					    #ced9f7 75%, #ced9f7
// 					  );
// 					  background-size: 10px 10px;
// 					  text-shadow:
// 					  0 0 5px #fff,0 0 5px #fff,0 0 5px #fff,
// 					  0 0 5px #fff,0 0 5px #fff,0 0 5px #fff,
// 					  0 0 5px #fff,0 0 5px #fff,0 0 5px #fff,
// 					  0 0 5px #fff,0 0 5px #fff,0 0 5px #fff,
// 					  0 0 5px #fff,0 0 5px #fff,0 0 5px #fff,
// 					  0 0 5px #fff;

// 					}


//         ',
//     )
// );

// register_block_style(
//     'core/heading',
//     array(
//         'name'         => 'design02',
//         'label'        => 'デザイン02',
//         'inline_style' => '.is-style-design02 { 
//             padding: 20px 10px 15px;
//             border-radius: 10px;
//             background: #f5d742;
//         }
//         .is-style-design02::before {
//             content: "●";
//             color: #ffffff;
//             margin-right: 10px;
//         }',
//     )
// );


//////////////////////////////////////////////////
//見出しタグ変更
//////////////////////////////////////////////////
function wporg_block_wrapper( $block_content, $block ) {
	if ( $block['blockName'] === 'core/heading' ) {
		if (preg_match("/h2/", $block["innerHTML"])) {
			return preg_replace(
			'/<h2(.*?)>(.*?)<\/h2>/',
			'<h2$1><span>$2</span></h2>',
			$block_content);
		}
		elseif (preg_match("/h5/", $block["innerHTML"])) {
			return  preg_replace(
			'/<h5(.*?)>(.*?)<\/h5>/',
			'<div class="h5Wrap"><h5$1>$2</h5></div>',
			$block_content);
		} else { 
			return $block_content; }
  }
  return $block_content;

}
 
add_filter( 'render_block', 'wporg_block_wrapper', 10, 2 );


//////////////////////////////////////////////////
//もくじ表示
//////////////////////////////////////////////////

 /*コード表示用の関数*/
function get_outline_info($content) {
	// 目次のHTMLを入れる変数を定義します。
	$outline = '';
	// h1〜h6タグの個数を入れる変数を定義します。
	$counter = 0;
    // 記事内のh1〜h6タグを検索します。(idやclass属性も含むように改良)
    if (preg_match_all('/<h(2)[^>]*>(.*?)<\/h\1>/', $content, $matches,  PREG_SET_ORDER)) {
    	   // 記事内で使われているh1〜h6タグの中の、1〜6の中の一番小さな数字を取得します。
    	   // ※以降ソースの中にある、levelという単語は1〜6のことを表します。
        $min_level = min(array_map(function($m) { return $m[1]; }, $matches));
        // スタート時のlevelを決定します。
        // ※このレベルが上がる毎に、<ul></li>タグが追加されていきます。
        $current_level = $min_level - 1;
        // 各レベルの出現数を格納する配列を定義します。
        $sub_levels = array('1' => 0, '2' => 0, '3' => 0, '4' => 0, '5' => 0, '6' => 0);
        // 記事内で見つかった、hタグの数だけループします。
        foreach ($matches as $m) {
            $level = $m[1];  // 見つかったhタグのlevelを取得します。
            $text = $m[2];  // 見つかったhタグの、タグの中身を取得します。
            // li, ulタグを閉じる処理です。2ループ目以降に中に入る可能性があります。
            // 例えば、前回処理したのがh3タグで、今回出現したのがh2タグの場合、
            // h3タグ用のulを閉じて、h2タグに備えます。
            while ($current_level > $level) {
                $current_level--;
                $outline .= '</li></ul>';
            }
            // 同じlevelの場合、liタグを閉じ、新しく開きます。
            if ($current_level == $level) {
                $outline .= '</li><li class="outline__item">';
            } else {
                // 同じlevelでない場合は、ul, liタグを追加していきます。
                // 例えば、前回処理したのがh2タグで、今回出現したのがh3タグの場合、
                // h3タグのためにulを追加します。
                while ($current_level < $level) {
                    $current_level++;
                    $outline .= sprintf('<ul class="outline__list outline__list-%s"><li class="outline__item">', $current_level);
                }
                // 見出しのレベルが変わった場合は、現在のレベル以下の出現回数をリセットします。
                for ($idx = $current_level + 0; $idx < count($sub_levels); $idx++) {
                    $sub_levels[$idx] = 0;
                }
            }
            // 各レベルの出現数を格納する配列を更新します。
            $sub_levels[$current_level]++;
            // 現在処理中のhタグの、パスを入れる配列を定義します。
            // 例えば、h2 -> h3 -> h3タグと進んでいる場合は、
            // level_fullpathはarray(1, 2)のようになります。
            // ※level_fullpath[0]の1は、1番目のh2タグの直下に入っていることを表します。
            // ※level_fullpath[1]の2は、2番目のh3を表します。
            $level_fullpath = array();
            for ($idx = $min_level; $idx <= $level; $idx++) {
                $level_fullpath[] = $sub_levels[$idx];
            }
            $target_anchor = 'outline__' . implode('_', $level_fullpath);

            // 目次に、<a href="#outline_1_2">1.2 見出し</a>のような形式で見出しを追加します。
            $outline .= sprintf('<a class="outline__link" href="#%s"><span class="outline__number">%s.</span> %s</a>', $target_anchor, implode('.', $level_fullpath), strip_tags($text));
            // 本文中の見出し本体を、<h3>見出し</h3>を<h3 id="outline_1_2">見出し</h3>
            // のような形式で置き換えます。
            $hid = preg_replace('/<h([1-6])/', '<h\1 id="' .$target_anchor . '"', $m[0]);
            $content = str_replace($m[0], $hid, $content);
			
        }
        // hタグのループが終了後、閉じられていないulタグを閉じていきます。
        while ($current_level >= $min_level) {
            $outline .= '</li></ul>';
            $current_level--;
        }
        // h1〜h6タグの個数
        $counter = count($matches);
    }
    return array('content' => $content, 'outline' => $outline, 'count' => $counter);
}

//目次を作成します。
function add_outline($content) {

    // 目次を表示するために必要な見出しの数
	if(get_option('fit_post_outline_number')){
		$number = get_option('fit_post_outline_number');
	}else{
		$number = 1;
	}
    // 目次関連の情報を取得します。
    $outline_info = get_outline_info($content);
    $content = $outline_info['content'];
    $outline = $outline_info['outline'];
    $count = $outline_info['count'];
	if (get_option('fit_post_outline_close') ) {
		$close = "";
	}else{
		$close = "checked";
	}
    if ($outline != '' && $count >= $number) {
        // 目次を装飾します。
        $decorated_outline = sprintf('
		<div class="outline">
		  <span class="outline__title">目次</span>
		  <input class="outline__toggle" id="outline__toggle" type="checkbox" '.$close.'>
		  <label class="outline__switch" for="outline__toggle"></label>
		  %s
		</div>', $outline);
        // カスタマイザーで目次を非表示にする以外が選択された時＆個別非表示が1以外の時に目次を追加します。
$content =  $decorated_outline . $content;

		if ( get_option('fit_post_outline') != 'value2' && get_post_meta(get_the_ID(), 'outline_none', true) != '1' && is_single() ) {
        	$shortcode_outline = '[outline]';
      if (preg_match('/(class="content")/', $content, $matches, PREG_OFFSET_CAPTURE)) {
            echo "true";
          	$pos = $matches[0][1];
          	$content = substr($content, 0, $pos) . $decorated_outline ;
        	}
		}
    }
	return $content;
}
add_filter('the_content', 'add_outline');


//////////////////////////////////////////////////
//目次の表示/非表示、個別選択設定
//////////////////////////////////////////////////

function add_outline_fields() {
	//add_meta_box(表示される入力ボックスのHTMLのID, ラベル, 表示する内容を作成する関数名, 投稿タイプ, 表示方法)
	add_meta_box( 'outline_setting', '目次の個別非表示設定', 'insert_outline_fields', 'post', 'normal');
}
add_action('admin_menu', 'add_outline_fields');

// カスタムフィールドの入力エリア
function insert_outline_fields() {
	global $post;

	if( get_post_meta($post->ID,'outline_none',true) == "1" ) {
		$outline_none_check = "checked";
	}else {
		$outline_none_check = "";
	}

	echo '
		<div style="margin:20px 0; overflow: hidden; line-height:2;">
	  	<div style="float:left;width:120px;">目次の表示設定</div>
	  	<div style="float:right;width:calc(100% - 140px);">
	    	<input type="checkbox" name="outline_none" value="1" '.$outline_none_check.' >:この投稿では目次を非表示にしますか？
	  	</div>
	  	<div style="clear:both;"></div>
		</div>
	';

}

// カスタムフィールドの値を保存
function save_outline_fields( $post_id ) {
	if(!empty($_POST['outline_none'])){
		update_post_meta($post_id, 'outline_none', $_POST['outline_none'] );
	}else{
		delete_post_meta($post_id, 'outline_none');
	}

}
add_action('save_post', 'save_outline_fields');



//////////////////////////////////////////////////
//説明文表示
//////////////////////////////////////////////////

function add_description_fields() {
	//add_meta_box(表示される入力ボックスのHTMLのID, ラベル, 表示する内容を作成する関数名, 投稿タイプ, 表示方法)
	add_meta_box( 'description_setting', '記事の説明文', 'insert_description_fields', 'post', 'normal');
}
add_action('admin_menu', 'add_description_fields');

// カスタムフィールドの入力エリア
function insert_description_fields() {
	global $post;

	wp_nonce_field( 'action-description_txt', 'nonce-description_txt' );
	$description_txt_date = get_post_meta($post->ID, 'description_txt', true);
	echo '
	  	<div>
	    	<textarea name="description_txt" cols="50" rows="10" wrap="sort" style="resize: vertical; width:100%;">'.$description_txt_date.'</textarea>
	  	</div>
	';
}
// カスタムフィールドの値を保存
function save_descriptio_fields( $post_id ) {
	update_post_meta($post_id, 'description_txt', $_POST['description_txt'] );
	// if(!empty($_POST['$description_txt'])){
	// 	update_post_meta($post_id, 'description_txt', $_POST['description_txt'] );
	// }else{
	// 	delete_post_meta($post_id, 'description_txt');
	// }
}
add_action('save_post', 'save_descriptio_fields');





// カスタムフィールドの追加
function add_custom_field() {
    add_meta_box( 'custom-item_lead', '紹介文(簡易)', 'create_item_lead', 'post', 'normal' );
}
add_action( 'admin_menu', 'add_custom_field' );
 
// カスタムフィールドのHTMLを追加する時の処理
function create_item_lead() {
    $keyname = 'item_lead';
    global $post;
    // 保存されているカスタムフィールドの値を取得
    $get_value = get_post_meta( $post->ID, $keyname, true );
 
    // nonceの追加
    wp_nonce_field( 'action-' . $keyname, 'nonce-' . $keyname );
 
    // HTMLの出力
    echo '<textarea name="' . $keyname . '">' . $get_value . '</textarea>';

	echo "<pre>";
    		echo "検証結果";
    		echo var_dump($_POST['item_lead']);
	echo "</pre>";
}
 
// カスタムフィールドの保存
add_action( 'save_post', 'save_custom_field' );
function save_custom_field( $post_id ) {
    $custom_fields = ['item_name', 'item_lead', 'item_detail', 'item_category', 'item_genre', 'item_eval'];
 
    foreach( $custom_fields as $d ) {
        if ( isset( $_POST['nonce-' . $d] ) && $_POST['nonce-' . $d] ) {
            if( check_admin_referer( 'action-' . $d, 'nonce-' . $d ) ) {
 
                if( isset( $_POST[$d] ) && $_POST[$d] ) {
                    update_post_meta( $post_id, $d, $_POST[$d] );
                } else {
                    delete_post_meta( $post_id, $d, get_post_meta( $post_id, $d, true ) );
                }
            }
        }
 
    }
}