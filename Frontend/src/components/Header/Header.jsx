import React, { useState } from 'react';
import {
  Group,
  Box,
  Burger,
  Drawer,
  ScrollArea,
  rem,
} from '@mantine/core';
import { Typography, IconButton } from '@mui/material';
import LinkedInIcon from '@mui/icons-material/LinkedIn';
import TwitterIcon from '@mui/icons-material/Twitter';
import GitHubIcon from '@mui/icons-material/GitHub';
import { useDisclosure } from '@mantine/hooks';
import classes from './HeaderMegaMenu.module.css';

function HeaderMegaMenu() {
  const [drawerOpened, { toggle: toggleDrawer, close: closeDrawer }] = useDisclosure(false);
  const [selectedPage, setSelectedPage] = useState('Inicio'); // Estado para la opción seleccionada

  const handlePageClick = (page) => {
    setSelectedPage(page); // Actualiza el estado con la página seleccionada
  };

  return (
    <Box pb={10}>
      <header className={classes.header}>
        <Group justify="space-between" h="100%">
          <Group h="60%" gap={0} visibleFrom="sm">
            <a
              href="#"
              className={`${classes.link} ${selectedPage === 'Inicio' ? classes.selected : ''}`}
              onClick={() => handlePageClick('Inicio')}
            >
              Inicio
            </a>
            <a
              href="#"
              className={`${classes.link} ${selectedPage === 'Blog' ? classes.selected : ''}`}
              onClick={() => handlePageClick('Blog')}
            >
              Blog
            </a>
            <a
              href="#"
              className={`${classes.link} ${selectedPage === 'Contacto' ? classes.selected : ''}`}
              onClick={() => handlePageClick('Contacto')}
            >
              Contacto
            </a>
          </Group>

          <Typography className={classes.andejecruher}>
            Andejecruher
          </Typography>

          <Group visibleFrom="sm">
            <IconButton href="https://twitter.com/Andejecruher" target="_blank">
              <TwitterIcon className={classes.iconSocial} />
            </IconButton>
            <IconButton href="https://www.linkedin.com/in/antonio-de-jesus-cruz-hernandez-2535748b/" target="_blank">
              <LinkedInIcon className={classes.iconSocial} />
            </IconButton>
            <IconButton href="https://github.com/Andejecruher" target="_blank">
              <GitHubIcon className={classes.iconSocial} />
            </IconButton>
          </Group>

          <Burger opened={drawerOpened} onClick={toggleDrawer} hiddenFrom="sm" />
        </Group>
      </header>

      <Drawer
        opened={drawerOpened}
        onClose={closeDrawer}
        size="100%"
        title={
          <Group>
            <Typography className={classes.andejecruher}>
              Andejecruher
            </Typography>
          </Group>
        }
        hiddenFrom="sm"
        zIndex={1000000}
      >
          <Box
          h={`calc(100vh - ${rem(80)})`} 
            style={{
              display: 'flex',
              flexDirection: 'column',
              justifyContent: 'space-between',
              height: '100%',
              alignItems: 'center',
              textAlign: 'center',
            }}
          >
            <Box
              style={{
                display: 'flex',
                flexDirection: 'column',
                justifyContent: 'center',
                alignItems: 'center',
                textAlign: 'center',
                flexGrow: 1,
              }}
            >
              <a
                href="#"
                className={`${classes.link} ${selectedPage === 'Inicio' ? classes.selected : ''}`}
                onClick={() => handlePageClick('Inicio')}
              >
                Inicio
              </a>
              <a
                href="#"
                className={`${classes.link} ${selectedPage === 'Blog' ? classes.selected : ''}`}
                onClick={() => handlePageClick('Blog')}
              >
                Blog
              </a>
              <a
                href="#"
                className={`${classes.link} ${selectedPage === 'Contacto' ? classes.selected : ''}`}
                onClick={() => handlePageClick('Contacto')}
              >
                Contacto
              </a>
            </Box>

            <Group justify="center" grow pb="xl" px="md">
              <IconButton href="https://twitter.com/Andejecruher" target="_blank">
                <TwitterIcon className={classes.iconSocial} />
              </IconButton>
              <IconButton href="https://www.linkedin.com/in/antonio-de-jesus-cruz-hernandez-2535748b/" target="_blank">
                <LinkedInIcon className={classes.iconSocial} />
              </IconButton>
              <IconButton href="https://github.com/Andejecruher" target="_blank">
                <GitHubIcon className={classes.iconSocial} />
              </IconButton>
            </Group>
          </Box>
      </Drawer>
      <main className={classes.mainContent}>
        {/* Aquí va el contenido principal de la página */}
      </main>
    </Box>
  );
}

export default HeaderMegaMenu;