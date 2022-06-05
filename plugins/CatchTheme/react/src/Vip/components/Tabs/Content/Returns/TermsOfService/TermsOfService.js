import React, {useState} from 'react';
import {useTranslation} from 'react-i18next';

const TermsOfService = (props) => {
    const {legal} = props;
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
            <span dangerouslySetInnerHTML={{__html: legal}} />
        </div>
    ) : null;

    return (
        <div className="tab-link terms-of-service">
            <div className="toggle-link"><span onClick={toggleHandler}>{t('Allgemeine Geschäftsbedingungen für dieses Angebot')}</span></div>
            {toggleText}
        </div>
    );
};

export default TermsOfService;
