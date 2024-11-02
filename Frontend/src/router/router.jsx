import React from "react";
import { createBrowserRouter } from "react-router-dom";
import Root from "./root";
import Home from "@src/pages/Home/Home";
import Contact from "@src/pages/Contact/Contact";
import Blog from "@src/pages/Blog/Blog";
import Article from "@src/pages/Article/Article";

const router = createBrowserRouter([
  {
    path: "/",
    element: <Root />,
    errorElement: <h1>404 Not Found</h1>,
    children: [
      {
        path: "/Inicio",
        element: <Home />,
      },
      {
        path: "/Blog",
        element: <Blog />,
      },
      {
        path: "/Blog/:postId", // Nueva ruta para mostrar los posts individualmente
        element: <Article />,
      },
      {
        path: "/Contacto",
        element: <Contact />,
      },
    ]
  },
]);

export default router;