import React, {useState} from 'react';
import {useSelector} from 'react-redux';
import ItemsSlider from '../ItemsSlider/ItemsSlider';
import MobileSlider from '../SimilarItemsSlider/MobileSlider/MobileSlider';

import './SimilarItemsSlider.scss';

const SimilarItemsSlider = (props) => {
    const {
        itemsList,
        headlineText,
        showItemPrice
    } = props;
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
            if (itemsList.length > itemSlider.itemSet * 5) {
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
            if ((index >= ((itemSlider.itemSet - 1) * 5))
                && (index < (itemSlider.itemSet * 5))) {
                return (
                    itemsToShow.push(item)
                );
            }
        });
    }

    const content = (isMobile || isTablet) ? (
        <MobileSlider
            sliderName="similar-items"
            showItemPrice={showItemPrice}
            itemsList={itemsList}
            headlineText={headlineText}
        />
    ) : (
        <ItemsSlider
            itemsList={itemsToShow}
            sliderName="similar-items"
            prev={() => slideHandler('prev')}
            next={() => slideHandler('next')}
            showItemPrice={showItemPrice}
            headlineText={headlineText}
        />
    );
    const headline = (isMobile || isTablet) ? (
        <h2 className="slider-headline">{headlineText}</h2>
    ) : null;

    return (
        <div className="similar-items-wrapper">
            {content}
        </div>
    );
};
export default SimilarItemsSlider;
