import React, { useState } from 'react';

import '../../styles.css'

export const UseStateExample = () => {

    const [color, setColor] = useState('#040135');
    const [fontSize, setFontSize] = useState(14);

    return (
        <div className="row mt-5 align-items-center">
            <div className="col-10 offset-1 p-3 font-weight-bold"
                 style={{
                     backgroundColor: color,
                     fontSize: `${fontSize}px`
                 }}>
                <div className="row">
                    <div className="col-4  align-self-center">
                        <div className="row justify-content-center label-padding">
                            <p className="label-example">useState</p>
                        </div>
                    </div>
                    <div className="col-8 align-self-center">
                        <div className="row justify-content-center">
                            <button className="dark-theme"
                                    onClick={() => setColor('#040135')}>
                                Dark
                            </button>
                            <button className="light-theme"
                                    onClick={() => setColor('#003153')}>
                                Light
                            </button>
                            <button className="font-control"
                                    onClick={() => setFontSize((s) => s + 2)}>
                                +
                            </button>
                            <button
                                className="font-control"
                                onClick={() => setFontSize((s) => s - 2)}>
                                -
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    );
};