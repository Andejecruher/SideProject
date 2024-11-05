import React, { useContext } from 'react';
import Container from '@mui/material/Container';
import Typography from '@mui/material/Typography';
import HeaderSearch from '@src/components/HeaderSearch/HeaderSearch';
import CardsCarousel from '@src/components/Carousels/Carousel';
import Posts from '@src/components/Posts/Posts';
import { BlogContext } from '@src/Context/BlogContext';
import './Blog.css';

function Blog() {
  const { latestPosts, articles, categories, tags, pagination } = useContext(BlogContext);
  return (
    <>
      <Container
        maxWidth="xl"
        component="main"
        sx={{ display: 'flex', flexDirection: 'column', my: 6, gap: 4, backgroundColor: 'background.paper' }}
      >
        <CardsCarousel data={latestPosts} />
        <HeaderSearch categories={categories} />
        <Typography className='text-pretty text-left text-2xl'>Mantente al tanto de las últimas novedades.</Typography>
        <Posts articles={articles} categories={categories} tags={tags} pagination={pagination} />
      </Container>
    </>
  );
}

export default Blog;
