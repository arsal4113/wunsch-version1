import React from 'react';
import {useTranslation} from "react-i18next";
import ShippingOptions from "../../ShippingOptions/ShippingOptions";

import './ExtraInfo.scss';

const ExtraInfo = (props) => {
    const {
        shippingDate,
        shippingCurrency,
        shippingPrice
    } = props;
    const {t} = useTranslation('vip');

    return (
        <div className="extra-info-wrapper">
            <div className="separator"/>
            <div className="payment-method-info">
                <span>{t('Payment methods')}</span>
                <div className="payment-method-image">
                    <div className="paypal"/>
                    <div className="visa"/>
                    <div className="express"/>
                    <div className="master"/>
                    <div className="sepa"/>
                </div>
            </div>
            <ShippingOptions
                shippingDate={shippingDate}
                shippingCurrency={shippingPrice !== '0.00' ? shippingCurrency : ''}
                shippingPrice={shippingPrice === '0.00' ? t('Free') : shippingPrice}
            />
        </div>
    );
};

export default ExtraInfo;