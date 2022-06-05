import React, {useState} from 'react';
import {useTranslation} from 'react-i18next';

import './ReturnInstructions.scss';

const ReturnInstructions = (props) => {
    const {returnInstructions} = props;
    const {t} = useTranslation('vip');
    const [toggleLink, setToggleLink] = useState({
        clicked: false
    });
    const toggleHandler = () => {
        if (toggleLink.clicked) {
            setToggleLink({
                clicked: false
            });
        }  else {
            setToggleLink({
                clicked: true
            });
        }
    };
    const toggleText = (toggleLink.clicked) ? (
        <div className="toggle-text">
            <span>{t('Rücknahmen werden im folgenden Zeitraum akzeptiert')}: {returnInstructions.return_period.value} {t(returnInstructions.return_period.unit)}</span><br/>
            <span>{t('Die Kosten der Rücknahme werden entrichtet durch')}: {t(returnInstructions.return_shipping_cost_payer)}</span><br/>
            <span dangerouslySetInnerHTML={{__html: returnInstructions.return_instructions}}/>
        </div>
    ) : null;
    return (
        <div className="tab-link return-instructions">
            <div className="toggle-link"><span onClick={toggleHandler}>{t('Vollständige Widerrufsbelehrung')}</span></div>
            {toggleText}
        </div>
    );
};

export default ReturnInstructions;
