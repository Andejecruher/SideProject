import React, { createContext, useContext, useState, useEffect } from 'react';
import { getArticles, getCategories, getTags, getLatestPosts, getArticleById, createComment, registerNewsletter } from '@src/Api/api';
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
  const [isLoadingComments, setIsLoadingComments] = useState(false);
  const [article, setArticle] = useState(null);
  const [category, setCategory] = useState(null);
  const [tag, setTag] = useState(null);
  const [search, setSearch] = useState('');
  const [error, setError] = useState(null);
  const [page, setPage] = useState(1);
  const [pageComments, setPageComments] = useState(1);

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
      setIsLoading(true);
      const response = await getArticles(query);
      if (response && response.data) {
        setArticles(response.data);
        setPagination(response.pagination || {});
      }
      setIsLoading(false);
    } catch (err) {
      setIsLoading(false);
      setError('Error fetching articles');
    }
  };

  const fetchArticleById = async (id) => {
    try {
      setIsLoading(true);
      const response = await getArticleById(id);
      if (response && response.data) setArticle(response.data);
      setIsLoading(false);
    } catch (err) {
      setError('Error fetching article');
      setIsLoading(false);
    }
  };

  const fetchArticleByIdComments = async (id) => {
    try {
      setIsLoadingComments(true);
      const response = await getArticleById(id);
      if (response && response.data) setArticle(response.data);
      setIsLoadingComments(false);
    } catch (err) {
      setError('Error fetching article');
      setIsLoadingComments(false);
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

  const fetchCreateComment = async (data) => {
    try {
      const response = await createComment(data);
      if (response && response.data) {
        setArticle(response.data);
      }
    } catch (err) {
      setError('Error creating comment');
    }
  };

  const fetchRegisterNewsletter = async (data) => {
    try {
      const response = await registerNewsletter(data);
      if (response && response.data) {
        return response.data;
      }
    } catch (err) {
      setError('Error registering newsletter');
      return err;
    }
  };

  const fetchAllData = async () => {
    setIsLoading(true);
    await Promise.all([fetchLatestPosts(), fetchArticles(), fetchCategories(), fetchTags()]);
    setIsLoading(false);
  };

  useEffect(() => {

    setTag(null);
    setSearch('');
    if (category === 'all') {
      fetchArticles('');
    }

    if (category && category !== 'all' && category !== 'Todas') {
      const query = `?category=${category.id}`;
      fetchArticles(query);
    }
  }, [category]);

  useEffect(() => {

    setSearch('');
    setCategory('Todas');
    if (tag) {
      const query = `?tag=${tag.id}`;
      fetchArticles(query);
    }
  }, [tag]);

  useEffect(() => {

    setTag(null);
    if (search) {
      const query = `?search=${search}`;
      fetchArticles(query);
    }
  }, [search]);

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
      page,
      search,
      pageComments,
      isLoadingComments,
      setArticle,
      setTag,
      setCategory,
      setSearch,
      setPage,
      setPageComments,
      fetchArticleById,
      fetchAllData,
      fetchArticles,
      fetchCreateComment,
      fetchArticleByIdComments,
      fetchRegisterNewsletter,
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
    console.warn('context is undefined');
  }
  return context;
};