import React from 'react';
import { FaHtml5, FaCss3Alt, FaJs, FaGitAlt, FaDocker, FaReact, FaLaravel, FaPhp, FaPython } from 'react-icons/fa';
import { SiCsharp, SiMongodb, SiMysql } from 'react-icons/si';
import useOnScreen from '@src/hooks/useOnScreen';
import classNames from 'classnames';

const skillsData = [
  { name: 'HTML5', icon: <FaHtml5 className="text-orange-600 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Estándar de marcado para el desarrollo web moderno.' },
  { name: 'CSS3', icon: <FaCss3Alt fill="#1572B6" className="text-blue-600 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Hojas de estilo para un diseño visual atractivo.' },
  { name: 'JavaScript', icon: <FaJs className="text-yellow-500 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Lenguaje de programación dinámico para la web.' },
  { name: 'PHP', icon: <FaPhp className="text-purple-600 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Lenguaje de programación para desarrollo del lado del servidor.' },
  { name: 'C#', icon: <SiCsharp className="text-purple-500 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Lenguaje de programación de alto nivel.' },
  { name: 'Python', icon: <FaPython className="text-yellow-400 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Lenguaje de programación multipropósito.' },
  { name: 'GIT', icon: <FaGitAlt fill='#F05032' className="text-red-500 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Sistema de control de versiones distribuido.' },
  { name: 'Docker', icon: <FaDocker fill='#2496ED' className="text-blue-500 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Contenedores para automatizar aplicaciones.' },
  { name: 'React.js', icon: <FaReact className="text-cyan-500 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Biblioteca para construir interfaces de usuario interactivas.' },
  { name: 'Laravel', icon: <FaLaravel fill="#FF2D20" className="text-red-700 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Framework PHP para aplicaciones web robustas.' },
  { name: 'MongoDB', icon: <SiMongodb className="text-green-500 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Base de datos NoSQL orientada a documentos.' },
  { name: 'MySQL', icon: <SiMysql fill="#4479A1" className="text-blue-600 w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110" />, description: 'Sistema de gestión de bases de datos relacional.' },
];


const Skills = () => {

  const [ref, isVisible] = useOnScreen({
    root: null, // Observar la ventana de visualización (viewport)
    rootMargin: "0px", // Margen opcional
    threshold: 0.1, // 10% del elemento debe estar visible para considerarlo en la vista
  });

  return (
    <div className="w-full py-16 bg-[#D9D9D9] text-black" ref={ref}>
      <div className="max-w-7xl mx-auto px-6 lg:px-8 text-center" >
        <h2 className={classNames("text-3xl font-extrabold mb-8 animate__animated", {
          "animate__fadeInDown ": isVisible,
        })}>Mis Habilidades</h2>
        <p className={classNames("text-sm md:text-base text-gray-500 mb-12", {

          "animate__animated animate__fadeInDown": isVisible,
        })}>Estas son algunas de las tecnologías y herramientas con las que trabajo para construir aplicaciones robustas y escalables.</p>

        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
          {skillsData.map((skill, index) => {
            const [ref, isVisible] = useOnScreen({
              root: null,
              rootMargin: '0px',
              threshold: 0.5,
            });

            return (
              <div
                key={index}
                ref={ref}
                className={classNames("cursor-pointer group relative p-2 bg-gray-100 shadow-lg rounded-lg transition-all duration-300 hover:shadow-2xl", {
                  "animate__animated animate__flipInX": isVisible,
                })}
              >
                <div className="w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110">
                  {skill.icon}
                </div>
                <h3 className="mt-4 text-xl md:text-2xl font-semibold">{skill.name}</h3>
                <p className="text-gray-500 mt-2 text-sm">{skill.description}</p>
              </div>
            );
          })}
        </div>
      </div>
    </div>
  );
};

export default Skills;
