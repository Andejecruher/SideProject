import React from 'react';
import Container from '@mui/material/Container';
import BlogArticle from '../../components/BlogArticle/BlogArticle';
import './Article.css';

function Article() {
  const articleData = {
    title: 'Introducción a JavaScript y su Evolución',
    description: 'Un recorrido sobre la historia y evolución de JavaScript, desde sus inicios hasta su popularidad actual.',
    content: `
      JavaScript es uno de los lenguajes de programación más populares del mundo. 
      Fue creado en 1995 por Brendan Eich mientras trabajaba en Netscape Communications. 
      Originalmente conocido como Mocha, luego cambió su nombre a LiveScript, 
      y finalmente fue renombrado a JavaScript para aprovechar la popularidad de Java en aquel entonces.
      
      Con los años, JavaScript ha evolucionado significativamente. Con la introducción de ECMAScript 6 (ES6) en 2015, 
      el lenguaje ganó muchas características modernas, como clases, módulos y funciones flecha. 
      Estas mejoras han permitido que JavaScript se utilice no solo en el desarrollo frontend, 
      sino también en el backend gracias a plataformas como Node.js.
      
      Hoy en día, JavaScript es esencial para el desarrollo de aplicaciones web modernas. 
      Desde bibliotecas como React y Vue hasta frameworks completos como Next.js y Nuxt.js, 
      la versatilidad y capacidad de JavaScript continúan expandiéndose.
    `,
    featured_image: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80',
    thumbnail: 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80',
    published: true,
    publication_date: '2024-11-02T10:00:00Z',
    category: 'Programación',
    author: 'Carlos López',
    comments: [
      {
        author: 'Maria González',
        date: '2024-11-02T12:30:00Z',
        text: 'Excelente artículo, muy informativo. Me encantó conocer más sobre la historia de JavaScript.'
      },
      {
        author: 'Pedro Martínez',
        date: '2024-11-02T15:45:00Z',
        text: 'Muy buen resumen, Carlos. Me gustó la claridad con la que explicas la evolución de JavaScript.'
      },
      {
        author: 'Lucia Fernández',
        date: '2024-11-02T17:00:00Z',
        text: '¡Gracias por compartir! Es genial ver cómo JavaScript ha cambiado tanto en tan poco tiempo.'
      } 
    ],
    tags: ['JavaScript', 'Programación', 'Historia', 'Desarrollo Web']
  };

  return (
    <>
      <Container
        maxWidth="xl"
        component="main"
        sx={{ display: 'flex', flexDirection: 'column', my: 6, gap: 4, backgroundColor: 'background.paper' }}
      >
        <BlogArticle {...articleData}/>
      </Container>
    </>
  );
}

export default Article;
