import React, {useState} from 'react';
import {useTranslation} from 'react-i18next';
import LoginForm from '../UI/Form/LoginForm/LoginForm';
import SuccessMessage from '../UI/Form/LoginForm/SuccesMessage/SuccessMessage';
import {useSelector} from 'react-redux';

import './UserSection.scss';

const UserSection = () => {
    const {t} = useTranslation('common');
    const [button, setButton] = useState('guest');
    const [isHovering, setIsHovering] = useState(false);
    const {checkoutLoggedIn} = useSelector((state) => state.loginUser);
    const {shippingAddressCompleted} = useSelector((state) => state.shippingAddress);
    const userLoggedIn = checkoutLoggedIn || window.userLogedIn;
    const socialLoginTag = window.location.hash.substring(1) === 'social';

    const clickHandler = (val) => {
        setButton(val);
        setIsHovering(false);
    };
    const changeBackground = (e) => {
        if (e.target.className === 'active')
        return;
        setIsHovering(!isHovering);
    };

    const userSectionHeader = (
        <div className={`user-buttons ${isHovering ? 'hover' : ''}`}>
            <button
                className={`${button === 'guest' ? 'active' : ''}`}
                onClick={() => clickHandler('guest')}
                onMouseOver={(e) => changeBackground(e)}
                onMouseLeave={(e) => changeBackground(e)}
            >
                {t('Guest')}
             </button>
            <button
                className={`${button === 'login' ? 'active' : ''}`}
                onClick={() => clickHandler('login')}
                onMouseOver={(e) => changeBackground(e)}
                onMouseLeave={(e) => changeBackground(e)}
            >
                {t('Login')}
            </button>
        </div>
    );

    let checkoutLogin;
    if (checkoutLoggedIn || (socialLoginTag && userLoggedIn)) {
        checkoutLogin = true;
    }

    return (
        <div
            className={`user-section-wrapper big-box ${button === 'login' || checkoutLogin ? 'user' : 'guest'} ${shippingAddressCompleted ? 'not-display' : ''}`}
        >
            {!userLoggedIn ? userSectionHeader : '' }
            {button === 'login' ? <LoginForm/> : '' }
            {checkoutLogin ? <SuccessMessage/> : ''}
        </div>
    );
};

export default UserSection;
