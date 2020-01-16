import React from 'react';


export const HiddenState = ({setVisible, label}) => {
    return (<div className="col-8 align-self-center">
        <div className="row justify-content-center">
            <button className="dark-theme" onClick={setVisible}>
                Show
            </button>
            <div className="label-margin">
                <p className="label-example">{label}</p>
            </div>
        </div>
    </div>);
};