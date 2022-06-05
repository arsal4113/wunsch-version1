import React, {Suspense} from 'react';
import {render} from 'react-dom';
import {Provider} from 'react-redux';
import store from '../../redux/store';
import '../../../i18n';
import Vip from '../../components/Vip/Vip';

render(
    <Provider store={store}>
        <Suspense fallback={<div></div>}>
            <Vip
                item={window.ebayItem}
                shortDescription={window.shortDescription}
                shippingDate={window.shippingDate}
                canonicalLink={window.canonicalLink}
                formAction={window.formAction}
                breadcrumbs={window.breadcrumb}
                nextItem={"/itm/v1%7C231974954136%7C0/Schwimmbecken-Fast-Set-Pool-366-x-76-cm-Quick-UP-Swimming-Pool-Planschbecken?category=4"}
                prevItem={"/itm/112641120959/Damen-Gartenhandschuhe-Arbeitshandschuhe-Schutzhandschuhe-Noppen-Grun-Grossenwahl?category=4"}
                similarItems={window.similarItems}
                topSoldItems={window.topSoldItems}
            />
        </Suspense>
    </Provider>,
    document.getElementById('vip')
);
