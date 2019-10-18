<?php

function add_normalize_CSS() {
    wp_enqueue_style( 'normalize-styles', "https://cdnjs.cloudflare.com/ajax/libs/normalize/7.0.0/normalize.min.css");
}

function add_widget_Support() {
                register_sidebar( array(
                                'name'          => 'Sidebar',
                                'id'            => 'sidebar',
                                'before_widget' => '<div>',
                                'after_widget'  => '</div>',
                                'before_title'  => '<h2>',
                                'after_title'   => '</h2>',
                ) );
}

add_action( 'widgets_init', 'add_Widget_Support' );

// Register a new navigation menu
function add_Main_Nav() {
    register_nav_menu('header-menu',__( 'Header Menu' ));
}
// Hook to the init action hook, run our navigation menu function
add_action( 'init', 'add_Main_Nav' );

add_theme_support( 'post-thumbnails' ); 

function comment_reply_script() {
    wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'comment_reply_script' );

function custom_theme_setup() {
    add_theme_support( 'html5', array( 'comment-list' ) );
}
add_action( 'after_setup_theme', 'custom_theme_setup' );


function returnDataJson($response, $status_code){
	header('Content-Type: application/json');

	http_response_code($statusCode);
	echo json_encode($response, true);
	switch (json_last_error()) {
		case JSON_ERROR_NONE:
		break;
		case JSON_ERROR_DEPTH:
			echo 'Maximum stack depth exceeded';
		break;
		case JSON_ERROR_STATE_MISMATCH:
			echo  'Underflow or the modes mismatch';
		break;
		case JSON_ERROR_CTRL_CHAR:
			echo  'Unexpected control character found';
		break;
		case JSON_ERROR_SYNTAX:
			echo  'Syntax error, malformed JSON';
		break;
		case JSON_ERROR_UTF8:
			echo  'Malformed UTF-8 characters, possibly incorrectly encoded';
		break;
		default:
			echo  'Unknown error';
		break;
	}
	wp_die();
}


add_action('wp_ajax_load_posts_by_ajax', 'load_posts_by_ajax_callback');
add_action('wp_ajax_nopriv_load_posts_by_ajax', 'load_posts_by_ajax_callback');

function load_posts_by_ajax_callback() {
    check_ajax_referer('load_more_posts', 'security');
    $paged = $_GET['page'];
    $args = array(
        'post_type' => 'post',
        'post_status' => 'publish',
        'posts_per_page' => '2',
        'paged' => $paged,
    );
    $my_posts = new WP_Query( $args );
    $resp = new stdClass();
    if ( $my_posts->have_posts() ){
        while ( $my_posts->have_posts() ){
            $my_posts->the_post();
            $d = array();
            $d['title'] = get_the_title();
            $d['resume'] = get_the_excerpt();
            $resp->data[] = $d;
        }
        $status_code = 200;
    }else{
        $resp->status = "Not Found";
        $status_code = 204;
    }

    returnDataJson($resp, $status_code);
}

class comment_walker extends Walker_Comment {
    
    

    /**
     * Starts the list before the elements are added.
     *
     * @since 2.7.0
     *
     * @see Walker::start_lvl()
     * @global int $comment_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Uses 'style' argument for type of HTML list. Default empty array.
     */
    public function start_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
 
        switch ( $args['style'] ) {
            case 'div':
                $output .= '<div class="ui list">' . "\n";
                break;
            case 'ol':
                $output .= '<ol class="ui list">' . "\n";
                break;
            case 'ul':
            default:
                $output .= '<ul class="ui list">' . "\n";
                break;
        }
    }

     /**
     * Ends the list of items after the elements are added.
     *
     * @since 2.7.0
     *
     * @see Walker::end_lvl()
     * @global int $comment_depth
     *
     * @param string $output Used to append additional content (passed by reference).
     * @param int    $depth  Optional. Depth of the current comment. Default 0.
     * @param array  $args   Optional. Will only append content if style argument value is 'ol' or 'ul'.
     *                       Default empty array.
     */
    public function end_lvl( &$output, $depth = 0, $args = array() ) {
        $GLOBALS['comment_depth'] = $depth + 1;
 
        switch ( $args['style'] ) {
            case 'div':
            $output .= "</div><!-- .children -->\n";
                break;
            case 'ol':
                $output .= "</ol><!-- .children -->\n";
                break;
            case 'ul':
            default:
                $output .= "</ul><!-- .children -->\n";
                break;
        }
    }

    // start_el – HTML for comment template
    /**
	 * Outputs a comment in the HTML5 format.
	 *
	 * @see wp_list_comments()
	 *
	 * @param WP_Comment $comment Comment to display.
	 * @param int        $depth   Depth of the current comment.
	 * @param array      $args    An array of arguments.
	 */
	protected function html5_comment( $comment, $depth, $args ) {

        $tag = ( 'div' === $args['style'] ) ? 'div' : 'li';
        $pt = "pt-3";
        if( $GLOBALS['comment_depth'] == 1) $pt = "pt-4";
        
        ?>
        <<?php echo $tag; ?> id="comment-<?php comment_ID(); ?>" <?php comment_class( $this->has_children ? 'parent item '.$pt : 'item'.$pt, $comment ); ?> itemprop="comment" itemscope itemtype="http://schema.org/Comment" style="width: 100%">
            <div stle="width: 100%;">
                <div style="float:left;width:65px">
                    <?php echo get_avatar( $comment, 65, '[default gravatar URL]', 'Author’s gravatar', $args = array('class'=>'ui circular image') ); ?>
                </div>
                <div style="float:left;margin-left:16px;width:calc(100% - 81px)">
                    <h5 class="mb-0"><a class="comment-author-link" href="<?php comment_author_url(); ?>" itemprop="author"><?php comment_author(); ?></a></h5>
                    <span class="small c-gray small"><time class="comment-meta-item" datetime="<?php comment_date('Y-m-d') ?>T<?php comment_time('H:iP') ?>" itemprop="datePublished"><?php comment_date('jS F Y') ?>, <?php comment_time() ?></time> -  
                    <a rel="nofollow" class="comment-reply-link quick-reply" href="?replytocom=<?php comment_ID() ?>#respond" data-parentid = "<?=$comment->comment_parent;?>" data-commentid="<?php comment_ID() ?>" data-postid="<?=$comment->comment_post_ID ?>" data-belowelement="div-comment-<?php comment_ID() ?>" data-respondelement="respond" aria-label="Responder para Um comentarista do <?php comment_author(); ?>">Responder</a></span>
                    <?php edit_comment_link($before = '<span class="edit-link ml-2"><svg class="svg-icon" width="16" height="16" aria-hidden="true" role="img" focusable="false" viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><path d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z"></path><path d="M0 0h24v24H0z" fill="none"></path></svg>'); ?>
                    <?php if ($comment->comment_approved == '0') : ?>
                    <p class="small mt-0 pt-0">Your comment is awaiting moderation.</p>
                    <?php endif; ?>

                    <p class="small mt-0 pt-0"><?=get_comment_text();?></p>

                    <div class="quick-holder-<?php comment_ID() ?>"></div>
                </div>
            </div>

    <?php }

}