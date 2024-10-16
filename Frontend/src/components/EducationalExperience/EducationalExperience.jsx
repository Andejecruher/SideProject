import React, { useRef, useEffect, useState } from 'react';
import education from '../../assets/education.png';
import classNames from 'classnames';
import useOnScreen from '@src/hooks/useOnScreen';
import { useMediaQuery } from '@mui/material';

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
  const isMobile = useMediaQuery('(max-width: 768px)');
  const isTablet = useMediaQuery('(max-width: 1023px)');

  const refs = useRef(steps.map(() => React.createRef()));
  const [visibleSteps, setVisibleSteps] = useState(steps.map(() => false));
  const [ref, isVisible] = useOnScreen({
    root: null, // Observar la ventana de visualización (viewport)
    rootMargin: "0px", // Margen opcional
    threshold: 0.1, // 10% del elemento debe estar visible para considerarlo en la vista
  });
  useEffect(() => {
    const observers = refs.current.map((ref, index) => {
      return new IntersectionObserver(
        ([entry]) => {
          setVisibleSteps((prevVisibleSteps) => {
            const newVisibleSteps = [...prevVisibleSteps];
            newVisibleSteps[index] = entry.isIntersecting;
            return newVisibleSteps;
          });
        },
        { threshold: 0.1 }
      );
    });

    refs.current.forEach((ref, index) => {
      if (ref.current) {
        observers[index].observe(ref.current);
      }
    });

    return () => {
      refs.current.forEach((ref, index) => {
        if (ref.current) {
          observers[index].unobserve(ref.current);
        }
      });
    };
  }, []);

  return (
    <section>
      <div className="bg-white text-black py-8">
        <div className="container mx-auto flex flex-col items-start lg:flex-row my-1 md:my-1">
          <div className="flex flex-col w-full lg:sticky md:top-36 lg:w-1/3 mt-2 md:mt-12 lg:px-6 px-10" ref={ref}>
            <p className={classNames("text-3xl md:text-4xl leading-normal md:leading-relaxed mb-2 font-bold animate__animated",{
              "animate__fadeInTopLeft": isVisible,
            })}>
              Experiencia Educativa
            </p>
            <p className={classNames("text-sm md:text-base text-black mb-4 animate__animated",{
              "animate__fadeInTopLeft": isVisible,
            })}>
              Durante mi preparación en la preparatoria, adquirí habilidades fundamentales en matemáticas y ciencias, que sentaron las bases para mi futura carrera en tecnología. Posteriormente, en la licenciatura en Ingeniería en Desarrollo de Software en la Universidad IEU, profundicé en el desarrollo de aplicaciones web y programación. A través de proyectos colaborativos, aprendí a aplicar tecnologías modernas y a trabajar eficazmente en equipo.
            </p>
          </div>
          <div className="ml-0 md:ml-12 lg:w-2/3 sticky">
            <div className="container mx-auto w-full h-full">
              <div className="relative wrap overflow-hidden p-10 h-full">
                <div
                  className="border-2 absolute h-full"
                  style={{ right: isMobile ? '95%' : !isMobile && isTablet ? '95%' : '50%', border: '2px solid black', borderRadius: '1%' }}
                ></div>
                <div
                  className="border-2 absolute h-full"
                  style={{ left: isMobile ? '5%' : !isMobile && isTablet ? '5%' : '50%', border: '2px solid black', borderRadius: '1%' }}
                ></div>

                {steps.map((step, index) => (
                  <div
                    key={index}
                    ref={refs.current[index]}
                    className={`mb-8 ml-10 lg:flex lg:justify-between items-center w-full ${isMobile ? 'flex-row-reverse left-timeline' : !isMobile && isTablet ? 'flex-row-reverse left-timeline' : step.alignment === "right" ? "flex-row-reverse left-timeline" : "right-timeline"
                      }`}
                  >
                    <div
                      className={classNames(`order-1 w-10/12 lg:w-5/12 px-1 py-4 ${isMobile ? 'flex-row-reverse left-timeline' : !isMobile && isTablet ? 'flex-row-reverse left-timeline' : step.alignment === "right" ? "text-right" : "text-left"
                        }`, {
                        "animate__animated animate__fadeInLeft": visibleSteps[index] && step.alignment === "left",
                        "animate__animated animate__fadeInRight": visibleSteps[index] && step.alignment === "right",
                      })}
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
                className="mx-auto -mt-5 md:-mt-5 w-[30%] md:w-[40%]"
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
