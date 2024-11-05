// src/api/axiosInstance.js
import axios from 'axios';

const API_URL = import.meta.env.VITE_BACKEND_API_URL;

const axiosInstance = axios.create({
    baseURL: API_URL,
    headers: {
        'Content-Type': 'application/json',
    },
});

// Interceptor para configurar el token en cada solicitud
axiosInstance.interceptors.request.use(
    (config) => {
        const token = import.meta.env.VITE_BACKEND_API_TOKEN; // Obtén el token de la cookie
        if (token) {
            config.headers['Authorization'] = `Bearer ${token}`;
        }
        return config;
    },
    (error) => Promise.reject(error)
);

// Interceptor para manejar errores de respuesta
axiosInstance.interceptors.response.use(
    (response) => response,
    (error) => {
        return Promise.reject(error);
    }
);

export default axiosInstance;
