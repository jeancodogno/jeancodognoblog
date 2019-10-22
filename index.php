<?php 
    get_header();
    get_template_part('head', get_post_format() ); 
?>
    <body>
        <div class="container">
            <div class="row">
                <section id="loading-posts" class="col-12 col-lg-9 pt-5 d-none" style="height: calc(100vh - 105px)">
                    <div class="spinner">
                        <div class="rect1"></div>
                        <div class="rect2"></div>
                        <div class="rect3"></div>
                        <div class="rect4"></div>
                        <div class="rect5"></div>
                    </div>
                </section>
                <section class="col-12 col-lg-9 pt-5" id="posts" style="min-height: calc(100vh - 105px)">
                    <?php
                        if(isset($_GET['page']))
                            $paged = $_GET['page'];
                        else
                            $paged = 1;
                        $num_peer_page = 5;
                        $args = array(
                            'post_type' => 'post',
                            'post_status' => 'publish',
                            'posts_per_page' => $num_peer_page,
                            'paged' => $paged,
                        );
                        $my_posts = new WP_Query( $args );
                        $resp = new stdClass();
                        if ( $my_posts->have_posts() ){
                            $total_posts = wp_count_posts()->publish;
                            $total_pages = ceil($total_posts / $num_peer_page);

                            while ( $my_posts->have_posts() ){
                                $my_posts->the_post();
                                $category = "";
                                $category_link = get_category_link(get_the_category()[0]->term_id);
                                if(get_the_category()[0]->term_id != 1)
                                    $category = get_the_category()[0]->cat_name;
                        ?>
                        <article class="card mb-4" id="post<?=get_the_ID();?>">
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
                                        <time class="post-time" datetime="<?=get_the_date('Y-m-d\TH:i:sO','','',false);?>" data-tid="2"><?=get_the_date('d M, Y','','',false);?></time>
                                    </div>
                                </div>
                                <a class="post-link" href="<?=get_the_permalink()?>">
                                    <h3 class="card-title post-title"><?=get_the_title();?></h3>
                                </a>
                            </header>
                            <div class="card-body px-0 pt-0">
                                <div class="card-text">
                                    <p class="post-excerpt"><?=get_the_excerpt();?></p>
                                    <div class="row">
                                        <div class="col-6">
                                            <a href="<?=get_the_permalink()?>" class="card-read-more post-link">                                        
                                                Continue reading
                                            </a>
                                        </div>
                                        <div class="col-6 text-right">
                                                <a href="#" class="no-decoration post-link">
                                                    <i class="far fa-comment-alt"></i>
                                                    <span class="post-ncomments"><?=get_comments_number();?></span>
                                                </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </article>
                        <?php
                            }
                            if($total_pages > 1){
                        ?>
                        <nav aria-label="Navegação de página exemplo">
                            <ul class="pagination">
                                <li class="page-item <?php if($paged-1 <= 0) echo "disabled"; ?>"><a class="page-link" href="?page=<?=$paged-1;?>">Anterior</a></li>
                                <?php
                                    for ($i=1; $i <= $total_pages; $i++) { 
                                ?>
                                <li class="page-item <?php if($i == $paged) echo "active";?> "><a class="page-link" href="?page=<?=$i;?>"><?=$i;?></a></li>
                                <?php
                                    }
                                ?>
                                <li class="page-item <?php if($paged >= $total_pages) echo "disabled"; ?>"><a class="page-link" href="?page=<?=$paged+1;?>">Próximo</a></li>
                            </ul>
                        </nav>
                        <?php
                            }
                        }else{
                            echo "Nenhum post encontrado.";
                        }
                    ?>
                </section> 
                <?php get_template_part('sidebar', get_post_format() );  ?>
            </div>
        </div>

        <?php get_footer(); ?>
            
        <article class="card mb-4 d-none" id="default-post">
            <a href="#" class="pb-2 post-link post-link-image">
            </a>
            <header class="card-header px-0 pb-0 pt-0">
                <div class="card-meta">
                    <a  class="post-link" href="#"><time class="post-time" datetime="2017-10-03 20:00" data-tid="2"></time></a> em <a class="link-category" href="" rel="category tag"></a>
                </div>
                <a class="post-link" href="">
                    <h3 class="card-title post-title"></h3>
                </a>
            </header>
            <div class="card-body px-0 pt-0">
                <div class="card-text">
                    <p class="post-excerpt"></p>
                    <div class="row">
                        <div class="col-6">
                            <a href="#" class="card-read-more post-link">                                        
                                Continue reading
                            </a>
                        </div>
                        <div class="col-6 text-right">
                                <a href="#" class="no-decoration post-link">
                                    <i class="far fa-comment-alt"></i>
                                    <span class="post-ncomments"></span>
                                </a>
                        </div>
                    </div>
                </div>
            </div>
        </article>

        <script type='text/javascript'>
            var url_load_posts = "<?php echo admin_url( 'admin-ajax.php' ); ?>";
            var security_key = "<?php echo wp_create_nonce("load_more_posts"); ?>";
        </script>
        <script type='text/javascript' src='<?=get_template_directory_uri();?>/js/index/main.js'></script>
    </body>
</html>