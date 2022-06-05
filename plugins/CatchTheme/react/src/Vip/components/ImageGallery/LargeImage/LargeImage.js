import React, {useState} from 'react';
import WishlistFlag from "../../WishlistFlag/WishlistFlag";
import ImageSlider from "../../ImageSlider/ImageSlider";
import {useSelector} from "react-redux";

import './LargeImage.scss';

const LargeImage = (props) => {
    const {
        largeImage,
        imageIndex,
        nextImage,
        prevImage,
        imageLength
    } = props;
    const isMobile = useSelector((state) => state.device.mobileDevice);
    const isTablet = useSelector((state) => state.device.tabletDevice);
    const showSliderButtons = imageLength !== 1;
    const bg = 'center';
    const [backgroundPosition, setBackgroundPosition] = useState(bg);
    let zoomStyle = {
        backgroundPosition: backgroundPosition,
        backgroundImage: `url(${largeImage})`
    };

    const handleMouseMove = e => {
        if (isMobile || isTablet)
            return;
        const { left, top, width, height } = e.target.getBoundingClientRect();
        const x = (e.pageX - left) / width * 100;
        const y = (e.pageY - top) / height * 100;
        setBackgroundPosition(`${x}% ${y}%`);
    };
    const handleMouseOut = () => {
        setBackgroundPosition(`center`);
    };
    return (
        <div className="large-image">
            <div className="large-image-wrapper" onMouseMove={handleMouseMove} onMouseOut={handleMouseOut} style={zoomStyle}/>
            <WishlistFlag/>
            <div className="image-counter"><span>{imageIndex}</span></div>
            <ImageSlider nextImage={nextImage} prevImage={prevImage} showSliderButtons={showSliderButtons}/>
        </div>
    );
};

export default LargeImage;
