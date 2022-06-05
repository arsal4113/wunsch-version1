import {
    SAVE_COUPON_START, SAVE_COUPON_SUCCESS, SAVE_COUPON_FAILURE, SET_COUPON
} from '../actionTypes';

const initialState = {
    success: false,
    coupon: '',
    isFetching: false,
    error: undefined
};

const couponReducer = (state = initialState, action) => {
    switch (action.type) {
        case SET_COUPON:
            return {
                ...state,
                coupon: action.payload
            };
        case SAVE_COUPON_START:
            return {
                ...state,
                isFetching: true
            };
        case SAVE_COUPON_SUCCESS:
            return {
                ...state,
                coupon: action.payload,
                isFetching: false,
                error: undefined,
                success: true
            };
        case SAVE_COUPON_FAILURE:
            return {
                ...state,
                isFetching: false,
                error: action.payload,
                success: false
            };
        default:
            return state;
    }
};

export default couponReducer;
