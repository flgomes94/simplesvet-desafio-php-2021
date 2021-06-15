import axios from 'axios';
// DEFINE AXIOS
const api = axios.create({
  baseURL: process.env.VUE_APP_BACKEND_API,
});

export default api;
