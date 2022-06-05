import React from 'react';
import { useTranslation } from 'react-i18next';

import './AddToWishlist.scss';

const AddToWishlist = (props) => {
    const {t} = useTranslation('vip');
    const {
        item
    } = props;
    const {wishlistItems} = window;
    const alreadyOnWishlist = wishlistItems[item.item_legacy_id] || wishlistItems[item.item_id];

    return (
        <a
            className={`button wishlist-item-link ${alreadyOnWishlist ? '' : 'add'}`}
            id="add-to-wishlist"
            href={`/customer/account/wishlist/add/${item.item_legacy_id}`}
            data-href-add={`/customer/account/wishlist/add/${item.item_legacy_id}`}
            onClick={(e) => { $(e.target).wishlistify(); }}
        >
            {t('Auf die Wunschliste')}
        </a>
    );
};

export default AddToWishlist;
