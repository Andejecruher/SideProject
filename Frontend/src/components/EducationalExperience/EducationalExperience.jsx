import React from 'react';
import education from '../../assets/education.png';
// import { FaGraduationCap } from 'react-icons/fa'; // Asegúrate de instalar react-icons

const steps = [
  {
    date: "10/09/2022 - Actualidad",
    title: "Universidad IEU",
    subtitle: "Ingenieria en desarrollo de software",
    description:
      "Actualmente, me encuentro inmerso en mi formación académica en la Universidad IEU, cursando con entusiasmo la carrera de Ingeniería en Desarrollo de Software. Estoy emocionado por la oportunidad de adquirir conocimientos técnicos y habilidades prácticas que me permitan destacar en el mundo del desarrollo de software.",
    alignment: "right",
  },
  {
    date: "2010 - 2013",
    title: "CBTis 169",
    subtitle: "Técnico en Informática",
    description:
      "Durante mi educación en el CBTis 169, tuve la oportunidad de explorar mi pasión por la tecnología y desarrollar habilidades clave que han dejado una huella significativa en mi camino académico. Uno de los momentos más destacados de mi experiencia fue la emocionante participación en concursos de tecnología a nivel internacional, donde tuvimos el honor de representar a México en Santiago de Chile.",
    alignment: "left",
  },
];

const EducationalExperience = () => {
  return (
    <section>
      <div className="bg-white text-black py-8">
        <div className="container mx-auto flex flex-col items-start md:flex-row my-1 md:my-1">
          <div className="flex flex-col w-full sticky md:top-36 lg:w-1/3 mt-2 md:mt-12 px-8">
            <p className="text-3xl md:text-4xl leading-normal md:leading-relaxed mb-2 font-bold">
              Experiencia Educativa
            </p>
            <p className="text-sm md:text-base text-black mb-4">
            Durante mi preparación en la preparatoria, adquirí habilidades fundamentales en matemáticas y ciencias, que sentaron las bases para mi futura carrera en tecnología. Posteriormente, en la licenciatura en Ingeniería en Desarrollo de Software en la Universidad IEU, profundicé en el desarrollo de aplicaciones web y programación. A través de proyectos colaborativos, aprendí a aplicar tecnologías modernas y a trabajar eficazmente en equipo.
            </p>
          </div>
          <div className="ml-0 md:ml-12 lg:w-2/3 sticky">
            <div className="container mx-auto w-full h-full">
              <div className="relative wrap overflow-hidden p-10 h-full">
                <div
                  className="border-2 absolute h-full"
                  style={{ right: '50%', border: '2px solid black', borderRadius: '1%' }}
                ></div>
                <div
                  className="border-2 absolute h-full"
                  style={{ left: '50%', border: '2px solid black', borderRadius: '1%' }}
                ></div>

                {steps.map((step, index) => (
                  <div
                    key={index}
                    className={`mb-8 flex justify-between items-center w-full ${step.alignment === "right" ? "flex-row-reverse left-timeline" : "right-timeline"
                      }`}
                  >
                    {/* <div className="order-1 w-5/12 flex justify-center">
                      <FaGraduationCap className="text-3xl text-black" />
                    </div> */}
                    <div
                      className={`order-1 w-5/12 px-1 py-4 ${step.alignment === "right" ? "text-right" : "text-left"
                        }`}
                    >
                      <p className="mb-1 text-base text-black font-bold">{step.date}</p>
                      <h4 className="mb-1 font-bold text-md md:text-2xl text-black">{step.title}</h4>
                      <h6 className="mb-3 font-normal text-md md:text-2xl text-black">{step.subtitle}</h6>
                      <p className="text-sm md:text-base leading-snug text-black">
                        {step.description}
                      </p>
                    </div>
                  </div>
                ))}
              </div>
              <img
                className="mx-auto -mt-5 md:-mt-5"
                src={education}
                alt="Tech Fest"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default EducationalExperience;
