import React, {Suspense} from 'react';
import {render} from 'react-dom';
import {Provider} from 'react-redux';
import store from '../../redux/store';
import Checkout from '../../components/Checkout/Checkout';
import '../../../i18n';

render(
    <Provider store={store}>
        <Suspense fallback={<div></div>}>
            <Checkout/>
        </Suspense>
    </Provider>,
    document.getElementById('checkout')
);
