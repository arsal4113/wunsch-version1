import React from 'react';
import {useSelector} from 'react-redux';
import { useTranslation } from 'react-i18next';

import './Selector.scss';

const Selector = ({options, label, onChange}) => {
    const { t } = useTranslation('vip');
    const singleAvailability = window.optionAvailable;
    const {selectedItemAttributes, error} = useSelector((state) => state.items);
    const attributeAvailability = window.attributeArray;
    const checkAvailability = (arr) => arr.every(Boolean);
    /**
     * check if attributes are available for current selection of attributes
     * and add them to the selector as options
     */
    const selectorOptions = (options) ? options.map((option, i) => {
        let available;
        const attributes = Object.keys(attributeAvailability);
        if (attributes.length < 2) {
            available = singleAvailability[option];
        } else {
            available = [];
            for (const attribute of attributes) {
                if (attribute === label) {
                    continue; // if key is for current selector, ignore
                }
                if (selectedItemAttributes[attribute] === '') {
                    continue; // if the other selector has nothing selected yet
                } else {
                    // add availability to available array
                    available.push(
                        attributeAvailability[attribute][selectedItemAttributes[attribute]][label][option]
                    );
                    // console.log(`${option} (${label}) is for selection ${selectedItemAttributes[attribute]} (${attribute}) ${attributeAvailability[attribute][selectedItemAttributes[attribute]][label][option] ? '' : 'NOT '}available`);
                }
            }
            available = available.length === 0 ? singleAvailability[option] : checkAvailability(available);
        }
        return available ? (<option key={i} value={option}>{option}</option>) : '';
    }) : null;
    const hasError = error && selectedItemAttributes && selectedItemAttributes[label] === '';
    return (
        <select
            id={['attr-', label].join('')}
            title={label}
            className={`selector${hasError ? ' error' : ''}`}
            onChange={onChange}
            value={selectedItemAttributes ? selectedItemAttributes[label] : ''}
        >
            <option key={-1} value="">{t('Please select')}</option>
            {selectorOptions}
        </select>
    );
};

export default Selector;
