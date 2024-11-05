import React, { createContext, useState, useEffect } from 'react';
import { getArticles, getCategories, getTags, getLatestPosts } from '@src/Api/api';
import PropTypes from 'prop-types';

// Crear el contexto
export const BlogContext = createContext();

// Crear el proveedor del contexto
export const BlogProvider = ({ children }) => {
  const [latestPosts, setLatestPosts] = useState([]);
  const [articles, setArticles] = useState([]);
  const [categories, setCategories] = useState([]);
  const [tags, setTags] = useState([]);
  const [pagination, setPagination] = useState({});

  useEffect(() => {
    // Función para obtener los datos de la API
    const fetchData = async () => {
      try {
        const latestPostsResponse = await getLatestPosts();
        setLatestPosts(latestPostsResponse.data);

        const articlesResponse = await getArticles();
        setArticles(articlesResponse.data);

        const categoriesResponse = await getCategories();
        setCategories(categoriesResponse.data);

        const tagsResponse = await getTags();
        setTags(tagsResponse.data);

        // Suponiendo que la paginación viene en la respuesta de los artículos
        setPagination(articlesResponse.pagination);
      } catch (error) {
        console.error('Error fetching data:', error);
      }
    };

    fetchData();
  }, []);

  return (
    <BlogContext.Provider value={{ latestPosts, articles, categories, tags, pagination }}>
      {children}
    </BlogContext.Provider>
  );
};

BlogProvider.propTypes = {
  children: PropTypes.node.isRequired,
};