import {
    SUBMIT_START, SUBMIT_SUCCESS, SUBMIT_FAILURE, SET_MARKETING_CONSENT
} from '../actionTypes';

const initialState = {
    orderNumber: undefined,
    isFetching: false,
    error: undefined,
    marketingConsent: false
};

const submitReducer = (state = initialState, action) => {
    switch (action.type) {
        case SET_MARKETING_CONSENT:
            return {
                ...state,
                marketingConsent: action.payload
            };
        case SUBMIT_START:
            return {
                ...state,
                isFetching: true
            };
        case SUBMIT_SUCCESS:
            return {
                ...state,
                orderNumber: action.payload,
                isFetching: false,
                error: undefined
            };
        case SUBMIT_FAILURE:
            return {
                ...state,
                orderNumber: undefined,
                isFetching: false,
                error: action.payload
            };
        default:
            return state;
    }
};

export default submitReducer;
