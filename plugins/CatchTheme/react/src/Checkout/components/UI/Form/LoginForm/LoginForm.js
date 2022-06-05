import React, {useState} from 'react';
import TextInput from '../Input/TextInput/TextInput';
import {useTranslation} from 'react-i18next';
import {loginControls, validateEmail} from '../../../../redux/utility';
import {useDispatch, useSelector} from 'react-redux';
import Button from '../Button/Button';
import Headline from '../../Headlines/Headline';
import SocialLogin from './SocialLogin/SocialLogin';
import {loginUserAsync} from '../../../../redux/loginUser/loginUser.actions';
import Loader from '../../Loader/Loader';
import RegistrationLink from './RegistrationLink/RegistrationLink';
import PasswordLink from './PasswordLink/PasswordLink';

import './LoginForm.scss';

const LoginForm = () => {
    const {t} = useTranslation(['form', 'error', 'common']);
    const dispatch = useDispatch();
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');
    const [emailError, setEmailError] = useState(false);
    const {isFetching, checkoutLoggedIn, error} = useSelector((state) => state.loginUser);
    const userLoggedIn = checkoutLoggedIn || window.userLogedIn;
    const inputs = [];
    const loginError = error ? <p className="error-message">{t('error:' + error.message)}</p> : '';

    const validateForm = () => {
        return email.length > 0 && password.length > 0;
    };

    const changeHandler = (input, e) => {
        const {value} = e.target;
        if (input === 'email') {
            setEmail(value);
            !validateEmail(value) ? setEmailError(t('The provided email address is invalid')) : setEmailError(false);
        } else {
            setPassword(value);
        }
    };
    const loginHandler = (e) => {
        e.preventDefault();
        const loginData = new FormData();
        loginData.append('email', email);
        loginData.append('password', password);
        loginData.append('checkout', '1');
        dispatch(loginUserAsync(loginData));
    };

    Object.keys(loginControls).forEach((loginControl) => {
        inputs.push(
            <TextInput
                key={loginControl}
                name={loginControls[loginControl].name}
                onChange={(e) => {
                    changeHandler(loginControl, e);
                }}
                error={(loginControl === 'email' ? emailError : '')}
                placeholder={t(`login.${loginControls[loginControl].name}`)}
                type={loginControls[loginControl].name}
            />
        );
    });
    const loginFormSection = (
        <form
            onSubmit={(e) => loginHandler(e)}
            className={`login-form ${isFetching ? ' blurred' : ''}`}
        >
            {inputs}
            {loginError}
            <Button disabled={!validateForm()} type="submit">{t('login.saveButton')}</Button>
        </form>
    );

    const loginForm = (
        <div className={`user-section-login ${isFetching ? ' blurred' : ''} ${loginError ? ' error' : ''}` }>
            {isFetching ? <Loader/> : ''}
            <Headline text={t('login.title')}/>
            {loginFormSection}
            <PasswordLink/>
            <SocialLogin/>
            <p>{t('login.registerText')}</p>
            <RegistrationLink/>
        </div>
    );

    return (
        !userLoggedIn  ? loginForm : ''
    );
};

export default LoginForm;
