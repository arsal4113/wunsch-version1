import React from 'react';
import { useTranslation } from 'react-i18next';

import './BuyOnEbay.scss';

const BuyOnEbay = (props) => {
    const {t} = useTranslation('vip');
    const {
        itemWebUrl
    } = props;

    return (
        <a
            href={itemWebUrl}
            className="button"
            id="buy-on-ebay"
            target="_blank"
            rel="noopener noreferrer"
        >
            {t('Kaufen auf eBay')}
        </a>
    );
};

export default BuyOnEbay;
