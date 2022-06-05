import React from 'react';
import {useTranslation} from 'react-i18next';

import './Address.scss';

const Address = ({ address }) => {
    if (!address) return null;
    const {t} = useTranslation('checkout');
    return (
        <address>
            {address.recipient || ''}
            <br/>
            {address.address_line_1 || ''}
            <br/>
            {address.address_line_2 || ''}
            {address.address_line_2 ? <br/> : ''}
            {`${address.postal_code} ${address.city}`}
            <br/>
            {t('country.Germany')}
        </address>
    );
};

export default Address;
