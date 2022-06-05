import React, { Component } from 'react';
import { connect } from 'react-redux';
import { withTranslation } from 'react-i18next';
import {
    INIT,
    ITEMS_ADDED,
    SHIPPING_ADDRESS_ENTERED,
    PAYMENT_METHOD_COMPLETED,
    COMPLETED
} from './stepTypes';
import {setStep} from '../../redux/step/step.actions';

import './Step.scss';

class Step extends Component {
    getStepClassName(step) {
        const {currentStep, maxStep } = this.props;
        let className = `step step-${step}`;
        if (step <= maxStep) {
            className += ' clickable';
        }
        if (step === currentStep) {
            className += ' selected';
        }
        switch (step) {
            case 2:
                /* Shipping Address */
                if (maxStep <= ITEMS_ADDED) {
                    return `${className} active`;
                }
                if (maxStep >= ITEMS_ADDED) {
                    return `${className} finished`;
                }
                break;
            case 3:
                /* Shipping Method */
                if (maxStep === SHIPPING_ADDRESS_ENTERED) {
                    return `${className} active`;
                }
                if (maxStep >= SHIPPING_ADDRESS_ENTERED) {
                    return `${className} finished`;
                }
                break;
            case 4:
                /* Payment method */
                if (maxStep === PAYMENT_METHOD_COMPLETED) {
                    return `${className} active`;
                }
                if (maxStep > PAYMENT_METHOD_COMPLETED) {
                    return `${className} finished`;
                }
                break;
            case 5:
                /* Ready to buy */
                if (maxStep === COMPLETED) {
                    return `${className} finished`;
                }
                break;
            default:
                return className;
        }
        return className;
    }

    goToStep(step) {
        const {_setStep, maxStep} = this.props;
        if (step <= maxStep) {
            if (step === INIT) {
                window.location.href = window.cartUrl;
            } else {
                _setStep(step);
            }
        }
    }

    render() {
        const {maxStep, t} = this.props;
        return (
            <div className="step-wrapper">
                <div className="step finished clickable" onClick={() => this.goToStep(INIT)}>
                    <span className="index">1</span>
                    <span className="step-name">{t('steps.cart')}</span>
                </div>
                <div className={`step-connector${maxStep > INIT ? ' finished' : ''}`}>
                    <hr/>
                </div>
                <div
                    className={this.getStepClassName(2)}
                    onClick={() => this.goToStep(ITEMS_ADDED)}
                >
                    <span className="index">2</span>
                    <span className="step-name">{t('steps.delivery')}</span>
                </div>
                <div
                    className={`step-connector${maxStep >= SHIPPING_ADDRESS_ENTERED ? ' finished' : ''}`}
                >
                    <hr/>
                </div>
                <div
                    className={this.getStepClassName(3)}
                    onClick={() => this.goToStep(SHIPPING_ADDRESS_ENTERED)}
                >
                    <span className="index">3</span>
                    <span className="step-name">{t('steps.payment')}</span>
                </div>
                <div
                    className={`step-connector${maxStep >= PAYMENT_METHOD_COMPLETED ? ' finished' : ''}`}
                >
                    <hr/>
                </div>
                <div
                    className={this.getStepClassName(4)}
                    onClick={() => this.goToStep(PAYMENT_METHOD_COMPLETED)}
                >
                    <span className="index">4</span>
                    <span className="step-name desktop">{t('steps.complete')}</span>
                    <span className="step-name mobile">{t('steps.complete_mobile')}</span>
                </div>
                <div className={`step-connector${maxStep === COMPLETED ? ' finished' : ''}`}>
                    <hr/>
                </div>
                <div className={this.getStepClassName(5)}>
                    <span className="index">5</span>
                    <span className="step-name">{t('steps.done')}</span>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    currentStep: state.step.step,
    maxStep: state.step.maxStep
});

const mapDispatchToProps = (dispatch) => ({
    _setStep: (step) => dispatch(setStep(step))
});

export default withTranslation('checkout')(connect(mapStateToProps, mapDispatchToProps)(Step));
