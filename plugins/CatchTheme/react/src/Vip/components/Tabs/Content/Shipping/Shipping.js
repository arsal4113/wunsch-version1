import React from 'react';
import { useTranslation } from 'react-i18next';
import paypal from '../../../../assets/payment-methods/paypal-784404_960_720.png';
import visa from '../../../../assets/payment-methods/Visa_2014_logo_detail.png';
import amex from '../../../../assets/payment-methods/AXP_BlueBoxLogo_EXTRALARGEscale_RGB_DIGITAL_1600x1600.png';
import mastercard from '../../../../assets/payment-methods/mastercard_logo-700x490.png';
import sepa from '../../../../assets/payment-methods/lastschriftlogo-qf_rgb.png';

import './Shipping.scss';

const Shipping = (props) => {
    const {
        item
    } = props;
    const {t} = useTranslation('vip');

    const shippingOptions = (item.shipping_options) ? item.shipping_options.map((option, i) => {
       return (
           <div className="shipping-option" key={i}>
               <span>{option.shipping_cost.display_price}, {option.type}</span>
           </div>
       );
    }) : '';
    const shippingExcluded = [];
    if (item.ship_to_locations.region_excluded) {
        item.ship_to_locations.region_excluded.map((region) => {
            return (
                shippingExcluded.push(region.region_name)
            );
        });
    }

    return (
        <div className="tab-content shipping">
            <div className="shipping-options">
                <span className="title">{t('Versand')}</span>
                {shippingOptions}<br/>
                <span className="region-excluded">{t('Der Versand ist ausgeschlossen nach')}: {shippingExcluded.join(', ')}</span>
            </div>
            <div className="payment-methods">
                <span className="title">{t('Zahlungsmethoden')}</span>
                <div className="image-container">
                    <img className="paypal" src={paypal} alt="PayPal"/>
                    <img className="visa" src={visa} alt="Visa Card"/>
                    <img className="amex" src={amex} alt="American Express"/>
                    <img className="mastercard" src={mastercard} alt="mastercard"/>
                    <img className="sepa" src={sepa} alt={t('Sepa Lastschrift')}/>
                </div>
            </div>
        </div>
    );
};

export default Shipping;
