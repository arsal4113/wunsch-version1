import React from 'react';
import {connect} from 'react-redux';
import {withTranslation} from 'react-i18next';
import Headline from '../UI/Headlines/Headline';
import ShippingMethod from './ShippingMethod/ShippingMethod';
import Loader from '../UI/Loader/Loader';
import {saveShippingMethodAsync} from '../../redux/items/items.actions';

import './ShippingMethods.scss';

class ShippingMethods extends React.Component {
    changeShippingMethod(itemId, shippingMethodCode) {
        const {_saveShippingMethod} = this.props;
        _saveShippingMethod(itemId, shippingMethodCode);
    }

    render() {
        const {
            t, items, savingShippingMethod, savingShippingAddress, error
        } = this.props;
        const loading = savingShippingMethod;
        const blur = savingShippingMethod || savingShippingAddress;
        const errorJSX = error ? <p className="error">{error.message}</p> : undefined;
        const itemShippingMethods = items.map((item) => {
            const shippingOptions = item.ebay_checkout_session_item_shippings.map((shippingMethod) => {
                const selectedMethodId = item.selected_ebay_checkout_session_item_shipping_id
                    ? item.selected_ebay_checkout_session_item_shipping_id
                    : item.ebay_checkout_session_item_shippings[0].id;
                return (
                    <ShippingMethod
                        key={shippingMethod.id}
                        method={shippingMethod}
                        selectedMethodId={selectedMethodId}
                        onClick={() => this.changeShippingMethod(
                            item.id, shippingMethod.shipping_service_code
                        )}
                    />
                );
            });
            return (
                <div key={item.id} className="item-shipping-wrapper">
                    <p className="item-name">{item.title}</p>
                    {shippingOptions}
                </div>
            );
        });
        return (
            <div className="shipping-method-wrapper">
                {loading ? <Loader/> : ''}
                <div className={`shipping-method-container${blur ? ' blurred' : ''}`}>
                    <Headline text={t('shippingMethods.title')}/>
                    {errorJSX}
                    {itemShippingMethods}
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    items: state.items.items,
    error: state.items.error,
    savingShippingMethod: state.items.isFetching,
    savingShippingAddress: state.shippingAddress.isFetching,
    step: state.step.step
});

const mapDispatchToProps = (dispatch) => ({
    _saveShippingMethod:
        (itemId, shippingMethodCode) => dispatch(saveShippingMethodAsync(itemId, shippingMethodCode))
});

export default withTranslation('checkout')(connect(mapStateToProps, mapDispatchToProps)(ShippingMethods));
