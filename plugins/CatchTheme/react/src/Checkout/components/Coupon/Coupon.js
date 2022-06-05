import React from 'react';
import {connect} from 'react-redux';
import { withTranslation } from 'react-i18next';
import Headline from '../UI/Headlines/Headline';
import TextInput from '../UI/Form/Input/TextInput/TextInput';
import Button from '../UI/Form/Button/Button';
import {saveCouponAsync, setCoupon} from '../../redux/coupon/coupon.actions';

import './Coupon.scss';

class Coupon extends React.Component {
    constructor(props) {
        super(props);
        this.saveCoupon = this.saveCoupon.bind(this);
    }

    changeHandler(e) {
        const {value} = e.target;
        const {_setCoupon} = this.props;
        _setCoupon(value);
    }

    saveCoupon() {
        const {_saveCouponAsync, _coupon} = this.props;
        if (_coupon) {
            _saveCouponAsync({redemption_code: _coupon});
        }
    }

    render() {
        const {
            t, responseErrors, _coupon, success
        } = this.props;
        return (
            <div className="coupon-wrapper">
                <Headline text={t('coupon.title')}/>
                <div className="coupon-form">
                    <TextInput
                        label={t('coupon.label')}
                        name="coupon"
                        onChange={(e) => { this.changeHandler(e); }}
                        value={_coupon}
                        type="text"
                        success={success ? t('coupon.success') : undefined}
                        error={responseErrors || undefined}
                    />
                    <Button
                        onClick={this.saveCoupon}
                        disabled={!_coupon}
                        className={success ? 'hidden' : ''}
                    >
                        <span className="desktop-title">{t('coupon.title')}</span>
                        <span className="mobile-title">{t('coupon.mobile-title')}</span>
                    </Button>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    savingCoupon: state.coupon.isFetching,
    responseErrors: state.coupon.error,
    _coupon: state.coupon.coupon,
    success: state.coupon.success
});

const mapDispatchToProps = (dispatch) => ({
    _saveCouponAsync: (formData) => dispatch(saveCouponAsync(formData)),
    _setCoupon: (coupon) => dispatch(setCoupon(coupon))
});

export default withTranslation('checkout')(connect(mapStateToProps, mapDispatchToProps)(Coupon));
