<?php 
    get_header();
    get_template_part('head', get_post_format() ); 
?>
    <body>
        <div class="container">
            <div class="row">
                <section id="loading-posts" class="col-12 col-lg-9 pt-5" style="height: calc(100vh - 105px)">
                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>
                </section>
                <section class="col-12 col-lg-9 pt-5 d-none" id="post">
                    <article class="card mb-4">
                        <header class="card-header px-0 pb-0 pt-0">
                            <div class="card-meta">
                            <a  class="post-link" href="#"><time class="post-time" datetime="2017-10-03 20:00" data-tid="2"></time></a> em <a class="link-category" href="" rel="category tag"></a>
                            </div>
                            <a class="post-link" href="">
                                <h3 class="card-title post-title"></h3>
                            </a>
                        </header>
                        <div class="card-body px-0 pt-0">
                            <div class="card-text post-content">
                                
                            </div>
                        </div>
                    </article>
                    <hr/>
                    <div class="card mb-4 pt-3">
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
        <script type='text/javascript' src='<?=get_template_directory_uri();?>/js/page/main.js'></script>
    </body>
</html>