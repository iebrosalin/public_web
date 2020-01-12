import React from 'react';

import './spinner.css';

const Spinner = () => {
  return (
      <div style={{width: "100%", height: "100%",}}>
    <div className="lds-css" >
      <div className="lds-double-ring" style={{margin:"auto"}}>
        <div></div>
        <div></div>
      </div>
    </div>
      </div>
  );
};

export default Spinner;
