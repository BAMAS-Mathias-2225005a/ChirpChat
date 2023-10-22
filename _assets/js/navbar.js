function openCloseUserMenu(menu){
    closeAllOtherMenu()

    var menuDeroulant = menu.children[1];
    if(menuDeroulant.className === 'menuOpen'){
        menuDeroulant.className = 'menuClose';
    }else{
        menuDeroulant.className = 'menuOpen'
    }
}

function closeAllOtherMenu(){
    const allMenu = document.getElementsByClassName("menuOpen");
    for(const m of allMenu){
        m.className = 'menuClose';
    }
}

