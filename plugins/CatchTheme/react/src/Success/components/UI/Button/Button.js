import React from 'react';

import './Button.scss';

const Button = ({onClick, label, loading}) => (
    <div className="button-wrapper">
        <button className={loading ? 'hidden' : ''} type="button" onClick={onClick}>{label}</button>
        <div className={`loader${loading ? ' shown' : ''}`}/>
    </div>
);

export default Button;
