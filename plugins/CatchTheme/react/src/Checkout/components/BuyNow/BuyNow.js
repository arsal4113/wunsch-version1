import React, {Component} from 'react';
import {connect} from 'react-redux';
import {withTranslation} from 'react-i18next';
import CheckboxInput from '../UI/Form/Input/CheckboxInput/CheckboxInput';
import Button from '../UI/Form/Button/Button';
import Loader from '../UI/Loader/Loader';
import {setMarketingConsent, submitAsync} from '../../redux/submit/submit.actions';

import './BuyNow.scss';

class BuyNow extends Component {
    constructor(props) {
        super(props);
        this.toggleMarketingConsent = this.toggleMarketingConsent.bind(this);
        this.buy = this.buy.bind(this);
    }

    toggleMarketingConsent() {
        const {marketingConsent, _setMarketingConsent} = this.props;
        _setMarketingConsent(!marketingConsent);
    }

    buy() {
        const {submit, marketingConsent} = this.props;
        submit({catchMarketingConsent: marketingConsent});
    }

    render() {
        const {
            t, error, loading, marketingConsent
        } = this.props;
        const errorJSX = error ? <p className="error">{t(`error:${error.message}`)}</p> : undefined;
        return (
            <div className="buy-now">
                {loading ? <Loader/> : ''}
                <div className={`content${loading ? ' blurred' : ''}`}>
                    <div className="text-wrapper">
                        <CheckboxInput
                            name="marketing_consent"
                            onClick={this.toggleMarketingConsent}
                            checked={marketingConsent}
                            className="subscribe-newsletter"
                        >
                            {t('buyNow.newsletter')}
                        </CheckboxInput>
                        <p>{t('buyNow.optOut')}</p>
                    </div>
                    {errorJSX}
                    <Button onClick={this.buy}>{t('buyNow.submit')}</Button>
                    <div className="text-wrapper">
                        <p className="disclaimer">
                            {t('buyNow.disclaimerFirst')}
                            <a
                                href="https://pages.ebay.com/help/policies/user-agreement.html"
                                target="_blank"
                            >
                                {t('buyNow.terms')}
                            </a>
                            {t('buyNow.disclaimerSecond')}
                            <a href="/datenschutz" target="_blank">{t('buyNow.privacy')}</a>
                            .
                        </p>
                    </div>
                </div>
            </div>
        );
    }
}

const mapStateToProps = (state) => ({
    error: state.submit.error,
    loading: state.submit.isFetching,
    marketingConsent: state.submit.marketingConsent
});

const mapDispatchToProps = (dispatch) => ({
    submit: (formData) => dispatch(submitAsync(formData)),
    _setMarketingConsent: (consent) => dispatch(setMarketingConsent(consent))
});

export default withTranslation(['checkout', 'error'])(connect(mapStateToProps, mapDispatchToProps)(BuyNow));
