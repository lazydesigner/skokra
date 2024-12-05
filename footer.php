

<footer>
    <ul>
        <li><a href="<?=get_url() ?>terms-and-conditions/">Terms and Conditions</a></li>
        <li><a href="<?=get_url() ?>privacy-and-policy/">Privacy Policy</a></li>
        <li><a href="<?=get_url() ?>">Contact us</a></li>
        <li><a href="<?= get_url() ?>u/post-insert/">Promote your ads</a></li>
        <li><a href="<?=get_url() ?>">Help</a></li>
        <li><a href="https://skokra.com">Skokra Network</a></li>
    </ul>
    <div class="footer-follow">
    <a href="<?= get_url() ?>" class="logo"><img src="<?= get_url() ?>assets/images/SKOKRA+LOGO+NEW+(2).webp.png" width="100%" height="100%" alt="" aria-label="skokra Ads network"></a>
        <!-- <ul>
            <li><a href="" aria-label="youtube"><i class="ri-youtube-fill"></i></a></li>
            <li><a href="" aria-label="instagram"><i class="ri-instagram-fill"></i></a></li>
            <li><a href="" aria-label="facebook"><i class="ri-facebook-fill"></i></a></li>
            <li><a href="" aria-label="twitter"><i class="ri-twitter-fill"></i></a></li>
        </ul> -->

        <div class="rta">
            <img src="<?= get_url() ?>assets/images/download.jpeg" width="100%" height="100%" alt="">
        </div>
    </div>
</footer>


<script>
    function remove_agree_terms_hide(){
        setTimeout(()=>{
        hidepop()
    },700)
    }  
    

    function hidepop(){
        document.body.classList.remove('body-no-scroll');
        var remove_agree_terms = document.getElementById("confirm-18");
        remove_agree_terms.style.display = "none";
    }

if (!window.location.href.endsWith('/')) {
        // Add a trailing slash to the URL
        window.history.replaceState(null, null, window.location.href + '/');
    }
    if(document.getElementById('list-of-states')){
    document.getElementById('list-of-states').addEventListener('change', (e) => {
        let state = e.target.value;
        const statedata = new FormData();
        statedata.append('activity', 'statesd');
        statedata.append('state', state);
        fetch('<?= get_url() ?>u/activity-center/', {
                method: 'POST',
                body: statedata
            })
            .then((response) => response.json())
            .then((data) => {
                document.getElementById('cities_s').innerHTML = data;
            })
    })
}
    if(document.getElementById('searchform')){
    document.getElementById('searchform').addEventListener('submit', (e) => {
        e.preventDefault()
        categoryf = document.getElementById('categoryf').value;
        list_of_states = document.getElementById('list-of-states').value;
        cities_s_ = document.getElementById('cities_s').value;
        
        cities_s = cities_s_.split("_");

        search = document.getElementById('search').value;

        if (list_of_states.trim().length != 0) {
            window.location.href = '<?= get_url() ?>' + categoryf + '/' + list_of_states+ '/';
        }
        if (cities_s[0].trim().length != 0) {
            window.location.href = '<?= get_url() ?>' + categoryf + '/'+cities_s[1]+ '/' + cities_s[0]+ '/';
        }

        if (search.trim().length != 0) {
            if (list_of_states.trim().length != 0){
                window.location.href = '<?= get_url() ?>' + categoryf + '/' + list_of_states+'/?s='+search
            }
            if (cities_s[0].trim().length != 0) {
                window.location.href = '<?= get_url() ?>' + categoryf + '/' + cities_s[0]+'/?s='+search
            }
            if(list_of_states.trim().length == 0 && cities_s[0].trim().length == 0){
            window.location.href = '<?= get_url() ?>' + categoryf+'/?s='+search;
            }

        }

        if(list_of_states.trim().length == 0 && cities_s[0].trim().length == 0 && search.trim().length == 0){
            window.location.href = '<?= get_url() ?>' + categoryf;
        }

    })}
</script>