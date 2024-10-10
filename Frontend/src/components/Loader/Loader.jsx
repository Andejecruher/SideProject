import React from 'react';
import ajh from '../../assets/ajh.png'; // Puedes reemplazar con la imagen que desees

const Loader = () => {
  return (
    <div className="flex flex-col items-center justify-center min-h-screen">
      {/* Imagen del Loader */}
      <img src={ajh} alt="Cargando..." className="w-32 h-32 mb-8" />
      
      {/* Dots en movimiento */}
      <div className="flex space-x-2">
        <div className="w-3 h-3 bg-black rounded-full animate-bounce" style={{ animationDelay: '0s' }}></div>
        <div className="w-3 h-3 bg-black rounded-full animate-bounce" style={{ animationDelay: '0.2s' }}></div>
        <div className="w-3 h-3 bg-black rounded-full animate-bounce" style={{ animationDelay: '0.4s' }}></div>
      </div>
    </div>
  );
};

export default Loader;
