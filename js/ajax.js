'use strict';

export {fetchCats};



async function fetchCats() {
    const response = await fetch('ajax_get_cats.php');
    const neko = await response.json();
    const nekos = [];
    for (let i = 0; i < neko.length; i++) {
        nekos.push(neko[i]);
    }
    return nekos;
    
}