import React from 'react';
import SliderControls from '../../ItemsSlider/SliderControls/SliderControls';

import './SmallImageSlider.scss';

const SmallImageSlider = (props) => {
    const {
        imageList,
        selected,
        prev,
        next,
        imageClick,
        imageSet,
        showControls
    } = props;

    let sliderImages = (imageList) ? imageList.map((image, i) => {
        let index = 0;
        if (imageSet === 1 ) {
            index = i;
        } else {
            let l = imageList.length > 4 ? imageList.length : 5;
            index = imageSet * l - (l - i);
        }
        return (
            <div
                className={["small-image-wrapper", index === selected ? " selected" : ""].join('')}
                key={index}
                onClick={() => imageClick(index)}
            >
                <img src={image}/>
            </div>
        );
    }) : null;

    const controls = showControls ? <SliderControls prev={prev} next={next} disablePrev={imageSet === 1}/> : null;

    return (
        <div className="small-image-slider">
            {controls}
            <div className="image-container">
                {sliderImages}
            </div>
        </div>
    );
};

export default SmallImageSlider;
