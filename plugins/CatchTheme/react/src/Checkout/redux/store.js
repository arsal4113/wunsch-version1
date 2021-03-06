import { createStore, applyMiddleware } from 'redux';
import logger from 'redux-logger';
import thunk from 'redux-thunk';

import rootReducer from './root-reducer';

let middlewares = [thunk];
if (process.env.NODE_ENV === 'development') {
    middlewares = [...middlewares, logger];
}

const store = createStore(rootReducer, applyMiddleware(...middlewares));

export default store;
