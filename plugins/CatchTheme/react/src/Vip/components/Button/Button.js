import React from 'react';

import './Button.scss';

const Button = (props) => {
    const {
        disabled,
        className,
        onClick,
        text,
        children
    } = props;
    return (
        <button type="button" disabled={disabled} className={className} onClick={onClick}>
            {text}
            {children}
        </button>
    );
};

export default Button;
