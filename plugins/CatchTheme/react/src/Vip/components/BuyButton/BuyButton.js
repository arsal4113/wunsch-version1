import React from 'react';
import {useSelector} from 'react-redux';
import {useTranslation} from 'react-i18next';
import AddToCart from './AddToCart/AddToCart';
import AddToWishlist from './AddToWishlist/AddToWishlist';
import BuyOnEbay from './BuyOnEbay/BuyOnEbay';

import './BuyButton.scss';


const BuyButton = (props) => {
    const {
        itemWebUrl,
        showBuyButton,
        item,
        selectedItem
    } = props;
    const {t} = useTranslation('vip');
    const {error} = useSelector((state) => state.items);
    const errorMessage = error && typeof error !== 'boolean' ? <span className="error">{t(error)}</span> : '';
    let button;
    if (item.items[selectedItem] && item.items[selectedItem].availability_status !== "IN_STOCK") {
        button = (<AddToWishlist item={item}/>);
    } else {
        if (showBuyButton) {
            button = (<AddToCart/>);
        } else {
            button = (<BuyOnEbay itemWebUrl={itemWebUrl}/>);
        }
    }
    return (
        <div className="buy-button-wrapper">
            {errorMessage}
            {button}
        </div>
    );
};

export default BuyButton;
