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
    if (navs.length === 0) {
        navs = document.querySelectorAll('.navbar-container .nav') //Admin Section Navigations
    }
    navs.forEach(nav=>{
        nav.classList.remove('active');
    }) 
    button.classList.add('active');
}

let lastScrollTop = 0;
let headerElement = document.querySelector("header");
let scrollTopElement = document.querySelector('.scroll-top');
window.addEventListener("scroll", () => {
  const currentScroll = window.pageYOffset || document.documentElement.scrollTop;

  //if the user click to make the window full screen, the following code will not work
  if (!isFullScreen) {
      if (currentScroll > lastScrollTop) {
        // Scrolling down
        headerElement.classList.add("hidden");
      } else {
        // Scrolling up
        headerElement.classList.remove("hidden");
      }
    
      lastScrollTop = currentScroll <= 0 ? 0 : currentScroll; // For Mobile or negative scrolling
  }
  if (currentScroll === 0) {
    scrollTopElement.style.display = 'none';
    } else {
      scrollTopElement.style.display = 'block';

  }
});

//toggling the full screen or exit full screen button
let isFullScreen = false;
let screenToggle = document.querySelector('.screen-toggle');
let mainElement = document.querySelector('main');
let footerElement = document.querySelector('footer');
let screenToggleLabel = document.querySelector('.screen-toggle span')
screenToggle.addEventListener('click', ()=>{
    if (!headerElement.classList.contains('hidden')) {
        headerElement.classList.add('hidden');
        mainElement.style.paddingTop = 0;
        screenToggle.style.top = '1rem';
        isFullScreen = true;
        screenToggleLabel.innerHTML = 'Exit Full Screen';
        footerElement.style.display = 'none';
    } else {
        headerElement.classList.remove('hidden');
        mainElement.style.paddingTop = '7rem';
        screenToggle.style.top = '8rem';
        isFullScreen = false;
        screenToggleLabel.innerHTML = 'Make Full Screen';
        footerElement.style.display = 'block';
    }
})

