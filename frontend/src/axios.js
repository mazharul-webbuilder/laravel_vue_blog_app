import axios from "axios";

axios.defaults.baseURL = 'http://127.0.0.1:8000/api';

// Define the interceptor
axios.interceptors.request.use(
    function (config) {
        // Get the token from local storage
        const token = localStorage.getItem('accessToken');

        // If token is available, add it to the request headers
        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }

        return config;
    },
    function (error) {
        return Promise.reject(error);
    }
);

export default axios;