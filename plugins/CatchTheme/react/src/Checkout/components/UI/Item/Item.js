import React from 'react';
import {useTranslation} from 'react-i18next';
import {formatPrice} from '../../../redux/utility';
import DeliveryDate from '../../ShippingMethods/ShippingMethod/DeliveryDate/DeliveryDate';

import './Item.scss';

const Item = ({ item }) => {
    const { t } = useTranslation(['checkout', 'common']);
    const shipping = item.selected_ebay_checkout_session_item_shipping
        ? item.selected_ebay_checkout_session_item_shipping
        : item.ebay_checkout_session_item_shippings[0];
    const shippingPrice = shipping.base_delivery_cost_value
        ? formatPrice(shipping.base_delivery_cost_value, shipping.base_delivery_cost_currency)
        : t('common:free');
    const deliveryDate = (
        <DeliveryDate
            minDeliveryDate={shipping.min_estimated_delivery_date}
            maxDeliveryDate={shipping.max_estimated_delivery_date}
        />
    );
    const itemPrice = formatPrice(item.base_price_value, item.base_price_currency);
    return (
        <div className="item-wrapper">
            <div className="image-container">
                <div className="image-wrapper">
                    <img src={item.image} alt="item"/>
                </div>
            </div>
            <div className="info-container">
                <p className="item-name">{item.title}</p>
                <p className="order-info">
                    <span className="big">{t('orderOverview.amount')}</span>
                    {` ${item.quantity}`}
                </p>
                <p className="order-info">
                    <span className="big">{t('orderOverview.delivery')}</span>
                    {` ${shipping.shipping_service_code} - ${shippingPrice}`}
                </p>
                <p className="order-info">
                    <span className="big">{`${t('shippingMethods.Delivery')}: `}</span>
                    {deliveryDate}
                </p>
                <p className="price">{itemPrice}</p>
            </div>
        </div>
    );
};

export default Item;
