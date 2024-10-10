import React, { useState, useEffect } from 'react';
import "./Home.css";
import HeaderMegaMenu from "../../components/Header/Header";
import AboutMe from "../../components/AboutMe/AboutMe";
import WorkExperience from "../../components/WorkExperience/WorkExperience";
import EducationalExperience from "../../components/EducationalExperience/EducationalExperience";
import Skills from "../../components/Skills/Skills";
import ContactForm from "../../components/ContactForm/ContactForm";
import Footer from "../../components/Footer/Footer";
import Loader from "../../components/Loader/Loader"; // Importa el componente Loader

function Home() {
  const [isLoading, setIsLoading] = useState(true);

  // Simula la carga de la página
  useEffect(() => {
    // Después de 2 segundos, desactiva el loader (puedes ajustar este tiempo)
    const timer = setTimeout(() => {
      setIsLoading(false);
    }, 2000);

    // Limpia el temporizador en caso de desmontaje
    return () => clearTimeout(timer);
  }, []);

  return (
    <>
      {isLoading ? (
        // Mostrar el loader mientras se carga la página
        <Loader />
      ) : (
        // Mostrar el contenido de la página después de la carga
        <>
          <HeaderMegaMenu />
          <AboutMe />
          <WorkExperience />
          <EducationalExperience />
          <Skills />
          <ContactForm />
          <Footer />
        </>
      )}
    </>
  );
}

export default Home;
