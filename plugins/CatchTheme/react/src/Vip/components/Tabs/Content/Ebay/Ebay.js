import React from 'react';
import {useTranslation} from 'react-i18next';
import ebayGuarantee from '../../../../assets/icon_guarantee_retina.png';
import ebayMoneyBack from '../../../../assets/ebay-money-back.svg';

import './Ebay.scss';

const Ebay = () => {
    const {t} = useTranslation('vip');
  return (
      <div className="tab-content ebay-protection">
          <div className="ebay-guarantee">
              <img src={ebayGuarantee} alt={t('eBay-Garantie icon')}/>
              <span>{t('eBay-Garantie')}</span>
          </div>
          <div className="tab-link">
              <a
                  href="https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338694004&customid=&mpre=https%3A%2F%2Fpages.ebay.de%2Feinkaufen%2Febay-garantie.html%23Garantiebedingungen"
                  target="_blank"
              >
                  {t('Garantiebedingungen')}
              </a>
          </div>
          <div className="ebay-money-back">
              <img src={ebayMoneyBack} alt={t('eBay Käuferschutz')}/><br/>
              <p><span>Bei Bezahlung mit PayPal, Lastschrift oder Kreditkarte.</span></p>
              <div className="tab-link">
                  <a
                      href="https://rover.ebay.com/rover/1/707-53477-19255-0/1?ff3=4&pub=5575585699&toolid=10001&campid=5338696426&customid=&mpre=https%3A%2F%2Fpages.ebay.de%2Feinkaufen%2Febay-kaeuferschutz.html"
                      target="_blank"
                  >
                      {t('Weitere Details')}
                  </a>
              </div>
          </div>
      </div>
  );
};

export default Ebay;
