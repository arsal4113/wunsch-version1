import React, {useState, useEffect} from 'react';
import {useTranslation} from 'react-i18next';
import {useSelector} from 'react-redux';
import Button from '../Button/Button';

import './InfoBox.scss';


const InfoBox = (props) => {
    const {
        mainText
    } = props;
    const {t} = useTranslation('vip');

    const isMobile = useSelector((state) => state.device.mobileDevice);

    const [scrollPosition, setScrollPosition] = useState({
        scrollY: 0
    });
    const [infoBoxState, setInfoBoxState] = useState({
        expanded: false
    });
    const handleScroll = () => {
        const positionY = window.pageYOffset;
        setScrollPosition({
            scrollY: positionY
        });
    };
    useEffect(() => {
        window.addEventListener('scroll', handleScroll, { passive: true });
        return () => {
            window.removeEventListener('scroll', handleScroll);
        };
    }, []);

    const infoBoxHandler = () => {
        setInfoBoxState({
            expanded: !infoBoxState.expanded
        });
    };

    const buttonClickHandler = () => {
        window.location = "/beliebt";
    };

    let boxContent = null;

    if (infoBoxState.expanded) {
        if (isMobile) {
            boxContent = (
                <div id="what-is-catch" className="info-box expanded" onClick={infoBoxHandler}>
                    <div className="teaser-links">
                        <a href="/">{t('Under 100 €')}</a>
                        <a href="/" target="_blank">{t('eBay Garantie')}</a>
                        <span>{t('kostenloser Versand')}</span>
                    </div>
                    <div className="main-text">{mainText}</div>
                    <Button onClick={buttonClickHandler} className="button yellow">{t('Catch dir deine Welt')}</Button>
                </div>
            );
        } else {
            boxContent = (
                <div id="what-is-catch" className="info-box expanded">
                    <div id="close-button" onClick={infoBoxHandler}/>
                    <div className="teaser-links">
                        <a href="/">{t('Under 100 €')}</a>
                        <a href="/" target="_blank">{t('eBay Garantie')}</a>
                        <span>{t('kostenloser Versand')}</span>
                    </div>
                    <div className="main-text">{mainText}</div>
                    <Button onClick={buttonClickHandler} className="button yellow">{t('Catch dir deine Welt')}</Button>
                </div>
            );
        }
    } else {
        if (isMobile) {
            if (scrollPosition.scrollY > 20) {
                setInfoBoxState({
                    expanded: true
                });
                /*boxContent = (
                    <div id="what-is-catch" className="info-box expanded" onClick={infoBoxHandler}>
                        <div className="teaser-links">
                            <a href="/">{t('Under 100 €')}</a>
                            <a href="/" target="_blank">{t('eBay Garantie')}</a>
                            <span>{t('kostenloser Versand')}</span>
                        </div>
                        <div className="main-text">{mainText}</div>
                        <Button onClick={buttonClickHandler} className="button yellow">{t('Catch dir deine Welt')}</Button>
                    </div>
                );*/
            } else {
                boxContent = (
                    <div id="what-is-catch" className="info-box" onClick={infoBoxHandler}>
                        <div className="teaser-links">
                            <a href="/">{t('Under 100 €')}</a>
                            <a href="https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338694004&customid=&mpre=https%3A%2F%2Fpages.ebay.de%2Feinkaufen%2Febay-garantie.html%23Garantiebedingungen"
                               target="_blank">{t('eBay Garantie')}</a>
                            <span>{t('kostenloser Versand')}</span>
                        </div>
                    </div>
                );
            }
        }
        else {
            boxContent = (
                <div id="what-is-catch" className="info-box">
                    <div className="teaser-links">
                        <a href="/">{t('Under 100 €')}</a>
                        <a href="https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338694004&customid=&mpre=https%3A%2F%2Fpages.ebay.de%2Feinkaufen%2Febay-garantie.html%23Garantiebedingungen"
                           target="_blank">{t('eBay Garantie')}</a>
                        <span>{t('kostenloser Versand')}</span>
                    </div>
                    <div id="expand-button" onClick={infoBoxHandler}/>
                </div>
            );
        }
    }
    return (
        boxContent
    );
};

export default InfoBox;
