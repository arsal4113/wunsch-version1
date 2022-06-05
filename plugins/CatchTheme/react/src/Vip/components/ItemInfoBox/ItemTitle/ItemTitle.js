import React from 'react';

import './ItemTitle.scss';

const ItemTitle = (props) => {
    const {itemTitle} = props;
    return (
        <div className="text-wrapper">
            <h1 className="item-title">{itemTitle}</h1>
        </div>
    );
};

export default ItemTitle;
