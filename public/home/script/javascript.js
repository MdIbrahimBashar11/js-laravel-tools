// ======================================== NAVBAR  ========================================
var hamburgerCheckbox = document.querySelector('.hambuger__checkbox'),
    sideMenu  = document.querySelector('.side__menu-bar'),
    closeSideMenu = document.querySelector('.close__menu-bar-btn'),
    navMenuLink = document.querySelectorAll('.navmenu__link');

hamburgerCheckbox.addEventListener('click', function(e){
  sideMenu.classList = 'side__menu-bar show';
})

closeSideMenu.addEventListener('click', closeSideMenuFunction);

navMenuLink.forEach(function(element){
  element.addEventListener('click', closeSideMenuFunction);
})

function closeSideMenuFunction(e){
  sideMenu.classList = 'side__menu-bar hide';
}





// ======================================== NAVBAR ACTIVATED LINK ========================================
const sections = document.querySelectorAll('section[id]');

window.addEventListener('scroll', scrollActive);

function scrollActive(){
  const scrollY = window.pageYOffset;

  sections.forEach(current =>{
    const sectionHeight = current.offsetHeight;
    const sectionTop = current.offsetTop - 50;
    var sectionId = current.getAttribute('id');

    if (scrollY > sectionTop && scrollY <= sectionTop + sectionHeight){
      document.querySelector('.nav__links a[href*=' + sectionId + ']').classList.add('active-link');
    }else{
      document.querySelector('.nav__links a[href*=' + sectionId + ']').classList.remove('active-link');
    }
  })
}





