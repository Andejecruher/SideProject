import { createTheme } from '@mui/material/styles';

const theme = createTheme({
  palette: {
    common: {
      white: '#F5F5F5',
    },
    background: {
      default: '#D9D9D9',
      paper: '#FFFFFF',
    },
    text: {
      primary: '#000000',
      secondary: '#000000',
    },
    primary: {
      main: '#000000',  // Tu color primario personalizado
    },
    secondary: {
      main: '#D9D9D9',  // Color secundario, si lo necesitas
    },
  },
  typography: {
    fontFamily: 'Manrope, Arial, sans-serif', // Establece "Manrope" como la fuente principal
  },
  components: {
    MuiAppBar: {
      styleOverrides: {
        root: {
          backgroundColor: '#D9D9D9', // Cambia a tu color preferido
          color: '#000000', // Cambia a tu color preferido
        },
      },
    },
  },
});

export default theme;
