import React, { Component } from 'react';
import { withTranslation } from 'react-i18next';
import { connect } from 'react-redux';
import TagManager from 'react-gtm-module';
import {GTM_DATALAYER} from '../../constants';
import ShippingMethods from '../ShippingMethods/ShippingMethods';
import ShippingAddress from '../ShippingAddress/ShippingAddress';
import PaymentMethods from '../PaymentMethods/PaymentMethods';
import OrderOverview from '../OrderOverview/OrderOverview';
import BuyNow from '../BuyNow/BuyNow';
import Step from '../Step/Step';
import Totals from '../Totals/Totals';
import EbayBuyerProtection from '../UI/EbayBuyerProtection/EbayBuyerProtection';
import UserSection from "../UserSection/UserSection";
import {
    ITEMS_ADDED, SHIPPING_ADDRESS_ENTERED, PAYMENT_METHOD_COMPLETED, COMPLETED
} from '../Step/stepTypes';

import './Checkout.scss';

// eslint-disable-next-line react/prefer-stateless-function
class Checkout extends Component {
    render() {
        const { step } = this.props;
        let checkout;
        let rightSide = (
            <>
                <Totals/>
                <EbayBuyerProtection/>
            </>
        );
        TagManager.initialize(GTM_DATALAYER);
        switch (step) {
            case ITEMS_ADDED:
                checkout = (
                    <>
                        <UserSection/>
                        <div className="big-box">
                            <ShippingMethods/>
                            <ShippingAddress/>
                        </div>
                    </>
                );
                break;
            case SHIPPING_ADDRESS_ENTERED:
                checkout = <PaymentMethods/>;
                GTM_DATALAYER.dataLayer.event = 'checkout1';
                TagManager.dataLayer(GTM_DATALAYER);
                break;
            case PAYMENT_METHOD_COMPLETED:
                checkout = <OrderOverview/>;
                rightSide = <BuyNow/>;
                GTM_DATALAYER.dataLayer.event = 'checkout2';
                TagManager.dataLayer(GTM_DATALAYER);
                break;
            case COMPLETED:
                break;
            default:
                // TODO: maybe needs error design
                break;
        }

        return (
            <div className="checkout-wrapper">
                <Step/>
                <div className={`center-wrapper${step >= PAYMENT_METHOD_COMPLETED ? ' resize' : ''}`}>
                    <div className="checkout-container left">
                        {checkout}
                    </div>
                    <div className="checkout-container right">
                        <div className="right-wrapper">
                            {rightSide}
                        </div>
                    </div>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    step: state.step.step
});

export default withTranslation('checkout')(connect(mapStateToProps)(Checkout));
