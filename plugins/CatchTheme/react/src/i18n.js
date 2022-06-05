import i18n from 'i18next';
import {initReactI18next} from 'react-i18next';
import HttpApi from 'i18next-http-backend';
import {lng} from './config/app.json';

i18n
    .use(HttpApi)
    .use(initReactI18next) // passes i18n down to react-i18next
    .init({
        lng: lng,
        fallbackLng: [lng],
        interpolation: {
            escapeValue: false // react already safes from xss
        },
        backend: {
            loadPath: '/catch_theme/translations/{{lng}}/{{ns}}.json',
            // eslint-disable-next-line no-undef
            queryStringParams: {v: LANGUAGE_STAMP}
        },
        react: {
            wait: true
        }
    });

export default i18n;
