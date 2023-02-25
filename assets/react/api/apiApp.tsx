import axios from 'axios';

declare var window: any;

const apiApp = axios.create({
    baseURL: window.APP_REACT_VARS.urlBase.replace(/\/\s*$/g, '')
})

export default apiApp;
