import React from 'react';
import { useNavigate } from 'react-router-dom';
import { Image, Container, Title, Button, Group, Text, List, ThemeIcon, rem } from '@mantine/core';
import { IconCheck } from '@tabler/icons-react';
import PropTypes from 'prop-types';
import classes from './HeroBullets.module.css';

function HeroBullets({ article, setArticle }) {

  const navigate = useNavigate();

  const handleReadMore = (article) => {
    setArticle(article);
    const title = article.title.toLowerCase().replace(/ /g, '-');
    navigate(`/Blog/${title}`);
  }
  return (
    <Container size="md">
      <div className={classes.inner}>
        <div className={classes.content}>
          <Title className={classes.title}>
            <span className={classes.highlight}>{article.title}</span>
          </Title>
          <Text c="dimmed" mt="md">
            {article.description}
          </Text>

          <List
            mt={30}
            size="sm"
            icon={
              <ThemeIcon size={20} radius="xl">
                <IconCheck style={{ width: rem(12), height: rem(12) }} stroke={1.5} />
              </ThemeIcon>
            }
            className={classes.list}
          >
            {article.tags && article.tags.map((tag) => (
              <List.Item key={tag.id}>{tag.name}</List.Item>
            ))}
          </List>

          <Group mt={30} className='w-full'>
            <Button radius="xl" size="md" className={classes.control} onClick={() => {
              handleReadMore(article);
            }}>
              Leer más ...
            </Button>
          </Group>
        </div>
        <Image src={article.featured_image} className={`sm:w-[60%] ${classes.image}`} />
      </div>
    </Container>
  );
}

HeroBullets.propTypes = {
  article: PropTypes.object,
  setArticle: PropTypes.func,
};

export default HeroBullets;