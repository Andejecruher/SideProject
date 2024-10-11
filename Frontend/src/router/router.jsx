import React from "react";
import { createBrowserRouter } from "react-router-dom";
import Root from "./root";
import Home from "@src/pages/Home/Home";
import Contact from "@src/pages/Contact/Contact";

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
        element: <Home />,
      },
      {
        path: "/Contacto",
        element: <Contact />,
      },
    ]
  },
]);

export default router;