import React, {useState, useEffect, useCallback, useMemo} from 'react';

const getPerson = (id) => {
    return fetch(`https://swapi.co/api/people/${id}/`)
        .then(res=>res.json())
        .then(data => data);
}

const useRequest = (request) => {

    const initialState = useMemo(
        () => ({
            data: null,
            loading: true,
            error: null
        }), []);

    const [dataState, setDataState] = useState(initialState);

    useEffect(() => {
        setDataState(initialState);
        let canceled = false;
        request()
            .then(data => !canceled && setDataState({
                data,
                loading: false,
                error: null
            }))
            .catch(error => !canceled && setDataState({
                data: null,
                loading: false,
                error
            })
        );

        return () => canceled = true;
        },[request, initialState]
    );

    return dataState;
}

const usePersonName =(id)=>{
    const  request = useCallback(
        () => getPerson(id),
        [id]
    );

    return  useRequest(request);

}

export const ShowState = ({setVisible, increment, decrement, count}) => {

    const {data, loading, error} =usePersonName(count);

    let result;
    if(error){
        result = <div className="label-margin">
            <p className="label-example">Something is wrong</p>
        </div>;
    }
    else if(loading){
        result = <div className="label-margin">
            <p className="label-example">loading...</p>
        </div>;
    }
    else {
        result = <div className="label-margin">
            <p className="label-example">{count} - {data.name}</p>
        </div>;
    }

    return (
        <div className="col-8 align-self-center">
            <div className="row justify-content-center">
                <button className="dark-theme" onClick={setVisible}>
                    Hide
                </button>
                <button className="font-control" onClick={increment}>
                    +
                </button>
                <button className="font-control" onClick={decrement}>
                    -
                </button>
                { result }
            </div>
        </div>
    );
}