import React from 'react';
import AboutMe from "@src/components/AboutMe/AboutMe";
import WorkExperience from "@src/components/WorkExperience/WorkExperience";
import EducationalExperience from "@src/components/EducationalExperience/EducationalExperience";
import Skills from "@src/components/Skills/Skills";
import ContactForm from "@src/components/ContactForm/ContactForm";

function Home() {

  return (
    <>
    <AboutMe />
    <WorkExperience />
    <EducationalExperience />
    <Skills />
    <ContactForm />
  </>
  );
}

export default Home;
