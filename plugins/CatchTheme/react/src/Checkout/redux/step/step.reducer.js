import {SET_MAX_STEP, SET_STEP} from '../actionTypes';
import {ITEMS_ADDED, SHIPPING_ADDRESS_ENTERED} from '../../components/Step/stepTypes';

let step = ITEMS_ADDED;
if (window.shippingAddressProvided) {
    step = SHIPPING_ADDRESS_ENTERED;
}

const INITIAL_STATE = {
    step: step,
    maxStep: step
};

const stepReducer = (state = INITIAL_STATE, action) => {
    switch (action.type) {
        case SET_STEP:
            return {
                ...state,
                step: action.payload
            };
        case SET_MAX_STEP:
            return {
                ...state,
                maxStep: action.payload
            };
        default:
            return state;
    }
};

export default stepReducer;
