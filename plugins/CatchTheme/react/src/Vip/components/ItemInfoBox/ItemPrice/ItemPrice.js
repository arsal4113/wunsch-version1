import React from 'react';
import {useTranslation} from 'react-i18next';

import './ItemPrice.scss';

const ItemPrice = (props) => {
    const {itemPrice} = props;
    const {t} = useTranslation('vip');

    return (
        <div className="text-wrapper price-wrapper">
            <div className="item-price"><span className="display-price">{itemPrice}</span><span className="tax-info">{t('inkl. MwSt')}</span></div>
        </div>
    );
};

export default ItemPrice;
