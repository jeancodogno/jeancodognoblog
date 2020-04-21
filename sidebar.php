<aside class="col-6 col-sm-5 col-md-4 col-lg-3 d-lg-block">
                    <div style="position: relative;">
                        <ul class="sidenavbar-nav mb-4 pb-2" id="navbar-sidebar">
                            <li class="sidenav-item mb-2 ml-2 <?php if($_SERVER['REQUEST_URI'] == "index.php" || $_SERVER['REQUEST_URI'] == "/") echo "active"; ?>">
                                <a class="sidenav-link" href="/">Home</a>
                            </li>
                            <?php 
                                $pages = get_pages();
                                foreach ( $pages as $page ) {
                                    $url = get_page_link($page->ID);
                            ?>
                            <li class="sidenav-item mb-2 ml-2 <?php if(get_the_ID() == $page->ID){ echo "active"; }?>">
                                <a class="sidenav-link " href="<?=$url;?>"><?=$page->post_title;?></a>
                            </li>
                            <?php
                                }
                            ?>
                        </ul>
                        <img src="<?=get_template_directory_uri();?>/img/perfil.jpg" alt="Jean Carlo Codogno" class="w-100 border-radius"/>
                        <h4 class="pt-3">Welcome</h4>
                        <p><?php bloginfo('description'); ?></p>
                        <h4 class="pt-3">Follow Me</h4>
                        
                        <ul class="d-flex p-0 list-social">
                            <li class="mr-3">
                                <a href="https://github.com/jeancodogno"><i class="fab fa-github"></i></a>
                            </li>
                            <li class="mr-3">
                                <a href="https://twitter.com/jeancodogno"><i class="fab fa-twitter"></i></a>
                            </li>
                            <li class="mr-3">
                                <a href="https://www.kaggle.com/jcodogno"><i class="icon-icon-kaggle"></i></a>
                            </li>
                            <li class="mr-3">
                                <a href="https://www.linkedin.com/in/jeancarlocodogno"><i class="fab fa-linkedin"></i></a>
                            </li>
                            <li class="mr-3">
                                <a href="https://www.medium.com/@jeancarlo.eng.comp"><i class="fab fa-medium"></i></a>
                            </li>
                            <li class="mr-3">
                                <a href="/feed.xml"><i class="fas fa-rss-square"></i></a>
                            </li>
                            <li class="mr-3">
                                <a href="mailto:jeancarlo.eng.comp@outlook.com"><i class="fas fa-envelope-open"></i></a>
                            </li>
                        </ul>

                        <!-- <h4 class="pt-3">Categories</h4>
                        <ul class="p-0">
                            <li class="pb-1"><a href="#">Design Skills</a></li>
                            <li class="pb-1"><a href="#">Projects</a></li>
                            <li class="pb-1"><a href="#">Social Life</a></li>
                            <li class="pb-1"><a href="#">Uncategorized</a></li>
                        </ul>

                        <h4 class="pt-3">Tags</h4>
                        <ul class="p-0 d-flex">
                            <li class="mr-2 no-grap"><a href="#">action</a></li>
                            <li class="mr-2 no-grap"><a href="#">creative</a></li>
                            <li class="mr-2 no-grap"><a href="#">design</a></li>
                            <li class="mr-2 no-grap"><a href="#">gopro</a></li>
                            <li class="mr-2 no-grap"><a href="#">image</a></li>
                        </ul> -->
                    </div>
                </aside>