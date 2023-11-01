function loadContent(page, button) {
    let adminSection = document.querySelector('.section.admin');
    let userSection = document.querySelector('.section.user');
    if (adminSection) {
        fetch(page) //PHP File
            .then(response => response.text())
            .then(data => {
                adminSection.innerHTML = data;
            });
           
    } else {
        fetch(page) //PHP File
            .then(response => response.text())
            .then(data => {
                userSection.innerHTML = data;
            });
        
    }
    let navs = document.querySelectorAll('.navigation-container .nav'); //User Section Navigations
    console.log(navs);
    if (navs.length === 0) {
        navs = document.querySelectorAll('.nav-container .nav') //Admin Section Navigations
    }
    navs.forEach(nav=>{
        nav.classList.remove('active');
    }) 
    button.classList.add('active');
}

let lastScrollTop = 0;

window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  if (currentScroll > lastScrollTop) {
    // Scrolling down
    document.querySelector("header").classList.add("hidden");
  } else {
    // Scrolling up
    document.querySelector("header").classList.remove("hidden");
  }

  lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
});

