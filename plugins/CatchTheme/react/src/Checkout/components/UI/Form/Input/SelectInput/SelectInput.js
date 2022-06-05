import React from 'react';
import { useTranslation } from 'react-i18next';

import '../Input.scss';
import './SelectInput.scss';

const SelectInput = ({
    error, options, value, name, className, disabled, onChange, required
}) => {
    const { t } = useTranslation(['error', 'checkout']);
    const errors = [];
    if (error) {
        Object.keys(error).forEach((errorKey) => {
            errors.push(<span className="error-message">{t(error[errorKey])}</span>);
        });
    }
    let errorClass;
    if (errors.length) {
        errorClass = 'error';
    }
    const selectOptions = [];
    Object.keys(options).forEach((key) => {
        selectOptions.push(
            <option key={key} value={key}>{t(`checkout:country.${options[key]}`)}</option>
        );
    });
    return (
        <div className={['input', 'select', `input-${name}`, className, errorClass].join(' ')}>
            {errors}
            <select disabled={disabled} onChange={onChange} defaultValue={value} name={name} required={required}>
                {selectOptions}
            </select>
        </div>
    );
};

export default SelectInput;
