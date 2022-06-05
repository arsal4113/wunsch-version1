import React, {useState} from 'react';
import {useSwipeable} from 'react-swipeable';
import Card from '../../ItemsSlider/Card/Card';

import './MobileSlider.scss';

const MobileSlider = (props) => {
    const {
        sliderName,
        itemsList,
        headlineText,
        showItemPrice
    } = props;
    const [itemsListIndex, setItemsListIndex] = useState({
        selected: 0
    });

    const firstItem = itemsListIndex.selected;

    const itemsToShow = [];
    if (itemsList) {
        itemsList.map((item, index) => {
            if (index >= firstItem) {
                return (
                    itemsToShow.push(item)
                );
            }
        });
    }

    let sliderItems = (itemsToShow.length > 0) ? itemsToShow.map((item, index) => {
        return (
            <a href={['/itm/', item.item_id].join('')} className="card-wrapper" key={index}>
                <Card item={item} showItemPrice={showItemPrice}/>
            </a>
        );
    }) : null;

    const handlers = useSwipeable({
        onSwipedLeft: () => swipeLeftHandler(),
        onSwipedRight: () => swipeRightHandler(),
        trackMouse: true
    });
    const swipeLeftHandler = () => {
        if (firstItem < itemsList.length - 1) {
            setItemsListIndex({
                selected: firstItem + 1
            });
        } else {
            if (firstItem === itemsList.length - 1) {
                setItemsListIndex({
                    selected: 0
                });
            }
        }
    };
    const swipeRightHandler = () => {
        console.log('swiping');
        if (firstItem < itemsList.length - 1 && firstItem > 0) {
            setItemsListIndex({
                selected: firstItem - 1
            });
        } else {
            if (firstItem === itemsList.length - 1) {
                setItemsListIndex({
                    selected: 0
                });
            }
        }
    };
    console.log('list length', itemsList.length);

    return (
        <div className="items-slider-wrapper">
            <div className="slider-headline">{headlineText}</div>
            <div id={sliderName} className="mobile-items-slider">
                <div className="swipe-container">
                    <div className="items-container" {...handlers}>
                        {sliderItems}
                    </div>
                </div>
            </div>
        </div>
    );
};

export default MobileSlider;
