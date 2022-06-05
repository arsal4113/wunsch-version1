import {
    SAVE_SHIPPING_METHOD_FAILURE,
    SAVE_SHIPPING_METHOD_START,
    SAVE_SHIPPING_METHOD_SUCCESS
} from '../actionTypes';

const initialState = {
    items: window.checkoutItems,
    isFetching: false,
    error: undefined
};

const itemsReducer = (state = initialState, action) => {
    switch (action.type) {
        case SAVE_SHIPPING_METHOD_START:
            return {
                ...state,
                isFetching: true
            };
        case SAVE_SHIPPING_METHOD_SUCCESS:
            return {
                ...state,
                items: action.payload,
                isFetching: false
            };
        case SAVE_SHIPPING_METHOD_FAILURE:
            return {
                ...state,
                isFetching: false,
                error: action.payload
            };
        default:
            return state;
    }
};

export default itemsReducer;
