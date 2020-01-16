import React from 'react';

export const Layout = ({child, label}) => {

    return (
        <div className="row mt-5 align-items-center">
            <div className="col-10 offset-1 p-3 font-weight-bold " style={{
                backgroundColor: "#040135",
                fontSize: `14px` }}>
                <div className="row justify-content-center">
                    <div className="col-4  align-self-center">
                        <div className="row justify-content-center label-padding">
                            <p className="label-example">{label}</p>
                        </div>
                    </div>
                    {child}
                </div>
            </div>
        </div>
    );
}