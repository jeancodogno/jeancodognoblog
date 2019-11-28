<?php 
    get_header();
    get_template_part('head', get_post_format() ); 
?>
    <body>
        <div class="container">
            <div class="row">
                <section class="col-12 col-lg-9 pt-5" id="post" style="min-height: calc(100vh - 101px);">
                <?php
                    the_post();
                    $id_post = get_the_ID();
                    $category = "";
                    if(get_the_category()[0]->term_id != 1)
                        $category = get_the_category()[0]->cat_name;
                ?>
                    <article class="card mb-4">
                        <?php
                            if(has_post_thumbnail()){
                        ?>
                        <a href="<?=get_the_permalink();?>" class="pb-2 post-link post-link-image">
                            <img src="<?=get_the_post_thumbnail_url();?>" alt="<?=get_the_title();?>" class="border-radius" width="100%"/>
                        </a>
                        <?php
                            }
                        ?>
                        <header class="card-header px-5 pb-2 pt-0">
                            <div class="card-meta">
                                <div class="meta-item">
                                    <span>In</span> <a class="link-category" href="<?=$category_link;?>" rel="category tag"><?=$category;?></a>
                                </div>
                                <div class="meta-item">
                                    <span><i class="fas fa-tags mr-1"></i>Tags:</span> <?php
                                $post_tags = get_the_tags();
                                if ( $post_tags ) {
                                ?>
                                    <a href=""><?=$post_tags[0]->name;?></a> 
                                <?php
                                    }
                                ?></div>
                                <div class="meta-item">
                                <i class="fas fa-calendar-day mr-1"></i><time class="post-time" datetime="<?=get_the_date('Y-m-d\TH:i:sO','','',false);?>" ><?=get_the_date('d M, Y','','',false);?></time>
                                </div>
                            </div>
                            <a class="post-link" href="<?=get_the_permalink()?>">
                                <h3 class="card-title post-title"><?=get_the_title();?></h3>
                            </a>
                        </header>
                        <div class="card-body px-5 pt-0">
                            <div class="card-text post-content">
                                <?=get_the_content();?>
                            </div>
                            <i class="fas fa-share i-share"></i>
                            <a class="btn-floating btn-fb btn-lg waves-effect waves-light" id="btn_facebook"><i class="fab fa-facebook-f"></i></a>
                            <a class="btn-floating btn-tw btn-lg waves-effect waves-light" id="btn_twitter"><i class="fab fa-twitter"></i></a>
                            <a class="btn-floating btn-li btn-lg waves-effect waves-light" id="btn_linkedin"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </article>
                    <hr class="p-0 m-0"/>
                    <div class="card px-5 mb-4 pt-3">
                        <h3 class="comments-title title mb-5"> <?=get_comments( array( 'post_id' => $id_post, 'count'=>true));?> comments <span class="screen-reader-text"><?=get_the_title();?></span></h3>
                        <?php

                            function show_comments($id_post, $parent = 0){ 
                                $comments = get_comments( array( 'post_id' => $id_post, 'parent' => [$parent] ) );
                            
                                if(count($comments) > 0){
                                    echo "<ul class='group-comment'>";
                                    foreach ( $comments as $comment ) :
                                        $date = new DateTime($comment->comment_date);
                                        // var_dump($comment);
                                        echo "<li class='comment' id='comment-".$comment->comment_ID."' itemprop='comment' itemscope itemtype='http://schema.org/Comment'>";
                                        echo "  <div style='float:left;width:50px'>";
                                        echo get_avatar( $comment, 50, '[default gravatar URL]', 'Author’s gravatar', $args = array('class'=>'rounded-circle') );
                                        echo "  </div>";
                                        echo "  <div style='margin-left:66px;width:calc(100% - 81px);border-left: 1px solid #ececec;padding-left: 20px;'>";
                                        echo "      <h4 class='comment-author mb-0'>".$comment->comment_author."</h4>";
                                        echo "      <time datetime='".$comment->comment_date_gmt."'>".$date->format('d M, Y')."</time>";
                                        echo '       - <a rel="nofollow" class="comment-reply-link quick-reply" href="?replytocom='.$comment->comment_ID.'#respond" data-parentid = "'.$comment->comment_parent.'" data-commentid="'.$comment->comment_ID.'" data-postid="'.$comment->comment_post_ID.'" data-belowelement="div-comment-'.$comment->comment_ID.'" data-respondelement="respond" aria-label="Reply for '.$comment->comment_author.'">Reply</a></span>';
                                        echo "      <p class='comment-content mt-2'>".$comment->comment_content."</p>";
                                        echo "  </div>";
                                        echo '<div class="quick-holder quick-holder-'.$comment->comment_ID.'"></div>';
                                        show_comments($id_post, $comment->comment_ID);
                                        echo "</li>";
                                    endforeach;
                                    echo "</ul>";
                                }
                            }

                            show_comments($id_post);
                        ?>
                        <div id="original-position-form">
                            <div id='respond-div'>
                            <?php 
                    
                                $comment_field = '<div class="row">
                                                    <div class="col-12">
                                                        <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                    </div>
                                                </div>';
                                $fields =  array(
                                    'author' =>
                                        '<div class="row">
                                        <div class="col-4 mt-3"><input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
                                        '" size="30" placeholder="Name"/></div>',
                                    'email' =>
                                        '<div class="col-4 mt-3"><input  class="form-control" id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
                                        '" size="30" placeholder="Email"/></div>',
                                    'url' =>
                                        '<div class="col-4 mt-3"><input class="form-control" id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
                                        '" size="30" placeholder="Website"/></div></div>',
                                    'cookies' => '<div class="col-12 mt-3 p-0"><div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" checked="' . $consent . '" autocomplete="off">
                                    <label class="custom-control-label" for="wp-comment-cookies-consent">Save my data for next time.</label>
                                </div></div>'
                                
                                );
                                $title_reply_before = '<h4 id="reply-title" class="comment-reply-title">';
                                $cancel_reply_before = '<smal class="ml-2">';
                            ?>
                        <?php comment_form($args = array(
																			'class_form'=>'needs-validation',
																			'class_submit'=>'btn btn-primary mt-3',
																			'comment_field'=>$comment_field,
																			'fields'=>$fields,
																			'title_reply_before' => $title_reply_before,
                                                                            'cancel_reply_before' => $cancel_reply_before)); ?>
                            </div>
                        </div>

                                                                            

                    </div>
                </section> 
                <?php get_template_part('sidebar', get_post_format() );  ?>
            </div>
        </div>

        <?php get_footer(); ?>
            
        <script type='text/javascript'>
            var url_load_post = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
            var security_key = "<?php echo wp_create_nonce("load_post"); ?>";
            var id_post = "<?php echo get_the_ID(); ?>";


            // QUICK REPLY FORM
            var hForm_a = $('#respond-div'); // paddings & margin

            $('a.quick-reply').click(function(){
                
                var id = $(this).attr('data-commentid');
                var parentid = $(this).attr('data-parentid');
                var postid = $(this).attr('data-postid');

                $('.quick-holder-'+id).html(hForm_a);

                $('#cancel-comment-reply-link').show();
                $('#comment_parent').val(id);
                return false;

            });

            // Cancel reply
            $('#cancel-comment-reply-link').click(function(){

                $('#cancel-comment-reply-link').hide();
                $('#original-position-form').html(hForm_a);
                $('#comment_parent').val('');
                return false;

            });
            $('#btn_facebook').on('click', function() {
                var url = window.location.href;
                window.open('https://www.facebook.com/sharer/sharer.php?u=' + url,
                    'facebook-share-dialog',
                    'width=800,height=600'
                );
                return false;
            });
            $('#btn_twitter').on('click', function() {
                var url = window.location.href;
                window.open('https://twitter.com/intent/tweet?text= '+ document.title +" " + url,
                    'twitter-share-dialog',
                    'width=800,height=600'
                );
                return false;
            });
            $('#btn_linkedin').on('click', function() {
                var url = window.location.href;
                window.open('https://www.linkedin.com/shareArticle?mini=true&title='+ document.title +"&url=" + url,
                    'twitter-share-dialog',
                    'width=800,height=600'
                );
                return false;
            });

        </script>
        <script>
        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
        'use strict';
        window.addEventListener('load', function() {
            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.getElementsByClassName('needs-validation');
            // Loop over them and prevent submission
            var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false) {
                event.preventDefault();
                event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
            });
        }, false);
        })();
        </script>
    </body>
</html>