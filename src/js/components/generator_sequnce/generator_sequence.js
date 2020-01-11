import Pair from "../../model/pair";

export  default class GeneratorSequence {

    static generatePairs = () =>{
        let arr = [];
        for (let i = 0; i != 10; ++i) arr.push(this.generateFace(i));
        return arr;
    }

    static generateFace (numberPair) {
        return new Pair(
            `images/${numberPair}${this.randomInteger(1,5)}.png`,
            `images/${numberPair}${this.randomInteger(1,5)}.png`,
        );
    }

    static randomInteger(min, max){
        // случайное число от min до (max+1)
        let rand = min + Math.random() * (max + 1 - min);
        return Math.floor(rand);
    }
}

