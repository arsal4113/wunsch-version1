import React from 'react';
import {useTranslation} from 'react-i18next';

import './SocialLogin.scss';

const SocialLogin = () => {
    const {t} = useTranslation(['form']);
    const socialLoginURLs = window.socialLoginURLs;
    let socialItems = [];

    Object.keys(socialLoginURLs).forEach(function (key){
        if (key === 'facebook' || key === 'ebay') {
            socialItems.push(
                <div className={`outline-wrapper ${key}`} key={key}>
                    <a className={key} key={key} href={socialLoginURLs[key]} rel='nofollow'>key</a>
                </div>
            );
        } else {
            socialItems.push(
                <div className="outline-wrapper" key={key}>
                    <a className={key} key={key} href={socialLoginURLs[key]} target="_blank" rel='nofollow'>key</a>
                </div>
            );
        }
    });
    return (
        <div className="social-login-wrapper">
            <p className="text">{t('login.socialText')}</p>
            <div className="social-accounts">
                {socialItems}
            </div>
            <div className="separator">
            </div>
        </div>
    );

};

export default SocialLogin;
