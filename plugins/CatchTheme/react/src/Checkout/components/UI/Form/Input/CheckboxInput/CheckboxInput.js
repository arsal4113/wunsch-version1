import React from 'react';

import './CheckboxInput.scss';

const CheckboxInput = ({
    name, className, checked, onClick, disabled, children, value
}) => (
    <div className={`input checkbox ${className}`}>
        <input
            id={`checkbox-${value}`}
            value={value}
            type="radio"
            name={name}
            checked={checked}
            readOnly
            onClick={onClick}
            disabled={disabled}
        />
        <label htmlFor={`checkbox-${value}`} className={checked ? 'checked' : ''}>{children}</label>
    </div>
);

export default CheckboxInput;
