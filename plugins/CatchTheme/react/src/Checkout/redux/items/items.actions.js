import {
    UPDATE_ITEMS,
    SAVE_SHIPPING_METHOD_START,
    SAVE_SHIPPING_METHOD_SUCCESS,
    SAVE_SHIPPING_METHOD_FAILURE
} from '../actionTypes';
import {refreshTotals} from '../totals/totals.actions';

export const updateItems = (items) => ({
    type: UPDATE_ITEMS,
    payload: items
});

const saveShippingMethodStart = () => ({
    type: SAVE_SHIPPING_METHOD_START
});

const saveShippingMethodSuccess = (items) => ({
    type: SAVE_SHIPPING_METHOD_SUCCESS,
    payload: items
});

const saveShippingMethodFailure = (error) => ({
    type: SAVE_SHIPPING_METHOD_FAILURE,
    payload: error
});

export const saveShippingMethodAsync = (itemId, shippingMethodCode) => (dispatch) => {
    dispatch(saveShippingMethodStart());
    fetch(
        window.shippingMethodURL,
        {
            method: 'POST',
            body: JSON.stringify({itemId: itemId, shippingId: shippingMethodCode}),
            headers: {
                'Content-Type': 'application/json'
            }
        }
    )
        .then((res) => res.text())
        .then((res) => {
            const response = JSON.parse(res);
            if (response.error) {
                throw response;
            }
            dispatch(saveShippingMethodSuccess(response.ebay_checkout_session_items));
            dispatch(refreshTotals(response.ebay_checkout_session_totals));
        })
        .catch((error) => {
            console.error('Error:', error);
            dispatch(saveShippingMethodFailure(error));
        });
};
