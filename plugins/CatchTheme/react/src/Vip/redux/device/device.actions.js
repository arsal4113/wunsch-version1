import {WINDOW_RESIZE} from '../actionTypes';

export const windowResize = (width, height) => ({
    type: WINDOW_RESIZE,
    windowWidth: width,
    windowHeight: height
});
