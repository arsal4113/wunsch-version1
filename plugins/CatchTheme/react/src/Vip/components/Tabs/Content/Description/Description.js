import React from 'react';

import './Description.scss';

const Description = (props) => {
    const {
        item
    } = props;

    return (
        <div className="tab-content description">
            <iframe
                src={`data:text/html; charset=utf-8,${encodeURIComponent(item.description)}`}
                title={item.title}
                sandbox="allow-scripts allow-popups allow-popups-to-escape-sandbox allow-same-origin"
            />
        </div>
    );
};

export default Description;
