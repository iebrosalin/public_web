import React from 'react';
import ReactDOM from 'react-dom';

import {Header} from "./components/header/header";
import {UseStateExample} from "./components/use-state-example/use-state-example";
import {UseEffectNotification} from "./components/use-effect-notification/use-effect-notification";
import {UseEffectPersonName} from "./components/use-effect-person-name/use-effect-person-name";

import './bootstrap.min.css';
import './styles.css';



const App = () => {
  return (
      <main>
          <Header/>
          <div className="container padding-container">
            <UseStateExample />
            <UseEffectNotification/>
            <UseEffectPersonName/>
          </div>
      </main>
    );
};



ReactDOM.render(<App />,
  document.getElementById('root'));
