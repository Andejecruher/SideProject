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

// Llama a la API para agregar una tarea
export const addTask = async (title, description, date) => {
    try {
        const response = await axiosInstance.post('/tasks', { title, description, date });
        return response.data;
    } catch (error) {
        return error;
    }
};

// Llama a la API para actualizar una tarea
export const updateTask = async (taskId, title, description, status) => {
    try {
        const response = await axiosInstance.put(`/tasks/${taskId}`, { title, description, status });
        return response.data;
    } catch (error) {
        return error;
    }
};

// Llama a la API para eliminar una tarea
export const deleteTask = async (taskId) => {
    try {
        const response = await axiosInstance.delete(`/tasks/${taskId}`);
        return response.data;
    } catch (error) {
        return error;
    }
};
