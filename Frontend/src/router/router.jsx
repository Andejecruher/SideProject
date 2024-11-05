import React, { Suspense, lazy } from "react";
import { createBrowserRouter, Navigate } from "react-router-dom";
import Root from "./root";
import ErrorPage from "./error-page";
import Loader from "../components/Loader/Loader";

// Usar React.lazy para cargar los componentes de forma diferida
const Home = lazy(() => import("@src/pages/Home/Home"));
const Contact = lazy(() => import("@src/pages/Contact/Contact"));
const Blog = lazy(() => import("@src/pages/Blog/Blog"));
const Article = lazy(() => import("@src/pages/Article/Article"));

const router = createBrowserRouter([
  {
    path: "/",
    element: <Root />,
    errorElement: <ErrorPage />,
    children: [
      {
        path: "/",
        element: <Navigate to="/Inicio" />,
      },
      {
        path: "/Inicio",
        element: (
          <Suspense fallback={<Loader />}>
            <Home />
          </Suspense>
        ),
      },
      {
        path: "/Blog",
        element: (
          <Suspense fallback={<Loader />}>
            <Blog />
          </Suspense>
        ),
      },
      {
        path: "/Blog/:title",
        element: (
          <Suspense fallback={<Loader />}>
            <Article />
          </Suspense>
        ),
      },
      {
        path: "/Contacto",
        element: (
          <Suspense fallback={<Loader />}>
            <Contact />
          </Suspense>
        ),
      },
    ],
  },
]);

export default router;