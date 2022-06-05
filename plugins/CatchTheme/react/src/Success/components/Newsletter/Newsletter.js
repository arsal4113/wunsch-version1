import React, { Component } from 'react';
import { withTranslation } from 'react-i18next';
import Input from '../UI/Input/Input';
import Button from '../UI/Button/Button';
import {validateEmail} from '../../../Checkout/redux/utility';

import './Newsletter.scss';

class Newsletter extends Component {
    constructor(props) {
        super(props);
        this.inputChangeHandler = this.inputChangeHandler.bind(this);
        this.subscribeToNewsletter = this.subscribeToNewsletter.bind(this);
        this.subscribeSuccess = this.subscribeSuccess.bind(this);
        this.subscribeError = this.subscribeError.bind(this);
        this.state = {
            email: '',
            isLoading: false,
            error: undefined,
            success: false
        };
    }

    inputChangeHandler(e) {
        const {value} = e.target;
        this.setState({email: value});
    }

    subscribeSuccess() {
        this.setState((prevState) => ({
            ...prevState,
            success: true,
            error: undefined,
            isLoading: false
        }));
    }

    subscribeError(error) {
        let errorMessage;
        if (error.isSubscribed) {
            errorMessage = 'isSubscribed';
        } else if (!error.isValidEmail) {
            errorMessage = 'invalidEmail';
        } else {
            errorMessage = 'unknown';
        }
        this.setState((prevState) => ({
            ...prevState,
            success: false,
            isLoading: false,
            error: errorMessage
        }));
    }

    subscribeToNewsletter() {
        const {email} = this.state;
        if (validateEmail(email)) {
            this.setState((prevState) => ({
                ...prevState,
                isLoading: true,
                error: undefined
            }));
            const formData = new FormData();
            formData.append('email', email);
            formData.append('react', '1');
            fetch(
                window.newsletterUrl,
                {
                    method: 'POST',
                    body: formData
                }
            )
                .then((res) => res.text())
                .then((res) => {
                    const response = JSON.parse(res);
                    if (!response.success) {
                        throw response;
                    }
                    this.subscribeSuccess();
                })
                .catch((error) => {
                    this.subscribeError(error);
                });
        } else {
            this.setState((prevState) => ({
                ...prevState,
                error: 'invalidEmail'
            }));
        }
    }


    render() {
        const {t, showNewsletter} = this.props;
        const {
            email, isLoading, error, success
        } = this.state;
        let newsletterJSX;
        if (!showNewsletter) {
            newsletterJSX = (
                <div className="newsletter-bubble small">
                    <p className="newsletter-headline">{t('newsletter.headline')}</p>
                    <p className="description">{t('newsletter.shortDescription')}</p>
                </div>
            );
        } else {
            newsletterJSX = (
                <div className="newsletter-bubble">
                    <p className="newsletter-headline">{t('newsletter.headline')}</p>
                    <p className="description">{t('newsletter.description')}</p>
                    <Input
                        placeholder={t('email')}
                        onChange={this.inputChangeHandler}
                        value={email}
                        error={error}
                        className={success ? 'success' : ''}
                    />
                    <Button
                        label={t('newsletter.button')}
                        onClick={this.subscribeToNewsletter}
                        loading={isLoading}
                    />
                    <p className="disclaimer">{t('newsletter.disclaimer')}</p>
                </div>
            );
        }
        return newsletterJSX;
    }
}

export default withTranslation('success')(Newsletter);
