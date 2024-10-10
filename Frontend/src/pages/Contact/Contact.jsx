import React from 'react';
import ContactForm from "../../components/ContactForm/ContactForm";

function Contact() {
  return (
    <div className="bg-white mx-auto p-4">
      {/* Título de la sección de contacto */}
      <h1 className="text-3xl font-bold text-center mt-16 mb-5">Contáctame</h1>

      {/* Descripción de la sección */}
      <p className="text-lg text-center mb-8">
        Si tienes alguna pregunta, inquietud o comentario, no dudes en escribir. Estoy aquí para ayudarte!
      </p>

      <ContactForm />
    </div>
  );
}

export default Contact;
