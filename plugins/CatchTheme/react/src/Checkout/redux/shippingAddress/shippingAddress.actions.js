import {
    SAVE_SHIPPING_ADDRESS_SUCCESS,
    SAVE_SHIPPING_ADDRESS_FAILURE,
    SAVE_SHIPPING_ADDRESS_START,
    GET_DATA_FROM_ZIPCODE_START,
    GET_DATA_FROM_ZIPCODE_SUCCESS,
    UPDATE_SHIPPING_ADDRESS,
    GET_DATA_FROM_ZIPCODE_FAILURE
} from '../actionTypes';
import {setStep, setMaxStep} from '../step/step.actions';
import * as stepTypes from '../../components/Step/stepTypes';
import {initPaymentMethods} from '../paymentMethods/paymentMethods.actions';

const saveShippingAddressStart = () => ({
    type: SAVE_SHIPPING_ADDRESS_START
});

const saveShippingAddressSuccess = (shippingAddress) => ({
    type: SAVE_SHIPPING_ADDRESS_SUCCESS,
    payload: shippingAddress
});

const saveShippingAddressFailure = (error) => ({
    type: SAVE_SHIPPING_ADDRESS_FAILURE,
    payload: error
});

export const saveShippingAddressAsync = (shippingAddress) => (dispatch) => {
    dispatch(saveShippingAddressStart());
    fetch(
        window.shippingAddressURL,
        {
            method: 'POST',
            body: JSON.stringify(shippingAddress), // data can be `string` or {object}!
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
            dispatch(initPaymentMethods(response.paymentMethods));
            dispatch(saveShippingAddressSuccess(response.shippingAddress));
            dispatch(setStep(stepTypes.SHIPPING_ADDRESS_ENTERED));
            dispatch(setMaxStep(stepTypes.SHIPPING_ADDRESS_ENTERED));
        })
        .catch((error) => {
            console.error('Error:', error);
            dispatch(saveShippingAddressFailure(error.message));
        });
};

export const updateShippingAddress = (shippingAddress) => ({
    type: UPDATE_SHIPPING_ADDRESS,
    payload: shippingAddress
});

const getAdditionalInfoFromZipCodeStart = () => ({
    type: GET_DATA_FROM_ZIPCODE_START
});

const getAdditionalInfoFromZipCodeSuccess = (stateOrProvince) => ({
    type: GET_DATA_FROM_ZIPCODE_SUCCESS,
    payload: stateOrProvince
});

const getAdditionalInfoFromZipCodeFailure = () => ({
    type: GET_DATA_FROM_ZIPCODE_FAILURE
});

export const getAdditionalInfoFromZipCodeAsync = (zipCode) => (dispatch) => {
    dispatch(getAdditionalInfoFromZipCodeStart());
    fetch(
        `${window.zipUrl}/${zipCode}`,
        {
            method: 'GET'
        }
    )
        .then((res) => res.text())
        .then((res) => {
            const response = JSON.parse(res);
            if (response.error || !response.ZipData) {
                throw response;
            }
            dispatch(getAdditionalInfoFromZipCodeSuccess(response.ZipData));
        })
        .catch((error) => {
            console.error('Error:', error);
            dispatch(getAdditionalInfoFromZipCodeFailure());
        });
};
