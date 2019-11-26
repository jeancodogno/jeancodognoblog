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
                        <div class="card-body px-0 pt-0">
                            <div class="card-text post-content">
                                <?=get_the_content();?>
                            </div>
                        </div>
                    </article>
                    <hr class="p-0 m-0"/>
                   
                </section> 
                <?php get_template_part('sidebar', get_post_format() );  ?>
            </div>
        </div>

        <?php get_footer(); ?>
            
    </body>
</html>