
import "./Home.css";
import HeaderMegaMenu from "../../components/Header/Header";
import AboutMe from "../../components/AboutMe/AboutMe";
import WorkExperience from "../../components/WorkExperience/WorkExperience";
import EducationalExperience from "../../components/EducationalExperience/EducationalExperience";
import Skills from "../../components/Skills/Skills";
import ContactForm from "../../components/ContactForm/ContactForm";
import Footer from "../../components/Footer/Footer";


function Home() {

  return (
    <>
      <HeaderMegaMenu />
      <AboutMe />
      <WorkExperience />
      <EducationalExperience />
      <Skills />
      <ContactForm />
      <Footer />
    </>
  );
}

export default Home;
