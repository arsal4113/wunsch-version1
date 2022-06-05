import React, {useState} from 'react';
import {useSelector} from 'react-redux';
import {useSwipeable} from 'react-swipeable';
import Card from '../../ItemsSlider/Card/Card';

import './MobileSlider.scss';

const MobileSlider = (props) => {
    const {
        itemsList,
        showItemPrice
    } = props;
    const isMobile = useSelector((state) => state.device.mobileDevice);
    const isTablet = useSelector((state) => state.device.tabletDevice);
    const [itemsListIndex, setItemsListIndex] = useState({
        selected: 0
    });

    const largeItem = itemsListIndex.selected;
    let secondItem;
    let thirdItem;
    let fourthItem;
    if (itemsList.length > 1) {
        secondItem = (largeItem === itemsList.length - 1) ? 0 : largeItem + 1;
    }
    if (itemsList.length > 2) {
        thirdItem = (largeItem === itemsList.length - 2) ? 0 : (largeItem === itemsList.length - 1) ? 1 : largeItem + 2;
    }
    if (itemsList.length > 3) {
        fourthItem = (
            largeItem === itemsList.length - 3) ? 0
            : (largeItem === itemsList.length - 2) ? 1
                : (largeItem === itemsList.length - 1) ? 2 : largeItem + 3;
    }
    const handlers = useSwipeable({
        onSwipedLeft: () => swipeLeftHandler(),
        onSwipedRight: () => swipeRightHandler(),
        preventDefaultTouchmoveEvent: true,
        trackMouse: true
    });
    const swipeLeftHandler = () => {
        if (largeItem < itemsList.length - 1) {
            setItemsListIndex({
                selected: largeItem + 1
            });
        } else {
            if (largeItem === itemsList.length - 1) {
                setItemsListIndex({
                    selected: 0
                });
            }
        }
    };
    const swipeRightHandler = () => {
        if (largeItem < itemsList.length - 1 && largeItem > 0) {
            setItemsListIndex({
                selected: largeItem - 1
            });
        } else {
            if (largeItem === itemsList.length - 1) {
                setItemsListIndex({
                    selected: 0
                });
            }
        }
    };
    const smallCards = isMobile ? (
        <div className="small-cards-wrapper">
            { secondItem ?
                <a href={['/itm/', itemsList[secondItem].item_id].join('')} className="card-wrapper first">
                    <div className="card-overlay"/>
                    <Card item={itemsList[secondItem]} showItemPrice={showItemPrice}/>
                </a> : null
            }
            { thirdItem ?
                <a href={['/itm/', itemsList[thirdItem].item_id].join('')} className="card-wrapper second">
                    <div className="card-overlay"/>
                    <Card item={itemsList[thirdItem]} showItemPrice={showItemPrice}/>
                </a> : null
            }
        </div>
    ) : isTablet ? (
        <div className="small-cards-wrapper">
            { secondItem ?
                <a href={['/itm/', itemsList[secondItem].item_id].join('')} className="card-wrapper first">
                    <div className="card-overlay"/>
                    <Card item={itemsList[secondItem]} showItemPrice={showItemPrice}/>
                </a> : null
            }
            { thirdItem ?
                <a href={['/itm/', itemsList[thirdItem].item_id].join('')} className="card-wrapper second">
                    <div className="card-overlay"/>
                    <Card item={itemsList[thirdItem]} showItemPrice={showItemPrice}/>
                </a> : null
            }
            { fourthItem ?
                <a href={['/itm/', itemsList[fourthItem].item_id].join('')} className="card-wrapper third">
                    <div className="card-overlay"/>
                    <Card item={itemsList[fourthItem]} showItemPrice={showItemPrice}/>
                </a> : null
            }
        </div>
    ) : null;

    return (
        <div className="mobile-items-slider">
            <div className="swipe-container" {...handlers}>
                <div className="items-container">
                    <a href={['/itm/', itemsList[largeItem].item_id].join('')} className="card-wrapper">
                        <Card item={itemsList[largeItem]} showItemPrice={showItemPrice}/>
                    </a>
                    {smallCards}
                </div>
            </div>
        </div>
    );
};

export default MobileSlider;
