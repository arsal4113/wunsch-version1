import React from 'react';
import { useTranslation } from 'react-i18next';
import './ChangeButton.scss';

const ChangeButton = ({ onClick }) => {
    const { t } = useTranslation('common');
    return (
        <span className="change-button" onClick={onClick}>{t('common:change')}</span>
    );
};

export default ChangeButton;
