import React from 'react';
import Input from '../Input';

const TextInput = ({
    placeholder, name, onChange, value, className, error, success, type, hasLoader, required, autoFocus
}) => (
    <Input
        type={type ? type : 'text'}
        placeholder={placeholder}
        name={name}
        onChange={onChange}
        value={value}
        className={className}
        error={error}
        success={success}
        hasLoader={hasLoader}
        required={required}
        autoFocus={autoFocus}
    />
);

export default TextInput;
