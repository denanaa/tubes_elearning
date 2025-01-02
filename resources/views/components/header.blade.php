<header 
    x-data="{ isNavbarFixed: false, isHamburgerActive: false }" 
    x-init="() => {
        window.addEventListener('scroll', () => {
            isNavbarFixed = window.pageYOffset > $el.offsetTop;
        });
    }"
    :class="{ 'navbar-fixed': isNavbarFixed }" 
    class="bg-transparent absolute top-0 left-0 w-full flex items-center z-10 transition duration-300 bg-[#37AFE1]"
>
