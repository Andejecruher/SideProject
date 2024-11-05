import React from 'react';
import Container from '@mui/material/Container';
import Typography from '@mui/material/Typography';
import HeaderSearch from '@src/components/HeaderSearch/HeaderSearch';
import CardsCarousel from '@src/components/Carousels/Carousel';
import Posts from '@src/components/Posts/Posts';
import './Blog.css';

function Blog() {
  return (
    <>
      <Container
        maxWidth="xl"
        component="main"
        sx={{ display: 'flex', flexDirection: 'column', my: 6, gap: 4, backgroundColor: 'background.paper' }}
      >
        <CardsCarousel />
        <HeaderSearch />
        <Typography className='text-pretty text-left text-2xl'>Mantente al tanto de las últimas novedades.</Typography>
        <Posts />
      </Container>
    </>
  );
}

export default Blog;
