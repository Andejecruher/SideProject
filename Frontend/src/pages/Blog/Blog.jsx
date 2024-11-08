import React, { useEffect } from 'react';
import Container from '@mui/material/Container';
import Typography from '@mui/material/Typography';
import HeaderSearch from '@src/components/HeaderSearch/HeaderSearch';
import CardsCarousel from '@src/components/Carousels/Carousel';
import Posts from '@src/components/Posts/Posts';
import Loader from '@src/components/Loader/Loader';
import { useBlog } from '@src/Context/BlogContext';
import './Blog.css';

function Blog() {
  const { articles, search, fetchAllData } = useBlog();
  const isNumber = (value) => !isNaN(Number(value));

  useEffect(() => {
    const url = window.location.href;
    const id = url.substring(url.lastIndexOf('/') + 1);
    if (!isNumber(id) && articles.length === 0) {
      fetchAllData();
    }
  }, []);

  if (!articles) {
    return <Loader />;
  }

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
        {
          search !== '' && (
            <Typography className='text-pretty text-left text-2xl'>Resultados de la búsqueda: {search}</Typography>
          )
        }
        <Posts />
      </Container>
    </>
  );
}

export default Blog;
