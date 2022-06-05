import React from 'react';
import { useTranslation } from 'react-i18next';

import './Input.scss';

const Input = ({
    error, success, name, className, type, onChange, value, placeholder, hasLoader, required, autoFocus
}) => {
    const { t } = useTranslation('error');
    let errorMessage;
    let successMessage;
    let input;
    if (error) {
        errorMessage = <p className="error-message">{t(error)}</p>;
    }
    if (success) {
        successMessage = <p className="success-message">{success}</p>;
    }
    const zipLoader = hasLoader ? <div className="zip-loader"/> : '';
    if (required) {
        if (autoFocus) {
            input = (
                <div className="outline-wrapper">
                    <input
                        type={type}
                        onChange={onChange}
                        value={value}
                        name={name}
                        placeholder={placeholder}
                        required={required}
                        autoFocus
                    />
                    <label htmlFor={name}>{placeholder}</label>
                    {zipLoader}
                </div>
            );
        } else {
            input = (
                <div className="outline-wrapper">
                    <input
                        type={type}
                        onChange={onChange}
                        value={value}
                        name={name}
                        placeholder={placeholder}
                        required={required}
                    />
                    <label htmlFor={name}>{placeholder}</label>
                    {zipLoader}
                </div>
            );
        }
    } else {
        input = (
            <div className="outline-wrapper">
                <input
                    type={type}
                    onChange={onChange}
                    value={value}
                    name={name}
                    placeholder={placeholder}
                    className={(value && value.length > 0) ? '' : 'invalid'}
                />
                {zipLoader}
            </div>
        );
    }
    return (
        <div
            className={
                `input input-${name} ${className || ''}${error ? ' error' : ''}${success ? ' success' : ''}`
            }
        >
            {input}
            {errorMessage}
            {successMessage}
        </div>
    );
};

export default Input;
