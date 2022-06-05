import {
    INIT_PAYMENT_METHODS, SAVE_PAYMENT_METHODS_FAILURE, SAVE_PAYMENT_METHODS_SUCCESS
} from '../actionTypes';

let initialPaymentMethods = [];
let selectedCode = null;

if (window.checkoutPayments && window.checkoutPayments.length) {
    initialPaymentMethods = window.checkoutPayments;
    if (window.selectedCheckoutPayment) {
        selectedCode = window.selectedCheckoutPayment.code || undefined;
    }
}

const initialState = {
    paymentMethods: initialPaymentMethods,
    selectedCode: selectedCode,
    error: undefined
};

const paymentMethodsReducer = (state = initialState, action) => {
    switch (action.type) {
        case INIT_PAYMENT_METHODS:
            return {
                ...state,
                paymentMethods: action.paymentMethods,
                selectedCode: null
            };
        case SAVE_PAYMENT_METHODS_SUCCESS:
            return {
                ...state,
                error: undefined,
                selectedCode: action.payload
            };
        case SAVE_PAYMENT_METHODS_FAILURE:
            return {
                ...state,
                error: action.payload
            };
        default:
            return state;
    }
};

export default paymentMethodsReducer;
