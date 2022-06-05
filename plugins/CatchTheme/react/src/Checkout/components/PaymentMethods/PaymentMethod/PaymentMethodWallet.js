import React from 'react';
import ReactDOM from 'react-dom';
import {connect} from 'react-redux';
import {setMaxStep, setStep} from '../../../redux/step/step.actions';
import {PAYMENT_METHOD_COMPLETED} from '../../Step/stepTypes';
import {
    savePaymentMethodFailure, savePaymentMethodSuccess
} from '../../../redux/paymentMethods/paymentMethods.actions';

class PaymentMethodWallet extends React.Component {
    constructor(props) {
        super(props);
        this.onAuthorize = this.onAuthorize.bind(this);
        this.state = {
            isSdkReady: false
        };
    }

    componentDidMount() {
        const {onButtonReady} = this.props;
        if (
            typeof window !== 'undefined'
            && window !== undefined
            && window.paypal === undefined
        ) {
            this.addPaypalSdk();
        } else if (
            typeof window !== 'undefined'
            && window !== undefined
            && window.paypal !== undefined
            && onButtonReady
        ) {
            onButtonReady();
        }
    }

    render() {
        const { isSdkReady } = this.state;

        if (!isSdkReady
            && (typeof window === 'undefined' || window.paypal === undefined)
        ) {
            return null;
        }

        const Button = window.paypal.Button.driver('react', {
            React,
            ReactDOM
        });

        return (
            <Button
                payment={this.createOrder}
                funding={{allowed: [window.paypal.FUNDING.CARD, window.paypal.FUNDING.ELV]}}
                locale="de_DE"
                style={{
                    size: 'responsive', shape: 'rect', color: 'blue', layout: 'vertical'
                }}
                onAuthorize={this.onAuthorize}
            />
        );
    }

    createOrder() {
        const postData = {payment_method_type: 'WALLET'};
        return fetch(
            window.savePaymentMethodUrl,
            {
                method: 'POST',
                body: JSON.stringify(postData),
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        )
            .then((res) => res.json())
            .then((response) => {
                if (response.error) {
                    throw new Error(response);
                }
                return response.externalReferenceId;
            }).catch((error) => {
                console.error('Error:', error);
            });
    }

    onAuthorize(data) {
        const {
            _setStep, _setMaxStep, _savePaymentMethodFailure, _savePaymentMethodSuccess
        } = this.props;
        const postData = {
            payment_method_type: 'WALLET',
            additionalData: data
        };
        return fetch(
            window.savePaymentMethodUrl,
            {
                method: 'POST',
                body: JSON.stringify(postData),
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        )
            .then((res) => res.json())
            .then((response) => {
                if (response.error) {
                    throw response;
                }
                _savePaymentMethodSuccess('PayPal');
                _setStep(PAYMENT_METHOD_COMPLETED);
                _setMaxStep(PAYMENT_METHOD_COMPLETED);
            }).catch((error) => {
                console.error('Error:', error);
                _savePaymentMethodFailure(error.message);
            });
    }

    addPaypalSdk() {
        const { onButtonReady } = this.props;
        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = 'https://www.paypalobjects.com/api/checkout.js';
        script['data-stage'] = 'www.paypal.com';
        script.onload = () => {
            this.setState({ isSdkReady: true });
            if (onButtonReady) {
                onButtonReady();
            }
        };
        script.onerror = () => {
            throw new Error('Paypal SDK could not be loaded.');
        };
        document.body.appendChild(script);
    }
}

const mapStateToProps = (state) => ({
    step: state.step.step
});

const mapDispatchToProps = (dispatch) => ({
    _setStep: (step) => dispatch(setStep(step)),
    _setMaxStep: (step) => dispatch(setMaxStep(step)),
    _savePaymentMethodSuccess: (methodCode) => dispatch(savePaymentMethodSuccess(methodCode)),
    _savePaymentMethodFailure: (error) => dispatch(savePaymentMethodFailure(error))
});

export default connect(mapStateToProps, mapDispatchToProps)(PaymentMethodWallet);
