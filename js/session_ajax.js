'use strict';

export async function fetchUserInfo() {
    const response = await fetch('ajax_get_user.php');
    const data = await response.json();
    const defaultUserInfo = { lvl: 1, catnip: 0 };
    if (!data || (data && data.error)) {
        if (window.localStorage.getItem('catnip')) {
            defaultUserInfo.catnip = parseInt(window.localStorage.getItem('catnip'));
        }
        if(window.localStorage.getItem('lvl')) {
            defaultUserInfo.lvl = parseInt(window.localStorage.getItem('lvl'));
        }
        return defaultUserInfo;
    }
    return data;
}

export async function saveUser(userInfo) {
    userInfo = { catnip : window.localStorage.getItem('catnip'), lvl : window.localStorage.getItem('lvl') };
    $.get('ajax_save.php', userInfo, ajaxLoaded);
    
}


function ajaxLoaded () {
    
    const infoTextInIndex = document.querySelector('.inscriptionOk');
    
    if(infoTextInIndex) {
        document.querySelector('.inscriptionOk').textContent = 'Successfully saved.';
    } else {
        $('header').after('<p class="inscriptionOk">Successfully saved.</p>');
    }
    setTimeout(() => {
            document.querySelector('.inscriptionOk').remove();
        }, 5000);
}
