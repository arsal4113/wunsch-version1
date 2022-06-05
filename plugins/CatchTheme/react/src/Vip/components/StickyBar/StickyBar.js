import React from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {useInView} from 'react-intersection-observer';
import Selector from '../Selector/Selector';
import QuantitySelector from '../QuantitySelector/QuantitySelector';
import {addItemToCartFailure} from '../../redux/items/items.actions';

import './StickyBar.scss';

const StickyBar = ({
    item, itemPrice, selectedItemIndex, confAttributes, changeHandler, buyButton
}) => {
    // eslint-disable-next-line no-unused-vars
    const [ref, inView, entry] = useInView({threshold: 0});
    const {mobileDevice} = useSelector((state) => state.device);
    const {error} = useSelector((state) => state.items);
    const dispatch = useDispatch();

    const currentItem = item.items[selectedItemIndex || 0];
    const originalPrice = currentItem.marketing_price.original_price.display_price !== ''
        ? <span className="original-price">{currentItem.marketing_price.original_price.display_price}</span>
        : null;

    let show = entry && entry.boundingClientRect.y < 0;
    let contentHeight = 0;
    if (mobileDevice) {
        contentHeight += 75;
        show = error && typeof error === 'boolean';
        if (show) {
            contentHeight += confAttributes ? (Object.keys(confAttributes).length + 1) * 46 : 46;
            $('#cookies-layer').css('bottom', contentHeight);
        } else {
            $('#cookies-layer').css('bottom', contentHeight);
        }
    }
    const attributeSelectors = confAttributes
        ? Object.entries(confAttributes).map(([attribute, value]) => (
            <div className="selector-container" key={attribute}>
                <span className="label">{attribute}</span>
                <Selector
                    label={attribute}
                    options={value}
                    onChange={(event) => changeHandler(attribute, event)}
                />
            </div>
        )) : '';

    return (
        <>
            <span ref={ref} id="sticky-bar-anchor"/>
            <div className={`sticky-bar-container${show ? ' show' : ''}`}>
                <div
                    className="content-wrapper"
                    style={{height: contentHeight ? `${contentHeight}px` : 'auto'}}
                >
                    <div className="product-info">
                        <img alt="fist-item" src={item.images[0]}/>
                        <div className="item-pricing">
                            <span className={`price${originalPrice ? ' discounted' : ''}`}>{itemPrice}</span>
                            <div className="mobile-buy-button">
                                {buyButton}
                            </div>
                            {originalPrice}
                        </div>
                    </div>
                    <div className={`user-input${!show ? ' hide' : ''}${confAttributes ? '' : ' empty-fix'}`}>
                        <div className="attribute-selection">
                            {attributeSelectors}
                        </div>
                        <div className="wrapper">
                            <QuantitySelector/>
                            {buyButton}
                        </div>
                    </div>
                    <div
                        className="mobile-top-element"
                        onClick={() => dispatch(addItemToCartFailure(!error))}
                    >
                        <div className="indicator"/>
                    </div>
                </div>
            </div>
        </>
    );
};

export default StickyBar;
