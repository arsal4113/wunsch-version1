import React from 'react';

import './SmallImage.scss';

const SmallImage = (props) => {
    const { smallImage } = props;

    return (
        <div className="small-image-wrapper">
            <img src={smallImage}/>
        </div>
    );
};

export default SmallImage;
