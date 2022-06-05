import React from 'react';
import ReturnAddress from './ReturnAddress/ReturnAddress';
import VatDetails from './VatDetails/VatDetails';
import ReturnInstructions from './ReturnInstructions/ReturnInstructions';
import TermsOfService from './TermsOfService/TermsOfService';

import './Returns.scss';
import Imprint from './Imprint/Imprint';

const Returns = (props) => {
    const {
        item
    } = props;

    console.log('return item', item);

    return (
        <div className="tab-content returns">
            <ReturnAddress
                returnAddress={item.seller.legal_info.legal_address}
                sellerName={item.seller.legal_info.name}
                contactName={[item.seller.legal_info.legal_contact_first_name, item.seller.legal_info.legal_contact_last_name].join(' ')}
                email={item.seller.legal_info.email}
                phone={item.seller.legal_info.phone}
            />
            <VatDetails
                vat={[item.seller.legal_info.vat_details.issuing_country, item.seller.legal_info.vat_details.vat_id].join(' ')}
                registrationNumber={item.seller.legal_info.registration_number}
            />
            <Imprint legal={item.seller.legal_info.imprint}/>
            <ReturnInstructions returnInstructions={item.return_terms}/>
            <TermsOfService legal={item.seller.legal_info.terms_of_service}/>
        </div>
    );
};

export default Returns;
