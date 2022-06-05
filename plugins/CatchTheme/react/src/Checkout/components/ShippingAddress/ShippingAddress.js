import React, { Component } from 'react';
import { connect } from 'react-redux';
import { withTranslation } from 'react-i18next';
import Address from '../UI/Form/Address/Address';
import {
    getAdditionalInfoFromZipCodeAsync,
    saveShippingAddressAsync,
    updateShippingAddress
} from '../../redux/shippingAddress/shippingAddress.actions';
import Headline from '../UI/Headlines/Headline';
import Button from '../UI/Form/Button/Button';
import CheckboxInput from '../UI/Form/Input/CheckboxInput/CheckboxInput';
import Loader from '../UI/Loader/Loader';
import View from './View';
import {validator} from '../../redux/utility';
import {ITEMS_ADDED} from '../Step/stepTypes';
import {setMaxStep} from '../../redux/step/step.actions';

import './ShippingAddress.scss';

class ShippingAddress extends Component {
    constructor(props) {
        super(props);
        this.saveHandler = this.saveHandler.bind(this);
        this.changeHandler = this.changeHandler.bind(this);
        this.toggleSaveAddress = this.toggleSaveAddress.bind(this);
        this.showAddressForm = this.showAddressForm.bind(this);
        this.state = {
            errors: {}
        };
    }

    showAddressForm() {
        const {_setMaxStep} = this.props;
        _setMaxStep(ITEMS_ADDED);
    }

    saveHandler(e) {
        e.preventDefault();
        const {_saveShippingAddress, _shippingAddress} = this.props;
        const errors = validator(_shippingAddress);
        if (!errors) {
            this.setState({errors: {}});
            _saveShippingAddress(_shippingAddress);
        } else {
            this.setState({errors: errors});
        }
    }

    changeHandler(name, e) {
        const {value} = e.target;
        const {_updateShippingAddress, _shippingAddress, setStateAndCity} = this.props;
        const shippingAddress = {
            ..._shippingAddress,
            [name]: value
        };
        _updateShippingAddress(shippingAddress);
        if (name === 'postal_code' && value.length === 5) {
            setStateAndCity(value);
        }
    }

    toggleSaveAddress() {
        const {_updateShippingAddress, _shippingAddress} = this.props;
        const shippingAddress = {
            ..._shippingAddress,
            save_address: !_shippingAddress.save_address
        };
        _updateShippingAddress(shippingAddress);
    }

    render() {
        const {
            savingAddress, savingMethod, responseError, t, maxStep, _shippingAddress, fetchingZipCodeData
        } = this.props;
        const {shippingAddress, errors} = this.state;
        const loading = savingAddress;
        const blur = savingAddress || savingMethod;
        const errorsJSX = responseError ? <p className="error">{responseError}</p> : '';
        const saveAddress = window.isLoggedIn ? (
            <CheckboxInput
                name="saveaddress"
                className="save-address"
                disabled={false}
                checked={_shippingAddress.save_address}
                onClick={this.toggleSaveAddress}
            >
                {t('shippingAddress.saveAddress')}
            </CheckboxInput>
        ) : '';

        let shippingAddressJSX;
        if (maxStep > ITEMS_ADDED) {
            shippingAddressJSX = (
                <div className={`shipping-address-form${blur ? ' blurred' : ''}`}>
                    <Headline text={t('shippingAddress.title')} changeFunction={this.showAddressForm}>
                        <p className="subtext">{t('shippingAddress.subtitle')}</p>
                    </Headline>
                    <View address={_shippingAddress}/>
                </div>
            );
        } else {
            shippingAddressJSX = (
                <form
                    onSubmit={this.saveHandler}
                    className={`shipping-address-form ${blur ? ' blurred' : ''}`}
                >
                    <Headline text={t('shippingAddress.title')}>
                        <p className="subtext">{t('shippingAddress.subtitle')}</p>
                    </Headline>
                    {errorsJSX}
                    <Address
                        address={_shippingAddress}
                        errors={errors}
                        changeHandler={this.changeHandler}
                        fetchingZipCodeData={fetchingZipCodeData}
                    />
                    {saveAddress}
                    <Button>{t('shippingAddress.saveButton')}</Button>
                    <p className="disclaimer">
                        {t('shippingAddress.disclaimer')}
                        {' '}
                        <a
                            target="_blank"
                            href="/datenschutz#paypal-target"
                        >
                            {t('common:here')}
                        </a>
                        .
                    </p>
                </form>
            );
        }
        return (
            <div className="shipping-address-wrapper">
                {loading ? <Loader/> : ''}
                {shippingAddressJSX}
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    savingAddress: state.shippingAddress.isFetching,
    savingMethod: state.items.isFetching,
    responseError: state.shippingAddress.error,
    maxStep: state.step.maxStep,
    _shippingAddress: state.shippingAddress.shippingAddress,
    fetchingZipCodeData: state.shippingAddress.fetchingZipCodeData
});

const mapDispatchToProps = (dispatch) => ({
    _saveShippingAddress: (shippingAddress) => dispatch(saveShippingAddressAsync(shippingAddress)),
    _setMaxStep: (step) => dispatch(setMaxStep(step)),
    _updateShippingAddress: (shippingAddress) => dispatch(updateShippingAddress(shippingAddress)),
    setStateAndCity: (zipCode) => dispatch(getAdditionalInfoFromZipCodeAsync(zipCode))
});

// eslint-disable-next-line max-len
export default withTranslation(['checkout', 'common'])(connect(mapStateToProps, mapDispatchToProps)(ShippingAddress));
