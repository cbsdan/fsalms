function loadContent(page, button) {
    fetch(page) //PHP File
        .then(response => response.text())
        .then(data => {
            document.querySelector('.section').innerHTML = data;
        });
    
    let navs = document.querySelectorAll('.navigation-container .nav');
    navs.forEach(nav=>{
        nav.classList.remove('active');
    }) 
    button.classList.add('active');
}

