import React from 'react';
import FormLink from '../FormLink/FormLink';
import {useTranslation} from 'react-i18next';

const RegistrationLink = () => {
    const {t} = useTranslation('form');

    const registerHandler = () => {
        catcher.showMenu();
        loadRecaptcha();
        $('.login-burger, .register-burger').toggle();
        $('.newsletter-wrapper').hide();
    };

    return (
        <FormLink className="registration-link" text={t('login.registration')} onClick={registerHandler}/>
    );
};

export default RegistrationLink;