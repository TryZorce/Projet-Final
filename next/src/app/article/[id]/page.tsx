"use client"
import React from 'react';
import ArticlePage from '@/ui/molecules/ArticleDetail';

const IdDetail = ({ params }) => {
  const { id } = params;

  if (!id) {
    return <p>L'identifiant de l'article est manquant.</p>;
  }

  return <ArticlePage id={id} />;
};

export default IdDetail;
