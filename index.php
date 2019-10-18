    <?php 
        get_header();
        get_template_part('head', get_post_format() ); 
    ?>
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
                <section class="col-12 col-lg-9 pt-5 d-none" id="posts" style="min-height: calc(100vh - 105px)">
                    <!-- <article class="card mb-4">
                        <header class="card-header px-0 pb-0 pt-0">
                            <div class="card-meta">
                                <a href="#"><time class="timeago" datetime="2017-10-03 20:00" data-tid="2">1 year ago</time></a> in <a href="page-category.html">Lifestyle</a>
                            </div>
                            <a href="post-image.html">
                                <h3 class="card-title">Oh, I guess they have the blues</h3>
                            </a>
                        </header>
                        <div class="card-body px-0 pt-0">
                            <div class="card-text">
                                <p>
                                    It’s no secret that the digital industry is booming. From exciting startups to global brands, companies are reaching out to digital agencies, responding to the new possibilities available. However, the industry is fast becoming overcrowded, heaving with agencies offering similar services …               
                                </p>
                                <div class="row">
                                    <div class="col-6">
                                        <a href="#" class="card-read-more">                                        
                                            Continue reading
                                        </a>
                                    </div>
                                    <div class="col-6 text-right">
                                            <a href="#" class="no-decoration">
                                                <i class="far fa-comment-alt"></i>
                                                <span class="comment_num">5</span>
                                            </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </article>
                    <article class="card mb-4"> 
                            <a href="#" class="pb-2">
                                <img src="img/foto2.jpg" alt="" width="100%" style="border-radius: 7px;"/>
                            </a>
                            <header class="card-header px-0 pb-0 pt-0">
                                <div class="card-meta">
                                    <a href="#"><time class="timeago" datetime="2017-10-03 20:00" data-tid="2">1 year ago</time></a> in <a href="page-category.html">Lifestyle</a>
                                </div>
                                <a href="post-image.html">
                                    <h3 class="card-title">Cosy Bright Office In Yellow And Grey Colors</h3>
                                </a>
                            </header>
                            <div class="card-body px-0 pt-0">
                                <div class="card-text">
                                    <p>
                                            It’s no secret that the digital industry is booming. From exciting startups to global brands, companies are reaching out to digital agencies, responding to the new possibilities available. However, the industry is fast becoming overcrowded, heaving with agencies offering similar services — on the surface, at least. Producing creative, fresh projects is the key to standing out. Unique side projects are the best place to innovate, but balancing commercially and creatively lucrative work is tricky. So, this article looks at …
                                    </p>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="#" class="card-read-more">                                        
                                                Continue reading
                                            </a>
                                        </div>
                                        <div class="col-6 text-right">
                                                <a href="#" class="no-decoration">
                                                    <i class="far fa-comment-alt"></i>
                                                    <span class="comment_num">5</span>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                    -->
                </section> 
                <?php get_template_part('sidebar', get_post_format() );  ?>
            </div>
        </div>

        <?php get_footer(); ?>

        <script type="text/javascript">
            var ajaxurl = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
            var page = 1;
            var data = {
                    'action': 'load_posts_by_ajax',
                    'page': page,
                    'security': '<?php echo wp_create_nonce("load_more_posts"); ?>'
                };
        
                $.ajax({
				type: 'POST',
				dataType: 'json',
				url: '__acoes.php?cancelar_servico&dbsID='+$('#servico_editar_id').val(),
				data: dataString

			}).done(function(json, statusText, xhr){
                $('#loading-posts').addClass('d-none');
                $('#posts').removeClass('d-none');
                if(xhr.status === 200) {
                    json.data.forEach(element => {
                        $('#posts').append(element);
                    });
                    page++;
                } else {
                    $('#posts').append("Nenhum post encontrado.");
                }
            });
        </script>
    </body>
</html>