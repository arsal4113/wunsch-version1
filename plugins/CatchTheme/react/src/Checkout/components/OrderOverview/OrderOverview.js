import React, {Component} from 'react';
import {connect} from 'react-redux';
import {withTranslation} from 'react-i18next';
import Headline from '../UI/Headlines/Headline';
import View from '../ShippingAddress/View';
import Item from '../UI/Item/Item';
import Total from '../Totals/Total/Total';
import {formatPrice} from '../../redux/utility';
import Button from '../UI/Form/Button/Button';
import {submitAsync} from '../../redux/submit/submit.actions';
import Loader from '../UI/Loader/Loader';

import './OrderOverview.scss';

class OrderOverview extends Component {
    constructor(props) {
        super(props);
        this.buy = this.buy.bind(this);
    }

    buy() {
        const {submit, marketingConsent} = this.props;
        submit({catchMarketingConsent: marketingConsent});
    }

    render() {
        const {
            t, shippingAddress, items, totals, coupon, error, loading
        } = this.props;
        const itemsJSX = items.map((item) => <Item key={item.id} item={item}/>);
        const totalJSX = totals.map(
            (total) => <Total key={total.code} total={total} itemCount={items.length} final/>
        );
        const totalPrice = totals.map((total) => {
            if (total.code === 'total') {
                return formatPrice(total.value, total.currency);
            }
            return false;
        });
        const errorJSX = error ? <p className="error">{t(`error:${error.message}`)}</p> : undefined;
        return (
            <div className="order-overview">
                {loading ? <Loader/> : ''}
                <div className={`content${loading ? ' blurred' : ''}`}>
                    <Headline text={t('orderOverview.title')}/>
                    <div className="order-details">
                        <div className="detail">
                            <p className="identifier">{t('orderOverview.deliveryTo')}</p>
                            <View address={shippingAddress}/>
                        </div>
                        <div className="detail">
                            <p className="identifier">{t('orderOverview.payment')}</p>
                            <p className="value">PayPal</p>
                        </div>
                        <div className="detail">
                            <p className="identifier">{t('orderOverview.coupon')}</p>
                            <p className="value">{coupon || t('orderOverview.withoutCoupon')}</p>
                        </div>
                        <div className="detail">
                            <p className="identifier">{t('orderOverview.total')}</p>
                            <p className="value">{totalPrice}</p>
                        </div>
                    </div>
                    <div className="items-wrapper">
                        {itemsJSX}
                    </div>
                    <div className="final-totals-wrapper">
                        {totalJSX}
                    </div>
                    {errorJSX}
                    <Button onClick={this.buy}>{t('buyNow.submit')}</Button>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    shippingAddress: state.shippingAddress.shippingAddress,
    items: state.items.items,
    totals: state.totals.totals,
    coupon: state.coupon.coupon,
    marketingConsent: state.submit.marketingConsent,
    error: state.submit.error,
    loading: state.submit.isFetching
});

const mapDispatchToProps = (dispatch) => ({
    submit: (formData) => dispatch(submitAsync(formData))
});

export default withTranslation(['checkout'])(connect(mapStateToProps, mapDispatchToProps)(OrderOverview));
