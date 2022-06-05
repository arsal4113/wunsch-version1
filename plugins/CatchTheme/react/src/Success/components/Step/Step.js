import React from 'react';
import {useTranslation} from 'react-i18next';

import './Step.scss';

const Step = () => {
    const {t} = useTranslation('success');
    return (
        <div className="step-wrapper">
            <div className="step finished">
                <span className="step-name">{t('steps.cart')}</span>
            </div>
            <div className="step-connector">
                <hr/>
            </div>
            <div className="step">
                <span className="step-name">{t('steps.delivery')}</span>
            </div>
            <div className="step-connector">
                <hr/>
            </div>
            <div className="step">
                <span className="step-name">{t('steps.payment')}</span>
            </div>
            <div className="step-connector">
                <hr/>
            </div>
            <div className="step">
                <span className="step-name desktop">{t('steps.complete')}</span>
                <span className="step-name mobile">{t('steps.complete_mobile')}</span>
            </div>
            <div className="step-connector">
                <hr/>
            </div>
            <div className="step final">
                <span className="index">5</span>
                <span className="step-name">{t('steps.done')}</span>
            </div>
        </div>
    );
};

export default Step;
