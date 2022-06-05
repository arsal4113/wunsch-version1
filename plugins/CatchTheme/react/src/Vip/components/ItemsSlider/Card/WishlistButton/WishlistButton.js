import React from 'react';

const WishlistButton = ({item}) => {
    const {wishlistItems} = window;
    const alreadyOnWishlist = wishlistItems[item.item_legacy_id] || wishlistItems[item.item_id];
    return (
        <a
            className={`wishlist-item-link ${alreadyOnWishlist ? 'remove' : 'add'}`}
            href={`/customer/account/wishlist/add/${item.item_legacy_id}`}
            data-href-remove={`/customer/account/wishlist/remove/${item.item_legacy_id}`}
            data-href-add={`/customer/account/wishlist/add/${item.item_legacy_id}`}
            onClick={(e) => { $(e.target).wishlistify(); }}
        >
            <span className={`wishlist-icon ${alreadyOnWishlist ? 'remove' : 'add'}`}/>
        </a>
    );
};

export default WishlistButton;
