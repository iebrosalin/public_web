export  default class Layout {

    static  pictures = [];

    static  initPictures = (pair) => {
        document.querySelector(".aspect-ratio-container").insertAdjacentHTML("beforeend",
            `<div class="aspect-ratio-pictures">
                <img id="img_1" class="img" src=${pair.first}>
                <img id="img_2" class="img" src=${pair.second}>
            </div>`);
        return this.getPictures();
    }

    static  getPictures = () => {
        if(this.pictures.length === 0 ){
            this.pictures =
                [
                    document.getElementById("img_1"),
                    document.getElementById("img_2")
                ];
            return this.pictures;
        }
        return this.pictures;
    }

    static setPairPictures = (pair) => {
        this.pictures[0].src = pair.first;
        this.pictures[1].src = pair.second;
    }

    static hideOverlay = () => {
        document.querySelector("div.overlay-container").style.display = 'none';
    }
    static showOverlay = () => {
        document.querySelector("div.overlay-container").style.display = 'flex';
    }
    static endGame = () => {
        document.querySelector("div.overlay-container").innerHTML = `
            <p class="text-overlay">Demo is completed. Now you can refresh page</p>`;
        this.showOverlay();
    }
}