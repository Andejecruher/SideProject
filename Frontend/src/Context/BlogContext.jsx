import React, { createContext, useContext, useState, useEffect } from 'react';
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
  const [isLoading, setIsLoading] = useState(true);
  const [article, setArticle] = useState({});
  const [category, setCategory] = useState(null);
  const [tag, setTag] = useState(null);
  const [error, setError] = useState(null);

  const fetchLatestPosts = async () => {
    try {
      const response = await getLatestPosts();
      if (response && response.data) setLatestPosts(response.data);
    } catch (err) {
      setError('Error fetching latest posts');
    }
  };

  const fetchArticles = async (query) => {
    try {
      const response = await getArticles(query);
      if (response && response.data) {
        setArticles(response.data);
        setPagination(response.pagination || {});
      }
    } catch (err) {
      setError('Error fetching articles');
    }
  };

  const fetchCategories = async () => {
    try {
      const response = await getCategories();
      if (response && response.data) setCategories(response.data);
    } catch (err) {
      setError('Error fetching categories');
    }
  };

  const fetchTags = async () => {
    try {
      const response = await getTags();
      if (response && response.data) setTags(response.data);
    } catch (err) {
      setError('Error fetching tags');
    }
  };

  useEffect(() => {
    // Llamar a todas las funciones de carga
    const fetchAllData = async () => {
      setIsLoading(true);
      await Promise.all([fetchLatestPosts(), fetchArticles(), fetchCategories(), fetchTags()]);
      setIsLoading(false);
    };

    fetchAllData();
  }, []);

  useEffect(() => {
    if (category === 'Todas') {
      fetchArticles('');
    }

    if (category && category !== 'Todas') {
      const query = `?category=${category.id}`;
      fetchArticles(query);
    }
  }, [category]);

  return (
    <BlogContext.Provider value={{
      latestPosts,
      articles,
      categories,
      tags,
      pagination,
      isLoading,
      error,
      article,
      tag,
      category,
      setArticle,
      setTag,
      setCategory
    }}>
      {children}
    </BlogContext.Provider>
  );
};

BlogProvider.propTypes = {
  children: PropTypes.node.isRequired,
};

export const useBlog = () => {
  const context = useContext(BlogContext);
  if (context === undefined) {
    throw new Error('useBlog must be used within a BlogProvider');
  }
  return context;
};