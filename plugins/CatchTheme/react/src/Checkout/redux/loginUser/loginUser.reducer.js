import {
    LOGIN_USER_START,
    LOGIN_USER_SUCCESS,
    LOGIN_USER_FAILURE
} from '../actionTypes';

const initialState = {
    isFetching: false,
    checkoutLoggedIn: 0, //|| window.userLogedIn
    userName: '',
    error: undefined
};

const loginUserReducer = (state = initialState, action) => {
    switch (action.type) {
        case LOGIN_USER_START:
            return {
                ...state,
                isFetching: true
            };
        case LOGIN_USER_SUCCESS:
            return {
                ...state,
                checkoutLoggedIn: true,
                isFetching: false,
                userName: action.payload,
                error: undefined
            };
        case LOGIN_USER_FAILURE:
            return {
                ...state,
                error: action.payload,
                isFetching: false
            };
        default:
            return state;
    }
};

export default loginUserReducer;