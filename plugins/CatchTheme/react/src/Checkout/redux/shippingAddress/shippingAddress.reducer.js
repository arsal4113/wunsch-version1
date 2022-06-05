import {
    SAVE_SHIPPING_ADDRESS_START,
    SAVE_SHIPPING_ADDRESS_SUCCESS,
    SAVE_SHIPPING_ADDRESS_FAILURE,
    UPDATE_SHIPPING_ADDRESS,
    GET_DATA_FROM_ZIPCODE_START, GET_DATA_FROM_ZIPCODE_SUCCESS, GET_DATA_FROM_ZIPCODE_FAILURE
} from '../actionTypes';
import { buildInitialStateFromAddress } from '../utility';

const initialState = {
    isFetching: false,
    shippingAddress: buildInitialStateFromAddress(window.checkoutShippingAddress, window.additionalUserData),
    error: undefined,
    fetchingZipCodeData: false,
    shippingAddressCompleted: false
};

const shippingAddressReducer = (state = initialState, action) => {
    switch (action.type) {
        case SAVE_SHIPPING_ADDRESS_START:
            return {
                ...state,
                isFetching: true
            };
        case SAVE_SHIPPING_ADDRESS_SUCCESS:
            return {
                ...state,
                shippingAddress: action.payload,
                isFetching: false,
                error: undefined,
                shippingAddressCompleted: true
            };
        case SAVE_SHIPPING_ADDRESS_FAILURE:
            return {
                ...state,
                error: action.payload,
                isFetching: false
            };
        case UPDATE_SHIPPING_ADDRESS:
            return {
                ...state,
                shippingAddress: {
                    ...state.shippingAddress,
                    ...action.payload
                }
            };
        case GET_DATA_FROM_ZIPCODE_START:
            return {
                ...state,
                fetchingZipCodeData: true
            };
        case GET_DATA_FROM_ZIPCODE_SUCCESS:
            const shippingAddress = {...state.shippingAddress};
            if (action.payload.area) {
                shippingAddress.state_or_province = action.payload.area;
            }
            if (action.payload.city) {
                shippingAddress.city = action.payload.city
            }
            return {
                ...state,
                fetchingZipCodeData: false,
                shippingAddress: shippingAddress
            };
        case GET_DATA_FROM_ZIPCODE_FAILURE:
            return {
                ...state,
                fetchingZipCodeData: false
            };
        default:
            return state;
    }
};

export default shippingAddressReducer;
