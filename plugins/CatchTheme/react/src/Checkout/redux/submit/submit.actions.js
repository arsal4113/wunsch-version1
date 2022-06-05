import {
    SUBMIT_START, SUBMIT_SUCCESS, SUBMIT_FAILURE, SET_MARKETING_CONSENT
} from '../actionTypes';

export const setMarketingConsent = (consent) => ({
    type: SET_MARKETING_CONSENT,
    payload: consent
});

export const submitStart = () => ({
    type: SUBMIT_START
});

export const submitSuccess = (response) => ({
    type: SUBMIT_SUCCESS,
    payload: response
});

export const submitFailure = (error) => ({
    type: SUBMIT_FAILURE,
    payload: error
});

export const submitAsync = (marketingConsent) => (dispatch) => {
    dispatch(submitStart());
    fetch(
        window.submitUrl,
        {
            method: 'POST',
            body: JSON.stringify(marketingConsent),
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
            window.location.replace(response.successUrl);
        }).catch((error) => {
            dispatch(submitFailure(error));
            console.error('Error:', error);
        });
};
