<div class="private-area-background" id="private-area-background">
    <div class="private-area">
        <div class="private-area-heading">
            <strong>Private Area</strong>
            <div id="cloase-the-private-area">X</div>
        </div>
        <div class="private-area-body">
            <div class="private-area-subheading">Hi! <?php if(isset($_SESSION['email'])){echo $_SESSION['email']; } ?></div>
            <div class="private-area-action">
                <div class="private-area-items">
                    <a href="<?=get_url()?>u/account/dashboard"><span><i class="ri-home-5-line"></i><br>
                        Dashboard</span></a>
                </div>
                <div class="private-area-items">
                    <a href="<?=get_url() ?>u/account/ads"><span><i class="ri-edit-circle-fill"></i><br>
                        Your Ad</span></a>
                </div>
                <div class="private-area-items">
                    <span><i class="ri-database-2-fill"></i><br>Credits</span>
                </div>
                <div class="private-area-items">
                    <span><i class="ri-line-chart-line"></i><br>Products</span>
                </div>
                <div class="private-area-items">
                    <span><i class="ri-coupon-3-fill"></i><br>Coupons</span>
                </div>
                <div class="private-area-items">
                    <span><i class="ri-account-pin-circle-fill"></i><br>Edit Profile</span>
                </div>
            </div>
            <div class="private-area-logout">
                <a href="<?=get_url() ?>logout/"><button><i class="ri-logout-circle-line"></i><br>LOGOUT</button></a>
            </div>
        </div>

    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        document.getElementById('open-private-area').addEventListener('click', () => {
            document.getElementById('private-area-background').style.display = 'grid'
        })
        document.getElementById('cloase-the-private-area').addEventListener('click', () => {
            document.getElementById('private-area-background').style.display = 'none'
        })
        document.querySelector('.private-area').addEventListener('click', (e) => {
            e.stopPropagation()
        })
        document.getElementById('private-area-background').addEventListener('click', () => {
            document.getElementById('private-area-background').style.display = 'none'
        })
    })
</script>