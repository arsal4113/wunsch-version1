import React from 'react';
import {useTranslation} from 'react-i18next';

const VatDetails = (props) => {
    const {
        vat,
        registrationNumber
    } = props;
    const {t} = useTranslation('vip');

    return (
        <div className="tab-section vat-details">
            <p>
                <span>{t('Handelsregisternummer')}: {registrationNumber}</span>
                <span>{t('Umsatzsteuer-Identifikationsnummer')}: {vat}</span>
            </p>
        </div>
    );
};

export default VatDetails;
