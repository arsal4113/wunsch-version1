import React from 'react';
import {useTranslation} from 'react-i18next';
import CheckboxInput from '../../UI/Form/Input/CheckboxInput/CheckboxInput';
import DeliveryDate from './DeliveryDate/DeliveryDate';
import {formatPrice} from '../../../redux/utility';

const ShippingMethod = ({
    method, selectedMethodId, onClick, disabled
}) => {
    const {t} = useTranslation('common');
    const estimatedDeliveryDate = (
        <DeliveryDate
            minDeliveryDate={method.min_estimated_delivery_date}
            maxDeliveryDate={method.max_estimated_delivery_date}
        />
    );
    const dasherizedName = method.shipping_service_code.toLowerCase().split(' ').join('-');
    return (
        <div className="shipping-methods">
            <CheckboxInput
                key={dasherizedName}
                className="shipping-method-check"
                name={dasherizedName}
                value={method.id}
                checked={method.id === selectedMethodId}
                onClick={onClick}
                disabled={disabled}
            >
                <div className="shipping-method-label">
                    <div className="shipping-method-name">
                        {method.shipping_service_code}
                    </div>
                    <div className="shipping-method-delivery">
                        <span>{`${t('checkout:shippingMethods:Delivery')}`}</span>
                        {estimatedDeliveryDate}
                    </div>
                </div>
                <div className="shipping-method-label">
                    <span className="shipping-method-price">
                        {method.base_delivery_cost_value === 0
                            ? t('common:free')
                            : formatPrice(
                                method.base_delivery_cost_value,
                                method.base_delivery_cost_currency
                            )}
                    </span>
                </div>
            </CheckboxInput>
        </div>
    );
};

export default ShippingMethod;
