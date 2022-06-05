import React from 'react';
import {useTranslation} from 'react-i18next';

import './StarRating.scss';

const StarRating = ({rating}) => {
    const {t} = useTranslation('vip');
    const {avg_rating, rating_count} = rating;
    const avgRating = parseFloat(avg_rating);
    const stars = [];
    for (let i = 0; i < 5; i++) {
        if (avgRating - i >= 0.75) {
            stars.push(<div className="star full"/>);
        } else if (avgRating - i >= 0.25) {
            stars.push(<div className="star half"/>);
        } else {
            stars.push(<div className="star empty"/>);
        }
    }
    return (
        <div className="rating">
            <div className="star-wrapper">{stars}</div>
            <span className="avg">{avg_rating}</span>
            <span>{`(${rating_count} ${rating_count > 1 ? t('Reviews') : t('Review')})`}</span>
        </div>
    );
};

export default StarRating;
