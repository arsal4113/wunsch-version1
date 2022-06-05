import React, {useState} from 'react';

import './ImageGallery.scss';
import LargeImage from './LargeImage/LargeImage';
import SmallImageSlider from './SmallImageSlider/SmallImageSlider';

const ImageGallery = (props) => {
    const {
        imageList,
        variantIndex
    } = props;
    const smallImageLength = 5;
    const [imageListIndex, setImageListIndex] = useState({
        selected: 0
    });
    const [imageSlider, setImageSlider] = useState( {
        imageSet: 1
    });
    const [updateImageIndex, setUpdateImageIndex] = useState( {
        update: true
    });
    const [variant, setVariant] = useState( {
        index: 0
    });
    if (variant.index !== variantIndex) {
        setVariant({index: variantIndex});
        setUpdateImageIndex({update: true});
    }
    if (variantIndex !== undefined && variantIndex !== imageListIndex.selected && updateImageIndex.update === true) {
        setImageListIndex({
            selected: variantIndex
        });
    }
    const imageClickHandler = (index) => {
        setUpdateImageIndex({update: false});
        setImageListIndex({
            selected: index
        });
    };
    const selectedImage = imageListIndex.selected;
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

    const largeImageHandler = (direction) => {
        setUpdateImageIndex({update: false});
        if (direction === 'prev') {
            if (selectedImage < 1)
                return;
            setImageListIndex({
                selected: selectedImage - 1
            });
            if (selectedImage !== 0 && selectedImage % smallImageLength === 0) {
                slideHandler('prev');
            }
        } else {
            if (selectedImage < imageList.length - 1) {
                setImageListIndex({
                    selected: selectedImage + 1
                });
                if (selectedImage !== 0 && (selectedImage + 1) % smallImageLength === 0) {
                    slideHandler('next');
                }
            } else {
                setImageListIndex({
                    selected: 0
                });
                setImageSlider({
                    imageSet: 1
                });
            }
        }
    };

    const imageIndex = `${selectedImage + 1} / ${imageList.length}`;
    return (
        <div className="image-gallery">
            <LargeImage
                largeImage={imageList[selectedImage]}
                imageIndex={imageIndex}
                nextImage={() => largeImageHandler('next')}
                prevImage={() => largeImageHandler('prev')}
                imageLength={imageList.length}
            />
            <SmallImageSlider
                imageList={imagesToShow}
                selected={selectedImage}
                prev={() => slideHandler('prev', 'mini')}
                next={() => slideHandler('next')}
                imageClick={(index) => imageClickHandler(index)}
                imageSet={imageSlider.imageSet}
                showControls={imageList.length >= smallImageLength}
            />
        </div>
    );
};

export default ImageGallery;
