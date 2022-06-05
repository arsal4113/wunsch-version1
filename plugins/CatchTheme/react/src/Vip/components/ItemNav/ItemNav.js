import React from 'react';
import {useSelector} from 'react-redux';
import Breadcrumbs from '../Breadcrumbs/Breadcrumbs';
import StarRating from '../StarRating/StarRating';

import './ItemNav.scss';

const ItemNav = ({breadcrumbs}) => {
    const {title, rating} = useSelector((state) => state.items.ebayItem);
    const starRating = rating ? <StarRating rating={rating}/> : '';
    return (
        <div className={`item-nav${rating ? '' : ' no-rating'}`}>
            <Breadcrumbs breadcrumbs={breadcrumbs} itemTitle={title}/>
            {starRating}
        </div>
    );
};

export default ItemNav;
