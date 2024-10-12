import React, {useEffect} from 'react';
import andejecruher from '../../assets/andejecruher.png';
import ajh from '../../assets/ajh.png';
import './AboutMe.css';
import EmailIcon from '@mui/icons-material/Email';
import GitHubIcon from '@mui/icons-material/GitHub';
import PhoneIcon from '@mui/icons-material/Phone';
import useOnScreen from '@src/hooks/useOnScreen';
import classNames from 'classnames';

const AboutMe = () => {
  const [ref, isVisible] = useOnScreen({
    root: null, // Observar la ventana de visualización (viewport)
    rootMargin: '0px', // Margen opcional
    threshold: 0.1, // 10% del elemento debe estar visible para considerarlo en la vista
  });

  const [refPhone, isVisiblePhone] = useOnScreen({
    root: null, // Observar la ventana de visualización (viewport)
    rootMargin: '0px', // Margen opcional
    threshold: 0.3, // 10% del elemento debe estar visible para considerarlo en la vista
  });

useEffect(() => {
  if (isVisiblePhone) {
    console.log('Phone visible', isVisiblePhone);
  } 
}
, [isVisiblePhone]);

  return (
    <div className="p-2 md:p-10 bg-white">
      <div className="grid col-span-1 md:flex items-center mt-20 justify-center">

        <div ref={ref} className={classNames('animate__animated md:mr-4', {
        'animate__fadeIn': isVisible,
      })}>
          <img className="md:w-40 w-28 ml-10" src={andejecruher} alt="Perfil" />
        </div>

        <div className={classNames('animate__animated md:mr-4', {
        'animate__fadeIn': isVisible,
      })}>
          <img className="md:w-60 w-80 mr-10" src={ajh} alt="Logo" />
        </div>

        <div className={classNames("animate__animated md:border-l-2 sm:pl-4 p-2 col-span-2 text-justify md:w-1/2 mt-10 md:mt-0",
        {'animate__fadeIn' : isVisible,}
        )}>
          <p className='about-me-text'>
            ¡Hola! Soy Andejecruher, un desarrollador Full Stack apasionado por la tecnología.
            Me encanta aprender y crecer constantemente en el campo del desarrollo web y las tecnologías emergentes.
          </p>
          <p className="mt-4 about-me-text">
            Siempre busco compartir mis conocimientos y experiencias con otros. Estoy enfocado en crear aplicaciones web
            eficientes y efectivas, y en mejorar mis habilidades en programación.
          </p>
        </div>
      </div>

      <div className="grid col-span-1 md:flex items-center justify-center mt-10">
        <div>
          <div className="md:flex items-center md:mb-4">
            <div className={classNames("animate__animated flex items-center md:mr-8 mb-2 md:mb-0",{
              "animate__fadeInLeft": isVisiblePhone,
            })}>
              <a href="mailto:andejecruher@gmail.com" target="_blank" rel="noopener noreferrer" className="flex items-center">
                <EmailIcon className="mr-2" fontSize="large" />
                <p>andejecruher@gmail.com</p>
              </a>
            </div>

            <div className={classNames("animate__animated flex items-center md:mr-8 mb-2 md:mb-0",{
              "animate__fadeInRight": isVisiblePhone,
            })}>
              <a href="https://github.com/Andejecruher" target="_blank" rel="noopener noreferrer" className="flex items-center">
                <GitHubIcon className="mr-2" fontSize="large" />
                <p><b>github.com/</b>andejecruher</p>
              </a>
            </div>
          </div>

          <div className="md:flex items-center" ref={refPhone}>
            <div className={classNames("animate__animated flex items-center md:mr-8 mb-2 md:mb-0",{
              "animate__fadeInLeft": isVisiblePhone,
            })}>
              <a href="tel:+523223018570" target="_blank" rel="noopener noreferrer" className="flex items-center" >
                <PhoneIcon className="mr-2" fontSize="large" />
                <p>+52 322 301 85 70</p>
              </a>
            </div>

            <div className={classNames("animate__animated flex items-center md:mr-8 mb-2 md:mb-0",{
              "animate__fadeInRight": isVisiblePhone,
            })}>
              <a href="tel:+523223018570" target="_blank" rel="noopener noreferrer" className="flex items-center" >
                <PhoneIcon className="mr-2" fontSize="large" />
                <p>+52 322 318 82 52</p>
              </a>
            </div>

          </div>
        </div>
      </div>
    </div>
  );
};

export default AboutMe;