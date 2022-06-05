import React, {useState} from 'react';
import {useSwipeable} from 'react-swipeable';
import {useSelector} from 'react-redux';
import LargeImage from '../ImageGallery/LargeImage/LargeImage';
import SmallImageSlider from '../ImageGallery/SmallImageSlider/SmallImageSlider';

import './MobileImageGallery.scss';

const MobileImageGallery = (props) => {
    const { imageList, variantIndex } = props;
    const [imageListIndex, setImageListIndex] = useState({
        selected: 0
    });
    const [updateImageIndex, setUpdateImageIndex] = useState( {
        update: true
    });
    const [variant, setVariant] = useState( {
        index: 0
    });

    let swiped = false;
    const largeImage = imageListIndex.selected;
    if (variant.index !== variantIndex) {
        setVariant({index: variantIndex});
        setUpdateImageIndex({update: true});
        swiped = false;
    }
    if (variantIndex !== largeImage && !swiped && updateImageIndex.update === true) {
        setImageListIndex({
            selected: variantIndex
        });
    }

    const isTablet = useSelector((state) => state.device.tabletDevice);
    const [imageSlider, setImageSlider] = useState( {
        imageSet: 1
    });
    const selectedImage = imageListIndex.selected;
    const smallImageLength = 5;
    let smallImageSlider = null;


    const handlers = useSwipeable({
        onSwipedLeft: () => swipeLeftHandler(),
        onSwipedRight: () => swipeRightHandler(),
        preventDefaultTouchmoveEvent: true,
        trackMouse: true
    });
    const miniSliderHandlers = useSwipeable({
        onSwipedLeft: () =>  slideHandler('next'),
        onSwipedRight: () =>  slideHandler('prev'),
        preventDefaultTouchmoveEvent: true,
        trackMouse: true
    });
    const swipeLeftHandler = () => {
        setUpdateImageIndex({update: false});
        swiped = true;
        if (selectedImage < imageList.length - 1) {
            setImageListIndex({
                selected: selectedImage + 1
            });
            if (selectedImage !== 0 && (selectedImage + 1) % smallImageLength === 0) {
                slideHandler('next');
            }
        } else {
            if (selectedImage === imageList.length - 1) {
                setImageListIndex({
                    selected: 0
                });
                setImageSlider({
                    imageSet: 1
                });
            }
        }
    };
    const swipeRightHandler = () => {
        setUpdateImageIndex({update: false});
        swiped = true;
        if (selectedImage < imageList.length - 1 && selectedImage > 0) {
            setImageListIndex({
                selected: selectedImage - 1
            });
            if (selectedImage !== 0 && selectedImage % smallImageLength === 0) {
                slideHandler('prev');
            }
        } else {
            if (selectedImage === imageList.length - 1) {
                setImageListIndex({
                    selected: 0
                });
            }
        }
    };

    const slideHandler = (direction, gallery) => {
        setUpdateImageIndex({update: false});
        if (direction === 'prev') {
            if (imageSlider.imageSet > 1) {
                setImageSlider({
                    imageSet: imageSlider.imageSet - 1
                });
                if (gallery === 'mini') {
                    setImageListIndex({
                        selected: (imageSlider.imageSet - 2) * smallImageLength
                    });
                }
            } else {
                setImageSlider({
                    imageSet: 1
                });
            }
        } else {
            if (imageList.length > imageSlider.imageSet * smallImageLength) {
                setImageSlider({
                    imageSet: imageSlider.imageSet + 1
                });
                setImageListIndex({
                    selected: imageSlider.imageSet * smallImageLength
                });
            } else {
                setImageSlider({
                    imageSet: 1
                });
                setImageListIndex({
                    selected: 0
                });
            }
        }
    };

    const imageClickHandler = (index) => {
        setUpdateImageIndex({update: false});
        setImageListIndex({
            selected: index
        });
    };

    const imagesToShow = [];
    if (imageList) {
        imageList.map((image, index) => {
            if ((index >= ((imageSlider.imageSet - 1) * smallImageLength))
                && (index < (imageSlider.imageSet * smallImageLength))) {
                return (
                    imagesToShow.push(image)
                );
            }
        });
    }
    if (isTablet) {
        smallImageSlider = (
            <SmallImageSlider
                imageList={imagesToShow}
                selected={selectedImage}
                prev={() => slideHandler('prev', 'mini')}
                next={() => slideHandler('next')}
                imageClick={(index) => imageClickHandler(index)}
                imageSet={imageSlider.imageSet}
                showControls={imageList.length >= smallImageLength}
            />
        );
    }

    const imageIndex = `${selectedImage + 1} / ${imageList.length}`;

    return (
        <div className="image-gallery">
            <div className="mobile-image-gallery" >
                <div className="swipe-container" {...handlers}/>
                <div className="image-container">
                    <LargeImage
                        largeImage={imageList[selectedImage]}
                        imageIndex={imageIndex}
                        nextImage={swipeLeftHandler}
                        prevImage={swipeRightHandler}
                        imageLength={imageList.length}
                    />
                </div>
            </div>
            <div className="mobil-mini-slider-wrapper" {...miniSliderHandlers}>
                {smallImageSlider}
            </div>
        </div>
    );
};

export default MobileImageGallery;
