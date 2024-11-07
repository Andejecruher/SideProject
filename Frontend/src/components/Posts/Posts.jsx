import React, { useEffect } from "react";
import { useNavigate } from "react-router-dom";
import { Button, List, ThemeIcon, rem } from "@mantine/core";
import { IconCheck } from "@tabler/icons-react";
import { useBlog } from "@src/Context/BlogContext";
import classes from "./Posts.module.css";

const Posts = () => {
  const {
    articles,
    categories,
    tags,
    pagination,
    page,
    setPage,
    setArticle,
    setCategory,
    setTag,
  } = useBlog();
  const navigate = useNavigate();

  const handleReadMore = (article) => {
    setArticle(article);
    const title = article.title.toLowerCase().replace(/ /g, "-");
    navigate(`/Blog/${title}`);
  };

  const handleCategory = (category) => {
    setCategory(category);
  };

  const handleTag = (tag) => {
    setTag(tag);
  };

  useEffect(() => {
    console.log(pagination);
    window.scrollTo(0, 0);
  }, [page]);

  return (
    <div className="container mx-auto">
      {/* Layout de las dos secciones */}
      <div className="flex flex-col lg:flex-row gap-8">
        {/* Sección principal de posts */}
        <div className="flex-1 grid grid-cols-1 md:grid-cols-2 gap-4">
          {/* Map de los posts */}
          {articles &&
            articles.map((article) => (
              <div
                key={article.id}
                className="relative flex flex-col bg-white shadow-sm border border-slate-200 rounded-lg w-100 h-full"
              >
                {/* Contenedor de imagen */}
                <div className="relative h-56 m-2.5 overflow-hidden text-white rounded-md">
                  <img src={article.thumbnail} alt={article.title} />
                </div>

                {/* Contenido principal */}
                <div className="p-4 flex-grow border-t border-slate-200">
                  {/* Tags */}
                  <List
                    size="sm"
                    icon={
                      <ThemeIcon size={20} radius="xl">
                        <IconCheck
                          style={{ width: rem(12), height: rem(12) }}
                          stroke={1.5}
                        />
                      </ThemeIcon>
                    }
                    className={classes.list}
                  >
                    {article.tags &&
                      article.tags.map((tag) => (
                        <List.Item key={tag.id}>{tag.name}</List.Item>
                      ))}
                  </List>
                  <h6 className="mb-2 text-slate-800 text-xl font-semibold">
                    {article.title}
                  </h6>
                  <p className="text-slate-600 leading-normal font-light">
                    {article.description}
                  </p>
                </div>

                {/* Footer */}
                <div className="flex items-center justify-between p-4 border-t border-slate-200">
                  <div className="flex items-center">
                    <img
                      alt={article.user.first_name}
                      src={article.user.avatar}
                      className="relative inline-block h-8 w-8 rounded-full"
                    />
                    <div className="flex flex-col ml-3 text-sm">
                      <span className="text-slate-800 font-semibold">
                        {article.user.first_name} {article.user.last_name}
                      </span>
                      <span className="text-slate-600">
                        {new Date(article.created_at).toLocaleDateString()}
                      </span>
                    </div>
                  </div>
                  <Button
                    radius="xl"
                    size="md"
                    onClick={() => {
                      handleReadMore(article);
                    }}
                  >
                    Leer más ...
                  </Button>
                </div>
              </div>
            ))}

          {/* Paginación */}

          <div className="flex items-center justify-center py-10 lg:px-0 sm:px-6 px-4 col-span-1 md:col-span-2">
            <div className="w-full  flex items-center justify-between border-t border-gray-200">
              <div
                className={`${
                  page === 1
                    ? "disable hover:text-grey cursor-default"
                    : "cursor-pointer hover:text-[#2089e3]"
                } flex items-center pt-3 text-gray-600`}
                onClick={() => {
                  if (page === 1) return;
                  setPage(page - 1);
                }}
              >
                <svg
                  width="14"
                  height="8"
                  viewBox="0 0 14 8"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1.1665 4H12.8332"
                    stroke="currentColor"
                    strokeWidth="1.25"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                  <path
                    d="M1.1665 4L4.49984 7.33333"
                    stroke="currentColor"
                    strokeWidth="1.25"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                  <path
                    d="M1.1665 4.00002L4.49984 0.666687"
                    stroke="currentColor"
                    strokeWidth="1.25"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                </svg>
                <p className="text-sm ml-3 font-medium leading-none ">
                  Anterior
                </p>
              </div>
              <div className="sm:flex hidden">
                <div className="sm:flex hidden">
                  {Array.from(
                    { length: pagination.total_pages },
                    (_, index) => (
                      <p
                        key={index + 1}
                        onClick={() => {
                          setPage(index + 1);
                        }}
                        className={`text-sm font-medium leading-none cursor-pointer border-t hover:border-[#2089e3] pt-3 mr-4 px-2 ${
                          pagination.current_page === index + 1
                            ? "text-[#2089e3] border-[#2089e3]"
                            : "text-gray-600 hover:text-[#2089e3] border-transparent"
                        }`}
                      >
                        {index + 1}
                      </p>
                    )
                  )}
                </div>
              </div>
              <div
                className={`${
                  page === pagination.total_pages
                    ? "disable hover:text-grey cursor-default"
                    : "cursor-pointer hover:text-[#2089e3]"
                } flex items-center pt-3 text-gray-600 `}
                onClick={() => {
                  if (page === pagination.total_pages) return;
                  setPage(page + 1);
                }}
              >
                <p className="text-sm font-medium leading-none mr-3">
                  Siguiente
                </p>
                <svg
                  width="14"
                  height="8"
                  viewBox="0 0 14 8"
                  fill="none"
                  xmlns="http://www.w3.org/2000/svg"
                >
                  <path
                    d="M1.1665 4H12.8332"
                    stroke="currentColor"
                    strokeWidth="1.25"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                  <path
                    d="M9.5 7.33333L12.8333 4"
                    stroke="currentColor"
                    strokeWidth="1.25"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                  <path
                    d="M9.5 0.666687L12.8333 4.00002"
                    stroke="currentColor"
                    strokeWidth="1.25"
                    strokeLinecap="round"
                    strokeLinejoin="round"
                  />
                </svg>
              </div>
            </div>
          </div>
        </div>

        {/* Sección derecha para información adicional */}
        <div className="w-full lg:w-1/3 flex flex-col gap-6">
          {/* Bloque de categorías */}
          <div className="bg-white rounded-lg shadow-md p-6 border border-slate-200">
            <h3 className="text-xl font-bold mb-4">Categorías</h3>
            <ul className="space-y-2">
              {categories &&
                categories.map((category) => (
                  <li
                    onClick={() => {
                      handleCategory(category);
                    }}
                    key={category.id}
                    className="flex justify-between text-blue-500 cursor-pointer border-b-gray-200 border-b"
                  >
                    <span>{category.name}</span>
                    <span>{category.articles_count}</span>
                  </li>
                ))}
            </ul>
          </div>

          {/* Bloque de tags */}
          <div className="bg-white rounded-lg shadow-md p-6 border border-slate-200">
            <h3 className="text-xl font-bold mb-4">Tags</h3>
            <div className="flex flex-wrap gap-2">
              {tags &&
                tags.map((tag) => (
                  <div
                    key={tag.id}
                    onClick={() => {
                      handleTag(tag);
                    }}
                    className={`bg-[${tag.color}] cursor-pointer text-white rounded-full px-4 py-1 text-sm`}
                    style={{
                      backgroundColor: tag.color,
                    }}
                  >
                    {tag.name}
                  </div>
                ))}
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Posts;
