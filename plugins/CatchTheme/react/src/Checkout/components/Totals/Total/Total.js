import React from 'react';
import {useTranslation} from 'react-i18next';
import {formatPrice} from '../../../redux/utility';

import './Total.scss';

const Total = ({total, itemCount, final}) => {
    const {t} = useTranslation(['checkout', 'common']);
    if ((!total.value || total.value === '0.00') && total.code !== 'deliveryCost') {
        return null;
    }
    let price;
    let name;
    if (!total.value || total.value === '0.00') {
        price = t('common:free');
    } else {
        price = formatPrice(total.value, total.currency);
    }
    if (total.code === 'priceSubtotal') {
        name = t('totals.priceSubtotal', {count: itemCount});
    } else {
        name = t(`totals.${total.code}${final ? 'Final' : ''}`);
    }
    return (
        <div className={`total total-${total.code} ${final ? 'final' : ''}`}>
            <span className="total-name">{name}</span>
            <span className="total-value">{price}</span>
        </div>
    );
};

export default Total;
