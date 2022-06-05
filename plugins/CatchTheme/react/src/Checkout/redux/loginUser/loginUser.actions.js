import {
    LOGIN_USER_START,
    LOGIN_USER_FAILURE,
    LOGIN_USER_SUCCESS
} from '../actionTypes';
import {updateShippingAddress} from '../shippingAddress/shippingAddress.actions';

const loginUserStart = () => ({
    type: LOGIN_USER_START
});

const loginUserSuccess = (response) => ({
    type: LOGIN_USER_SUCCESS,
    payload: response
});

const loginUserFailure = (error) => ({
    type: LOGIN_USER_FAILURE,
    payload: error
});

export const loginUserAsync = (loginData) => (dispatch) => {
    dispatch(loginUserStart());
    fetch(
        window.loginAction,
        {
            method: 'POST',
            body: loginData
        }
    )
        .then((res) => res.text())
        .then((res) => {
            const response = JSON.parse(res);
            if (!response.success) {
                throw response;
            }
            if (response.shippingAddressProvided) {
                location.reload();
            } else {
                dispatch(updateShippingAddress(response.shippingAddress))
                dispatch(loginUserSuccess(response.userName));
            }
        })
        .catch((error) => {
            console.error('Error:', error);
            dispatch(loginUserFailure(error));
        });
};
