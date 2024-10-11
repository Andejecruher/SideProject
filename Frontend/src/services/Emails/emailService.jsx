import emailjs from 'emailjs-com';

const emailUserID = import.meta.env.VITE_APP_EMAIL_USER_ID;
const emailServiceID = import.meta.env.VITE_APP_EMAIL_SERVICE_ID;
const emailTemplateConfirmationID = import.meta.env.VITE_APP_EMAIL_CONFIRMACION_TEMPLATE_ID;
const emailTemplateContactID = import.meta.env.VITE_APP_EMAIL_CONTACTO_TEMPLATE_ID;

export const sendEmailConfirmation = (formData) => {
  return emailjs.send(emailServiceID, emailTemplateConfirmationID, formData, emailUserID);
};

export const sendEmailContact = (formData) => {
  return emailjs.send(emailServiceID, emailTemplateContactID, formData, emailUserID);
};