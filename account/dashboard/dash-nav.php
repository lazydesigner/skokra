<header>
    <div class="container">
        <nav>
            <a href="" class="brand">
                <img src="<?= get_url() ?>assets/images/SKOKRA+LOGO+NEW+(2).webp.png" width="100%" height="100%" alt="Skokra Logo">
            </a>
            <span>
                <div id="open-private-area"><i class="ri-user-star-line"></i><br><small><?php if(isset($_SESSION['email'])){echo $_SESSION['email']; } ?></small></div>
                <a href="<?= get_url() ?>u/post-insert/"><button class="post-your-ad"><span>POST YOUR AD</span><i class="ri-arrow-right-line"></i></button></a>
            </span>
        </nav>
    </div>
</header>