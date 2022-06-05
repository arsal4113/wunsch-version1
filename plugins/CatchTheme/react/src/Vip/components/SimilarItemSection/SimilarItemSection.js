import React from 'react';
import {useTranslation} from "react-i18next";
import SimilarItemsSlider from '../SimilarItemsSlider/SimilarItemsSlider';

import './SimilarItemsSection.scss'

const SimilarItemSection = (props) => {
    const {t} = useTranslation('vip');
    const { similarItemsList } = props;
    return (
        <section className="similar-items-section">
            <SimilarItemsSlider
                itemsList={similarItemsList}
                headlineText={t('Similar Products')}
                showItemPrice={true}
            />
        </section>
    );
};

export default SimilarItemSection;
