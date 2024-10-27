import React from 'react';
import Container from '@mui/material/Container';
import Typography from '@mui/material/Typography';
import HeaderSearch from '@src/components/HeaderSearch/HeaderSearch';
import './Blog.css';

function Blog() {
  return (
    <>
      <Container
        maxWidth="xl"
        component="main"
        sx={{ display: 'flex', flexDirection: 'column', my: 6, gap: 4, backgroundColor: 'background.paper' }}
      >
        <div>
          <Typography variant="h1" gutterBottom>
            Blog
          </Typography>
          <Typography>Mantente al tanto de las últimas novedades.</Typography>
        </div>
        <HeaderSearch />
      </Container>
    </>
  );
}

export default Blog;
