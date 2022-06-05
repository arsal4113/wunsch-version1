import React from 'react';
import FormLink from '../FormLink/FormLink';
import {useTranslation} from 'react-i18next';

const PasswordLink = () => {
    const {t} = useTranslation('form');

    const passwordHandler = () => {
        catcher.showMenu();
        $('.login-burger, .password-burger').toggle();
        $('.newsletter-wrapper').hide();
        $('#back-to-login-link').hide();
    };

    return (
        <FormLink text={t('login.forgotPassword')} onClick={passwordHandler}/>
    );
};

export default PasswordLink;