import React, { useEffect } from 'react';
import Container from '@mui/material/Container';
import Typography from '@mui/material/Typography';
import HeaderSearch from '@src/components/HeaderSearch/HeaderSearch';
import CardsCarousel from '@src/components/Carousels/Carousel';
import Posts from '@src/components/Posts/Posts';
import { getArticles, getCategories, getTags, getLatestPosts } from '@src/Api/api';
import './Blog.css';

function Blog() {
  const data = [
    {
      image:
        'https://images.unsplash.com/photo-1508193638397-1c4234db14d8?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80',
      title: 'Best forests to visit in North America',
      category: 'nature',
    },
    {
      image:
        'https://images.unsplash.com/photo-1559494007-9f5847c49d94?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80',
      title: 'Hawaii beaches review: better than you think',
      category: 'beach',
    },
    {
      image:
        'https://images.unsplash.com/photo-1608481337062-4093bf3ed404?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80',
      title: 'Mountains at night: 12 best locations to enjoy the view',
      category: 'nature',
    },
    {
      image:
        'https://images.unsplash.com/photo-1507272931001-fc06c17e4f43?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80',
      title: 'Aurora in Norway: when to visit for best experience',
      category: 'nature',
    },
    {
      image:
        'https://images.unsplash.com/photo-1510798831971-661eb04b3739?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80',
      title: 'Best places to visit this winter',
      category: 'tourism',
    },
    {
      image:
        'https://images.unsplash.com/photo-1582721478779-0ae163c05a60?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=400&q=80',
      title: 'Active volcanos reviews: travel at your own risk',
      category: 'nature',
    },
  ];

  const getArticlesData = async () => {
    const articles = await getArticles();
    console.log(articles);
  };

  const getCategoriesData = async () => {
    const categories = await getCategories();
    console.log(categories);
  }

  const getTagsData = async () => {
    const tags = await getTags();
    console.log(tags);
  }

  const getLatestPostsData = async () => {
    const latestPosts = await getLatestPosts();
    console.log(latestPosts);
  }

  useEffect(() => {
    getLatestPostsData();
    getArticlesData();
    getCategoriesData();
    getTagsData();
  }, []);
  return (
    <>
      <Container
        maxWidth="xl"
        component="main"
        sx={{ display: 'flex', flexDirection: 'column', my: 6, gap: 4, backgroundColor: 'background.paper' }}
      >
        <CardsCarousel data={data}/>
        <HeaderSearch />
        <Typography className='text-pretty text-left text-2xl'>Mantente al tanto de las últimas novedades.</Typography>
        <Posts />
      </Container>
    </>
  );
}

export default Blog;
