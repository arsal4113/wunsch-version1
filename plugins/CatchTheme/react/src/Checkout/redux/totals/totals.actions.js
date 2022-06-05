import { REFRESH_TOTALS } from '../actionTypes';

export const refreshTotals = (totals) => ({
    type: REFRESH_TOTALS,
    payload: totals
});
