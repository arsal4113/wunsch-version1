import React from 'react';
import {useSelector} from 'react-redux';
import SliderControls from './SliderControls/SliderControls';
import Card from './Card/Card';

import './ItemsSlider.scss';

const ItemsSlider = (props) => {
    const {
        itemsList,
        showItemPrice,
        headlineText,
        darkMode,
        prev,
        next,
        sliderName
    } = props;
    const isMobile = useSelector((state) => state.device.mobileDevice);
    const isTablet= useSelector((state) => state.device.tabletDevice);
    let sliderItems = (itemsList) ? itemsList.map((item, index) => {
        return (
            <Card key={index} item={item} showItemPrice={showItemPrice}/>
        );
    }) : null;

    const sliderControls = (isMobile || isTablet) ? null : (<SliderControls darkMode={darkMode} prev={prev} next={next}/>);

    return (
        <div className="items-slider-wrapper">
            <div className="slider-headline">{headlineText}</div>
            <div id={sliderName} className="items-slider">
                {sliderControls}
                <div className="items-wrapper">
                    {sliderItems}
                </div>
            </div>
        </div>
    );
};

export default ItemsSlider;
