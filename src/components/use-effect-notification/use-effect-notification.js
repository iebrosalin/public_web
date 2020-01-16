import React, {useState} from 'react';

import {ShowState} from "./states/show-state/show-state";
import {HiddenState} from "./states/hidden-state/hidden-state";
import {Layout} from "./layout/layout";

export const UseEffectNotification = () => {

    const [visible, setVisible] = useState(true);

    const label = "useEffect notification";

    if(visible){
        return (
            <Layout
                label={label}
                child = {
                    <ShowState setVisible={() => setVisible(false)} label={"Notification"}/>
                }
            />
        );
    }

    return (
        <Layout
            label={label}
            child = {<HiddenState setVisible={() =>setVisible(true)} label={" Hidden notification"}/>}
        />
    );
};