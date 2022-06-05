import {
    SAVE_COUPON_START, SAVE_COUPON_SUCCESS, SAVE_COUPON_FAILURE, SET_COUPON
} from '../actionTypes';
import {setMaxStep} from '../step/step.actions';
import {SHIPPING_ADDRESS_ENTERED} from '../../components/Step/stepTypes';

export const setCoupon = (coupon) => ({
    type: SET_COUPON,
    payload: coupon
});

export const saveCouponStart = () => ({
    type: SAVE_COUPON_START
});

export const saveCouponSuccess = (code) => ({
    type: SAVE_COUPON_SUCCESS,
    payload: code
});

export const saveCouponFailure = (error) => ({
    type: SAVE_COUPON_FAILURE,
    payload: error
});

export const saveCouponAsync = (code) => (dispatch) => {
    dispatch(saveCouponStart());
    fetch(
        window.saveCouponUrl,
        {
            method: 'POST',
            body: JSON.stringify(code),
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
            dispatch(saveCouponSuccess(response.appliedCoupons[0].redemptionCode));
            dispatch(setMaxStep(SHIPPING_ADDRESS_ENTERED));
        }).catch((error) => {
            dispatch(saveCouponFailure(error.message));
            console.error('Error:', error);
        });
};
