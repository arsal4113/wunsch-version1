import React from 'react';
import {useSelector} from 'react-redux';
import {useTranslation} from 'react-i18next';

import './SuccessMessage.scss';

const SuccessMessage = () => {
    const {t} = useTranslation(['form', 'common']);
    const {userName} = useSelector((state) => state.loginUser);
    const userFirstName = userName || window.userFirstName;

    return (
        <div className="login-success">
            <p>{t('common:Hi')} {`${userFirstName}!`}</p>
            <span>{t('login.success')}</span>
        </div>
    );
};

export default SuccessMessage;
