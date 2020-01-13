import React from 'react';

import './ad-block.css';

const AdBlock = () => {
    return (
        <div className="shit-block  row d-xl-block d-lg-block d-md-none d-sm-none d-none" >
            <div className=" col-12 " style={{
                "justify-content": "center",
                "align-items": "center",
                display: "flex",
                "flex-flow": "column",
                height: "100%"
            }}>
                <p >Here can be your advertising</p>
                {/*<div className="mt-2 row align-self-center">*/}
                {/*    <iframe style={{margin:"auto"}}src="https://www.youtube.com/embed/to2SMng4u1k?showinfo=0&iv_load_policy=3&modestbranding=1&autoplay=1&loop=1" frameborder="0"*/}
                {/*            allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"*/}
                {/*            allowfullscreen="true"></iframe>*/}
                {/*</div>*/}
            </div>
        </div>
    );
};

export default AdBlock;
