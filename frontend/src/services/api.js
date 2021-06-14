import axios from 'axios';

const api = axios.create({
  baseURL: 'http://172.24.148.212:8000/',
});

export default api;
