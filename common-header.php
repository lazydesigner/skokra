<header>
    <div class="container">
        <nav class="nav">
            <a href="<?= get_url() ?>" class="logo"><img src="<?= get_url() ?>assets/images/SKOKRA+LOGO+NEW+(2).webp.png" width="100%" height="100%" alt=""></a>
            <ul>

                <?php if (!isset($_SESSION['email'])) { ?>

                    <li><a href="<?= get_url() ?>login/"><i class="ri-login-box-line"></i> Login</a></li>
                    <li><a href="<?= get_url() ?>signup/"><i class="ri-edit-circle-line"></i> Sign up</a></li>
                <?php } else { ?>
                    <li class="user-account">
                        <div id="open-private-area"><i class="ri-user-star-line"></i><br><small><?=$_SESSION['email'] ?></small></div>
                    </li>
                <?php } ?>
                <li><a id="forward-the-link" data-href="<?= get_url() ?>u/post-insert/"><button class="post-your-ad"><span>POST YOUR AD</span><i class="ri-arrow-right-line"></i></button></a></li>
            </ul>
        </nav>
    </div>
</header>
<?php if (empty($dashboard)) { ?>
    <div class="search-header">
        <div class="container">
            <form action="" autocomplete="off">
                <div>
                    <div class="form-group">
                        <select name="category" id="">
                            <option value="call-girls">Call Girls</option>
                            <option value="male-escorts">Male Escorts</option>
                            <option value="massage">massage</option>
                            <option value="adult-meeting">Adult Meeting</option>
                            <option value="transsexual">Transsexual</option>
                        </select>
                        <input type="search" placeholder="Search Here...">
                    </div>
                    <div class="form-group">
                        <select name="state" id="">
                            <option value="all">All the regions</option>
                            <option value="delhi">Delhi</option>
                            <option value="agra">Agra</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="goa">Goa</option>
                            <option value="pune">Pune</option>
                            <option value="others">Others</option>
                        </select>
                        <select name="cities" id="">
                            <option value="delhi">Delhi</option>
                            <option value="agra">Agra</option>
                            <option value="mumbai">Mumbai</option>
                            <option value="goa">Goa</option>
                            <option value="pune">Pune</option>
                            <option value="others">Others</option>
                        </select>
                        <select name="area" id="">
                            <option value="all">all</option>
                        </select>
                        <button><i class="ri-search-2-line"></i> Search</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php } ?>