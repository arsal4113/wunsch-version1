import React from 'react';

const View = ({ address }) => (
    <address>
        {address.recipient}
        <br/>
        {address.company || ''}
        {address.company ? <br/> : ''}
        {address.address_line_1}
        <br/>
        {address.address_line_2 || ''}
        {address.address_line_2 ? <br/> : ''}
        {`${address.postal_code} ${address.city}`}
        <br/>
        Deutschland
    </address>
);

export default View;
