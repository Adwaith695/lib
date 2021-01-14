/*!
    * Start Bootstrap - SB Admin v6.0.1 (https://startbootstrap.com/templates/sb-admin)
    * Copyright 2013-2020 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
    (function($) {
    "use strict";

    // Add active state to sidbar nav links
    var path = window.location.href; // because the 'href' property of the DOM element is the absolute path
        $("#layoutSidenav_nav .sb-sidenav a.nav-link").each(function() {
            if (this.href === path) {
                $(this).addClass("active");
            }
        });

    // Toggle the side navigation
    $("#sidebarToggle").on("click", function(e) {
        e.preventDefault();
        $("body").toggleClass("sb-sidenav-toggled");
    });
})(jQuery);


function login(){
    const email = document.getElementById('uem').value;
    const pass = document.getElementById('ups').value;
    let logerrors=[];
    if(!email || ! pass){
        logerrors.push({msg:'Please Fill all the fields'});
    }
    if(logerrors.length >0){
        document.getElementById("logerror").className = 'alert alert-danger';
        logerrors.forEach(function(logerror){
            document.getElementById("logerror").textContent = logerror.msg;
        });
    }else{
        document.getElementById('login-user').submit();
    }
}
