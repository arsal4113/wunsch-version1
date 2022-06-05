import i18n from 'i18next';
import { initReactI18next } from 'react-i18next';

import successDe from './translations/de/success.json';
import successEn from './translations/en/success.json';

import checkoutDe from '../translations/de/checkout.json';
import checkoutEn from '../translations/en/checkout.json';

import commonDe from '../translations/de/common.json';
import commonEn from '../translations/en/common.json';

import errorDe from '../translations/de/error.json';
import errorEn from '../translations/en/error.json';


// the translations
const resources = {
    en: {
        success: successEn,
        checkout: checkoutEn,
        common: commonEn,
        error: errorEn
    },
    de: {
        success: successDe,
        checkout: checkoutDe,
        common: commonDe,
        error: errorDe
    }
};
i18n
    .use(initReactI18next) // passes i18n down to react-i18next
    .init({
        resources,
        lng: 'de',
        interpolation: {
            escapeValue: false // react already safes from xss
        }
    });

export default i18n;
