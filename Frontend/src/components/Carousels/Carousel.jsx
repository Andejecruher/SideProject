import React from 'react';
import { Carousel } from '@mantine/carousel';
import HeroBullets from '../HeroBullets/HeroBullets';
import classes from './CardCarousel.module.css';
import PropTypes from 'prop-types';

function CardsCarousel({ data }) {

  const slides = data.map((item) => (
    <Carousel.Slide key={item.title}>
      <HeroBullets />
    </Carousel.Slide>
  ));

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

CardsCarousel.propTypes = {
  data: PropTypes.array.isRequired,
};

export default CardsCarousel;