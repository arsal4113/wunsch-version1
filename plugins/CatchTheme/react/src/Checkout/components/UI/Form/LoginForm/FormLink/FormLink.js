import React from 'react';

import './FormLink.scss';

const FormLink = (props) => {
    const {
        className,
        text,
        onClick
    } = props;

    return (
        <div className={`link-wrapper ${className}`}>
            <a onClick={onClick}>
                {text}
            </a>
        </div>
    );

};

export default FormLink;
