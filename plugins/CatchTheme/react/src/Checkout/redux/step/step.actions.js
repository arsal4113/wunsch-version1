import {SET_MAX_STEP, SET_STEP} from '../actionTypes';

export const setStep = (step) => ({
    type: SET_STEP,
    payload: step
});

export const setMaxStep = (step) => ({
    type: SET_MAX_STEP,
    payload: step
});
