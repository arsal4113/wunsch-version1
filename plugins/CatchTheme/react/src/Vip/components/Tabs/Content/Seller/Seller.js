import React from 'react';
import {useTranslation} from 'react-i18next';

import './Seller.scss';

const Seller = (props) => {
    const {
        item
    } = props;
    const {t} = useTranslation('vip');

    return (
        <div className="tab-content seller">
            <div className="seller-name">
                {item.seller.username}
                <span className="feedback-score">({item.seller.feedback_score})</span><br />
                <span className="feedback-percentage">
                    {item.seller.feedback_percentage} {t('Positives Feedback')}
                </span>
            </div>
            <div className="tab-link"><a href={item.item_web_url}>{t('Melden auf eBay')} </a></div>
            <div className="item-condition">{t('Artikelzustand')}: <span>{t('Neu')}</span></div>
        </div>
    );
};

export default Seller;
