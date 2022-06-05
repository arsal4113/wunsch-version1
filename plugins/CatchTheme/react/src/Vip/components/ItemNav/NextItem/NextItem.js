import React from 'react';
import './NextItem.scss';

const NextItem = (props) => {
    const {
        nextItem,
        displayText,
        className
    } = props;

    return (
        <a href={nextItem} className={["next-item-link", className ].join(' ')}>{displayText}</a>
    );
};
export default NextItem;
