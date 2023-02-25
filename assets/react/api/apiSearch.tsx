import axios from 'axios';

declare var window: any;

const apiSearch = axios.create({
    baseURL: window.APP_REACT_VARS.urlEngineSearch.replace(/\/\s*$/g, ''),
    headers: {
        apiKey: window.APP_REACT_VARS.tokenEngineSearch
    }
})

export default apiSearch;
