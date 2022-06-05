import React from 'react';
import {useTranslation} from 'react-i18next';
import {useSelector, useDispatch} from 'react-redux';
import {hideMobilePopup} from '../../redux/items/items.actions';

import './MobileCheckoutPopup.scss';

const MobileCheckoutPopup = () => {
    const isLoading = useSelector((state) => state.items.isFetching);
    const dispatch = useDispatch();
    const {t} = useTranslation('vip');
    const closePopup = () => {
        dispatch(hideMobilePopup());
    };
    const popupContent = isLoading
        ? (<div className="loader"/>)
        : (
            <div className="popup-content">
                <div className="popup-close" onClick={closePopup}/>
                <div className="icon-wrapper"/>
                <div className="link-wrapper">
                    <a href={window.checkoutUrl} className="button to-checkout">{t('To checkout')}</a>
                    <a href={window.cartUrl} className="button to-cart">{t('To cart')}</a>
                </div>
            </div>
        );
    return (
        <div className="mobile-checkout-popup">
            {popupContent}
        </div>
    );
};

export default MobileCheckoutPopup;
