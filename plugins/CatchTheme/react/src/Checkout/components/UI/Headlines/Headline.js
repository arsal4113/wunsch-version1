import React from 'react';
import {useTranslation} from 'react-i18next';
import './Headline.scss';

const Headline = ({ text, children, changeFunction }) => {
    const {t} = useTranslation('common');
    return (
        <div className="headline-wrapper">
            <div className="top-container">
                <p className="headline">{text}</p>
                <div className={`change-button${changeFunction ? ' show' : ''}`} onClick={changeFunction}>
                    {t('change')}
                </div>
            </div>
            {children}
        </div>
    );
};

export default Headline;
