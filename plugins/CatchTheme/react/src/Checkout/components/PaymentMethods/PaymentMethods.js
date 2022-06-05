import React from 'react';
import {connect} from 'react-redux';
import {withTranslation} from 'react-i18next';
import PaymentMethodPayPal from './PaymentMethod/PaymentMethodPaypal';
import {PAY_PAL_CLIENT_ID} from '../../constants';
import Headline from '../UI/Headlines/Headline';
import Description from '../UI/Description/Description';
import View from '../ShippingAddress/View';
import PaymentMethodWallet from './PaymentMethod/PaymentMethodWallet';
import Coupon from '../Coupon/Coupon';
import Loader from '../UI/Loader/Loader';
import {ITEMS_ADDED, PAYMENT_METHOD_COMPLETED, SHIPPING_ADDRESS_ENTERED} from '../Step/stepTypes';
import {setMaxStep} from '../../redux/step/step.actions';

import './PaymentMethods.scss';
import ShippingAddress from '../ShippingAddress/ShippingAddress';

class PaymentMethods extends React.Component {
    constructor(props) {
        super(props);
        this.showPaymentOptions = this.showPaymentOptions.bind(this);
        this.showAddressForm = this.showAddressForm.bind(this);
    }

    showPaymentOptions() {
        const {_setMaxStep} = this.props;
        _setMaxStep(SHIPPING_ADDRESS_ENTERED);
    }
    showAddressForm() {
        const {_setMaxStep} = this.props;
        _setMaxStep(ITEMS_ADDED);
    }

    render() {
        const {
            t, paymentMethods, savingCoupon, maxStep, selectedCode, error, shippingAddress, isMobile
        } = this.props;
        let paymentJSX;
        let content;
        if (maxStep >= PAYMENT_METHOD_COMPLETED) {
            paymentJSX = (
                <>
                    <Headline text={t('paymentMethods.title')} changeFunction={this.showPaymentOptions}/>
                    <div className="payment-wrapper">
                        <p className="selected-method-name">{selectedCode}</p>
                        <div className="green-tick"/>
                    </div>
                </>
            );
        } else {
            const errorJSX = error ? <p className="error">{error}</p> : undefined;
            const paymentMethodsJSX = paymentMethods.map((method) => {
                switch (method.label) {
                    case 'PAYPAL':
                        return (
                            <PaymentMethodPayPal
                                key={method.label}
                                options={{clientId: PAY_PAL_CLIENT_ID, currency: 'EUR'}}
                            />
                        );
                    case 'WALLET':
                        return (
                            <PaymentMethodWallet
                                key={method.label}
                                paymentId={method.id}
                                paymentType={method.payment_method_type}
                            />
                        );
                    default:
                        return '';
                }
            });

            paymentJSX = (
                <>
                    <Headline text={t('paymentMethods.title')}/>
                    {errorJSX}
                    <div className="payment-wrapper">
                        <Description>{t('paymentMethods.chooseDescription')}</Description>
                        <div>
                            {paymentMethodsJSX}
                        </div>
                    </div>
                </>
            );
        }
        if (maxStep > ITEMS_ADDED) {
            if (isMobile) {
                content = (
                    <div className={`payment-container${savingCoupon ? ' blurred' : ''}`}>
                        <div className="shipping-address-wrapper mobile">
                            <Headline text={t('paymentMethods.shippingAddress')} changeFunction={this.showAddressForm}>
                                <p className="subtext">{t('shippingAddress.subtitle')}</p>
                            </Headline>
                            <View address={shippingAddress}/>
                        </div>
                        {paymentJSX}
                        <Coupon/>
                    </div>
                );
            } else {
                content = (
                    <div className={`payment-container${savingCoupon ? ' blurred' : ''}`}>
                        <div className="shipping-address-wrapper">
                            <Headline text={t('paymentMethods.shippingAddress')}>
                                <p className="subtext">{t('shippingAddress.subtitle')}</p>
                            </Headline>
                            <View address={shippingAddress}/>
                            <Headline changeFunction={this.showAddressForm}/>
                        </div>
                        {paymentJSX}
                        <Coupon/>
                    </div>
                );
            }
        } else {
            content = (
                    <ShippingAddress/>
            );
        }

        return (
            <div className="payment-wrapper big-box">
                {savingCoupon ? <Loader shown={savingCoupon}/> : ''}
                {content}
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    isMobile: state.device.mobileDevice,
    shippingAddress: state.shippingAddress.shippingAddress,
    paymentMethods: state.paymentMethods.paymentMethods,
    savingCoupon: state.coupon.isFetching,
    maxStep: state.step.maxStep,
    selectedCode: state.paymentMethods.selectedCode,
    error: state.paymentMethods.error
});

const mapDispatchToProps = (dispatch) => ({
    _setMaxStep: (step) => dispatch(setMaxStep(step))
});

export default withTranslation('checkout')(connect(mapStateToProps, mapDispatchToProps)(PaymentMethods));
