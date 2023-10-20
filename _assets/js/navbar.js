function openCloseUserMenu(){
    var menu = document.getElementById("scrolledProfile");
    if(menu.className === 'menuOpen'){
        menu.className = 'menuClose';
    }else{
        menu.className = 'menuOpen'
    }

}