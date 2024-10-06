import React from 'react';
import { FaHtml5, FaCss3Alt, FaJs, FaGitAlt, FaDocker, FaReact, FaLaravel, FaPhp, FaPython } from 'react-icons/fa';
import { SiCsharp, SiMongodb, SiMysql } from 'react-icons/si';

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
  return (
    <div className="w-full py-16 bg-[#D9D9D9] text-black">
      <div className="max-w-7xl mx-auto px-6 lg:px-8 text-center">
        <h2 className="text-4xl font-extrabold mb-8">Mis Habilidades</h2>
        <p className="text-lg text-gray-500 mb-12">Estas son algunas de las tecnologías y herramientas con las que trabajo para construir aplicaciones robustas y escalables.</p>

        <div className="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
          {skillsData.map((skill, index) => (
            <div key={index} className="group relative p-6 bg-gray-100 shadow-lg rounded-lg transition-all duration-300 hover:shadow-2xl">
              <div className="w-16 h-16 mx-auto transition-transform duration-500 transform group-hover:scale-110">
                {skill.icon}
              </div>
              <h3 className="mt-4 text-xl font-semibold">{skill.name}</h3>
              <p className="text-gray-500 mt-2">{skill.description}</p>
            </div>
          ))}
        </div>
      </div>
    </div>
  );
};

export default Skills;
