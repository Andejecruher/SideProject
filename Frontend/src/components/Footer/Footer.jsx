import React from 'react';
import ajh from '../../assets/ajh.png';

const Footer = () => {
  return (
    <div className="flex flex-col w-full h-fit bg-[#D9D9D9] text-black px-14 py-14">
      <div className="flex flex-row justify-center">
        <div className="flex flex-row justify-center w-[50%]">
          <div className="flex flex-row">
            <img src={ajh} width="120" alt="Logo Preview" />
            <div className="text-5xl andejecruher">Andejecruher</div>
          </div>
        </div>

        <div className="flex flex-row w-[50%] justify-center">
          {/* Sección de Newsletter */}
          <div className="flex flex-col">
            <div className="font-bold uppercase text-[#9ca3af] pb-3">Newsletter</div>
            <p className="text-black mb-2">Suscríbete a nuestro boletín.</p>
            <form className="flex items-center">
              <input
                type="email"
                name="email"
                placeholder="Introduce tu correo"
                className="w-full bg-gray-100 text-gray-700 rounded-l-lg py-3 px-4 focus:outline-none focus:ring-purple-600 focus:border-transparent"
                required
              />
              <button type="submit" className="bg-black text-[#ffffff] font-semibold py-3 px-6 rounded-r-lg transition-colors duration-300">
                Suscribirse
              </button>
            </form>
          </div>
        </div>
      </div>

      <div className="w-full border-t border-gray-500 my-8"></div>
      <div className="text-center">© {new Date().getFullYear()} Andejecruher - Todos los derechos reservados.</div>
    </div>
  );
};

export default Footer;
