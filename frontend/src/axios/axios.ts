import axios from "axios";

const axiosInstance = axios.create({
  baseURL: "http://127.0.0.1:8000/",
  timeout: 1000,
  withCredentials: true,
  withXSRFToken: true,
  headers: {
    "Accept": "application/json",
    "Content": "application/json",
  }
})

axiosInstance.interceptors.request.use(function(config) {
  const token = localStorage.getItem('access_token');
  if (token) {
    config.headers['Authorization'] = `Bearer ${token}`;
  }
  return config;
});

export default axiosInstance;
