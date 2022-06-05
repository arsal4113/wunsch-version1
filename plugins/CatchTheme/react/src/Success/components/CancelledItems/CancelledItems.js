import React from 'react';
import {useTranslation} from 'react-i18next';

import './CancelledItems.scss';

const CancelledItems = ({items}) => {
    const {t} = useTranslation('success');
    const itemsJSX = items.map((item) => (
        <div key={item.id} className="item">
            <div className="img-wrapper">
                <img alt="item" src={item.image}/>
            </div>
            <p className="item-name">{item.title}</p>
        </div>
    ));
    return (
        <div className="cancelled-items">
            <div className="top-border">
                <span>{t('cancelledItems.headline')}</span>
                <div className="red-bubble"/>
            </div>
            <div className="content">
                <p className="info">{t('cancelledItems.info')}</p>
                {itemsJSX}
                <a href={window.cartUrl}>{t('cancelledItems.back')}</a>
            </div>
        </div>
    );
};

export default CancelledItems;
