// Import necessary dependencies
import React, { useState, useEffect } from 'react';
import Link from 'next/link';
import './ArticleList.scss';

interface Article {
  id: number;
  name: string;
  image: string;
}

const ArticlesPage: React.FC = () => {
  const [articles, setArticles] = useState<Article[]>([]);
  const [loading, setLoading] = useState<boolean>(true);
  const [error, setError] = useState<string | null>(null);

  useEffect(() => {
    const fetchArticles = async () => {
      try {
        const response = await fetch('http://localhost:8000/api/articles');
        if (!response.ok) {
          throw new Error(`Erreur HTTP : ${response.status}`);
        }

        const data = await response.json();
        setArticles(data['hydra:member']);
        setLoading(false);
      } catch (err) {
        if (err instanceof Error) {
          setError(err.message); // Ensure that 'error' is of type string
        } else {
          setError('Une erreur inconnue s\'est produite.');
        }
        setLoading(false);
      }
    };

    fetchArticles();
  }, []);

  if (loading) {
    return <p>Chargement en cours...</p>;
  }

  if (error) {
    return <p>Erreur : {error}</p>;
  }

  return (
    <div className="article-list-container">
      <p>Liste des Articles</p>
      <div className="article-list">
        {articles.map((article) => (
          <div key={article.id} className="article-item">
            <Link href={`/article/${article.id}`}>
              <div className='list-center'>
                <p>{article.name}</p>
                <img src={`http://127.0.0.1:8000/images/${article.image}`} alt={article.name} className="image" />
              </div>
            </Link>
          </div>
        ))}
      </div>
    </div>
  );
};

export default ArticlesPage;
