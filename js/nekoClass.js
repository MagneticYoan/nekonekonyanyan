'use strict';


// class for all cats
export class Neko {
    constructor(showmin, showmax, url, name, catnip, id, nekoClicked, price) {
        this.showmin = showmin;
        this.showmax = showmax;
        this.url = url;
        this.name = name;
        this.catnip = catnip;
        this.id = id;
        this.nekoClicked = nekoClicked;
        this.domId = `nekoClicker${this.id}`
        this.price = price;
    }
    
    //get a random number between min and max include
    getRandomIntInclusive(min, max) {
      min = Math.ceil(min);
      max = Math.floor(max);
      return Math.floor(Math.random() * (max - min +1)) + min;
    }
    
    //delete the cat and get the timer for the next cat
    deleteNeko() {
        let nextNekoTimer = this.getRandomIntInclusive(this.showmin, this.showmax);
        this.nekoClicked(this.catnip);
        $(`#${this.domId}`).remove();
        
        setTimeout(() => {
            this.showNewNeko();
        }, nextNekoTimer);
    }
    
    //place the cat within the clicker block
    placeNeko(cat) {
        cat[0].style.top = `${this.getRandomIntInclusive(0, $('#clicker').height() - 50)}px`;
        cat[0].style.left = `${this.getRandomIntInclusive(0, $('#clicker').width() - 50)}px`;
    }
    
    // make a cat appear, create the event listeners.
    showNewNeko() {
        let html = `<img src="img/walking_${this.url}.gif" alt="${this.name}" id="${this.domId}" class="nekoImg" />`;
        $('#clicker').append(html);
        this.placeNeko($(`#${this.domId}`));
        
        $(`#${this.domId}`).click(this.deleteNeko.bind(this));
        $(`#${this.domId}`).on('touchstart', this.deleteNeko.bind(this));
    }
    
    //create new instance of neko
    startTimer() {
        const timer = this.showmin;
        setTimeout(() => {
            this.showNewNeko();
        }, timer);
    }
    
}