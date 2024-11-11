import React, { useState, useEffect } from 'react';
import { useBlog } from '@src/Context/BlogContext';
import './HeaderSearch.css';

export default function HeaderSearch() {
  const [isOpen, setIsOpen] = useState(false);
  const [selectedLink, setSelectedLink] = useState('Todas');
  const [searchQuery, setSearchQuery] = useState('');
  const { category, categories, setCategory, setSearch } = useBlog();

  useEffect(() => {
    if (category && category.name) {
      setSelectedLink(category.name);
    }
  }, []);

  useEffect(() => {
    if (category === 'Todas') {
      setSelectedLink(category);
    }
    if (category && category.name) {
      setSelectedLink(category.name);
    }
  }, [category]);

  const handleSearchChange = (event) => {
    event.preventDefault();
    setSearchQuery(event.target.value);
  };

  const handleSearchSubmit = (event) => {
    event.preventDefault();
    // Realizar la búsqueda aquí
    setSearch(searchQuery);
    setSelectedLink('Todas');
    setSearchQuery('');
    // Puedes llamar a una función para realizar la búsqueda o redirigir a una página de resultados
  };

  const handleLinkClick = (category) => {
    if (category === 'Todas') {
      setSelectedLink('Todas');
      setCategory('all');
      return;
    }
    setSelectedLink(category.name);
    setCategory(category);
  };

  const toggleMenu = () => {
    setIsOpen(!isOpen);
  };

  return (
    <div className="conten-header-search">
      <nav className="border-gray-200 px-2">
        <div className="mx-auto flex flex-wrap items-center justify-between">
          <div className="relative mr-3 md:mr-0 md:hidden max-w-[200px] searchInput">
            <div className="absolute inset-y-0 left-0 pl-3 flex items-center cursor-pointer" onKeyDown={(e) => e.key === 'Enter' && handleSearchSubmit(e)} onClick={(e) => handleSearchSubmit(e)}>
              <svg className="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clipRule="evenodd"></path>
              </svg>
            </div>
            <input
              type="text"
              className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2"
              placeholder="Search..."
              value={searchQuery}
              onChange={handleSearchChange}
              onKeyDown={(e) => e.key === 'Enter' && handleSearchSubmit(e)}
            />
          </div>
          <div className="flex md:order-2">
            <div className="relative mr-3 md:mr-0 hidden md:block">
              <div className="absolute inset-y-0 left-0 pl-3 flex items-center cursor-pointer" onKeyDown={(e) => e.key === 'Enter' && handleSearchSubmit(e)} onClick={(e) => handleSearchSubmit(e)}>
                <svg className="w-5 h-5 text-gray-500" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                  <path fillRule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clipRule="evenodd"></path>
                </svg>
              </div>
              <input
                type="text"
                className="bg-gray-50 border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2"
                placeholder="Search..."
                value={searchQuery}
                onChange={handleSearchChange}
                onKeyDown={(e) => e.key === 'Enter' && handleSearchSubmit(e)} />
            </div>
            <button onClick={toggleMenu} className="md:hidden text-gray-400 hover:text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 rounded-lg inline-flex items-center justify-center" aria-expanded={isOpen}>
              <span className="sr-only">Open main menu</span>
              <svg className={`${isOpen ? 'hidden' : 'block'} w-6 h-6`} fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clipRule="evenodd"></path>
              </svg>
              <svg className={`${isOpen ? 'block' : 'hidden'} w-6 h-6`} fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fillRule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clipRule="evenodd"></path>
              </svg>
            </button>
          </div>
          <div className={`md:flex justify-between items-center w-full md:w-auto md:order-1 ${isOpen ? 'block' : 'hidden'}`}>
            <ul className="flex-col md:flex-row flex md:space-x-2 mt-4 md:mt-0 md:text-sm md:font-medium">
              <li className=''>
                <a href="#" onClick={() => handleLinkClick('Todas')} className={`block rounded p-2 ${selectedLink === 'Todas' ? 'btn-selected' : 'text-gray-70'}`}>Todas</a>
              </li>
              {categories && categories.map((category) => (
                <li key={category.id} className=''>
                  <a href="#" onClick={() => handleLinkClick(category)} className={`block rounded p-2 ${selectedLink === category.name ? 'btn-selected' : 'text-gray-70'}`}>{category.name}</a>
                </li>
              ))}
            </ul>
          </div>
        </div>
      </nav>
    </div>
  );
};
