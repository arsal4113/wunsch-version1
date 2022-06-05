import React from 'react';
import {useTranslation} from 'react-i18next';

import './ReportLink.scss';

const ReportLink = (props) => {
    const {url} = props;
    const {t} = useTranslation('vip');
    return (
        <div className="report-link-button-wrapper">
            <div className="link-wrapper">
                <a href={url} target="_blank" className="report-item-link">{t('Melden auf eBay')}</a>
            </div>
        </div>
    );
};

export default ReportLink;
