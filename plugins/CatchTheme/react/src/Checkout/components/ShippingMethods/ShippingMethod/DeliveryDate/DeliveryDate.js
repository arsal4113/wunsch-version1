import React from 'react';

const DeliveryDate = (props) => {
    let estimatedDeliveryDate = null;
    if (props.minDeliveryDate && props.maxDeliveryDate) {
        const minDate = new Date(props.minDeliveryDate);
        const maxDate = new Date(props.maxDeliveryDate);
        const minDay = minDate.toLocaleString('de-DE', {
            day: '2-digit'
        });
        const minMonth = minDate.toLocaleString('de-DE', {
            month: 'short'
        });
        if (props.minDeliveryDate !== props.maxDeliveryDate) {
            const maxDay = maxDate.toLocaleString('de-DE', {
                day: '2-digit'
            });
            const maxMonth = maxDate.toLocaleString('de-DE', {
                month: 'short'
            });

            if (minMonth !== maxMonth) {
                estimatedDeliveryDate = ` ${minDay}. ${minMonth}-${maxDay}. ${maxMonth}`;
            } else {
                estimatedDeliveryDate = ` ${minDay}.-${maxDay}. ${maxMonth}`;
            }
        } else {
            estimatedDeliveryDate = ` ${minDay}. ${minMonth}`;
        }
        estimatedDeliveryDate = (
            <span className="small-info">
                {estimatedDeliveryDate}
            </span>
        );
    }
    return estimatedDeliveryDate;
};

export default DeliveryDate;
