import React, {useEffect, useRef} from 'react';
import {useSelector, useDispatch} from 'react-redux';
import {useTranslation} from 'react-i18next';
import ImageGallery from '../ImageGallery/ImageGallery';
import ItemInfoBox from '../ItemInfoBox/ItemInfoBox';
import ShortDescription from '../ShortDescription/ShortDescription';
import ShippingOptions from '../ShippingOptions/ShippingOptions';
import ReportLink from '../ReportLink/ReportLink';
import MoreItemsSlider from '../MoreItemsSlider/MoreItemsSlider';
import ItemNav from '../ItemNav/ItemNav';
import Tabs from '../Tabs/Tabs';
import Accordion from '../Accordion/Accordion';
import MobileImageGallery from '../MobileImageGallery/MobileImageGallery';
import {windowResize} from '../../redux/device/device.actions';
import MobileCheckoutPopup from '../MobileCheckoutPopup/MobileCheckoutPopup';
import SimilarItemSection from '../SimilarItemSection/SimilarItemSection';
import Bestsellers from '../Bestsellers/Bestsellers';

import './Vip.scss';

const Vip = (props) => {
    const dispatch = useDispatch();
    const {
        item,
        prevItem,
        nextItem,
        shortDescription,
        shippingDate,
        canonicalLink,
        formAction,
        breadcrumbs,
        similarItems,
        topSoldItems
    } = props;

    console.log('item', item);
    const {t} = useTranslation('vip');
    const itemList = topSoldItems !== undefined ? topSoldItems : similarItems;
    const similarItemsList = similarItems;
    const isMobile = useSelector((state) => state.device.mobileDevice);
    const isTablet = useSelector((state) => state.device.tabletDevice);
    const selectedItemIndex = useSelector((state) => state.items.selectedItemIndex);
    /**
     * get List of configurable attributes keys
     */
    const {configurable_attributes} = item;
    const colorVariants = ['Color', 'Colour', 'Colors', 'Colours', 'Main Color', 'Main Colour', 'Main Colors',
        'Main Colours', 'Frame Colour', 'Farbe', 'Farben', 'FARBE', 'farbe', 'farben', 'FarbeID', 'Haupt farbe', 'Farbe wählen', 'Farbauswahl',
        'Farbe-Color', 'Farbwahl'];
    const pictureChangeVariants = ['Size', 'Width', 'Character', 'Fabric', 'Modell', 'Model', 'Style', 'Art',
        'Motiv', 'Style', 'style', 'Design', 'design', 'Letter', 'kind', 'Select', 'Pattern', 'Fassung', 'fassung', 'Land', 'land',
        'Variante', 'Auswahl', 'Designauswahl', 'Variante wählen', 'Product Shape', 'Paw Patrol', 'Variation'];
    let attributeList = [];
    let validPictureChangeAttribute = null;
    let variantIndex = 0;
    if (configurable_attributes !== undefined) {
        Object.entries(configurable_attributes).map(([attribute]) => (
                attributeList.push(attribute)
            )
        );
        if (attributeList !== []) {
            attributeList.map((attribute) => {
                for (let x = 0; x < colorVariants.length; x++) {
                    if (attribute === colorVariants[x]) {
                        validPictureChangeAttribute = colorVariants[x];
                    }
                }
                for (let x = 0; x < pictureChangeVariants.length; x++) {
                    if (attribute === pictureChangeVariants[x]) {
                        validPictureChangeAttribute = pictureChangeVariants[x];
                    }
                }
            });
        }
    }
    const showMobilePopup = useSelector((state) => state.items.showMobilePopup);
    const allImages = [];
    if (item.items.length > 1) {
        item.items.map((variant) => (
            variant.images.map((image) => allImages.push(image))
        ));
    }
    const variantImages = Array.from(new Set(allImages));
    const imageList = (JSON.stringify(item.images) === JSON.stringify(variantImages)) ? item.images : item.images.concat(variantImages);

    if (validPictureChangeAttribute && selectedItemIndex) {
        if (imageList) {
            imageList.map((image, index) => {
               if (JSON.stringify(image) === JSON.stringify(item.items[selectedItemIndex].images[0])) {
                   variantIndex = index;
               }
            });
        }
    }
    const tabSectionContent = (isMobile) ? <Accordion item={item}/> : <Tabs item={item}/>;

    useEffect(() => {
        const resizer = () => {
            dispatch(windowResize(window.innerWidth, window.innerHeight));
        };
        window.addEventListener('resize', resizer);
        return () => window.removeEventListener(resizer);
    }, []);

    const currentIsMobileValue = useRef();
    currentIsMobileValue.current = isMobile;
    const searchBarHandler = () => {
        const header = $("#header");
        if (window.scrollY > 5 && window.scrollY !== 0) {
            header.addClass("scrolled-down");
        }
        if (window.scrollY === 0) {
            header.removeClass("scrolled-down");
        }
    };
    useEffect(
        () => {
            window.addEventListener('scroll', searchBarHandler);
        },
        [isMobile]
    );

    let topSectionContent = null;
    let mobileCheckoutPopup = null;
    if (isMobile || isTablet) {
        topSectionContent = (
            <div className="item-view-wrapper">
                <MobileImageGallery imageList={imageList} variantIndex={variantIndex}/>
                <ItemInfoBox
                    itemTitle={item.title}
                    itemPrice={item.items[0].price.display_price}
                    itemAttributes={item.configurable_attributes}
                    shippingDate={shippingDate}
                />
            </div>
        );
        if (isMobile) {
            if (showMobilePopup) {
                mobileCheckoutPopup = (<MobileCheckoutPopup/>);
            }
        }
    } else {
        topSectionContent = (
            <div className="item-view-wrapper">
                <ImageGallery imageList={imageList} variantIndex={variantIndex}/>
                <ItemInfoBox
                    itemTitle={item.title}
                    itemPrice={item.items[0].price.display_price}
                    itemAttributes={item.configurable_attributes}
                    shippingDate={shippingDate}
                />
            </div>
        );
    }
    const bestsellerSection = topSoldItems.length
        ? (
            <section className="bestseller-section">
                <Bestsellers/>
            </section>
        ) : null;
    return (
        <div id="vip-content">
            {mobileCheckoutPopup}
            <section className="top-section">
                <ItemNav prev={prevItem} next={nextItem} breadcrumbs={breadcrumbs}/>
                {topSectionContent}
            </section>
            <section className="tab-section">
                <ReportLink url={ebayItem.item_web_url_for_ebay}/>
                {tabSectionContent}
            </section>
            <SimilarItemSection similarItemsList={similarItemsList}/>
            {bestsellerSection}
        </div>
    );
};

export default Vip;
