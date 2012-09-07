(function($){
    //open help window
    Mousetrap.bind('?', function() { 
        $('#mouse').slideToggle('fast');
    });

    //open help window
    Mousetrap.bind('esc', function() { 
        $('#mouse').slideUp('fast');
    });

    //focus search box
    Mousetrap.bind('/', function() { 
        var adminBar = $('#adminbar-search');
        
        if(adminBar.length) {
            adminBar.focus();
        } else {
            $('#s').focus();
        }
        
        return false;
    });

    //toggle the debug-bar
    Mousetrap.bind('d', function() {
        if(typeof wpDebugBar != 'undefined') {
            wpDebugBar.toggle.visibility();
        }
    });

    //reload current page
    Mousetrap.bind('r', function() { location.reload();});

    Mousetrap.bind('g h', function() { _goto(mouse.home);}); //homepage
    Mousetrap.bind('g l', function() { _goto(mouse.login);}); //login page
    Mousetrap.bind('g d', function() { _goto(mouse.dashboard);}); //dashboard
    Mousetrap.bind('g c', function() { _goto(mouse.edit_comments);}); //dashboard
    Mousetrap.bind('g t', function() { _goto(mouse.themes);}); //themes page
    Mousetrap.bind('g p', function() { _goto(mouse.plugins);}); //plugins page
    Mousetrap.bind('g u', function() { _goto(mouse.users);}); //users page
    Mousetrap.bind('g s', function() { _goto(mouse.settings);}); //settings page

    Mousetrap.bind('p a', function() { _goto(mouse.post_all);}); //all posts
    Mousetrap.bind('p n', function() { _goto(mouse.post_new);}); //new post
    Mousetrap.bind('P a', function() { _goto(mouse.page_all);}); //all page
    Mousetrap.bind('P n', function() { _goto(mouse.page_new);}); //new page

    //edit post
    Mousetrap.bind('e', function() {
        if(mouse.edit_link == null ) {
            alert('can not edit here');
            return false;
        } else {
            _goto(mouse.edit_link);
        }
    });

    /**
     * Goto a page url
     * 
     * @param page url
     */
    function _goto(url) {
        location.href = url;
    }

})(jQuery);
