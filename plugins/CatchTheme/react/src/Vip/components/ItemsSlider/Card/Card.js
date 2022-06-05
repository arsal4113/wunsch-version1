import React from 'react';
import WishlistButton from './WishlistButton/WishlistButton';
import {formatPrice} from '../../../helper';

import './Card.scss';

const Card = ({item, showItemPrice, isBestseller, showWishlist}) => {
    const originalPrice = item.original_price
        ? <span className="original-price">{formatPrice(item.original_price, item.currency)}</span> : null;
    const unitPrice = (item.unit_price_measure !== '' && item.unit_price_value !== '')
        ? (
            <span className="unit-price">
                {`${formatPrice(item.unit_price_value, item.currency)} / ${item.unit_price_measure}`}
            </span>
        ) : null;
    const itemPrice = showItemPrice ? (
        <div className="card-price">
            <span className={`item-price${originalPrice ? ' discounted' : ''}`}>
                {originalPrice}
                {formatPrice(item.price, item.currency)}
            </span>
            {unitPrice}
        </div>
    ) : null;
    const wishlistButton = showWishlist ? <WishlistButton item={item}/> : null;
    return (
        <div className={`card${isBestseller ? ' bestseller-item' : ''}`}>
            <a href={`/itm/${item.item_id}`}>
                <div className="image-wrapper">
                    <img alt="item" src={item.image_url}/>
                </div>
                {itemPrice}
            </a>
            {wishlistButton}
        </div>
    );
};

export default Card;
