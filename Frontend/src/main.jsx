import React from "react";
import ReactDOM from "react-dom/client";
import Home from "./Pages/Home/Home.jsx";
import { ThemeProvider } from "@mui/material/styles";
import CssBaseline from "@mui/material/CssBaseline";
import theme from "./components/Themes/theme";
// Import styles of packages that you've installed.
// All packages except `@mantine/hooks` require styles imports
import '@mantine/core/styles.css';

import { MantineProvider } from '@mantine/core';
import "./index.css";

ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
  <MantineProvider>
    <ThemeProvider theme={theme}>
      <CssBaseline />{" "}
      {/* Esto asegura que los estilos básicos sean reseteados */}
      <Home />
    </ThemeProvider>
  </MantineProvider>
  </React.StrictMode>
);
