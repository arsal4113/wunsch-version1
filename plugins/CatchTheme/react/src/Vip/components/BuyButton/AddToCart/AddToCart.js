import React from 'react';
import { useTranslation } from 'react-i18next';
import {useDispatch, useSelector} from 'react-redux';
import {addItemToCartAsync, addItemToCartFailure} from '../../../redux/items/items.actions';

import './AddToCart.scss';

const AddToCart = () => {
    const {t} = useTranslation('vip');
    const {
        ebayGlobalId, countryCode, widgetType, wrapperLayout
    } = window;
    const dispatch = useDispatch();
    const {
        ebayItem, selectedItemIndex, itemQuantity, isFetching, selectedItemAttributes
    } = useSelector((state) => state.items);
    const {mobileDevice} = useSelector((state) => state.device);
    const addToCartHandler = () => {
        if (selectedItemIndex !== undefined) {
            const {
                id, price, quantity, marketing_price
            } = ebayItem.items[selectedItemIndex];
            const itemData = {
                qty: itemQuantity,
                attributes: selectedItemAttributes,
                itemId: id,
                ebayGlobalId,
                countryCode,
                widgetType,
                wrapperLayout,
                variantPrice: price.amount,
                originalPriceValue: marketing_price.original_price.value || ''
            };
            if (quantity > 3) {
                itemData.tags = {'almost-sold-out': 'Fast ausverkauft'};
            }
            dispatch(addItemToCartAsync(itemData, mobileDevice));
        } else {
            dispatch(addItemToCartFailure(true));
        }
    };
    return (
        <button
            disabled={isFetching}
            className="button"
            id="add-to-cart"
            onClick={addToCartHandler}
            data-id={ebayItem.items[selectedItemIndex] ? ebayItem.items[selectedItemIndex].id : null}
            data-price={ebayItem.items[selectedItemIndex]
                ? ebayItem.items[selectedItemIndex].price.amount : null}
        >
            {t('In den Warenkorb')}
        </button>
    );
};

export default AddToCart;
