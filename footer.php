<footer>
    <ul>
        <li><a href="">Terms and Conditions</a></li>
        <li><a href="">Privacy Policy</a></li>
        <li><a href="">Contact us</a></li>
        <li><a href="">Promote your ads</a></li>
        <li><a href="">Help</a></li>
        <li><a href="">Skokra Network</a></li>
    </ul>
    <div class="footer-follow">
        <ul>
            <li><a href="" aria-label="youtube"><i class="ri-youtube-fill"></i></a></li>
            <li><a href="" aria-label="instagram"><i class="ri-instagram-fill"></i></a></li>
            <li><a href="" aria-label="facebook"><i class="ri-facebook-fill"></i></a></li>
            <li><a href="" aria-label="twitter"><i class="ri-twitter-fill"></i></a></li>
        </ul>

        <div class="rta">
            <img src="<?= get_url() ?>assets/images/download.jpeg" width="100%" height="100%" alt="">
        </div>
    </div>
</footer>

<script>
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
        cities_s = document.getElementById('cities_s').value;
        search = document.getElementById('search').value;

        if (list_of_states.trim().length != 0) {
            window.location.href = '<?= get_url() ?>' + categoryf + '/' + list_of_states;
        }
        if (cities_s.trim().length != 0) {
            window.location.href = '<?= get_url() ?>' + categoryf + '/' + cities_s;
        }

        if (search.trim().length != 0) {
            if (list_of_states.trim().length != 0){
                window.location.href = '<?= get_url() ?>' + categoryf + '/' + list_of_states+'/?s='+search
            }
            if (cities_s.trim().length != 0) {
                window.location.href = '<?= get_url() ?>' + categoryf + '/' + cities_s+'/?s='+search
            }
            if(list_of_states.trim().length == 0 && cities_s.trim().length == 0){
            window.location.href = '<?= get_url() ?>' + categoryf+'/?s='+search;
            }

        }

        if(list_of_states.trim().length == 0 && cities_s.trim().length == 0 && search.trim().length == 0){
            window.location.href = '<?= get_url() ?>' + categoryf;
        }

    })}
</script>