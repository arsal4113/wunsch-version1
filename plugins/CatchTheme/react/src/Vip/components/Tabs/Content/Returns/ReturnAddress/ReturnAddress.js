import React from 'react';
import {useTranslation} from 'react-i18next';

const ReturnAddress = (props) => {
    const {
        returnAddress,
        sellerName,
        contactName,
        email,
        phone
    } = props;
    const {t} = useTranslation('vip');
    const secondAddressLine = returnAddress.address_line_2 ? <span className="return-address-row">{returnAddress.address_line_2}</span> : null;

    return (
        <div className="tab-section return-address">
            <p>
                <span className="return-address-row">{sellerName}</span>
                <span className="return-address-row">{contactName}</span>
                <span className="return-address-row">{returnAddress.address_line_1}</span>
                {secondAddressLine}
                <span className="return-address-row">{returnAddress.postal_code} {returnAddress.city}</span>
            </p>
            <p>
                <span className="return-address-row">{t('E-Mail')}: {email}</span>
                <span className="return-address-row">{t('Telefon')}: {phone}</span>
            </p>
        </div>
    );
};

export default ReturnAddress;
