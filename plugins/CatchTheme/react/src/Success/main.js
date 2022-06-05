import React, {Suspense} from 'react';
import { render } from 'react-dom';
import './i18n';
import Success from './container/Success/Success';

render(
    <Suspense fallback={<div></div>}>
        <Success/>
    </Suspense>,
    document.getElementById('success')
);
