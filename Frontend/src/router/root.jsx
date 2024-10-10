import React from "react";
import { Outlet } from "react-router-dom";
import HeaderMegaMenu from "@src/components/Header/Header";
import Footer from "@src/components/Footer/Footer";


const Root = () => {
  return (
    <>
      <HeaderMegaMenu />
      <Outlet />
      <Footer />
    </>
  );
}

export default Root;