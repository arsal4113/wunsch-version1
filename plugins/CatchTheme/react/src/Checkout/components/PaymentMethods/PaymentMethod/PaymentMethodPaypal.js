import React from 'react';
import ReactDOM from 'react-dom';
import {connect} from 'react-redux';
import * as stepTypes from '../../Step/stepTypes';
import {setMaxStep, setStep} from '../../../redux/step/step.actions';

class PaymentMethodPayPal extends React.Component {
    constructor(props) {
        super(props);
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

        if (
            !isSdkReady
            && (typeof window === 'undefined' || window.paypal === undefined)
        ) {
            return null;
        }

        const Button = window.paypal.Buttons.driver('react', {
            React,
            ReactDOM
        });

        return (
            <Button
                createOrder={this.createOrder}
                onApprove={this.onApprove}
            />
        );
    }

    createOrder() {
        return fetch(
            window.getPaymentMethodUrl,
            {
                method: 'GET',
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        )
            .then((res) => res.json())
            .then(
                (response) => {
                    if (response.errors) {
                        throw new Error(response.errors);
                    }
                    return response.orderId;
                }
            ).catch((error) => console.error('Error:', error));
    }

    onApprove(data) {
        const {_setStep, _setMaxStep} = this.props;
        return fetch(
            window.savePaymentMethodUrl,
            {
                method: 'POST', // or 'PUT'
                body: JSON.stringify(data),
                headers: {
                    'Content-Type': 'application/json'
                }
            }
        )
            .then((res) => res.json())
            .then(
                (response) => {
                    if (response.errors) {
                        throw new Error(response.errors);
                    }
                    _setStep(stepTypes.PAYMENT_METHOD_COMPLETED);
                    _setMaxStep(stepTypes.PAYMENT_METHOD_COMPLETED);
                }
            ).catch((error) => console.error('Error:', error));
    }

    addPaypalSdk() {
        const { options, onButtonReady } = this.props;
        const queryParams = [];

        if (options) {
            Object.keys(options).map((k, index) => {
                const name = k.split(/(?=[A-Z])/).join('-').toLowerCase();
                queryParams.push(`${name}=${options[k]}`);
            });
        }

        const script = document.createElement('script');
        script.type = 'text/javascript';
        script.src = `https://www.paypal.com/sdk/js?${queryParams.join('&')}`;
        script.async = true;
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
    _setMaxStep: (step) => dispatch(setMaxStep(step))
});

export default connect(mapStateToProps, mapDispatchToProps)(PaymentMethodPayPal);
