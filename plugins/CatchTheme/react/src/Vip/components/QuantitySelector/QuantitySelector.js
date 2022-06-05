import React from 'react';
import {useDispatch, useSelector} from 'react-redux';
import {updateItemQuantity} from '../../redux/items/items.actions';
import {useTranslation} from "react-i18next";
import minus from '../../assets/minus.svg';
import plus from '../../assets/plus.svg';

import './QuantitySelector.scss';

const QuantitySelector = () => {
    const {t} = useTranslation('vip');
    const {itemQuantity, maxItemQuantity} = useSelector((state) => state.items);
    const dispatch = useDispatch();
    const changeQuantity = (amount) => {
        if ((amount === 1 && itemQuantity >= maxItemQuantity)
            || (amount === -1 && itemQuantity <= 1)) return;
        dispatch(updateItemQuantity(itemQuantity + amount));
    };
    return (
        <div className="selector-wrapper">
            <label>{t('Amount')}</label>
            <div className="quantity-selector">
                <div className="quantity minus" onClick={() => changeQuantity(-1)}>
                    <img src={minus} alt="minus"/>
                </div>
                <span className="quantity number">{itemQuantity}</span>
                <div className="quantity plus" onClick={() => changeQuantity(1)}>
                    <img src={plus} alt="plus"/>
                </div>
            </div>
        </div>
    );
};

export default QuantitySelector;