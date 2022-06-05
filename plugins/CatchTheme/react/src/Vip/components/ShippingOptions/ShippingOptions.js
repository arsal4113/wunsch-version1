import React from 'react';
import {useTranslation} from 'react-i18next';

import './ShippingOptions.scss'

const ShippingOptions = (props) => {
    const {
        shippingDate,
        shippingCurrency,
        shippingPrice,
    } = props;
    const {t} = useTranslation('vip');

    return (
        <div className="text-box shipping-info">
            <div>
                <span>{t('Standard shipping')}{': '}</span>
                <span>{shippingPrice} {t(shippingCurrency)}</span>
            </div>
            <div>
                <span>{t('Shipping')}{': '}</span>
                {
                    shippingDate[0] !== '' && shippingDate[1] !== '' ?
                        (
                            <span>{t('Between')} {shippingDate[0]} {t('and')} {shippingDate[1]}</span>
                        ) :
                        (
                            <span>{t('No Delivery Date')}</span>
                        )
                }
            </div>
        </div>
    );
};

export default ShippingOptions;
