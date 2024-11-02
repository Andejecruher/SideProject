import React from "react";
import { Button } from '@mantine/core';
import PropTypes from 'prop-types';

const Posts = ({ articles, categories, tags }) => {
  return (
    <div className="container mx-auto">
      {/* Layout de las dos secciones */}
      <div className="flex flex-col lg:flex-row gap-8">

        {/* Sección principal de posts */}
        <div className="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
          <div className="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg w-100">
            <div className="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
              <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80" alt="card-image" />
            </div>
            <div className="p-4">
              <div className="mb-4 rounded-full bg-cyan-600 py-0.5 px-2.5 border border-transparent text-xs text-white transition-all shadow-sm w-20 text-center">
                POPULAR
              </div>
              <h6 className="mb-2 text-slate-800 text-xl font-semibold">
                Website Review Check
              </h6>
              <p className="text-slate-600 leading-normal font-light">
                The place is close to Barceloneta Beach and bus stop just 2 min by walk
                and near to &quot;Naviglio&quot; where you can enjoy the main night life in
                Barcelona.
              </p>
            </div>

            <div className="flex items-center justify-between p-4">
              <div className="flex items-center">
                <img
                  alt="Tania Andrew"
                  src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1480&amp;q=80"
                  className="relative inline-block h-8 w-8 rounded-full"
                />
                <div className="flex flex-col ml-3 text-sm">
                  <span className="text-slate-800 font-semibold">Lewis Daniel</span>
                  <span className="text-slate-600">
                    January 10, 2024
                  </span>
                </div>
              </div>
              <Button radius="xl" size="md" >
                Leer más ...
              </Button>
            </div>
          </div>
          <div className="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg w-100">
            <div className="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
              <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80" alt="card-image" />
            </div>
            <div className="p-4">
              <div className="mb-4 rounded-full bg-cyan-600 py-0.5 px-2.5 border border-transparent text-xs text-white transition-all shadow-sm w-20 text-center">
                POPULAR
              </div>
              <h6 className="mb-2 text-slate-800 text-xl font-semibold">
                Website Review Check
              </h6>
              <p className="text-slate-600 leading-normal font-light">
                The place is close to Barceloneta Beach and bus stop just 2 min by walk
                and near to &quot;Naviglio&quot; where you can enjoy the main night life in
                Barcelona.
              </p>
            </div>

            <div className="flex items-center justify-between p-4">
              <div className="flex items-center">
                <img
                  alt="Tania Andrew"
                  src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1480&amp;q=80"
                  className="relative inline-block h-8 w-8 rounded-full"
                />
                <div className="flex flex-col ml-3 text-sm">
                  <span className="text-slate-800 font-semibold">Lewis Daniel</span>
                  <span className="text-slate-600">
                    January 10, 2024
                  </span>
                </div>
              </div>
              <Button radius="xl" size="md" >
                Leer más ...
              </Button>
            </div>
          </div>
          <div className="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg w-100">
            <div className="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
              <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80" alt="card-image" />
            </div>
            <div className="p-4">
              <div className="mb-4 rounded-full bg-cyan-600 py-0.5 px-2.5 border border-transparent text-xs text-white transition-all shadow-sm w-20 text-center">
                POPULAR
              </div>
              <h6 className="mb-2 text-slate-800 text-xl font-semibold">
                Website Review Check
              </h6>
              <p className="text-slate-600 leading-normal font-light">
                The place is close to Barceloneta Beach and bus stop just 2 min by walk
                and near to &quot;Naviglio&quot; where you can enjoy the main night life in
                Barcelona.
              </p>
            </div>

            <div className="flex items-center justify-between p-4">
              <div className="flex items-center">
                <img
                  alt="Tania Andrew"
                  src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1480&amp;q=80"
                  className="relative inline-block h-8 w-8 rounded-full"
                />
                <div className="flex flex-col ml-3 text-sm">
                  <span className="text-slate-800 font-semibold">Lewis Daniel</span>
                  <span className="text-slate-600">
                    January 10, 2024
                  </span>
                </div>
              </div>
              <Button radius="xl" size="md" >
                Leer más ...
              </Button>
            </div>
          </div>
          <div className="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg w-100">
            <div className="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
              <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1471&amp;q=80" alt="card-image" />
            </div>
            <div className="p-4">
              <div className="mb-4 rounded-full bg-cyan-600 py-0.5 px-2.5 border border-transparent text-xs text-white transition-all shadow-sm w-20 text-center">
                POPULAR
              </div>
              <h6 className="mb-2 text-slate-800 text-xl font-semibold">
                Website Review Check
              </h6>
              <p className="text-slate-600 leading-normal font-light">
                The place is close to Barceloneta Beach and bus stop just 2 min by walk
                and near to &quot;Naviglio&quot; where you can enjoy the main night life in
                Barcelona.
              </p>
            </div>

            <div className="flex items-center justify-between p-4">
              <div className="flex items-center">
                <img
                  alt="Tania Andrew"
                  src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?ixlib=rb-1.2.1&amp;ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&amp;auto=format&amp;fit=crop&amp;w=1480&amp;q=80"
                  className="relative inline-block h-8 w-8 rounded-full"
                />
                <div className="flex flex-col ml-3 text-sm">
                  <span className="text-slate-800 font-semibold">Lewis Daniel</span>
                  <span className="text-slate-600">
                    January 10, 2024
                  </span>
                </div>
              </div>
              <Button radius="xl" size="md" >
                Leer más ...
              </Button>
            </div>
          </div>
        </div>

        {/* Sección derecha para información adicional */}
        <div className="w-full lg:w-1/3 flex flex-col gap-6">

          {/* Bloque de categorías */}
          <div className="bg-white rounded-lg shadow-md p-6 border border-slate-200">
            <h3 className="text-xl font-bold mb-4">Categorías</h3>
            <ul className="space-y-2">
              <li className="text-blue-500 hover:underline cursor-pointer border-b-gray-200 border-b">Categoría 1</li>
              <li className="text-blue-500 hover:underline cursor-pointer border-b-gray-200 border-b">Categoría 2</li>
              <li className="text-blue-500 hover:underline cursor-pointer border-b-gray-200 border-b">Categoría 3</li>
            </ul>
          </div>

          {/* Bloque de tags */}
          <div className="bg-white rounded-lg shadow-md p-6 border border-slate-200">
            <h3 className="text-xl font-bold mb-4">Tags</h3>
            <div className="flex flex-wrap gap-2">
              <span className="bg-gray-200 text-gray-700 px-3 py-1 rounded-full cursor-pointer">#React</span>
              <span className="bg-gray-200 text-gray-700 px-3 py-1 rounded-full cursor-pointer">#Tailwind</span>
              <span className="bg-gray-200 text-gray-700 px-3 py-1 rounded-full cursor-pointer">#JavaScript</span>
            </div>
          </div>

        </div>
      </div>
    </div>
  );
};

Posts.propTypes = {
  articles: PropTypes.array,
  categories: PropTypes.array,
  tags: PropTypes.array,
};

export default Posts;
