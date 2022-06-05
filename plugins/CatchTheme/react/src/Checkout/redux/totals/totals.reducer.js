import { REFRESH_TOTALS } from '../actionTypes';

let totals = [];
if (window.checkoutTotals) {
    totals = window.checkoutTotals;
}

const initialState = {
    totals
};

const totalsReducer = (state = initialState, action) => {
    switch (action.type) {
        case REFRESH_TOTALS:
            return {
                ...state,
                totals: action.payload
            };
        default:
            return state;
    }
};

export default totalsReducer;
