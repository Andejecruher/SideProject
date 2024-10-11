import React, { useState } from 'react';
import Snackbar from '@mui/material/Snackbar';
import Alert from '@mui/material/Alert';
import { sendEmailConfirmation, sendEmailContact } from '@src/services/Emails/emailService';

const ContactForm = () => {
  const [formData, setFormData] = useState({
    name: '',
    lastName: '',
    email: '',
    subject: '',
    message: '',
  });
  const [loading, setLoading] = useState(false);
  const [message, setMessage] = useState('');
  const [open, setOpen] = useState(false);
  const [severity, setSeverity] = useState('');

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData((prevData) => ({
      ...prevData,
      [name]: value,
    }));
  };

  const handleClose = (event, reason) => {
    if (reason === 'clickaway') {
      return;
    }
    setOpen(false);
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setLoading(true);
    setMessage('');

    try {
      await sendEmailContact(formData);
      await sendEmailConfirmation(formData);
      setSeverity('success');
      setOpen(true);
      setMessage('¡Correo enviado exitosamente!');
      setFormData({
        name: '',
        lastName: '',
        email: '',
        subject: '',
        message: '',
      });
    } catch (error) {
      setSeverity('error');
      setOpen(true);
      setMessage('Error al enviar el correo.');
      console.error('Error al enviar el correo.', error);
    } finally {
      setLoading(false);
    }
  };

  return (
    <>
    <Snackbar
      open={open}
      autoHideDuration={6000}
      onClose={handleClose}
      anchorOrigin={{ vertical: 'top', horizontal: 'right' }}
    >
      <Alert onClose={handleClose} severity={severity} sx={{ width: '100%' }}>
        {message}
      </Alert>
    </Snackbar>
    <div className="bg-white relative flex min-h-screen flex-col justify-center overflow-hidden py-6 sm:py-12">
        <div className="max-w-5xl mx-auto w-full">
          <div className="grid grid-cols-1 lg:grid-cols-6 h-full">
            <div className="bg-blue-900 p-4 lg:col-span-2 col-span-1">
              <h2 className="mb-10 font-bold text-2xl text-blue-100 before:block before:absolute before:bg-sky-300 before:content[''] relative before:w-20 before:h-1 before:-skew-y-3 before:-bottom-4">Información de Contacto</h2>
              <p className="font-bold text-blue-100 py-8 border-b border-blue-700">
                Dirección
                <span className="font-normal text-xs text-blue-300 block">Calle Pavo Real #431 Los Tamarindos, Ixtapa, Puerto Vallarta, Jalisco.</span>
              </p>
              <p className="font-bold text-blue-100 py-8 border-b border-blue-700">
                Número de Teléfono
                <span className="font-normal text-xs text-blue-300 block"><a href="tel:+523223018570" className="font-normal text-xs text-blue-300 block">
                  +52 322 301 85 70
                </a></span>
              </p>
              <p className="font-bold text-blue-100 py-8 border-b border-blue-700">
                Dirección de Correo
                <span className="font-normal text-xs text-blue-300 block"><a href="mailto:andejecruher@gmail.com" className="font-normal text-xs text-blue-300 block">
                  andejecruher@gmail.com
                </a></span>
              </p>
            </div>
            <div className="bg-blue-50 p-4 lg:col-span-4 col-span-1">
              <h2 className="mb-14 font-bold text-4xl text-blue-900 before:block before:absolute before:bg-sky-300 before:content[''] relative before:w-20 before:h-1 before:-skew-y-3 before:-bottom-4">Ponerse en Contacto</h2>
              <form onSubmit={handleSubmit}>
                <div className="grid gap-6 mb-6 grid-cols-1 sm:grid-cols-2">
                  <div className="flex flex-col">
                    <label htmlFor="name" className="mb-2 text-xs font-semibold text-gray-600">Nombre</label>
                    <input
                      id="name"
                      className="py-4 bg-white rounded-full px-6 placeholder:text-xs border border-gray-300 focus:border-blue-500 focus:outline-none"
                      name="name"
                      placeholder="Tu nombre"
                      value={formData.name}
                      onChange={handleChange}
                      required />
                  </div>
                  <div className="flex flex-col">
                    <label htmlFor="lastName" className="mb-2 text-xs font-semibold text-gray-600">Apellido</label>
                    <input
                      id="lastName"
                      className="py-4 bg-white rounded-full px-6 placeholder:text-xs border border-gray-300 focus:border-blue-500 focus:outline-none"
                      name="lastName"
                      placeholder="Tu apellido"
                      value={formData.lastName}
                      onChange={handleChange}
                      required />
                  </div>
                </div>
                <div className="grid gap-6 mb-6 grid-cols-1 sm:grid-cols-2">
                  <div className="flex flex-col">
                    <label htmlFor="email" className="mb-2 text-xs font-semibold text-gray-600">Correo Electrónico</label>
                    <input
                      id="email"
                      className="py-4 bg-white rounded-full px-6 placeholder:text-xs border border-gray-300 focus:border-blue-500 focus:outline-none"
                      name="email"
                      placeholder="Dirección de correo"
                      value={formData.email}
                      onChange={handleChange}
                      required />
                  </div>
                  <div className="flex flex-col">
                    <label htmlFor="subject" className="mb-2 text-xs font-semibold text-gray-600">Asunto</label>
                    <input
                      id="subject"
                      className="py-4 bg-white rounded-full px-6 placeholder:text-xs border border-gray-300 focus:border-blue-500 focus:outline-none"
                      name="subject"
                      placeholder="Asunto"
                      value={formData.subject}
                      onChange={handleChange}
                      required />
                  </div>
                </div>
                <div className="mb-6">
                  <label htmlFor="message" className="mb-2 text-xs font-semibold text-gray-600">Mensaje</label>
                  <textarea
                    id="message"
                    className="w-full bg-white rounded-2xl placeholder:text-xs px-6 py-4 border border-gray-300 focus:border-blue-500 focus:outline-none"
                    name="message"
                    placeholder="Tu mensaje aquí"
                    value={formData.message}
                    onChange={handleChange}
                    rows="8"
                    required />
                </div>
                <div className="flex justify-center">
                  <button
                    type="submit"
                    className="rounded-full bg-black text-white font-bold py-4 px-6 min-w-40 transition-all"
                    disabled={loading}
                  >
                    {loading ? 'Enviando...' : 'Enviar'}
                  </button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div></>
  );
};

export default ContactForm;