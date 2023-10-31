function loadContent(page, button) {
    //get the document header and title for later use to get its color property
    const header = document.querySelector('header');
    const title = document.querySelector('header .title-container');
    
    const activeBtnColor = window.getComputedStyle(header).getPropertyValue('background-color').trim();
    const deactiveBtnColor = window.getComputedStyle(title).getPropertyValue('color').trim();
    
    // Using JavaScript to fetch and load content from PHP files
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

//user navigation
