import React, { useEffect } from 'react';
import { useBlog } from '@src/Context/BlogContext';
import Container from '@mui/material/Container';
import BlogArticle from '@src/components/BlogArticle/BlogArticle';
import Loader from '@src/components/Loader/Loader';
import './Article.css';

function Article() {
  const { article, isLoading, fetchArticleById } = useBlog();
  const isNumber = (value) => !isNaN(Number(value));

  useEffect(() => {
    scrollTo(0, 0);
    const url = window.location.href;
    const id = url.substring(url.lastIndexOf('/') + 1);
    if (isNumber(id) && !article) {
      fetchArticleById(id);
    }
  }, []);

  if (isLoading) {
    return <Loader />;
  }

  if (!article) {
    return <Loader />;
  }
  return (
    <Container
      maxWidth="xl"
      component="main"
      sx={{ display: 'flex', flexDirection: 'column', my: 6, gap: 4, backgroundColor: 'background.paper' }}
    >
      <BlogArticle />
    </Container>
  );
}

export default Article;
