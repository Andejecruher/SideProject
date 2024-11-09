import React, { useState } from 'react';
import ajh from '../../assets/ajh.png';
import { IconCheck, IconX } from '@tabler/icons-react';
import { notifications } from '@mantine/notifications';
import { useBlog } from '@src/Context/BlogContext';

const Footer = () => {
  const { fetchRegisterNewsletter } = useBlog();
  const [email, setEmail] = useState('');

  const handleEmailChange = (event) => {
    setEmail(event.target.value);
  };

  const handleSubmit = async (event) => {
    event.preventDefault();
    try {
      await fetchRegisterNewsletter({ email });
      notifications.show({
        title: '¡Gracias por suscribirte!',
        message: 'Te has suscrito correctamente a nuestro boletín.',
        position: 'top-right',
        icon: <IconCheck />,
        autoClose: 5000,
      });
      setEmail('');
    } catch (error) {
      notifications.show({
        title: 'Error al suscribirte',
        message: 'Ha ocurrido un error al suscribirte a nuestro boletín. Por favor, inténtalo de nuevo.',
        position: 'top-right',
        icon: <IconX />,
        autoClose: 5000,
      });
    }
  };
  return (
    <div className="flex flex-col w-full h-fit bg-[#D9D9D9] text-black px-8 py-8 lg:px-14 lg:py-14">
      <div className="flex flex-col lg:flex-row justify-between lg:items-center">
        {/* Sección del Logo */}
        <div className="flex flex-col items-center lg:items-start mb-2 lg:mb-0">
          <div className="flex items-center">
            <img src={ajh} width="120" alt="Logo Preview" />
            <div className="text-3xl lg:text-5xl font-bold md:ml-2 andejecruher">Andejecruher</div>
          </div>
        </div>

        {/* Sección de Newsletter */}
        <div className="flex flex-col items-center lg:items-end">
          <div className="font-bold uppercase text-[#9ca3af] pb-3 text-center lg:text-left">Newsletter</div>
          <p className="text-black mb-2 text-center lg:text-left">Suscríbete a nuestro boletín.</p>
          <form className="md:flex w-full lg:w-auto" onSubmit={handleSubmit}>
            <input
              type="email"
              name="email"
              placeholder="Introduce tu correo"
              className="w-full bg-gray-100 text-gray-700 rounded md:rounded-l-lg py-3 px-4 focus:outline-none focus:ring-purple-600 focus:border-transparent"
              value={email}
              onChange={handleEmailChange}
              required
            />
            <button
              type="submit"
              className="bg-black text-white font-semibold py-3 px-6 rounded md:rounded-r-lg transition-colors duration-300 w-full mt-2 md:mt-0"
            >
              Suscribirse
            </button>
          </form>
        </div>
      </div>

      {/* Línea divisoria */}
      <div className="w-full border-t border-gray-500 my-8"></div>

      {/* Texto de derechos reservados */}
      <div className="text-center">© {new Date().getFullYear()} Andejecruher - Todos los derechos reservados.</div>
    </div>
  );
};

export default Footer;
