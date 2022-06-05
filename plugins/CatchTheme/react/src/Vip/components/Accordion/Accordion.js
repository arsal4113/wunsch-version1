import React, {useState} from 'react';
import {useTranslation} from 'react-i18next';
import Attributes from '../Tabs/Content/Attributes/Attributes';
import Shipping from '../Tabs/Content/Shipping/Shipping';
import Seller from '../Tabs/Content/Seller/Seller';
import Returns from '../Tabs/Content/Returns/Returns';
import Description from '../Tabs/Content/Description/Description';
import Ebay from '../Tabs/Content/Ebay/Ebay';
import AccordionButton from './AccordionButton/AccordionButton';

import './Accordion.scss';

const Accordion = (props) => {
    const {item} = props;
    const {t} = useTranslation('vip');

    return (
        <div className="accordion">
            <AccordionButton
                className="accordion-button"
                text={<span>{t('Attributes')}</span>}
                content={<Attributes item={item.items[0]}/>}
            />

            <AccordionButton
                className="accordion-button"
                text={<span>{t('Description')}</span>}
                content={<Description item={item}/>}
            />

            <AccordionButton
                className="accordion-button"
                text={<span>{t('Returns')}</span>}
                content={<Returns item={item.items[0]}/>}
            />
            <AccordionButton
                className="accordion-button"
                text={<span>{t('Seller')}</span>}
                content={<Seller item={item.items[0]}/>}
            />
            <AccordionButton
                className="accordion-button"
                text={<span>{t('Shipping and Payment')}</span>}
                content={<Shipping item={item.items[0]}/>}
            />
            <AccordionButton
                className="accordion-button"
                text={<span>{t('eBay Guarantee')}</span>}
                content={<Ebay/>}
            />
        </div>
    );
};

export default Accordion;
