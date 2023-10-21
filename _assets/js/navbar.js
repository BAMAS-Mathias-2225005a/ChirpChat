function openCloseUserMenu(menu){
    var menuDeroulant = menu.children[1];
    if(menuDeroulant.className === 'menuOpen'){
        menuDeroulant.className = 'menuClose';
    }else{
        menuDeroulant.className = 'menuOpen'
    }
}

