import React from 'react';

import './WishlistFlag.scss';

const WishlistFlag = () => {
    return (
        <span className="wishlist-wrapper" dangerouslySetInnerHTML={{__html: window.wishlistLink ?? ''}} />
    )
};

export default WishlistFlag;
