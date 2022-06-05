import React from 'react';
import {useSelector} from "react-redux";

import './ImageSlider.scss';

const ImageSlider = (props) => {
    const {
        nextImage,
        prevImage,
        showSliderButtons
    } = props;
    const isMobile = useSelector((state) => state.device.mobileDevice);
    if (!showSliderButtons || isMobile)
        return null;
    return (
        <div className="large-image-slider">
            <div className="slider-controls">
                <span className="controller prev" onClick={prevImage}/>
                <span className="controller next" onClick={nextImage}/>
            </div>
        </div>
    );
};

export default ImageSlider;