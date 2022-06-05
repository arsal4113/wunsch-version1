import {
    INIT_PAYMENT_METHODS, SAVE_PAYMENT_METHODS_FAILURE, SAVE_PAYMENT_METHODS_SUCCESS
} from '../actionTypes';

export const initPaymentMethods = (paymentMethods) => ({
    type: INIT_PAYMENT_METHODS,
    paymentMethods: paymentMethods
});

export const savePaymentMethodSuccess = (methodCode) => ({
    type: SAVE_PAYMENT_METHODS_SUCCESS,
    payload: methodCode
});

export const savePaymentMethodFailure = (error) => ({
    type: SAVE_PAYMENT_METHODS_FAILURE,
    payload: error
});
