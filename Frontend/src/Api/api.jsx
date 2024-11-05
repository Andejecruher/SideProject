// src/api/apiService.js
import axiosInstance from './axiosInstance';


// Llama a la API para obtener los articulos
export const getArticles = async () => {
    try {
        const response = await axiosInstance.get('/articles');
        return response.data;
    } catch (error) {
        return error;
    }
};
// Llama a la API para obtener los posts mas recientes
export const getLatestPosts = async () => {
    try {
        const response = await axiosInstance.get('/articles-latest');
        return response.data;
    } catch (error) {
        return error;
    }
};
// Llama a la API para obtener los categories
export const getCategories = async () => {
    try {
        const response = await axiosInstance.get('/categories');
        return response.data;
    } catch (error) {
        return error;
    }
};
// Llama a la API para obtener los tags
export const getTags = async () => {
    try {
        const response = await axiosInstance.get('/tags');
        return response.data;
    } catch (error) {
        return error;
    }
};

