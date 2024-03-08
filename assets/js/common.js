const links = document.querySelectorAll('#forward-the-link');

links.forEach(link=>{
    const url = link.getAttribute('data-href');
    link.addEventListener('click',()=>{window.location.href = url })
    
})


