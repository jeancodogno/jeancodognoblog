<header>
    <nav class="navbar navbar-expand-lg navbar-light p-1">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="<?=get_template_directory_uri();?>/img/logo.svg" class="d-inline-block align-top" alt="Jean Codogno">
            </a>
            <a href="#" class="d-block d-lg-none navbar-toggler" id="btn-toggle">
                <i class="fas fa-bars"></i>
            </a>
            <div class="d-none d-lg-block ">
                <ul class="navbar-nav ml-auto">
                <li class="nav-item ml-2 <?php if($_SERVER['REQUEST_URI'] == "index.php" || $_SERVER['REQUEST_URI'] == "/") echo "active"; ?>">
                        <a class="nav-link" href="/">Home</a>
                    </li>
                    <?php 
                        $pages = get_pages();
                        foreach ( $pages as $page ) {
                            $url = get_page_link($page->ID);
                    ?>
                    <li class="nav-item ml-2 <?php if(get_the_ID() == $page->ID){ echo "active"; }?>">
                        <a class="nav-link " href="<?=$url;?>"><?=$page->post_title;?></a>
                    </li>
                    <?php
                        }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
</header>