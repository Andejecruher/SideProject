import React, { useEffect, useRef } from 'react';
import { useBlog } from '@src/Context/BlogContext';
import FormComments from '@src/components/FormComments/FormComments';

const BlogArticle = () => {
  const { article, pageComments, fetchArticleByIdComments, setPageComments, isLoadingComments } = useBlog();
  const { title, description, content, featured_image, published, publication_date, category, user, comments, tags } = article;

  const firstCommentRef = useRef(null);

  const handlePaginate = (pageSelect) => {
    if (pageSelect === pageComments) return;
    setPageComments(pageSelect);
    let query = `${article.id}?page=${pageSelect}`;
    fetchArticleByIdComments(query);
  };

  useEffect(() => {
    if (firstCommentRef.current) {
      firstCommentRef.current.scrollIntoView({ behavior: 'smooth' });
    }
  }, [comments]);

  return (
    <div className="p-3 bg-white shadow-md rounded-lg mt-3 border border-slate-200">
      {/* Title & Description */}
      <h1 className="text-3xl font-bold text-gray-800 mb-2">{title}</h1>
      <p className="text-gray-600 mb-4 italic">{description}</p>

      {/* Featured Image */}
      {featured_image && (
        <img src={featured_image} alt="Featured" className="w-full h-96 object-cover rounded-md mb-6" />
      )}

      {/* Publication Details */}
      <div className="flex items-center justify-between text-sm text-gray-500 mb-6">
        <div>
          <p><span className="font-semibold">Publicado por:</span> {user && user.first_name} {user && user.last_name}</p>
          <p><span className="font-semibold">Fecha:</span> {new Date(publication_date).toLocaleDateString()}</p>
          <p><span className="font-semibold">Categoría:</span> {category && category.name}</p>
        </div>
        <div className={`py-1 px-3 rounded-md ${published === 1 ? 'bg-green-600 text-white' : 'bg-red text-white'}`}>
          {published === 1 ? 'Publicado' : 'No Publicado'}
        </div>
      </div>

      {/* Tags Section */}
      {tags && (
        <div className="mb-6">
          <h3 className="text-lg font-semibold text-gray-700 mb-2">Tags:</h3>
          <div className="flex flex-wrap gap-2">
            {tags.map((tag, index) => (
              <span
                key={index}
                className="rounded-full bg-cyan-600 text-white px-2 py-1 text-sm cursor-pointer"
                style={{ backgroundColor: `${tag.color}` }}
              >
                {tag.name}
              </span>
            ))}
          </div>
        </div>
      )}

      {/* Article Content */}
      <div className="text-gray-800 leading-relaxed mb-8">
        <div dangerouslySetInnerHTML={{ __html: content }} />
      </div>

      {/* Comments Section */}
      {isLoadingComments ? (
        <div className="flex items-center justify-center py-10">
          <div className="flex items-center justify-center">
            <svg
              className="animate-spin -ml-1 mr-3 h-5 w-5 text-gray-800"
              xmlns="http://www.w3.org/2000/svg"
              fill="none"
              viewBox="0 0 24 24"
            >
              <circle
                className="opacity-25"
                cx="12"
                cy="12"
                r="10"
                stroke="currentColor"
                strokeWidth="4"
              ></circle>
              <path
                className="opacity-75"
                fill="currentColor"
                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"
              ></path>
            </svg>
          </div>
        </div>
      ) : (
        <div className="mt-8" ref={firstCommentRef}>
          <h2 className="text-2xl font-bold text-gray-800 mb-4" >Comentarios</h2>
          {comments && comments.data.length > 0 ? (
            <div className="space-y-4" >
              {comments.data.map((comment, index) => (
                <div key={index} className="p-4 border rounded-md shadow-sm">
                  <p className="text-gray-700 font-semibold">{comment.author_name}</p>
                  <p className="text-gray-500 text-sm">{new Date(comment.published_at).toLocaleDateString()}</p>
                  <p className="text-gray-800 mt-2">{comment.content}</p>
                </div>
              ))}
            </div>
          ) : (
            <p className="text-gray-500">No hay comentarios aún.</p>
          )}
        </div>
      )}

      {/* Paginación */}

      {comments && comments.data.length > 0 && (
        <div className="flex items-center justify-center py-10 lg:px-0 sm:px-6 px-4">
          <div className="w-full  flex items-center justify-between border-t border-gray-200">
            <div
              className={`${pageComments === 1
                ? "disable hover:text-grey cursor-default"
                : "cursor-pointer hover:text-[#2089e3]"
                } flex items-center pt-3 text-gray-600`}
              onClick={() => {
                if (pageComments === 1) return;
                handlePaginate(pageComments - 1);
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
                  { length: comments.last_page },
                  (_, index) => (
                    <p
                      key={index + 1}
                      onClick={() => {
                        handlePaginate(index + 1);
                      }}
                      className={`text-sm font-medium leading-none cursor-pointer border-t hover:border-[#2089e3] pt-3 mr-4 px-2 ${comments.current_page === index + 1
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
              className={`${pageComments === comments.last_page
                ? "disable hover:text-grey cursor-default"
                : "cursor-pointer hover:text-[#2089e3]"
                } flex items-center pt-3 text-gray-600 `}
              onClick={() => {
                if (pageComments === comments.last_page) return;
                handlePaginate(pageComments + 1);
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
      )}

      {/* Comments Form */}
      <div className="mt-8 border-t-2 border-gray pt-4">
        <FormComments />
      </div>
    </div>
  );
}


export default BlogArticle;
