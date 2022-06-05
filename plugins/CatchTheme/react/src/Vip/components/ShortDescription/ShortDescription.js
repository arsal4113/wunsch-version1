import React from 'react';
import {useTranslation} from 'react-i18next';

const ShortDescription = (props) => {
    const {
        shortDescription
    } = props;

    const {t} = useTranslation('vip');

    return (
        <div className="text-box short-description">
            <h3>{t('Beschreibung')}</h3>
            {shortDescription}
        </div>
    );
};

export default ShortDescription;
