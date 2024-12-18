import React, { useRef, useEffect, useState } from 'react';
import { useMediaQuery } from '@mui/material';
import useOnScreen from '@src/hooks/useOnScreen';
import classNames from 'classnames';

const steps = [
  {
    date: "09/2023 - 06/2024",
    title: "Full Stack Developer",
    subtitle: "DiferenteWeb",
    description:
      "Desarrollo y mantenimiento de APIs robustas para integrar servicios externos y mejorar la eficiencia en la comunicación entre aplicaciones. Integración de soluciones de comercio electrónico mediante la plataforma BigCommerce, incluyendo la personalización de tiendas. Trabajo con bases de datos relacionales (MySQL) y no relacionales (MongoDB), asegurando la escalabilidad y seguridad en el almacenamiento de datos.",
    alignment: "right",
  },
  {
    date: "04/2023 - 07/2023",
    title: "Full Stack Developer",
    subtitle: "Hoteles Buenaventura",
    description:
      "Se desarrolló un calendario de fechas para Hoteles Buenaventura utilizando un stack de desarrollo moderno. Con Laravel y MySQL, se crearon APIs REST robustas que gestionan reservas y disponibilidad. El frontend, implementado con React.js, permite a los usuarios visualizar y seleccionar fechas de forma interactiva.",
    alignment: "left",
  },
  {
    date: "03/2022 - 05/2023",
    title: "Full Stack Developer",
    subtitle: "TheRocketCode",
    description:
      "Como Full Stack Developer en TheRocketCode, mi rol se centró en el desarrollo de funcionalidades para aplicaciones web utilizando React.js. Un logro destacado fue la migración exitosa del cotizador de precios de Next.js a React.js, optimizando la experiencia del usuario. Además, contribuí en la construcción de una API sólida con Node.js, Express y MongoDB para una comunicación eficiente entre el frontend y backend.",
    alignment: "right",
  },
  {
    date: "2013 - 2015",
    title: "Diseñadores web",
    subtitle: "Creativa Softline",
    description:
      "Como Diseñador Web en Creativa Softline, fui responsable de liderar la creación y desarrollo del concepto para diversos sitios web. Mi rol abarcó desde el diseño inicial hasta la implementación, donde utilicé herramientas como Skeleton, Bootstrap y Boilerplate para crear páginas web visualmente atractivas y altamente funcionales.",
    alignment: "left",
  },
];

const WorkExperience = () => {
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
      <div className="bg-[#D9D9D9] text-black py-8">
        <div className="container mx-auto flex flex-col items-start lg:flex-row my-1 md:my-1">
          <div className="flex flex-col w-full lg:sticky md:top-36 lg:w-1/3 mt-2 md:mt-12 lg:px-6 px-10" ref={ref}>
            <p className={classNames("text-3xl md:text-4xl leading-normal md:leading-relaxed mb-2 font-bold animate__animated", {
              "animate__fadeInTopLeft": isVisible,
            })}>
              Experiencia Laboral
            </p>
            <p className={classNames("text-sm md:text-base text-black mb-4 animate__animated", {
              "animate__fadeInTopLeft": isVisible,
            })}>
              Desarrollador Full Stack con una sólida experiencia en el diseño y desarrollo de aplicaciones web dinámicas y escalables. A lo largo de mi carrera, he trabajado tanto en el frontend como en el backend, utilizando tecnologías modernas para ofrecer soluciones innovadoras que mejoran la experiencia del usuario y optimizan los procesos empresariales.
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
                        }`,{
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
                className="mx-auto -mt-20 md:-mt-20 w-[40%] md:w-auto"
                src="https://user-images.githubusercontent.com/54521023/116968861-ef21a000-acd2-11eb-95ac-a34b5b490265.png"
                alt="Tech Fest"
              />
            </div>
          </div>
        </div>
      </div>
    </section>
  );
};

export default WorkExperience;