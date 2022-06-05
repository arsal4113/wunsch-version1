import {
    ADD_ITEM_TO_CART_FAILURE,
    ADD_ITEM_TO_CART_START,
    ADD_ITEM_TO_CART_SUCCESS, HIDE_MOBILE_POPUP, SHOW_MOBILE_POPUP,
    UPDATE_ITEM_QUANTITY,
    UPDATE_SELECTED_ITEM
} from '../actionTypes';

export const updateSelectedItem = (itemIndex, selectedItemAttributes) => ({
    type: UPDATE_SELECTED_ITEM,
    index: itemIndex,
    attributes: selectedItemAttributes
});

export const updateItemQuantity = (quantity) => ({
    type: UPDATE_ITEM_QUANTITY,
    payload: quantity
});

const addItemToCartStart = (isMobile) => {
    if (!isMobile) {
        $('.mini-cart-wrapper').mini_cart('show');
        $('.mini-cart-wrapper').mini_cart('toggleLoader', true);
        $('.mini-cart-loader').css('height', $('#mini-cart-container').height() + 20);
    }
    return {
        type: ADD_ITEM_TO_CART_START
    };
};

const addItemToCartSuccess = (isMobile) => {
    $('.mini-cart-wrapper').trigger('success').mini_cart('refresh', true);
    $('#add-to-cart').trigger('success');
    if (!isMobile) {
        setTimeout(() => {
            if (!$('.mini-cart-wrapper').is(':hover')) {
                $('.mini-cart-wrapper').mini_cart('hide');
            }
        }, 3000);
    }
    return {
        type: ADD_ITEM_TO_CART_SUCCESS
    };
};

export const addItemToCartFailure = (error) => {
    if (error !== true) {
        $('.mini-cart-wrapper').mini_cart('refresh', true);
        setTimeout(() => {
            if (!$('.mini-cart-wrapper').is(':hover')) {
                $('.mini-cart-wrapper').mini_cart('hide');
            }
        }, 3000);
    }
    return {
        type: ADD_ITEM_TO_CART_FAILURE,
        payload: error
    };
};

export const showMobilePopup = () => ({
    type: SHOW_MOBILE_POPUP
});

export const hideMobilePopup = () => ({
    type: HIDE_MOBILE_POPUP
});

export const addItemToCartAsync = (itemData, isMobile) => (dispatch) => {
    dispatch(addItemToCartStart(isMobile));
    if (isMobile) dispatch(showMobilePopup());
    fetch(
        window.formAction,
        {
            method: 'POST',
            body: JSON.stringify(itemData),
            headers: {
                'Content-Type': 'application/json'
            }
        }
    )
        .then((res) => res.json())
        .then((response) => {
            if (response.error) {
                throw response;
            }
            dispatch(addItemToCartSuccess(isMobile));
        })
        .catch((error) => {
            console.error('Error:', error);
            dispatch(addItemToCartFailure(error.message));
            if (isMobile) dispatch(hideMobilePopup());
        });
};
