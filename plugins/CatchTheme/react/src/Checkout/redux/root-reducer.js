import { combineReducers } from 'redux';

import deviceReducer from './device/device.reducer';
import stepReducer from './step/step.reducer';
import totalsReducer from './totals/totals.reducer';
import shippingAddressReducer from './shippingAddress/shippingAddress.reducer';
import itemsReducer from './items/items.reducer';
import couponReducer from './coupon/coupon.reducer';
import paymentMethodsReducer from './paymentMethods/paymentMethods.reducers';
import submitReducer from './submit/submit.reducer';
import loginUserReducer from './loginUser/loginUser.reducer';

export default combineReducers({
    device: deviceReducer,
    step: stepReducer,
    totals: totalsReducer,
    shippingAddress: shippingAddressReducer,
    items: itemsReducer,
    coupon: couponReducer,
    paymentMethods: paymentMethodsReducer,
    submit: submitReducer,
    loginUser: loginUserReducer
});
