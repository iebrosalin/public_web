import GeneratorSequence from "../generator_sequnce/generator_sequence";
import Layout from "../layout/layout";

export default class App {

   state = {
        'position': 0,
        'pairs': [],
    };
   images = [];
   timerId = 0;

   getCurrentPair = () => this.state.pairs[this.state.position];


   init = () => {
       this.state.pairs = GeneratorSequence.generatePairs();
       this.images = Layout.initPictures(this.getCurrentPair());
       setTimeout(
           () => {
               Layout.hideOverlay();
               this.timerId = setInterval(this.changePair, 1000);
           },
           1000
       );
   }

   changePair = () => {
       if(this.state["position"] == 9){
           clearInterval(this.timerId);
           Layout.endGame();
           return;
       }

       ++ this.state.position;

       Layout.setPairPictures(this.getCurrentPair())
   }

   run = () => this.init();
}
