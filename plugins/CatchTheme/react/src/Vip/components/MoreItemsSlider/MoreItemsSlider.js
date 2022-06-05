import React, {useState} from 'react';
import {useSelector} from 'react-redux';
import {useTranslation} from 'react-i18next';
import ItemsSlider from '../ItemsSlider/ItemsSlider';

import './MoreItemsSlider.scss';
import MobileSlider from './MobileSlider/MobileSlider';
import swipeLikeHot from '../../assets/swipe-like-hot.svg';

const MoreItemsSlider = (props) => {
    const {
        itemsList,
        headlineText,
        darkMode,
        showItemPrice,
    } = props;
    console.log("Itemslist", itemsList);
    const {t} = useTranslation('vip');
    const isMobile = useSelector((state) => state.device.mobileDevice);
    const isTablet = useSelector((state) => state.device.tabletDevice);

    const [itemSlider, setItemSlider] = useState({
        itemSet: 1
    });

    const slideHandler = (direction) => {

        if (direction === 'prev') {
            if (itemSlider.itemSet > 1) {
                setItemSlider({
                    itemSet: itemSlider.itemSet - 1
                });
            } else {
                setItemSlider({
                    itemSet: 1
                });
            }
            console.log('click similar items slider prev control');
        } else {
            if (itemsList.length > itemSlider.itemSet * 4) {
                setItemSlider({
                    itemSet: itemSlider.itemSet + 1
                });
            } else {
                setItemSlider({
                    itemSet: 1
                });
            }
        }
    };

    const itemsToShow = [];
    if (itemsList) {
        itemsList.map((item, index) => {
            if ((index >= ((itemSlider.itemSet - 1) * 4))
                && (index < (itemSlider.itemSet * 4))) {
                return (
                    itemsToShow.push(item)
                );
            }
        });
    }

    console.log('more item', itemSlider.itemSet);
    console.log(itemsToShow);

    const content = (isMobile || isTablet) ? (
        <MobileSlider
            showItemPrice={showItemPrice}
            itemsList={itemsList}
            headlineText={headlineText}
        />
    ) : (
        <ItemsSlider
            sliderName="more-items"
            darkMode={darkMode}
            prev={() => slideHandler('prev')}
            next={() => slideHandler('next')}
            showItemPrice={showItemPrice}
            itemsList={itemsToShow}
            headlineText={headlineText}
        />
    );
    const headline = (isMobile || isTablet) ? (
        <div className="slider-headline">{headlineText}</div>
    ) : null;
    const swipe = (isMobile || isTablet) ? (
        <div className="swipe-like-its-hot">
            <span>{t('Swipe it like it\'s hot')}</span>
            <img src={swipeLikeHot}/>
        </div>
    ) : null;

    return (
        <div className="more-items-wrapper">
            {headline}
            {content}
            {swipe}
        </div>
    );
};

export default MoreItemsSlider;
