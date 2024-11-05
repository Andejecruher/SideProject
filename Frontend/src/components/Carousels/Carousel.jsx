import React from 'react';
import { Carousel } from '@mantine/carousel';
import HeroBullets from '../HeroBullets/HeroBullets';
import classes from './CardCarousel.module.css';
import { BlogContext } from '@src/Context/BlogContext';

function CardsCarousel() {
  const { latestPosts } = React.useContext(BlogContext);

  const slides = Array.isArray(latestPosts) ? latestPosts.map((item) => (
    <Carousel.Slide key={item.title}>
      <HeroBullets article={item} />
    </Carousel.Slide>
  )) : [];

  return (
    <div className={classes.carousel}>
      <Carousel
        withIndicators
        align="start"
        slidesToScroll={1}
        classNames={{
          indicator: classes.indicator,
          indicators: classes.indicators,
          slide: classes.slide,
        }}
      >
        {slides}
      </Carousel>
    </div>
  );
}

export default CardsCarousel;