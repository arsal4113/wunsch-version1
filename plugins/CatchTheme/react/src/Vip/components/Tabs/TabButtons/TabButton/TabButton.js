import React from 'react';
import Button from '../../../Button/Button';

import './TabButton.scss';

const TabButton = (props) => {
    const {
        className,
        text,
        onClick
    } = props;

    return (
        <Button
            text={text}
            onClick={onClick}
            className={className}
        />
    );
};

export default TabButton;
