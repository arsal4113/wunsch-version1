import React from 'react';

import './Button.scss';

const Button = ({
    disabled, onClick, children, className
}) => (
    <div className={`button ${className || ''}`}>
        <button disabled={disabled} onClick={onClick}>{children}</button>
    </div>
);

export default Button;
