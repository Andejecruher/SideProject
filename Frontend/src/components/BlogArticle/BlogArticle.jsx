import React from 'react';
import PropTypes from 'prop-types';
import FormComments from '@src/components/FormComments/FormComments';

const BlogArticle = ({ 
  title, 
  description, 
  content, 
  featured_image,  
  published, 
  publication_date, 
  category, 
  author, 
  comments,
  tags // Nueva prop para los tags
}) => {
  return (
    <div className="mx-auto p-3 bg-white shadow-md rounded-lg mt-3 border border-slate-200">
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
          <p><span className="font-semibold">Publicado por:</span> {author}</p>
          <p><span className="font-semibold">Fecha:</span> {new Date(publication_date).toLocaleDateString()}</p>
          <p><span className="font-semibold">Categoría:</span> {category}</p>
        </div>
        <div className={`py-1 px-3 rounded-md ${published ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600'}`}>
          {published ? 'Publicado' : 'No Publicado'}
        </div>
      </div>

      {/* Tags Section */}
      {tags && tags.length > 0 && (
        <div className="mb-6">
          <h3 className="text-lg font-semibold text-gray-700 mb-2">Tags:</h3>
          <div className="flex flex-wrap gap-2">
            {tags.map((tag, index) => (
              <span
                key={index}
                className="rounded-full bg-cyan-600 text-white px-2 py-1 text-sm"
              >
                {tag}
              </span>
            ))}
          </div>
        </div>
      )}

      {/* Article Content */}
      <div className="text-gray-800 leading-relaxed mb-8">
        <p>{content}</p>
      </div>

      {/* Comments Section */}
      <div className="mt-8">
        <h2 className="text-2xl font-bold text-gray-800 mb-4">Comentarios</h2>
        {comments.length > 0 ? (
          <div className="space-y-4">
            {comments.map((comment, index) => (
              <div key={index} className="p-4 border rounded-md shadow-sm">
                <p className="text-gray-700 font-semibold">{comment.author}</p>
                <p className="text-gray-500 text-sm">{new Date(comment.date).toLocaleDateString()}</p>
                <p className="text-gray-800 mt-2">{comment.text}</p>
              </div>
            ))}
          </div>
        ) : (
          <p className="text-gray-500">No hay comentarios aún.</p>
        )}
      </div>

      {/* Comments Form */}
      <div className="mt-8 border-t-2 border-gray pt-4">
        <FormComments />
      </div>
    </div>
  );
};

BlogArticle.propTypes = {
  title: PropTypes.string.isRequired,
  description: PropTypes.string.isRequired,
  content: PropTypes.string.isRequired,
  featured_image: PropTypes.string,
  thumbnail: PropTypes.string.isRequired,
  published: PropTypes.bool.isRequired,
  publication_date: PropTypes.string.isRequired,
  category: PropTypes.string.isRequired,
  author: PropTypes.string.isRequired,
  comments: PropTypes.arrayOf(
    PropTypes.shape({
      author: PropTypes.string.isRequired,
      date: PropTypes.string.isRequired,
      text: PropTypes.string.isRequired,
    })
  ).isRequired,
  tags: PropTypes.arrayOf(PropTypes.string), // Definición de la prop tags
};

export default BlogArticle;
