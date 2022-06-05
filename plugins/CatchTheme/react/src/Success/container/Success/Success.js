import React from 'react';
import {useTranslation} from 'react-i18next';
import Step from '../../components/Step/Step';
import Newsletter from '../../components/Newsletter/Newsletter';
import Address from '../../components/Address/Address';
import Item from '../../../Checkout/components/UI/Item/Item';
import CancelledItems from '../../components/CancelledItems/CancelledItems';
import Totals from '../../components/Totals/Totals';

import './Success.scss';

const Success = () => {
    const {t} = useTranslation('success');
    let items;
    if (window.checkoutItems) {
        items = window.checkoutItems.map((item) => <Item key={item.id} item={item}/>);
    }
    const cancelledItems = window.cancelledItems ? <CancelledItems items={window.cancelledItems}/> : '';
    return (
        <div className="success-wrapper">
            <Step/>
            <div className="content-wrapper">
                <div className="content left">
                    <p className="headline">{t('thanks')}</p>
                    <p className="confirm">{t('confirmMessage', {email: window.userEmail})}</p>
                    <Newsletter showNewsletter={window.showNewsletter}/>
                    <div className="image-bubble"/>
                    {cancelledItems}
                </div>
                <div className="content right">
                    <div className="header">
                        <p className="order-headline">{t('order.headline')}</p>
                        <a href="/" className="continue">{t('order.continue')}</a>
                    </div>
                    <div className="order-details">
                        <div className="left-wrapper">
                            <Address address={window.shippingAddress}/>
                        </div>
                        <div className="right-wrapper">
                            {cancelledItems}
                            {items}
                            <Totals totals={window.checkoutTotals} items={window.checkoutItems}/>
                            <a href="/" className="continue-mobile">{t('order.continue')}</a>
                        </div>
                    </div>
                </div>
                <div className="mobile-newsletter">
                    <Newsletter showNewsletter={window.showNewsletter}/>
                </div>
            </div>
        </div>
    );
};

export default Success;
