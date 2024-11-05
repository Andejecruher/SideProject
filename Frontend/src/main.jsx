import React from "react";
import ReactDOM from "react-dom/client";
import { ThemeProvider } from "@mui/material/styles";
import { RouterProvider } from "react-router-dom";
import { MantineProvider } from '@mantine/core';
import { BlogProvider } from "@src/Context/BlogContext";
import CssBaseline from "@mui/material/CssBaseline";
import theme from "@src/components/Themes/theme";
import router from "@src/router/router";
import 'animate.css';
import '@mantine/core/styles.css';
import '@mantine/carousel/styles.css';
import "./index.css";


ReactDOM.createRoot(document.getElementById("root")).render(
  <React.StrictMode>
    <BlogProvider>
      <MantineProvider>
        <ThemeProvider theme={theme}>
          <CssBaseline />{" "}
          {/* Esto asegura que los estilos básicos sean reseteados */}
          <RouterProvider router={router} />
        </ThemeProvider>
      </MantineProvider>
    </BlogProvider>
  </React.StrictMode>
);
