import {WINDOW_RESIZE} from '../actionTypes';

const initialState = {
    mobileDevice: window.innerWidth < 768 || window.innerHeight < 480,
    tabletDevice: window.innerWidth > 767 && window.innerWidth < 1024,
    largeDevice: window.innerWidth > 1440
};

const deviceReducer = (state = initialState, action) => {
    switch (action.type) {
        case WINDOW_RESIZE:
            return {
                ...state,
                mobileDevice: action.windowWidth < 768 || action.windowHeight < 480,
                tabletDevice: action.windowWidth > 767 && action.windowWidth < 1024,
                largeDevice: window.innerWidth > 1440
            };
        default:
            return state;
    }
};

export default deviceReducer;
