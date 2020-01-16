import React, {useState} from 'react';

import {ShowState} from "./states/show-state/show-state";
import {HiddenState} from "./states/hidden-state/hidden-state";
import {Layout} from "./layout/layout";

export const UseEffectPersonName = () => {

    const [visible, setVisible] = useState(true);
    const [count, setCount] = useState(1);

    const label = "useEffect person name";

    if(visible){
        return (
            <Layout
                label={label}
                child = {
                    <ShowState
                        setVisible={() => setVisible(false)}
                        increment={()=> setCount((count) =>{
                            if(count === 5){
                                return  count;
                            }
                            return  count + 1
                        })}
                        decrement={()=> setCount((count) =>{
                          if(count === 1){
                              return  count;
                          }
                          return  count - 1
                        })}
                        count={count}
                    />
                }
            />
        );
    }

    return (
        <Layout
            label={label}
            child = {<HiddenState setVisible={() =>setVisible(true)}/>}
        />
    );
};