import React, {useEffect} from 'react';

export const ShowState = ({setVisible, label}) => {

    useEffect(
        ()=> {
            const timeout = setTimeout(()=> setVisible(false), 2500);

            return () => clearTimeout(timeout);
        },
    );

    return (
        <div className="col-8 align-self-center">
            <div className="row justify-content-center">
                <button className="dark-theme" onClick={setVisible}>
                    Hide
                </button>
                <div className="label-margin">
                    <p className="label-example">{label}</p>
                </div>
            </div>
        </div>
    );
}