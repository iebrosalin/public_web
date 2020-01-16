import React from 'react';


export const HiddenState = ({setVisible}) => {
    return (<div className="col-8 align-self-center">
        <div className="row justify-content-center">
            <button className="dark-theme" onClick={setVisible}>
                Show
            </button>
        </div>
    </div>);
};