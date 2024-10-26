import React from "react";
import { createBrowserRouter } from "react-router-dom";
import Root from "./root";
import Home from "@src/pages/Home/Home";
import Contact from "@src/pages/Contact/Contact";
import Blog from "@src/pages/Blog/Blog";

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
        path: "/Contacto",
        element: <Contact />,
      },
    ]
  },
]);

export default router;