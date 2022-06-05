import React from 'react';
import {useTranslation} from 'react-i18next';
import TabButton from './TabButton/TabButton';

import './TabButtons.scss';

const TabButtons = (props) => {
    const {
        selected,
        tabSelector,
    } = props;
    const {t} = useTranslation('vip');

    return (
        <div className="tab-button-wrapper">
            <TabButton
                className={['tab-button', selected === 'attributes' ? ' selected' : ''].join('')}
                text={<span>{t('Attributes')}</span>}
                onClick={() => tabSelector('attributes')}
            />
            <TabButton
                className={['tab-button', selected === 'description' ? ' selected' : ''].join('')}
                text={<span>{t('Description')}</span>}
                onClick={() => tabSelector('description')}
            />
            <TabButton
                className={['tab-button', selected === 'returns' ? ' selected' : ''].join('')}
                text={<span>{t('Returns')}</span>}
                onClick={() => tabSelector('returns')}
            />
            <TabButton
                className={['tab-button', selected === 'seller' ? ' selected' : ''].join('')}
                text={<span>{t('Seller')}</span>}
                onClick={() => tabSelector('seller')}
            />
            <TabButton
                className={['tab-button', selected === 'shipping' ? ' selected' : ''].join('')}
                text={<span>{t('Shipping and Payment')}</span>}
                onClick={() => tabSelector('shipping')}
            />
            <TabButton
                className={['tab-button', selected === 'ebay' ? ' selected' : ''].join('')}
                text={<span>{t('eBay Guarantee')}</span>}
                onClick={() => tabSelector('ebay')}
            />
        </div>
    );
};

export default TabButtons;
