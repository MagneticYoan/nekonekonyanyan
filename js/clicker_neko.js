import { fetchCats } from './ajax.js';
import { Neko } from './nekoClass.js';
import { fetchUserInfo, saveUser } from './session_ajax.js';

document.addEventListener('DOMContentLoaded', async() => {

    //get user info from database or localstorage
    const userInfo = await fetchUserInfo();
    let catnip = parseInt(userInfo.catnip);
    let lvl = parseInt(userInfo.lvl);

    //add catnip
    const nekoClicked = (catnipAmount) => {
        catnip += catnipAmount;
        $("#catnipNumber").text(catnip);
        window.localStorage.setItem('catnip', catnip);
        let userCatnip = { 'key': catnip };
        let catnipPlayerNeeds = document.getElementById('buttonToLevelUp');
        if(catnipPlayerNeeds) {
            catnipPlayerNeeds = catnipPlayerNeeds.dataset.catnip;
            //check catnip to buy a new cat
            if(catnip >= catnipPlayerNeeds) {
                document.getElementById('firstOfTheCats').classList.remove("hiddenCats");
            }
            else {
                document.getElementById('firstOfTheCats').classList.add("hiddenCats");
            }
        }
    }

    //get all cats from database with ajax
    const nekos = await fetchCats();

    //create all type of cat's instances
    let allNekos = [];
    for (const neko of nekos) {
        const { catnip, id, image, name, show_max, show_min, price } = neko;
        allNekos.push(new Neko(show_min, show_max, image, name, parseInt(catnip), id, nekoClicked, price));
    }

    //set the catnip number at the start of the game
    $("#catnipNumber").text(catnip);

    //set the player lvl
    let playerlvl = 1;
    if (userInfo) {
        playerlvl = userInfo.lvl;
        window.localStorage.setItem('lvl', playerlvl);
    }
    else {
        playerlvl = 1;
        window.localStorage.setItem('lvl', playerlvl);
    }

    //show all the available cats in the cathouse (yellow, on the right
    function showGottenCats(id) {
        $('#allPossesedCatsAndAddOn').append(`<article class ="gottenKitten">
        	<img src="img/${nekos[id].image}.png" alt="${nekos[id].name}"/>
        </article>`)
    }

    //start the timer for all the cats available to the player by checking his lvl
    function startAllNeko(allNekos) {
        allNekos.forEach(neko => {
            if (neko.id <= playerlvl) {
                neko.startTimer();
            }
        })
        for (let i = 0; i < playerlvl; i++) {
            showGottenCats(i);
        }
        showNekoToBuy();
    }

    //change the player lvl and start the timer of the new cat
    function levelUp() {
        playerlvl = parseInt(playerlvl) + 1;
        localStorage.setItem('lvl', playerlvl);
        const neko = allNekos.find(neko => neko.id == playerlvl);
        neko.startTimer();
    }
    
    

    //show next cats to buy
    function showNekoToBuy() {
        $('.allNekoLevelToBuy').html('');
        let firstTurn = true;
        for (let i = parseInt(playerlvl); i < parseInt(playerlvl) + 2; i++) {
            if(allNekos[i]) {
        		if(firstTurn) {
        		    $('.allNekoLevelToBuy').append(`<article data-id="${allNekos[i].domId}" class="catLevelIsLock">
        				<img src="img/${allNekos[i].url}.png" alt="${allNekos[i].name}" id="firstOfTheCats" class="hiddenCats"/>
        				<div class="infoAboutCats"><p>Name : ${allNekos[i].name}</p>
        				<p>Catnip: ${allNekos[i].catnip}</p>
        				<p>Price : ${allNekos[i].price}</p>
        				<p>Repop : ${allNekos[i].showmin / 1000 }s - ${allNekos[i].showmax / 1000 }s</p></div>
        				<button id="buttonToLevelUp" data-catnip="${allNekos[i].price}" class="buttonLevel">Adopt</button></article>`);
        		    firstTurn = false;
        			
        			function checkLevelUp() {
        			    const catnipPlayerNeeds = document.getElementById('buttonToLevelUp').dataset.catnip;
                        //check catnip to buy a new cat
                        if(catnip >= catnipPlayerNeeds) {
                            //change the catnip number and set the new one in localstorage
                            catnip -= catnipPlayerNeeds;
                            $("#catnipNumber").text(catnip);
                            window.localStorage.setItem('catnip', catnip);
                            let userCatnip = { 'key': catnip };
                            //change the lvl and start the timer for the new cat
                            levelUp();
                            showGottenCats(playerlvl - 1);
                            showNekoToBuy();
                        }
                        else {
                            const infoTextInIndex = document.querySelector('.inscriptionOk');
    
                            if(infoTextInIndex) {
                                document.querySelector('.inscriptionOk').textContent = 'You need more catnip to adopt this cat';
                            } else {
                                $('header').after('<p class="inscriptionOk">You need more catnip to adopt this cat</p>');
                            }
                            setTimeout(() => {
                                    document.querySelector('.inscriptionOk').remove();
                                }, 5000);
                        }
        			}
        			//allow the player to level up by "buying" a new type of cat
                    $('#buttonToLevelUp').click(() => {
                        checkLevelUp();
                    })
                    $('#buttonToLevelUp').on('touchstart', () => {
                        checkLevelUp();
                    })
                    
                    
        		}
        		else {
        		    $('.allNekoLevelToBuy').append(`<article data-id="${allNekos[i].domId}" class="catLevelIsLock">
        				<img src="img/${allNekos[i].url}.png" alt="${allNekos[i].name}" class="hiddenCats"/>
        				<div class="infoAboutCats"><p>Name : ${allNekos[i].name}</p>
        				<p>Catnip: ${allNekos[i].catnip}</p>
        				<p>Price : ${allNekos[i].price}</p>
        				<p>Repop : ${allNekos[i].showmin / 1000 }s - ${allNekos[i].showmax / 1000 }s</p></div></article>`);
        		}
            }
        }
    }
    
    //Set clicker max height with screen height
    if(window.screen.width < 1200) {
        $("body").css("min-height", screen.height);
    }
    
    
    //delete some of the td in the admin pannel if the screensize is small
    if(window.screen.width < 480) {
        $("#clicker").css("max-height", screen.height);
        $('.notDisplayingOnPhonesTd').remove();
    }
    
    function autoSaveUser() {
        if(userInfo) {
            setTimeout(() => {
                saveUser(userInfo);
                autoSaveUser();
            }, 60000);
        }
    }
    
    
    
    
    //save into database buttons
    $('#saveBtn').click(() => {
        saveUser(userInfo);
    })

    $('#saveBtn').on('touchstart', () => {
        saveUser(userInfo);
    })

    //game start
    autoSaveUser();
    startAllNeko(allNekos);
});