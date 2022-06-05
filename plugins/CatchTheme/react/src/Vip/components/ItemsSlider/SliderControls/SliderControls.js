import React from 'react';

import './SliderControls.scss';

const SliderControls = (props) => {
    const {
        prev,
        next,
        darkMode,
        disablePrev
    } = props;
    console.log('disable prev', disablePrev);
    return (
        <div className={["slider-controls", darkMode ? " dark" : ""].join('')}>
            <span className={["control prev", disablePrev ? " disabled" : ""].join('')} onClick={prev}/>
            <span className="control next" onClick={next}/>
        </div>
    );
};

export default SliderControls;
