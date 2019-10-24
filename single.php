<?php 
    get_header();
    get_template_part('head', get_post_format() ); 
?>
    <body>
        <div class="container">
            <div class="row">
                <section class="col-12 col-lg-9 pt-5" id="post">
                <?php
                    the_post();
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
                        <header class="card-header px-0 pb-0 pt-0">
                            <div class="card-meta">
                                <div class="meta-item">
                                    <span>Em</span> <a class="link-category" href="<?=$category_link;?>" rel="category tag"><?=$category;?></a>
                                </div>
                                <div class="meta-item">
                                    <span>Tags:</span> <?php
                                $post_tags = get_the_tags();
                                if ( $post_tags ) {
                                ?>
                                    <a href=""><?=$post_tags[0]->name;?></a> 
                                <?php
                                    }
                                ?></div>
                                <div class="meta-item">
                                    <time class="post-time" datetime="<?=get_the_date('Y-m-d\TH:i:sO','','',false);?>" ><?=get_the_date('d M, Y','','',false);?></time>
                                </div>
                            </div>
                            <a class="post-link" href="<?=get_the_permalink()?>">
                                <h3 class="card-title post-title"><?=get_the_title();?></h3>
                            </a>
                        </header>
                        <div class="card-body px-0 pt-0">
                            <div class="card-text post-content">
                                <?=get_the_content();?>
                            </div>
                        </div>
                    </article>
                    <hr/>
                    <div class="card mb-4 pt-3">
                        <?php

                            function show_comments($id_post, $parent = 0){ 
                                $comments = get_comments( array( 'post_id' => $id_post, 'parent' => [$parent] ) );
                                if(count($comments) > 0){
                                    echo "<ul>";
                                    foreach ( $comments as $comment ) :
                                        echo "<li>";
                                        echo $comment->comment_author;
                                        echo "<br/>";
                                        echo $comment->comment_content;
                                        show_comments($id_post, $parent = $comment->comment_ID);
                                        echo "</li>";
                                    endforeach;
                                    echo "</ul>";
                                }
                            }

                            show_comments($id_post);
                        ?>
                        <h4>Deixe um recado</h4>

                        <form action="http://wordpress/wp-comments-post.php" method="post" id="commentform" class="ui form grid">
                            <p class="comment-notes">
                                <span id="email-notes">O seu endereço de e-mail não será publicado.</span> Campos obrigatórios são marcados com <span class="required">*</span>
                            </p>
                            <div class="row">
                                <div class="col-12">
                                    <label for="comment">Comentário</label>
                                    <textarea id="comment" class="form-control" name="comment" cols="45" rows="4" aria-required="true"></textarea>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" value="yes" autocomplete="off">
                                        <label class="custom-control-label" for="wp-comment-cookies-consent">Salvar meus dados neste navegador para a próxima vez que eu comentar</label>
                                    </div>
                                </div>
                            </div>	
                            <div class="row mt-1">
                                <div class="col-5 form-group">
                                    <label for="author">Name<span class="required">*</span></label>
                                    <input id="author" class="form-control" name="author" type="text" value="" size="30">
                                </div>
                                <div class="col-5 form-group">
                                    <label for="email">Email<span class="required">*</span></label>
                                    <input id="email" class="form-control" name="email" type="text" value="" size="30">
                                </div>
                                <div class="col-2 text-right">
                                    <input name="submit" class="btn btn-primary mt-4 w-100" type="submit" id="submit" value="Publicar"> 
                                    <input type="hidden" name="comment_post_ID" value="1" id="comment_post_ID">
                                    <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                </div>
                            </div>
                        </form>

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
        </script>
    </body>
</html>