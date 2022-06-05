import { combineReducers } from 'redux';

import deviceReducer from './device/device.reducer';
import itemsReducer from './items/items.reducer';

export default combineReducers({
    device: deviceReducer,
    items: itemsReducer
});
